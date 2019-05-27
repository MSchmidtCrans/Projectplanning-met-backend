<?php

header('Content-type: application/json; charset=utf-8');

$servername = "localhost";
$username = "phpdb";
$password = "wachtwoord";

$myJson=$_POST['jsonObj'];
$user = json_decode($myJson);



try {
    //connect to DB
    $conn = new PDO("mysql:host=$servername;dbname=usercheck", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Prepare and execute mysql query
    $adressquery = $conn->prepare("SELECT * FROM users WHERE username='$user->username'");
    $adressquery->execute();

    //Set array to receive record
    $userFound = array();
    
    //Loop through all rows from table
    foreach($adressquery as $item) {   

    //Add user array
    $userFound = $item;
    }

    

    //Sent array as JSON
    echo json_encode($userFound);

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();

}

$conn = null;

?>