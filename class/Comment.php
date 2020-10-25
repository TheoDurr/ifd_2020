<?php
/**
 * Class used to represent a comment
 */
class Comment extends Atom{
    private $_id, $_content, $_userId, $_reviewId, $_creationDate;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function id(){return $this->_id;}
    public function content(){return $this->_content;}
    public function userId(){return $this->_userId;}
    public function reviewId(){return $this->_reviewId;}
    public function creationDate(){return $this->_creationDate;}

    // Setter
    public function setId(int $id){
        $this->_id = $id;
    }

    public function setContent(string $content){
        $this->_content = $content;
    }

    public function setUserId(int $id){
        $this->_userId = $id;
    }

    public function setReviewId(int $id){
        $this->_reviewId = $id;
    }

    public function setCreationDate(string $date){
        $this->_creationDate = $date;
    }
}