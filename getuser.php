<?php

header('Content-type: application/json; charset=utf-8');

// Start the session
session_start();
  
echo ($_SESSION['username']);
    
?>

