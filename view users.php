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
    <th>user name</th>
    <th>number of houses</th>
    <th>role</th>
    <th>action</th>
    
     <?php
     @session_start();
     $user_id = $_SESSION["user_id"];
     
     
     $sql3 = "SELECT * FROM `user` WHERE `ROLE` = 'tenant' OR `ROLE` = 'owner'";
     $qry = mysqli_query($conn,$sql3);
    
     while( $row = mysqli_fetch_array($qry))
     {
     $ownID = $row["ID"];
     $username = $row["NAME"]." ". $row["SURNAME"];
     $mail = $row["EMAIL"];
     $Q2 = mysqli_query($conn,"SELECT * FROM `house` WHERE `OWNERID` = '$ownID' ");
     $num = mysqli_num_rows($Q2);
     
     //$_SESSION["house_id"] = $houseID;
  
     ?>
     <form action="mailto:someone@gmail.com" method="post">

     <tr>
      <th scope="row"><?php echo $username?></th>
      <td><?php echo $num?></td>
      <td><?php echo $row["ROLE"]?></td>
      <td>
       <button  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ownID?>">
        contact owner
       </button>
       
     </td>
    </tr>
   
     </td> 
     </tr>
    
     
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $ownID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p><b>comment</b></p>
      
<form action="mailto:<?php echo $mail ?>" method="post" enctype="text/plain">
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
 
}
      
        ?>

<?php
        
    ?>

    
</table>



</Form>
</body>
</html>
