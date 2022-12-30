<?php 
if(!isset($_SESSION)) { 
    session_start(); 
} 
require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';

if (isset($_SESSION["user_id"])) {
    $ip = $_SERVER["REMOTE_ADDR"];
    $url = $_SERVER["REQUEST_URI"];

    $mysqli = SQLRepository::getInstance()->getConnection();
    $stmt = $mysqli->prepare("INSERT INTO accesari (ip, user_id, pagina) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $ip, $_SESSION["user_id"], $url);

    $stmt->execute();
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="apple-touch-icon" sizes="180x180" href="./assets/ico/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="./assets/ico/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="./assets/ico/favicon-16x16.png">
<link rel="manifest" href="/assets/ico/site.webmanifest">
<link rel="mask-icon" href="/assets/ico/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/nav.css">
<link rel="stylesheet" href="/assets/css/print.css" media="print">
<link rel="stylesheet" href="/assets/css/nav-500.css" type="text/css" media="screen and (max-width:650px)"/>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" href="./assets/css/font-awesome.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<script src="/assets/js/jquery-3.6.1.min.js"></script>
<script src="/assets/js/tema.js"></script>
<script src="/assets/js/print.js"></script>
<script src="/assets/js/cookies.js"></script>