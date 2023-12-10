<?php
    $sel = '|%82Ad*Oµ9!/?PoX7r';
    $login = $_POST["login"];
    $mdp = hash("sha256",$_POST["password"].$sel);
    
?>