<?php

class Database {

    private $_host = 'localhost';
    private $_user = 'root';
    private $_pass = '';
    private $_db = 'vms';
    public $connect;

    public function __construct() {
        return self::connection();
    }

    public function connection() {
        $this->connect = mysqli_connect($this->_host, $this->_user, $this->_pass, $this->_db);
        if (!$this->connect) {
            die('Sorry, Database connection is not established');
        } else {
            
        }
    }

}

$database = new Database();
