<?php

$gManager = new GameManager($db);
$data['games'] = $gManager->get();

require dirname(__FILE__) . '../../view/games.php';