<?php 
// require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';
$query_delete = "delete from accesari where now()-data_accesare >= interval '10 minutes'";
SQLRepository::getInstance()->getConnection()->query($query_delete); 
SQLRepository::getInstance()->closeConnection();
?>