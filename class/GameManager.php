<?php
/**
 * Class used to manage games
 */
class GameManager extends Manager
{
    /**
     * Db initialization
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        parent::__construct($db);
    }

    /**
     * Add a game to the database
     *
     * @param Game $game
     * @return mixed
     */
    public function add(Game $game)
    {
        $q = $this->_db->prepare('INSERT INTO game (name, editorId, description, img, categoryId, price, playersMin, playersMax, complexity, concentration, ambiance)
        VALUES (:name, :editorId, :description, :img, :categoryId, :price, :playersMin, :playersMax, :complexity, :concentration, :ambiance)');

        $q->bindValue(':name', ucwords($game->name()), PDO::PARAM_STR);
        $q->bindValue(':editorId', $game->editor()->id(), PDO::PARAM_INT);
        $q->bindValue(':description', $game->description(), PDO::PARAM_STR);
        $q->bindValue(':img', $game->img(), PDO::PARAM_STR);
        $q->bindValue(':categoryId', $game->category()->id(), PDO::PARAM_INT);
        $q->bindValue(':price', (string) $game->price(), PDO::PARAM_STR);
        $q->bindValue(':playersMin', $game->playersMin(), PDO::PARAM_INT);
        $q->bindValue(':playersMax', $game->playersMax(), PDO::PARAM_INT);
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
    public function delete(Game $game)
    {
        // Game's reviews deletion (this ensure no orphan review stays in the database)
        $rM = new ReviewManager($this->_db);
        $reviews = $rM->get(new Review(array('gameId' => $game->id())));

        if($reviews){
            foreach($reviews as $r){
                $rM->delete($r);
            }
        }

        // Game deletion
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
    public function get(Game $g = null)
    {
        if ($g) {
            $array = $g->toArray(false);

            $s = "SELECT * FROM game WHERE ";

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
            $q = $this->_db->query('SELECT * FROM game');
        }
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $data['editor'] = $this->getEditor(new Editor(array('id' => $data['editorId'])));
            $data['category'] = $this->getCategory(new Category(array('id' => $data['categoryId'])));
            $data['avgScore'] = $this->getAvgScore(new Game(array('id' => $data['id'])));
            $result[] = new Game($data);
        }
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * Look for a specific game in the database with characteristics between certain intervals. 
     * @param int $id
     * @return mixed
     */
    public function getBetween(array $data)
    {
        if ($data) { // If there is data
            //We prepare the request depending on the data received in parameter  
            $q = $this->_db->prepare('SELECT * FROM game WHERE (price) BETWEEN (:priceMin) AND (:priceMax) 
            AND (playersMin)>=(:playersMin) AND (playersMax)<=(:playersMax);');

            $q->bindValue(':priceMin', $data['priceMin'], PDO::PARAM_INT);
            $q->bindValue(':priceMax', $data['priceMax'], PDO::PARAM_INT);
            $q->bindValue(':playersMin', $data['playersMin'], PDO::PARAM_INT);
            $q->bindValue(':playersMax', $data['playersMax'], PDO::PARAM_INT);
    
            $r = $q->execute(); // we execute the request

            while ($data2= $q->fetch(PDO::FETCH_ASSOC)) { 
            //As long as data is retrieved from the database, it is memorized in the data2 array.
                $data2['editor'] = $this->getEditor(new Editor(array('id' => $data2['editorId'])));
                $data2['category'] = $this->getCategory(new Category(array('id' => $data2['categoryId'])));
                $data2['avgScore'] = $this->getAvgScore(new Game(array('id' => $data2['id'])));
                $result[] = new Game($data2);
                //We create a new object of type game
            }
        }
        if (empty($result)) { // If the array is empty we return false
            return false;
        } else { // if not we return the array
            return $result;
        }
      
    }

    /**
     * Update the game with new data
     *
     * @param Game $r
     * @return mixed
     */
    public function update(Game $game)
    {
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
        $q->bindValue(':complexity', $game->complexity(), PDO::PARAM_INT);
        $q->bindValue(':concentration', $game->concentration(), PDO::PARAM_INT);
        $q->bindValue(':ambiance', $game->ambiance(), PDO::PARAM_INT);

        $q->bindValue(':id', $game->id(), PDO::PARAM_INT);

        $result = $q->execute();

        return $result;
    }

    /**
     * Upload a picture 
     *
     * @param string &($mesErrors)
     * @return void
     */
    public function UploadPicture(string &$mesErrors)
    {
        $target_repo = "C:/xampp/htdocs/ifd_2020/public/img/";
        $target_file = $target_repo . basename($_FILES['image']["name"]);
        $uploadOk = 1;
        $typeImage = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $size=getimagesize($_FILES["image"]["tmp_name"]);

        // We check the file size
        if ($_FILES['image']["size"] > 500000) {
            $mesErrors= "Cette image est trop volumineuse.";
            $uploadOk = 0;
        } elseif ($size[0]!=$size[1]) {
            $uploadOk = 0;
            $mesErrors= "Cette image n'est pas carrée";
        }

        // We check the format file
        elseif ($typeImage != "jpg" && $typeImage != "png" && $typeImage != "jpeg" && $typeImage != "gif") {
            $mesErrors= "Seul le type jpg/png/jpeg/gif sont acceptés";
            $uploadOk = 0;
        }

        // We check if $uploadOk is set to 0 (thus there isn't error)
        if ($uploadOk == 0) {
            // if it's not ok, error messages are written
            $mesErrors=$mesErrors . " / Le téléchargement a échoué";
        
        } 
        else { // if everything is ok, we try to upload the file
            if (move_uploaded_file($_FILES['image']["tmp_name"], $target_file)) {
                $mesErrors=" Le fichier a bien été téléchargé.";
            } else {
                $mesErrors= "Le téléchargement a échoué";
            }
        }
    }

    /**
     * Get the editor by its Id
     *
     * @param Editor $e
     * @return mixed
     */
    private function getEditor(Editor $e)
    {
        $eManager = new EditorManager($this->_db);
        $result = $eManager->get($e);

        return $result[0];
    }

    /**
     * Get the category by its Id
     *
     * @param Categroy $c
     * @return mixed
     */
    private function getCategory(Category $c)
    {
        $cManager = new CategoryManager($this->_db);
        $result = $cManager->get($c);

        return $result[0];
    }
    /**
     * Get the average score of the game
     *
     * @param Game $g
     * @return int
     */
    private function getAvgScore(Game $g)
    {
        $rManager = new ReviewManager($this->_db);
        $result = $rManager->get(new Review(array('gameId' => $g->id())));

        if ($result) {
            $i = 0;
            $score = 0;
            foreach ($result as $review) {
                $score += $review->score();
                $i++;
            }

            return $score/$i;
        } else { // If there is no reviews yet
            return 100;
        }
    }

    /**
     * Return number of entries in database
     *
     * @return int
     */
    public function count(){
        $result = $this->_db->query("SELECT COUNT(*) FROM game");

        return (int) $result->fetch()[0];
    }
}