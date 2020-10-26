<?php
/**
 * Class used to manage editors
 */
class EditorManager extends Manager{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Adds an Editor to the database
     *
     * @param Editor $e
     * @return mixed
     */
    public function add(Editor $e){
        $q = $this->_db->prepare('INSERT INTO editor (name) VALUES (:name)');

        $q->bindValue(':content', $e->name(), PDO::PARAM_STR);

        $result = $q->execute();

        return $result;
    }

    /**
     * Deletes an editor
     *
     * @param Editor $e
     * @return mixed
     */
    public function delete(Editor $e){
        $q = $this->_db->prepare('DELETE FROM editor WHERE id = :id');
        $result = $q->execute(array('id' => $e->id()));

        return $result;
    }

    /**
     * Look for a specific editor in the database or return all editors
     *
     * @param Editor $e
     * @return mixed
     */
    public function get(Editor $e = NULL){
        if($e){
            $array = $e->toArray(false);

            $s = "SELECT * FROM editor WHERE ";

            $i = 0;
            foreach($array as $key => $value){
                $s = $s . $key . " = :" . $key;
                if($i != count($array) - 1){
                    $s = $s . ", ";
                }
                $i++;
            }

            $q = $this->_db->prepare($s);
            $q->execute($array);
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if($data){
                return new Editor($data); 
            } else {
                return false;
            }
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM editor');

            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $result[] = new Editor($data);
            }
    
            return $result;
        }
    }

    /**
     * Update the comment with new data
     *
     * @param Editor $e
     * @return mixed
     */
    public function update(Editor $e){
        $q = $this->_db->prepare('UPDATE editor SET name = :name WHERE id = :id');

        $q->bindValue(':name', $e->name(), PDO::PARAM_STR);
        $q->bindValue(':id', $e->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }
}