<?php
class SQLRepository {
    private static $instance; 

    private $conn; 

    private final function __construct() {
        include(getenv('APP_ROOT_PATH') . '/functions/database/config.php');
        $this->conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME);
        if($this->conn->connect_error) {
            die("Connection to database failed: " . $conn->connect_error);
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new SQLRepository(); 
        }
        return self::$instance; 
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>