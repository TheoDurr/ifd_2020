<?php
/**
 * Class used to manage reviews
 */
class ReviewManager extends Manager{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Adds a review to the database
     *
     * @param Review $r
     * @return mixed
     */
    public function add(Review $r){
        $q = $this->_db->prepare('INSERT INTO review (gameId, score, content, userId)
        VALUES (:gameId, :score, :content, :userId)');

        $q->bindValue(':gameId', $r->gameId(), PDO::PARAM_INT);
        $q->bindValue(':score', $r->score(), PDO::PARAM_INT);
        $q->bindValue(':content', $r->content(), PDO::PARAM_STR);
        $q->bindValue(':userId', $r->userId(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }

    /**
     * Deletes a review
     *
     * @param Review $r
     * @return mixed
     */
    public function delete(Review $r){
        $q = $this->_db->prepare('DELETE FROM review WHERE id = :id');
        $result = $q->execute(array('id' => $r->id()));

        return $result;
    }

    /**
     * Looks for a specific review in the database by its Id
     *
     * @param int $id
     * @return Review or False if there is no occurrence
     */
    public function get(Review $r){
        if($r){
            $array = $r->toArray(false);

            $s = "SELECT * FROM editor WHERE ";

            $i = 0;
            foreach($array as $key => $value){
                $s = $s . $key . " = :" . $key;
                if($i != count($array) - 1){
                    $s = $s . ", ";
                }
                $i++;
            }

            $q = $this->_db->prepare($s);
            $q->execute($array);
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if($data){
                return new Comment($data); 
            } else {
                return false;
            }
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM editor');

            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $result[] = new Comment($data);
            }
    
            return $result;
        }
    }

    /**
     * Update the review with new data
     *
     * @param Review $r
     * @return mixed
     */
    public function update(Review $r){
        $q = $this->_db->prepare('UPDATE review SET score = :score, content = :content WHERE id = :id');

        $q->bindValue(':score', $r->score(), PDO::PARAM_INT);
        $q->bindValue(':content', $r->content(), PDO::PARAM_STR);
        $q->bindValue(':id', $r->id(), PDO::PARAM_INT);

        $result = $q->execute();
        
        return $result;
    }
}