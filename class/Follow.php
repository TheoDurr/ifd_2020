<?php
/**
 * Class used to represent a realation of follow
 */

 class Follow extends Atom{
     private $_followingId, $_followedId;

     public function __construct($data){
        $this->hydrate($data);
     }
     
     // Getters
     public function followingId(): int{return $this->_followingId;}
     public function followedId(): int{return $this->_followedId;}
     
     // Setters
     public function setfollowingId(int $id){
         $this->_followingId = $id;
     }
     
     public function setFollowedId(int $id){
         $this->_followedId = $id;
     }
 }