<?php
/**
 * Manage database connection across all managers
 */

class Manager {

    protected $_db;

    protected function __construct($db){
        $this->setDb($db);
    }

    // Setters
    private function setDb(PDO $db){
        $this->_db = $db;
    }

}