<?php
include_once('config/init.php');

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private static $instance = NULL;
    public $conn;

    private function __construct(){
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

            $this->conn = new PDO($dsn, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn; 
    }

    /* Get Instance */
    public static function getInstance(){
		if(!self::$instance){
			self::$instance = new Database;
		}
		return self::$instance;
    }

    /* Connect */
    public function getConnection(){
        return $this->conn;
    }
}
?>