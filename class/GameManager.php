<?php
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
        $q->bindValue(':editorId', $game->editor()->id(), PDO::PARAM_INT);
        $q->bindValue(':description', $game->description(), PDO::PARAM_STR);
        $q->bindValue(':img', $game->img(), PDO::PARAM_STR);
        $q->bindValue(':categoryId', $game->category()->id(), PDO::PARAM_INT);
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
     * Look for a specific game in the database or return all games
     *
     * @param int $id
     * @return mixed
     */
    public function get(Game $g = NULL){
        if($g){
            $array = $g->toArray(false);

            $s = "SELECT * FROM game WHERE ";

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
                $data['editor'] = $this->getEditor(new Editor(array('id' => $data['editorId'])));
                $data['category'] = $this->getCategory(new Category(array('id' => $data['categoryId'])));
                $data['avgScore'] = $this->getAvgScore(new Game(array('id' => $data['id'])));
                return new Game($data); 
            } else {
                return false;
            }
        } else {
            $result = array();
            $q = $this->_db->query('SELECT * FROM game');

            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $data['editor'] = $this->getEditor(new Editor(array('id' => $data['editorId'])));
                $data['category'] = $this->getCategory(new Category(array('id' => $data['categoryId'])));
                $data['avgScore'] = $this->getAvgScore(new Game(array('id' => $data['id'])));
                $result[] = new Game($data);
            }
    
            return $result;
        }
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
        $q->bindValue(':editorId', $game->editor()->id(), PDO::PARAM_INT);
        $q->bindValue(':description', $game->description(), PDO::PARAM_STR);
        $q->bindValue(':img', $game->img(), PDO::PARAM_STR);
        $q->bindValue(':categoryId', $game->category()->id(), PDO::PARAM_INT);
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

    private function getEditor(Editor $e){
        $eManager = new EditorManager($this->_db);
        $result = $eManager->get($e);

        return $result;
    }

    private function getCategory(Category $c){
        $cManager = new CategoryManager($this->_db);
        $result = $cManager->get($c);

        return $result;
    }

    private function getAvgScore(Game $g){
        $rManager = new ReviewManager($this->_db);
        $result = $rManager->get(new Review(array('gameId' => $g->id())));

        if($result){
            $i = 0;
            $score = 0;
            foreach($result as $review){
                $score += $review->score();
                $i++;
            }

            return $score/$i;
        } else {
            return 0;
        }
    }
}