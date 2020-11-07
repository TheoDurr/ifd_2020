<?php

$stats = array();

// Users
$uM = new UserManager($db);
$stats['users'] = $uM->count();

// Games
$gM = new GameManager($db);
$stats['games'] = $gM->count();

// Reviews
$rM = new ReviewManager($db);
$stats['reviews'] = $rM->count();

// Reviews
$cM = new CommentManager($db);
$stats['comments'] = $cM->count();