<?php
/**
 * Class used to manage categories
 */
class FollowManager extends Manager{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Adds a follow to the database
     *
     * @param Follow $f
     * @return mixed
     */
    public function add(Follow $f){
        $q = $this->_db->prepare('INSERT INTO follow (followingId,followedId) VALUES (:followingId,:followedId)');

        $q->bindValue(':followingId', $f->followingId(), PDO::PARAM_STR);
        $q->bindValue(':followedId', $f->followedId(), PDO::PARAM_STR);

        $result = $q->execute();

        return $result;
    }

    /**
     * Deletes a follow
     *
     * @param Follow $f
     * @return mixed
     */
    public function delete(Follow  $f){
        $q = $this->_db->prepare('DELETE FROM follow WHERE followingId = :followingId AND followedId = :followedId');
        $q->bindValue(':followingId', $f->followingId(), PDO::PARAM_STR);
        $q->bindValue(':followedId', $f->followedId(), PDO::PARAM_STR);

        $result = $q->execute();

        return $result;
    }

    /**
     * Look for a specific follow in the database or return all follows
     *
     * @param Follow $f
     * @return mixed
     */
    public function get(Follow $f = NULL){
        if($f){ 
            $array = $f->toArray(false);

            $s = "SELECT * FROM follow WHERE ";

            $i = 0;
            foreach ($array as $key => $value) {
                if(strpos($value, "%" === false)){
                    $s = $s . $key . " = :" . $key;
                } else {
                    $s = $s . $key . " LIKE :" . $key;
                }
                if ($i != count($array) - 1) {
                    $s = $s . " AND ";
                }
                $i++;
            }

            $q = $this->_db->prepare($s);
            $q->execute($array);
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM follow');
        }
        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Follow($data);
        }
        if(empty($result)){
            return false;
        } else {
            return $result;
        }
    }
}