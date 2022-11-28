<?php 
    require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';
    $mysqli = SQLRepository::getInstance()->getConnection();

    $result = $mysqli->query("SELECT * FROM produse");
    $produse = [];
    while($produs = $result->fetch_assoc()) {
        $produse[] = $produs;
    }

    header('Content-Type', 'application/json');
    echo json_encode($produse);
    exit();
?>