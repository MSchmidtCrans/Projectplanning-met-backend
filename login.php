<?php

    // Start the session
    session_start();

header('Content-type: application/json; charset=utf-8');

$myJson=$_POST['jsonObj'];
$dataFields = json_decode($myJson);

$servername = "localhost";
$usernamedb = "phpdb";
$password = "wachtwoord";


try {
    //connect to DB
    $conn = new PDO("mysql:host=$servername;dbname=usercheck", $usernamedb, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Prepare and execute mysql query
    $adressquery = $conn->prepare("SELECT * FROM users WHERE username='" . $dataFields->username . "'");
    $adressquery->execute();

    //Set array to receive record
    $person = array();
    
    //Loop through all rows from table
    foreach($adressquery as $item) {   

    //Add person array
    $person = $item;
    }

    //Set user to true if user exists and password is correct
    if ($person) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $dataFields->username;
    }

    //Sent array as JSON
    echo json_encode($person);

    }

    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>