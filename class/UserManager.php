<?php
/**
 * Class used to manage users
 */
require_once 'manager.php';

class UserManager extends Manager {
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Add an user to the database
     *
     * @param User $user user to add
     * @return void
     */
    public function add(User $user){
        $q = $this->_db->prepare('INSERT INTO user (firstName, lastName, birthDate, email, password) VALUES(:firstName, :lastName, :birthDate, :email, :password)');

        $q->bindValue(':firstName', strtolower($user->firstName()), PDO::PARAM_STR);
        $q->bindValue(':lastName', strtolower($user->lastName()), PDO::PARAM_STR);
        $q->bindValue(':birthDate', $user->birthDate(),PDO::PARAM_STR);
        $q->bindValue(':email', $user->email(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->password(), PDO::PARAM_STR);

        $result = $q->execute();
    }

    /**
     * Delete an user
     *
     * @param User $user user to delete
     * @return void
     */
    public function delete(User $user){
        $q =$this->_db->prepare('DELETE FROM user WHERE id = :id');
        $result = $q->execute(array('id' => $user->id()));
    }

    /**
     * Look for a specific user in the database by its Id
     *
     * @param [int,string] $id
     * @return User or False if there is no occurrence
     */
    public function get($id){
        $q = $this->_db->prepare('SELECT * FROM user WHERE id = :id');
        $q->execute(array('id' => $id));
        
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if($data){
            return new User($data); // Id is unique, so return the first (and the only) occurrence
        } else {
            return false;           // No occurrence
        }
    }

    /**
     * Get the list of users
     *
     * @return array user objects
     */
    public function getList(): array {
        $result = array();
        
        $q = $this->_db->query('SELECT * FROM user ORDER BY firstName, lastName');

        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new User($data);
        }

        return $result;
    }

    public function update(User $user){

    }
}