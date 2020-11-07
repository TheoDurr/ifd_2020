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

        $q->bindValue(':name', $e->name(), PDO::PARAM_STR);

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
            foreach ($array as $key => $value) {
                if(strpos($value, "%" === false)){
                    $s = $s . $key . " = :" . $key;
                } else {
                    $s = $s . $key . " LIKE :" . $key;
                }
                if ($i != count($array) - 1) {
                    $s = $s . ", ";
                }
                $i++;
            }

            $q = $this->_db->prepare($s);
            $q->execute($array);
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM editor');
        }
        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Editor($data);
        }
        if(empty($result)){
            return false;
        } else {
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

    /**
     * Return number of entries in database
     *
     * @return void
     */
    public function count(){
        $result = $this->_db->query("SELECT COUNT(*) FROM editor");

        return (int) $result->fetch()[0];
    }
}