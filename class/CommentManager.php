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
     * @return void
     */
    public function delete(Comment $c): void{
        $q = $this->_db->prepare('DELETE FROM review WHERE id = :id');
        $result = $q->execute(array('id' => $c->id()));
    }

    /**
     * Look for a specific comment in the database by its Id
     *
     * @param int $id
     * @return mixed or False if there is no occurrence
     */
    public function get(Comment $comment = NULL){
        if($comment){
            $array = $comment->toArray(false);

            $s = "SELECT * FROM comment WHERE ";

            $i = 0;
            foreach($array as $key => $value){
                $s = $s . $key . " = :" . $key;
                if($i != count($array) - 1){
                    $s = $s . ", ";
                }
                $i++;
            }
            var_dump($s);

            $q = $this->_db->prepare($s);
            $q->execute($array);
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if($data){
                return new Comment($data); // Id is unique, so return the first (and the only) occurrence
            } else {
                return false;           // No occurrence
            }
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM comment ORDER BY creationDate');

            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $result[] = new Comment($data);
            }
    
            return $result;
        }
    }

    /**
     * Update the comment with new data
     *
     * @param Comment $c
     * @return void
     */
    public function update(Comment $c){
        $q = $this->_db->prepare('UPDATE comment SET content = :content WHERE id = :id');

        $q->bindValue(':content', $c->content(), PDO::PARAM_STR);
        $q->bindValue(':id', $c->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }
}