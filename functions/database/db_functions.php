<?php

// require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';

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

function getClientsForUserId($id) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM clienti WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function createClient($user_id, $delivery_address, $invoice_address) {
    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("INSERT INTO clienti (id, adresa_facturare, adresa_livrare) VALUES (?, ?, ?)");
    $stmt->bind_paraim("iss", $user_id, $delivery_address, $invoice_address);
    $stmt->execute();
}

function sendOrder($user_id, $client_id, $delivery_address, $cart, $promotie) {
    // cosul e de forma p1|q1,p2|q2,p3|q3

    $prod_toks = explode(",", $cart);
    foreach ($prod_toks as $prod_tok) {
        $toks = explode("|", $prod_tok);
        $prod_id = (int) $prod_tok[0];
        $prod_q = (int) $prod_tok[1];
    }
}

?>