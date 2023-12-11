<?php
    $sel = '|%82Ad*Oµ9!/?PoX7r';
    $data = json_decode(file_get_contents("../data/user.JSON"),true);
    $username = $_POST["username"];
    $password = hash("sha256",$_POST["password"].$sel);
    $newuser = [
        "username" => $username,
        "password" => $password,
        "lastConnexion" => ""
    ];
    $test = false;
    foreach($data as $elem){
        if($username == $elem["username"]){
            $test = true;
        }
    }
    $test ? header("Location:../registerPage.php?CodeErr=1") : $data[] = $newuser;
    file_put_contents("../data/user.JSON",json_encode($data));
    header("Location:../connexion.php");
?>