<?php
include "connect database.php";
include "index.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
      $sql3 = "SELECT * FROM `house`";
      $rslt = mysqli_query($conn,$sql3);
      while($row = mysqli_fetch_array($rslt))
      {
        $houseID = $row["ID"];
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal'.$houseID.'">Save changes</button><br>';
        $houseID = $row["ID"];
        $_SESSION["h_id"] = $houseID;
        $img = $row["PICTURE"];
        $desc = $row["DESCRIPTION"];
        $OWNID = $row["OWNERID"];
        $addr = $row["HOUSENO"]." ".$row["STREETNAME"];

    ?>
       <div class="column">
                <div class='responsive'>
          <div class='gallery'>
            <a target='_blank' href='<?php echo $img ?>'>
              <img src='<?php echo $img ?>' alt='Forest' width='600' height='400'>
            </a>
            <b><div class='desc'>PRICE = R<?php echo $row["PRICE"] ?></div></b>
            <b><div class='desc'><?php echo $desc ?></div></b>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?php echo $houseID?>">view house</button><br>
        
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
     
      <form action="no1.php" method="post">
      <input type="text" name = "hey">
      <label for="hey">enter here</label>
      <button  name = "hello">hello</button>
      
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
      
if (isset($_POST["hello"]))
    {
    $sql4 = "INSERT INTO `appointment` (`USERID`, `OWNERID`, `HOUSEID`, `ROOMID`, `BOOKINGID`) VALUES ( '1', '2', '$houseID', '0', '1700')";
    if(mysqli_query($conn,$sql4))
    {
      //$_SESSION["ADDRESS"] = $addr; 
      ?>
        
        <script>
        alert("appointment booked successfully!<?php echo $houseID ?>");
          window.location = "view appointments.php";
        </script><?php
    }
}
      }
    ?>
</body>
</html>