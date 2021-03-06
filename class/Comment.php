<?php
/**
 * Class used to represent a comment
 */
class Comment extends Atom{
    private $_id, $_content, $_userId, $_user, $_reviewId, $_creationDate;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function id(): int{return $this->_id;}
    public function content(): string{return $this->_content;}
    public function userId(): int{return $this->_userId;}
    public function user(): User{return $this->_user;}
    public function reviewId(): int{return $this->_reviewId;}
    public function creationDate(): string{return date('d-m-Y:H.i.s',strtotime($this ->_creationDate));}

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

    public function setUser(user $user){
        $this->_user = $user;
    }

    public function setReviewId(int $id){
        $this->_reviewId = $id;
    }

    public function setCreationDate(string $date){
        $this->_creationDate = $date;
    }
}