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
    
    /**
     * __construct - Constructor of the class, assign inputs to attributes
     *
     * @param  mixed $dbType
     * @param  mixed $host
     * @param  mixed $dbName
     * @param  mixed $user
     * @param  mixed $pass
     * @return void
     */
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