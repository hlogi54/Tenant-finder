<?php
include "connect database.php";
include "index.html";
@session_start();
if(! isset($_SESSION["logged_in"])){
  echo "<script>
      alert('user not logged in');window.location = 'login.php';</script>"; 
  
}

?>
 
 <?php
    $loc = $_SESSION["loc"];
    $i = 0;
    $prc = $_SESSION["price"];
    $sql = "SELECT * FROM `house` WHERE `APPROVED` = 'TRUE' AND `CITY` = '$loc'";
    $rslt = mysqli_query($conn,$sql);
    $i = 0;
    $num = mysqli_num_rows($rslt);
    $size = 100/$num;
    while($row = mysqli_fetch_array($rslt))
    {
        $i++;
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
<div class="modal fade" id="exampleModal<?php echo $houseID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">book an appointment to view house</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>
        <?php
         $sql2 = "SELECT * FROM `house pictures` WHERE `HOUSEID` = $houseID";
         $rslt2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_array($rslt2))
        {
          $img2 = $row2["PICNAME"];
          //echo " <img src='$img2' alt='house image' class='img-thumbnail'><br>";
          echo "<div class='responsive'>
          <div class='imgs'>
            <a target='_blank' href='$img2'>
              <img src='$img2' alt='Forest' width='600' height='400'>
            </a>
          </div>
        </div><br><br>";
        }
        ?>
     <form action="search rslt.php" method="post" >

      <section>
     <b> select the dates from available dates </b> <br>  
    
      <select name="viewingDates" id="" value = "dates" required>
      <?php
      $rslt3 = mysqli_query($conn,"SELECT * FROM `viewing date` WHERE `HOUSEID` = $houseID");
      while($row3 = mysqli_fetch_array($rslt3))
      {
        $time = $row3["TIME"];
        $Vdate = $row3["DATE"];
        $Vid = $row3["BOOKINGID"];

        ?>

        <option class = "form-control" value="<?php echo $Vid ?>" id = "view<?php echo $Vid ?>"><?php echo $Vdate." ". $time ?></option>
      <?php
      }
      ?>
    </select>
    </section>
      </p>
  <button type ="submit" class="btn btn-primary" name = "set">book appointment</button>
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
    }
    if (isset($_POST['set']))
    {
     
     
    $hid = $_SESSION["h_id"];
     $userId = $_SESSION["user_id"];
     $bookingID = $_POST['viewingDates'];
     
     $sql4 = "INSERT INTO `appointment` (`USERID`, `OWNERID`, `HOUSEID`, `ROOMID`, `BOOKINGID`) VALUES ( '$userId', '$OWNID', '$houseID', '0', '$bookingID')";
     if(mysqli_query($conn,$sql4))
     {
       //$_SESSION["ADDRESS"] = $addr; 
       ?>
         
         <script>
         alert("appointment booked successfully! <?php echo $i ?>");
           window.location = "view appointments.php";
         </script>

       <?php
     }
   } 
    
  ?>

<style>
div.gallery {
  border: 1px solid #ccc;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: 450px;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 49.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
div.imgs {
  border: 1px solid #ccc;
}

div.imgs:hover {
  border: 1px solid #777;
}

div.imgs img {
  width: 230px;
  height: 230px;
}


</style>