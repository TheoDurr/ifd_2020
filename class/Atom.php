<?php
/**
 * Atom is the base class for all other classes such as user, game, category, etc...
 */
abstract class Atom {

    /**
     * Hydration function
     *
     * @param array $data
     * @return void
     */
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method) && isset($value)){
                $this->$method($value);
            }
        }
    }

    /**
     * Return object attributes in an array
     *
     * @return array
     */
    public function toArray(bool $returnNullValues = true): array{
        $array = [];
        foreach ((array) $this as $key => $value) {
            $result = explode('_', $key);
            if ($value == null) {
                if ($returnNullValues) {
                    $array[$result[1]] = $value;
                }
            } else {
                $array[$result[1]] = $value;
            }
        }
        return $array;
    }
}