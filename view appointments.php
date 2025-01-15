<?php

include "connect database.php";
include "index.html";
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
     $sql3 = "SELECT * FROM `appointment` WHERE `USERID` = '$userid' ";
     $qry = mysqli_query($conn,$sql3);
    
     while( $row = mysqli_fetch_array($qry))
     {
        $houseID = $row["HOUSEID"];
        $viewID = $row["BOOKINGID"];
        $Q2 = mysqli_query($conn,"SELECT * FROM `house` WHERE `ID` = '$houseID' ");
        $row2 = mysqli_fetch_array($Q2);
        $price = $row2["PRICE"];
        $oid = $row["OWNERID"];
        $address = $row2["HOUSENO"]. " " .$row2["STREETNAME"]." ".$row2["CITY"];

        $Q3 = mysqli_query($conn,"SELECT * FROM `user` WHERE `ID` = '$userid' ");
        $row3 = mysqli_fetch_array($Q3);
        $user_name = $row3["NAME"];

        $sql = "SELECT * FROM `viewing date` WHERE `BOOKINGID` = '$viewID'";
        $rslt2 = mysqli_query($conn,$sql);
        while($row2 = mysqli_fetch_array($rslt2))
        {
          $date = $row2["DATE"];
          $dt = date("Y-m-d");
              
     ?>
     <form action="view appointments.php" method="post" onsubmit="return false">
     
     <tr>
      <th scope="row"><?php echo $user_name?></th>
      <td><?php echo $date ?></td>
      <td><?php echo $address?></td>
      <td>
      <?php
      if($date > $dt)
      {
        ?>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $houseID?>">change date</button>
      <?php
      }
      if($date < $dt || $date == $dt)
      {
        ?>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal<?php echo $houseID?>">viewed.</button>
      <a href="houses/TITLE DEEDS_1.pdf" download><button type="button" class="btn btn-secondary" >view lease.</button></a></td>
      <?php
      }
      ?>
    </tr>
   

     </td> 
     </tr>
     </form>
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
      <p>Set the date for the appointment to view the room / house at <?php echo $address ?></p>
  <form action="view appointments.php" method="post">
  <input type="date" name="day" id="day"  class="form-control" required><br>
  <input type="time" name="tme" id="tme"  class="form-control" required><br>    
  <button name="add" class="form-control"  type = 'submit'>Save changes</button>
  
  </Form>
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
        <h5 class="modal-title" id="exampleModalLabel">make payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="view appointments.php" method="post">


          <div class="col-50">
            <h3>Payment</h3>
            
            <b><label for="cname">Name on Card</label></b>
            <input class = "form-control" type="text" id="cname" name="cardname" placeholder="enter your name" required><br>
            <b><label for="ccnum">Credit card number</label></b>
            <input class = "form-control" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required><br>
            <b><label for="expmonth">Exp Month</label></b>
            <input class = "form-control" type="text" id="expmonth" name="expmonth" placeholder="month" required><br>

            <div class="row">
              <div class="col-50">
                <b><label for="expyear"> Exp Year</label></b>
                <input class = "form-control" type="text" id="expyear" name="expyear" placeholder="1900" required><br>
              </div>
              <div class="col-50">
                <b><label for="cvv"> CVV</label></b>
                 <input class = "form-control" type="text" id="cvv" name="cvv" placeholder="000" required>
              </div>
            </div>
          </div>

        </div>
        
        <button class ="btn btn-success" type="submit" name = "pay">Continue to checkout</button>
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
          R <b><?php echo $price ?></b>
        </span>
      </h4>
    </div>
  </div>
</div></p>
</div>

      </div>
      <div class="modal-footer">
       
      
      </div>
    </div>
  </div>
</div>
</div>

<?php

?>
    <?php
 
    }
        }
        if (isset($_POST["pay"]))
{
    $name = $_POST["cardname"];
    $cvv = $_POST["cvv"];
    $cardno = $_POST["cardnumber"];
    $sql = "INSERT INTO `payment` (`CARDNO`, `CVVNO`, `CARDHOLDERNAME`, `HOUSEID`, `ROOMID`,`USERID`, `OWNERID`) VALUES ( '$cardno', '$cvv', '$name', '$houseID', '26','$userid','$houseID');";
    if(mysqli_query($conn,$sql))
    {
      
        $sqll = "UPDATE `house` SET `APPROVED` = 'FALSE' WHERE `house`.`ID` = $houseID";
        if(mysqli_query($conn,$sqll))
          {
      
            echo "<script>alert('house rent paid for');
            window.location = 'thank you page.php';
            </script>";
          }
  
    }
}
      
?>
</table>



</Form>
</body>
</html>


<?php

?>