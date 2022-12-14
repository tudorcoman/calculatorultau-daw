<?php
session_start();
require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';
require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';

$user = $_POST["username"];
$parola = $_POST["parola"];
if(!preg_match("/^[A-Za-z0-9]+$/", $user)) {
    die('Eroare la conectare');
}

$mysqli = SQLRepository::getInstance()->getConnection();
$stmt = $mysqli->prepare("SELECT * FROM utilizatori WHERE username = ? AND confirmat_mail=1");

$stmt->bind_param("s", $user);
if($stmt->execute()) {
    $result = $stmt->get_result();
    $line = $result->fetch_assoc();
    if(mysqli_num_rows($result) == 1 && password_verify($parola, $line["parola"])) {
        $_SESSION["user_id"] = $line["id"];
        session_write_close();
        header("Location: /");
        exit();
    } else {
        die('Eroare la conectare');
    }
    
}



?>