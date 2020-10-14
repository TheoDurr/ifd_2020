<?php
function autoloader($className){
    require_once 'class/' . $className . '.php';
}