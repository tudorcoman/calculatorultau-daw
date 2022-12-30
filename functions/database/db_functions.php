<?php

require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';
require_once getenv('APP_ROOT_PATH') . '/functions/factura/index.php';
require_once getenv('APP_ROOT_PATH') . '/functions/email/email.php';

function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function executeQueryFromFile($file) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $query = file_get_contents($file);
    $result = $mysqli->query($query);
    return $result;
}

function getUserInfo($id_user) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM utilizatori WHERE id = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getUsernameResults($username) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM utilizatori WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getClientForUserId($id) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM clienti WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getStocProdus($produs, $depozit) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $query = file_get_contents(getenv('APP_ROOT_PATH') . '/sql/gestiune/get_stoc_depozit.sql');
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $produs, $depozit);
    $stmt->execute(); 
    $result = $stmt->get_result();
    return $result->fetch_assoc()["cantitate"];
}


function getProductName($id) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("SELECT nume FROM produse WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()["nume"];
}

function getProductUnitPrice($id) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("SELECT pret FROM produse WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()["pret"];
}

function createClient($user_id, $delivery_address, $invoice_address) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("INSERT INTO clienti (id, adresa_facturare, adresa_livrare) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $delivery_address, $invoice_address);
    $stmt->execute();
}

function getAccesariReport() {
    return resultFromArray(executeQueryFromFile(getenv('APP_ROOT_PATH') . '/sql/accesari/ip.sql'));
}

function getGestiuneReport() {
    return resultFromArray(executeQueryFromFile(getenv('APP_ROOT_PATH') . '/sql/gestiune/get_all.sql'));
}

function getOnlineUsersReport() {
    return executeQueryFromFile(getenv('APP_ROOT_PATH') . '/sql/accesari/online.sql')->fetch_assoc();
}

function getComenziReport($period) {
    if (strcmp($period, "week") == 0) {
        return resultFromArray(executeQueryFromFile(getenv('APP_ROOT_PATH') . '/sql/comenzi/week.sql'));
    } else if (strcmp($period, "month") == 0) {
        return resultFromArray(executeQueryFromFile(getenv('APP_ROOT_PATH') . '/sql/comenzi/month.sql'));
    } else if (strcmp($period, "day") == 0) {
        return resultFromArray(executeQueryFromFile(getenv('APP_ROOT_PATH') . '/sql/comenzi/day.sql'));
    } else {
        die('Bad parameters');
    }
}

function sendOrder($user_id, $delivery_address, $invoice_address, $cart, $promotie, $depozit_id) {
    // cosul e de forma p1|q1,p2|q2,p3|q3
    
    $client = getClientForUserId($user_id);
    $mysqli = SQLRepository::getInstance()->getConnection();
    if ($client->num_rows == 0) {
        $stmt = $mysqli->prepare("INSERT INTO clienti (id, adresa_facturare, adresa_livrare) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $delivery_address, $invoice_address);
        $stmt->execute();
    } else {
        $client = $client->fetch_assoc();
        if ($client["invoice_address"] != $invoice_address || $client["delivery_address"] != $delivery_address) {
            $stmt = $mysqli->prepare("UPDATE clienti SET adresa_facturare = ? AND adresa_livrare = ? WHERE id = ?");
            $stmt->bind_param("ssi", $invoice_address, $delivery_address, $user_id);
            $stmt->execute();
        }
    }

    $date_str = date("m/d/Y");

    $mysqli->autocommit(FALSE);
    $stmt = $mysqli->prepare("INSERT INTO comenzi (beneficiar, adresa_livrare, cod_promotie, data_comenzii) VALUES (?, ?, ?, SYSDATE())");
    $stmt->bind_param("iss", $user_id, $delivery_address, $promotie);
    $stmt->execute();
    $order_id = $mysqli->insert_id;

    $prod_toks = explode(",", $cart);

    $prod_names = array();
    $prod_qs = array();
    $prod_unit_prices = array();

    foreach ($prod_toks as $prod_tok) {
        $toks = explode("|", $prod_tok);
        $prod_id = (int) $toks[0];
        $prod_q = (int) $toks[1];
        $prod_p = getProductUnitPrice($prod_id);
        if(getStocProdus($prod_id, $depozit_id) < $prod_q) {
            $mysqli->rollback();
            die('Comanda nu poate fi procesata deoarece nu exista suficient stoc');
            return;
        }

        $stmt = $mysqli->prepare("INSERT INTO linie_produs_comanda (id_produs, cantitate, id_comanda, id_depozit, pret_unitar) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $prod_id, $prod_q, $order_id, $depozit_id, $prod_p);
        $stmt->execute();

        $prod_qs[] = $prod_q;
        $prod_names[] = getProductName($prod_id);
        $prod_unit_prices[] = $prod_p; 
    }

    $mysqli->commit();
    $mysqli->autocommit(TRUE);
    $user = getUserInfo($user_id);
    $nume_complet = $user["prenume"] . " " . $user["nume"];

    $pdf = generate_invoice($order_id, $nume_complet, $invoice_address, $prod_names, $prod_qs, $prod_unit_prices, $date_str);

    // trimitere email cu factura
    send_email($user["email"], $nume_complet, "Comanda $order_id", "<p> Comanda ta a fost inregistrata cu succes. Am atasat si factura. </p> <p> Livrarea se va face la $delivery_address in urmatoarele 3-5 zile lucratoare. </p>.", $pdf);
}

?>