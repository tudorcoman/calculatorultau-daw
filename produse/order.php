<?php 
    function validate_address($address) {
        return preg_match("/^[A-Za-z0-9 ,.]+$/", $address);
    }

    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("Location: /inregistrare");
        die();
    }

    if(!validate_address($_POST["livrare"]) || !validate_address($_POST["facturare"])) {
        die('Adresa invalida');
    }

    if(!preg_match("/^[0-9\|0-9,]+$/", $_POST["cos"])) {
        die('Eroare la transmiterea comenzii');
    }

    require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';

    sendOrder($_SESSION["user_id"], $_POST["livrare"], $_POST["facturare"], $_POST["cos"], "", 1);

    header("Location: /");
?>