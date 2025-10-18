<?php

class Database
{
    private $servidor = "localhost";
    private $user = "root";
    private $pass = "abcdef2020";
    private $dbName;
    private $con;

    public function __construct($dbName)
    {
        $this->con = null;
        $this->dbName = $dbName;
        $dsn = "mysql:host=$this->servidor;dbname=$this->dbName";
        $this->con = new PDO($dsn, $this->user, $this->pass);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCon()
    {
        return $this->con;
    }
}
