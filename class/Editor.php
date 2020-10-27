<?php
/**
 * Class used to represent an editor
 */
class Editor extends Atom{
    private $_id, $_name;

    public function __construct($data){
        $this->hydrate($data);
    }
    
    // Getters
    public function id(): int{return $this->_id;}
    public function name(): string{return $this->_name;}

    // Setters
    public function setId(int $id){
        $this->_id = $id;
    }

    public function setName(string $name){
        $this->_name = $name;
    }
}