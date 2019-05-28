<?php

// Start the session
session_start();
  

header('Content-type: application/json; charset=utf-8');

$myJson=$_POST['jsonObj'];
$dataFields = json_decode($myJson);


$servername = "localhost";
$username = "phpdb";
$password = "wachtwoord";


try {
    //connect to DB
    $conn = new PDO("mysql:host=$servername;dbname=usercheck", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Insert new data to database 
    
    $sql = "INSERT INTO users (username, firstname, lastname, passwrd, mailadress)
    VALUES ('$dataFields->username', '$dataFields->firstname', '$dataFields->lastname', '$dataFields->passwrd', '$dataFields->mailadress')";    
    $conn->exec($sql);

    //Get last inserted record to bounce back to js
    $last_id = $conn->lastInsertId();

    //Prepare and execute mysql query
    $adressquery = $conn->prepare("SELECT * FROM users WHERE id=$last_id");
    $adressquery->execute();

    //Set array to receive record
    $user = array();
    
    //Loop through all rows from table
    foreach($adressquery as $item) {   

    //Add person array
    $user = $item;
    }

    //Sent array as JSON
    echo json_encode($user);
    }

    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>