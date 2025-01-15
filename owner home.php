<?php
include "connect database.php";
include_once "owner home.html";
include_once "welcome owner.php";
@session_start();
if(! isset($_SESSION["logged_in"])){
    echo "<script>
        alert('user not logged in');window.location = 'login.php';</script>"; 
    
  }
?>
