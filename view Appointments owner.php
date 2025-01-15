<?php

include "connect database.php";
include "owner home.html";
@session_start();
if(! isset($_SESSION["logged_in"])){
  echo "<script>
      alert('user not logged in');window.location = 'login.php';</script>"; 
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view houses</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<body>
<div>
<table class="table">    
    <th>user id</th>
    <th>date</th>
    <th>address</th>
    <th>action</th>
    
     <?php

     $userid = $_SESSION["user_id"];     
     //$user_name = $_SESSION["username"];
     $sql3 = "SELECT * FROM `appointment` WHERE `OWNERID` = '$userid' ";
     $qry = mysqli_query($conn,$sql3);
    
     while( $row = mysqli_fetch_array($qry))
     {
     
      $user_id = $row["USERID"];
      $Q3 = mysqli_query($conn,"SELECT * FROM `user` WHERE `ID` = '$user_id' ");
        $row3 = mysqli_fetch_array($Q3);
        $user_name = $row3["NAME"];
        $viewID = $row["BOOKINGID"];
        $sql = "SELECT * FROM `viewing date` WHERE `BOOKINGID` = '$viewID'";
        $rslt2 = mysqli_query($conn,$sql);
        while($row2 = mysqli_fetch_array($rslt2))
        {
          $date = $row2["DATE"]; 
          $houseID = $row2["HOUSEID"];
          $Q2 = mysqli_query($conn,"SELECT * FROM `house` WHERE `ID` = '$houseID' ");
        $row2 = mysqli_fetch_array($Q2);
        
        $address = $row2["HOUSENO"]. " " .$row2["STREETNAME"]." ".$row2["CITY"];

     ?>
     <form action="view appointments owner.php" method="post">
     
     <tr>
      <th scope="row"><?php echo $user_name?></th>
      <td><?php echo $date ?></td>
      <td><?php echo $address ?></td>
      <td>
     <button name = 'del' class="btn btn-danger" onclick="return confirm('are you sure <?php echo $price ?>')" >delete appointment</button>
     </td>
    </tr>
      </form>
   
     <?php
        }
      }
      if (isset($_POST['del']))
      {
      
           $sql4 = "DELETE FROM `house` WHERE `ID` = $houseID";
           while (mysqli_query($conn,$sql4))
           {
               ?>
               <script>alert("house deleted");
               window.location = 'owner home.php';
           </script>
           <?php 
           } 
        
      }
?>

