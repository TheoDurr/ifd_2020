<?php 
/**
 * Class used to represent a reaction
 */
class Reaction extends Atom {
    private $_userId, $_reviewId, $_type;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function userId(): int{return $this->_userId;}
    public function reviewId(): int{return $this->_reviewId;}
    public function type(): int{return $this->_type;}

    // Setters
    public function setUserId(int $id){
        $this->_userId = $id;
    }
    public function setReviewId(int $id){
        $this->_reviewId = $id;
    }
    public function setType(int $type){
        $this->_type = $type;
    }
} 
