<?php
/**
 * Class used to manage reviews
 */
class ReactionManager extends Manager{
    /**
     * Db initialization
     * 
     * @param PDFO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Adds a riveiw to the database
     * 
     * @param Review $r
     * @return mixed
     */
    public function add(Reaction $r){
        $q = $this->_db->prepare('INSERT INTO reaction (userId,reviewId,type) VALUES (:userId, :reviewId, :type)');

        $q->bindValue(':userId',$r->userId(), PDO::PARAM_INT);
        $q->bindValue(':reviewId',$r->reviewId(), PDO::PARAM_INT);
        $q->bindValue(':type',$r->type(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }

    public function delete(Reaction $r){
        $q = $this->_db->prepare('DELETE FROM reaction WHERE userId = :userId AND reviewId = :reviewId');
        $q->bindValue(':userId',$r->userId(), PDO::PARAM_INT);
        $q->bindValue(':reviewId',$r->reviewId(), PDO::PARAM_INT);
        $result = $q->execute();

        return $result;
    }

    /**
     * Looks for a specific reaction in the database by its userId and reviewId
     *
     * @param int $id
     * @return Reaction or False if there is no occurrence
     */
    public function get(Reaction $r = NULL){
        if($r){
            $array = $r->toArray(false);

            $s = "SELECT * FROM reaction WHERE ";

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
            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $result[] = new Reaction($data);
            }

            if(empty($result)){
                return false;
            } else {
                return $result;
            }
            } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM reaction');

            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $result[] = new Reaction($data);
            }
    
            return $result;
        }
    }

    /**
     * Update the reaction with new data
     *
     * @param Reaction $r
     * @return mixed
     */
    public function update(Reaction $r){
        $q = $this->_db->prepare('UPDATE reaction SET type = :type WHERE userId = :userId AND reviewId =:reviewId');

        $q->bindValue(':userId',$r->userId(), PDO::PARAM_INT);
        $q->bindValue(':reviewId',$r->reviewId(), PDO::PARAM_INT);
        $q->bindValue(':type',$r->type(), PDO::PARAM_INT);

        $result = $q->execute();
        
        return $result;
    }
}