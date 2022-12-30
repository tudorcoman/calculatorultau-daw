<?php 
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("Location: /inregistrare");
        die();
    }

    require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';

    sendOrder($_SESSION["user_id"], $_POST["livrare"], $_POST["facturare"], $_POST["cos"], "", 1);

    header("Location: /");
?>