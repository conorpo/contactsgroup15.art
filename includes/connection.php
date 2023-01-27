<?php 
class connection {
    protected static $_instance = null;
    public static function instance() {
        if (!isset(self::$_instance)) {
        self::$_instance = new connection(); 
        } 
    return self::$_instance; 
    }
    public function getconnection(){
        $dbhost = (getenv("DBHOST")  ? getenv("DBHOST") : "localhost");
        $dbuser = (getenv("DBUSER")  ? getenv("DBUSER") : "main");
        $dbpass = (getenv("DBPASS")  ? getenv("DBPASS") : "");
        $dbname = (getenv("DBNAME")  ? getenv("DBNAME") : "prod");
        $conn = null;
        return $conn;

    }
}