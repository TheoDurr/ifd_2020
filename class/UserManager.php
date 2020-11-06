<?php
/**
 * Class used to manage users
 */
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
     * @return mixed
     */
    public function add(User $user){
        $q = $this->_db->prepare('INSERT INTO user (firstName, lastName, birthDate, email, password)
        VALUES(:firstName, :lastName, :birthDate, :email, :password)');

        $q->bindValue(':firstName', strtolower($user->firstName()), PDO::PARAM_STR);
        $q->bindValue(':lastName', strtolower($user->lastName()), PDO::PARAM_STR);
        $q->bindValue(':birthDate', $user->birthDate(),PDO::PARAM_STR);
        $q->bindValue(':email', $user->email(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->password(), PDO::PARAM_STR);

        $result = $q->execute();

        return $result;
    }

    /**
     * Delete an user
     *
     * @param User $user user to delete
     * @return mixed
     */
    public function delete(User $user){
        // User's reviews deletion (this ensure no orphan review stays in the database)
        $rM = new ReviewManager($this->_db);
        $reviews = $rM->get(new Review(array('userId' => $user->id())));

        if($reviews){
            foreach($reviews as $r){
                $rM->delete($r);
            }
        }

        // User deletion
        $q =$this->_db->prepare('DELETE FROM user WHERE id = :id');
        $result = $q->execute(array('id' => $user->id()));

        return $result;
    }

    /**
     * Look for a specific user in the database or return all users
     *
     * @param int $id
     * @return mixed
     */
    public function get(User $u = NULL){
        if($u){
            $array = $u->toArray(false);

            $s = "SELECT * FROM user WHERE ";

            $i = 0;
            foreach ($array as $key => $value) {
                if(strpos($value, "%" === false)){
                    $s = $s . $key . " = :" . $key;
                } else {
                    $s = $s . $key . " LIKE :" . $key;
                }
                if ($i != count($array) - 1) {
                    $s = $s . ", ";
                }
                $i++;
            }

            $q = $this->_db->prepare($s);
            $q->execute($array);
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM user');
        }
        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new User($data);
        }
        if(empty($result)){
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Update the user with new data
     *
     * @param User $user new data
     * @return mixed result of the request
     */
    public function update(User $user){
        $q = $this->_db->prepare('UPDATE user SET firstName = :firstName, lastName = :lastName, birthDate = :birthDate, email = :email, password = :password, admin = :admin WHERE id = :id');

        $q->bindValue(':firstName', strtolower($user->firstName()), PDO::PARAM_STR);
        $q->bindValue(':lastName', strtolower($user->lastName()), PDO::PARAM_STR);
        $q->bindValue(':birthDate', $user->birthDate(),PDO::PARAM_STR);
        $q->bindValue(':email', $user->email(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->password(), PDO::PARAM_STR);
        $q->bindValue(':admin', $user->admin(), PDO::PARAM_BOOL);
        $q->bindValue(':id', $user->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }
}