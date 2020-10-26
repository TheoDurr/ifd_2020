<?php
/**
 * Class used to manage comments
 */
class CommentManager extends Manager{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Adds a comment to the database
     *
     * @param Comment $c
     * @return mixed
     */
    public function add(Comment $c){
        $q = $this->_db->prepare('INSERT INTO comment (content, userId, reviewId)
        VALUES (:content, :userId, :reviewId)');

        $q->bindValue(':content', $c->content(), PDO::PARAM_STR);
        $q->bindValue(':userId', $c->userId(), PDO::PARAM_INT);
        $q->bindValue(':reviewId', $c->reviewId(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }

    /**
     * Deletes a comment
     *
     * @param Comment $c
     * @return mixed
     */
    public function delete(Comment $c){
        $q = $this->_db->prepare('DELETE FROM review WHERE id = :id');
        $result = $q->execute(array('id' => $c->id()));

        return $result;
    }

    /**
     * Look for a specific comment in the database or return all comments
     *
     * @param Comment $comment
     * @return mixed
     */
    public function get(Comment $c = NULL){
        if($c){
            $array = $c->toArray(false);

            $s = "SELECT * FROM comment WHERE ";

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
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM comment');
        }
        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Comment($data);
        }
        if(empty($result)){
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Update the comment with new data
     *
     * @param Comment $c
     * @return mixed
     */
    public function update(Comment $c){
        $q = $this->_db->prepare('UPDATE comment SET content = :content WHERE id = :id');

        $q->bindValue(':content', $c->content(), PDO::PARAM_STR);
        $q->bindValue(':id', $c->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }
}