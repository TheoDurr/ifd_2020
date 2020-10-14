<?php
// Atom is the base class for all other classes such as user, game, category, etc...
class Atom {

    /**
     * Hydratation function
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
}