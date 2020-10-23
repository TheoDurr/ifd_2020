<?php
require_once 'manager.php';

/**
 * Class used to manage games
 */
class GameManager extends Manager{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db){
        parent::__construct($db);
    }

    /**
     * Add a game to the database
     *
     * @param Game $game
     * @return mixed
     */
    public function add(Game $game){
        $q = $this->_db->prepare('INSERT INTO game (name, editorId, description, img, categoryId, price, playersMin, playersMax, userId, complexity, concentration, ambiance)
        VALUES (:name, :editorId, :description, :img, :categoryId, :price, :playersMin, :playersMax, :userId, :complexity, :concentration, :ambiance)');

        $q->bindValue(':name', ucwords($game->name()), PDO::PARAM_STR);
        $q->bindValue(':editorId', $game->editorId(), PDO::PARAM_INT);
        $q->bindValue(':description', $game->description(), PDO::PARAM_STR);
        $q->bindValue(':img', $game->img(), PDO::PARAM_STR);
        $q->bindValue(':categoryId', $game->categoryId(), PDO::PARAM_INT);
        $q->bindValue(':price', (string) $game->price(), PDO::PARAM_STR);
        $q->bindValue(':playersMin', $game->playersMin(), PDO::PARAM_INT);
        $q->bindValue(':playersMax', $game->playersMax(), PDO::PARAM_INT);
        $q->bindValue(':userId', $game->userId(), PDO::PARAM_INT);
        $q->bindValue(':complexity', $game->complexity(), PDO::PARAM_INT);
        $q->bindValue(':concentration', $game->concentration(), PDO::PARAM_INT);
        $q->bindValue(':ambiance', $game->ambiance(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }

    /**
     * Delete an user
     *
     * @param Game $game game to delete
     * @return mixed
     */
    public function delete(Game $game){
        $q =$this->_db->prepare('DELETE FROM game WHERE id = :id');
        $result = $q->execute(array('id' => $game->id()));

        return $result;
    }

    /**
     * Look for a specific game in the database by its Id
     *
     * @param int $id
     * @return mixed
     */
    public function get(int $id){
        $q = $this->_db->prepare('SELECT * FROM game WHERE id = :id');
        $q->execute(array('id' => $id));
        
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if($data){
            return new Game($data); // Id is unique, so return the first (and the only) occurrence
        } else {
            return false;           // No occurrence
        }
    }

    /**
     * Get the list of games
     *
     * @return array all entries of the database
     */
    public function getList(): array{
        $result = array();

        $q = $this->_db->query('SELECT * FROM game ORDER BY name');

        while($data = $q->fetch(PDO::FETCH_ASSOC)){
            $result[] = new Game($data);
        }

        return $result;
    }

    public function update(Game $game){
        $q = $this->_db->prepare('
        UPDATE game SET
                name = :name, 
                editorId = :editorId,
                description = :description,
                img = :img,
                categoryId = :categoryId,
                price = :price,
                playersMin = :playersMin,
                playersMax = :playersMax,
                userId = :userId,
                complexity = :complexity,
                concentration = :concentration,
                ambiance = :ambiance
        WHERE id = :id
        ');

        $q->bindValue(':name', ucwords($game->name()), PDO::PARAM_STR);
        $q->bindValue(':editorId', $game->editorId(), PDO::PARAM_INT);
        $q->bindValue(':description', $game->description(), PDO::PARAM_STR);
        $q->bindValue(':img', $game->img(), PDO::PARAM_STR);
        $q->bindValue(':categoryId', $game->categoryId(), PDO::PARAM_INT);
        $q->bindValue(':price', (string) $game->price(), PDO::PARAM_STR);
        $q->bindValue(':playersMin', $game->playersMin(), PDO::PARAM_INT);
        $q->bindValue(':playersMax', $game->playersMax(), PDO::PARAM_INT);
        $q->bindValue(':userId', $game->userId(), PDO::PARAM_INT);
        $q->bindValue(':complexity', $game->complexity(), PDO::PARAM_INT);
        $q->bindValue(':concentration', $game->concentration(), PDO::PARAM_INT);
        $q->bindValue(':ambiance', $game->ambiance(), PDO::PARAM_INT);

        $q->bindValue(':id', $game->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }
}