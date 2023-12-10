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

    print_r($data)."<br><br>";

    foreach($data[0] as $key => $elem){
        echo $key;
        echo $elem["username"];
    }
    
    // $data[] = $newuser;
    // file_put_contents("../data/user.JSON",json_encode($data));
?>