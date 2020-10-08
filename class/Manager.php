<?php
/**
 * Manage database connection accross all managers
 */

class Manager {

    private $dbType;
    private $dbName;
    private $host;
    private $user;
    private $pass;

    public function __construct($dbType, $host, $dbName, $user, $pass){
        $this->$dbType = $dbType;
        $this->$host = $host;
        $this->$dbName = $dbName;
        $this->$user = $user;
        $this->$pass = $pass;
    }
    
    /**
     * connect
     *
     * @return PDO Database object used to do requests to the database
     */
    protected function connect(){
        return new PDO($this->dbType . ':host=' . $this->host . ';dbname=' . $this->dbName . ';charset=utf-8', $this->user, $this->pass);
    }
}