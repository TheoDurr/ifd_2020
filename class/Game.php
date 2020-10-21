<?php
/**
 * Class used to represent a game
 */
class Game extends Atom {
    private $_id, $_name, $_editorId, $_description, $_img, $_categoryId, $_price,
    $_playersMin, $_playersMax, $_userId, $_complexity, $_concentration, $_ambiance;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function id(): int{return $this->_id;}
    public function name(): string{return $this->_name;}
    public function editorId(): int{return $this->_editorId;}
    public function description(): string{return $this->_description;}
    public function img(){return $this->_img;}
    public function categoryId(): int{return $this->_categoryId;}
    public function price(): float{return $this->_price;}
    public function playersMin(): int{return $this->_playersMin;}
    public function playersMax(): int{return $this->_playersMax;}
    public function userId(): int{return $this->_userId;}
    public function complexity(): int{return $this->_complexity;}
    public function concentration(): int{return $this->_concentration;}
    public function ambiance(): int{return $this->_ambiance;}

    // Setters
    public function setId(int $id){
        $this->_id = $id;
    }

    public function setName(string $name){
        if(strlen($name) <= 255){
            $this->_name = $name;
        } else {
            $this->_name = substr($name, 0, 255);
        }
    }

    public function setEditorId(int $id){
        $this->_editorId = $id;
    }

    public function setDescription(string $content){
        $this->_description = $content;
    }

    public function setImg(string $img){
        $this->_img = $img;
    }

    public function setCategoryId(int $id){
        $this->_categoryId = $id;
    }

    public function setPrice(float $price){
        $this->_price = $price;
    }

    public function setPlayersMin(int $number){
        $this->_playersMin = $number;
    }

    public function setPlayersMax(int $number){
        $this->_playersMax = $number;
    }

    public function setUserId(int $id){
        $this->_userId = $id;
    }

    public function setComplexity(int $number){
        $this->_complexity = $number;
    }

    public function setConcentration(int $number){
        $this->_concentration = $number;
    }

    public function setAmbiance(int $number){
        $this->_ambiance = $number;
    }
}