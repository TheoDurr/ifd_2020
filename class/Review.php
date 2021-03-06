<?php
/**
 * Class used to represent a review
 */
class Review extends Atom {
    private $_id, $_gameId, $_score, $_content, $_userId, $_user, $_creationDate, $_totalReaction;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function id(): int{return $this->_id;}
    public function gameId(): int{return $this->_gameId;}
    public function score(): int{return $this->_score;}
    public function content(): string{return $this->_content;}
    public function userId(): int{return $this->_userId;}
    public function user(): User{return $this->_user;}
    public function creationDate(): string{return date('d-m-Y:H.i.s',strtotime($this ->_creationDate));}
    public function totalReaction(): int{return $this->_totalReaction;}

    // Setters
    public function setId(int $id){
        $this->_id = $id;
    }

    public function setGameId(int $id){
        $this->_gameId = $id;
    }

    public function setScore(int $score){
        if($score >= 0 && $score <= 10){
            $this->_score = $score;
        } else {
            throw new Exception("Value exceed range (0-10)");
        }
    }

    public function setContent(string $content){
        $this->_content = $content;
    }

    public function setUserId(int $id){
        $this->_userId = $id;
    }

    public function setUser(User $user){
        $this->_user = $user;
    }

    public function setCreationDate(string $date){
        $this->_creationDate = $date;
    }
    
    public function setTotalReaction(int $totalReaction){
        $this->_totalReaction = $totalReaction;
    }
}