<?php
include "connect database.php";
include "owner home.html";
@session_start();
if(! isset($_SESSION["logged_in"])){
  echo "<script>
      alert('user not logged in');window.location = 'login.php';</script>"; 
  
}

$sql = "SELECT * FROM HOUSE";
$rslt = mysqli_query($conn,$sql);
$num_rows = mysqli_num_rows($rslt);
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
    <th>viewing ID</th>
    <th>location</th>
    <th>time</th>
    <th>date</th>
    <th>action</th>
    
    
     <?php
     @session_start();
     $user_id = $_SESSION["user_id"];
     
     
     $sql3 = "SELECT * FROM `viewing date` WHERE `OWNID` = '$user_id' ";
     $qry = mysqli_query($conn,$sql3);
     
     while( $row = mysqli_fetch_array($qry))
     {
     $viewID = $row["BOOKINGID"];
     $date = $row["DATE"];
     $time = $row["TIME"];
     $houseID= $row["HOUSEID"];
     $Q2 = mysqli_query($conn,"SELECT * FROM `house` WHERE `ID` = '$houseID' ");
        $row2 = mysqli_fetch_array($Q2);

        $address = $row2["HOUSENO"]. " " .$row2["STREETNAME"]." ".$row2["CITY"];
     ?>
     <form action="viewing dates.php" method="post">
     
     <tr>
     <td><?php echo $viewID?></td>
      <th scope="row"><?php echo $address?></th>
      <td><?php echo $time?></td>
      <td><?php echo $date?></td>
      <td>
     
     <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal<?php echo $houseID?>" onclick="return confirm('are you sure you want to edit the date')">
      edit date
     </button>
    </td>
    </tr>
   </a>
     </td> 
     </tr>
     
     

  
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $houseID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>Set the date for the appointment to view the room / house at </p>
  
  <input type="date" name="day" id="day"  class="form-control" required><br>
  <input type="time" name="tme" id="tme"  class="form-control" required><br>    
  <button name="sub" class="form-control"  type = 'submit'>Save changes</button>
  
  </Form>
</div>

      </div>
      <div class="modal-footer">
       
      
      </div>
    </div>
  </div>
</div>
</div>
   <?php
   if (isset($_POST["sub"]))
   {
     $tme = strval($_POST["tme"]);
     $day = strval($_POST["day"]);
     $sql4 = "UPDATE `viewing date` SET `DATE` = '$day', `TIME` = '$tme' WHERE `viewing date`.`BOOKINGID` = $viewID";
     while(mysqli_query($conn,$sql4))
     {
      echo "<script>alert('date altered');
      window.location = 'viewing dates.php';
  </script>";
     }
  }

     
}
?>