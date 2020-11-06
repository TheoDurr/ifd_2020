<?php
/**
 * Class used to manage categories
 */
class CategoryManager extends Manager{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Adds a Category to the database
     *
     * @param Category $c
     * @return mixed
     */
    public function add(Category $c){
        $q = $this->_db->prepare('INSERT INTO editor (name) VALUES (:name)');

        $q->bindValue(':name', $c->name(), PDO::PARAM_STR);

        $result = $q->execute();

        return $result;
    }

    /**
     * Deletes a category
     *
     * @param Category $e
     * @return mixed
     */
    public function delete(Category $e){
        $q = $this->_db->prepare('DELETE FROM category WHERE id = :id');
        $result = $q->execute(array('id' => $e->id()));

        return $result;
    }

    /**
     * Look for a specific category in the database or return all categories
     *
     * @param Category $c
     * @return mixed
     */
    public function get(Category $c = NULL){
        if($c){ 
            $array = $c->toArray(false);

            $s = "SELECT * FROM category WHERE ";

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
            $q = $this->_db->query('SELECT * FROM category');
        }
        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Category($data);
        }
        if(empty($result)){
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Update the category with new data
     *
     * @param Category $c
     * @return mixed
     */
    public function update(Category $c){
        $q = $this->_db->prepare('UPDATE editor SET name = :name WHERE id = :id');

        $q->bindValue(':name', $c->name(), PDO::PARAM_STR);
        $q->bindValue(':id', $c->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }

    /**
     * Return number of entries in database
     *
     * @return void
     */
    public function count(){
        $result = $this->_db->query("SELECT COUNT(*) FROM category");

        return (int) $result->fetch()[0];
    }
}