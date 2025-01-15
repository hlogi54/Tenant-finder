<?php

include "connect database.php";
include "admin.html";
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
    <th>address</th>
    <th>owner name</th>
    <th>price</th>
    <th>action</th>
    
     <?php
     @session_start();
     $user_id = $_SESSION["user_id"];
     
     
     $sql3 = "SELECT * FROM house";
     $qry = mysqli_query($conn,$sql3);
    
     while( $row = mysqli_fetch_array($qry))
     {
     $address = $row["HOUSENO"]." ". $row["STREETNAME"]." ". $row['CITY']; 
     $loc = $row["CITY"];
     $houseID = $row["ID"];
     $price = $row["PRICE"];
     $ownID = $row["OWNERID"];
     $Q2 = mysqli_query($conn,"SELECT * FROM `user` WHERE `ID` = '$ownID' ");
     $row2 = mysqli_fetch_array($Q2);
     $username = $row2["NAME"]." ". $row2["SURNAME"];
     $_SESSION["house_id"] = $houseID;
  
     ?>
     <form action="view houses admin.php" method="post">

     <tr>
      <th scope="row"><?php echo $address?></th>
      <td><?php echo $username?></td>
      <td><?php echo $price?></td>
      <td>
      <?php if($row["APPROVED"] == "TRUE")      
        {
         
          ?> <button name = "decline" class="btn btn-danger" data-toggle="modal" data-target="#Modal2<?php echo $houseID?>">
      decline house
     </button>
          <?php
      
        }
        ?>
       
       <?php
      
       if($row["APPROVED"] == "FALSE" || $row["APPROVED"] == NULL){
        ?>
         
          <button class="btn btn-success" class="btn btn-danger" data-toggle="modal" data-target="#Modal<?php echo $houseID?>" >
        approve house
       </button>
       
       
       <?php
       }
       ?>
       <button  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $houseID?>">
        contact owner
       </button>    
     </td>
    </tr>
   
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
      <p>Set the date for the appointment to view the room / house at <?php echo $loc ." for ". $price?></p>
      <form action="mailto:<?php echo $row2["EMAIL"] ?>" method="post">
  
  <input type="text" name="comment"  class="form-control" required><br>    
  <button name="add" class="form-control"  type = 'submit'>Send</button>
      </form>
  
</div>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</div>

     
<!-- Modal -->
<div class="modal fade" id="Modal<?php echo $houseID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <form action="view houses admin.php" method="post">
      <a href="<?php echo strval($row["DOCUMENT"]) ?>" download>
      view the house documents pending approval
      </a>
      <p><input type="checkbox" name="verified" id="vrfd" required>
       <b><label for="verified">Documents viewed and verified</label></b> 
    
    </p>
      <button name="approve" class="form-control"  type = 'submit'>APPROVE</button>
  </form>
  
</div>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</div>

    
<!-- Modal -->
<div class="modal fade" id="Modal2<?php echo $houseID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>enter reason for declining house</p>
       
<form action="mailto:someone@example.com" method="post" enctype="text/plain">
Name:<br>
<input type="text" name="name"><br>
E-mail:<br>
<input type="text" name="mail"><br>
Comment:<br>
<input type="text" name="comment" size="50"><br><br>
<input type="submit" value="Send">
<input type="reset" value="Reset">
</form>
  
</div>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</div>



     <?php 
 
 if (isset($_POST["approve"]))
 {
   $sqll = "UPDATE `house` SET `APPROVED` = 'TRUE' WHERE `house`.`ID` = $houseID";
   if(mysqli_query($conn,$sqll))
   {
    echo "<script>alert('house approved');
    window.location = 'view houses admin.php';
</script>";
   }
 }
 if (isset($_POST["decline"]))
 {
   $sqll = "UPDATE `house` SET `APPROVED` = 'FALSE' WHERE `house`.`ID` = $houseID";
   if(mysqli_query($conn,$sqll))
   {
    echo "<script>alert('house declined');
    window.location = 'view houses admin.php';
</script>";
   }
 } 
  
}
      
        ?>

<?php
        
    ?>

    
</table>



</Form>
</body>
</html>
