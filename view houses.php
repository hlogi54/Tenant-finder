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
    <th>house ID</th>
    <th>house location</th>
    <th>price</th>
    <th>action</th>
    
     <?php
     @session_start();
     $user_id = $_SESSION["user_id"];
     
     
     $sql3 = "SELECT * FROM house WHERE `OWNERID` = '$user_id'";
     $qry = mysqli_query($conn,$sql3);
    
     while( $row = mysqli_fetch_array($qry))
     {
      $_SESSION["ADDRESS"] = $row["HOUSENO"]." ". $row["STREETNAME"]." ". $row['CITY']; 
     $loc = $row["CITY"];
     $date = date("Y-m-d");
     $houseID = $row["ID"];
     $price = $row["PRICE"];
     ?>
     <form action="view houses.php" method="post">
     
     <tr>
      <th scope="row"><?php echo $houseID?></th>
      <td><?php echo $loc?></td>
      <td><?php echo $price?></td>
      <td>
      
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $houseID?>">
      set date
     </button>
     <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal<?php echo $houseID?>" onclick="return confirm('are you sure you want to edit house number <?php echo $houseID ?>')">
      edit house
     </button>
     <button  name = 'del' class="btn btn-danger"  onclick="return confirm('are you sure <?php echo $price .'and '. $houseID?>')" >delete house</button>
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
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $date?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>Set the date for the appointment to view the room / house at <?php echo $loc ." for ". $price?></p>
  <form action="view houses.php" method="post">
      <input type="date" name="day" id="day"  class="form-control" min = "<?php echo $date ?>" required><br>
  <input type="time" name="tme" id="tme"  class="form-control" min = "09:00" max = "19:00" required><br>    
  <button name="add" class="form-control"  type = 'submit'>Save changes</button>
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
<div class="modal fade" id="myModal<?php echo $houseID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">edit house number <?php echo $price ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>edit house</p>
 <form action="view houses.php" method="post">
  <input type="text" name="price" id="pri"  class="form-control" value="<?php echo $price ?>"><br>
  <input type="file" name="pictures[]" id="pic"  class="form-control" multiple><br>    
  <button name="save" class="form-control"  type = 'submit'>Save changes</button>
  </form>
 
</div>

      </div>
      <div class="modal-footer">
       
      
      </div>
    </div>
  </div>
</div>
</div>
</form>


     <?php
      if (isset($_POST['save']))
  {
    $newPrice = $_POST["price"];
    $sqlst = "UPDATE `house` SET `PRICE` = $newPrice WHERE `house`.`ID` = $houseID";
  while(mysqli_query($conn,$sqlst))
  {
    echo "<script>
    alert('done');window.location ='view houses.php';</script>";

  }
                if (isset($_FILES["pictures"]["name"]))
                {
                
                $dd =  $houseID;
                $desc = $_POST['desc'];
                $totalfiles = count($_FILES["pictures"]["name"]);
                $target_dir = "houses/";
                
                
                for ($i = 0;$i < $totalfiles;$i++)
                {
                $target_file = $target_dir . basename($_FILES["myFiles"]["name"][$i]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


                $sql = "INSERT INTO `house pictures` (`HOUSEID`, `PICNAME`) VALUES ('$dd', '$target_file');";
                mysqli_query($conn,$sql);
                echo "<script>
                      alert('house pictures added!!');window.location ='view houses.php';</script>";
                }
                echo "<script>
                alert('UPDATES COMPLETED');window.location ='view houses.php';</script>";
          
                }

  }
  
  if (isset($_POST['add']))
  {
      $date = strval($_POST["day"]);
      $tme = strval($_POST["tme"]);
      $rsltt = mysqli_query($conn,"SELECT * FROM room WHERE `HOUSEID` = $houseID");
      $room_id = mysqli_num_rows($rsltt);
      $sqlstr = "INSERT INTO `viewing date` (`DATE`, `TIME`, `HOUSEID`, `OWNID`, `ROOMID`) VALUES ('$date', '$tme', '$houseID', '$user_id', '$room_id');";
      if(mysqli_query($conn,$sqlstr))
      {
          ?>
          <script>alert("dates updated");
          window.location = 'view houses.php';
      </script>
      <?php   
      }
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
        <?php

    ?>

    
</table>




</body>
</html>
<?php

?>