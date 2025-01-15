
<?php
include_once "owner home.html";
include "connect database.php";
@session_start();
if(! isset($_SESSION["logged_in"])){
  echo "<script>
      alert('user not logged in');window.location = 'login.php';</script>"; 
  
}
if (isset($_FILES["fileToUpload"]["name"]))
{
$target_dir = "houses/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
}
if (isset($_POST["province"]))
{

  $id = $_SESSION["user_id"];
    
  $add = $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $street = $_POST["street"];
    $code = $_POST["code"];
    $type = strval($_POST["role"]); 
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $rslt = mysqli_query($conn,"SELECT * FROM `house`");
    $num = mysqli_num_rows($rslt) + 1;

    $sql = "INSERT INTO `house` (`ID`,`HOUSENO`, `STREETNAME`, `CITY`, `PROVINCE`, `OWNERID`, `CODE`, `PICTURE`, `PRICE`,`DESCRIPTION`) VALUES ('$num','$add', '$street', '$city', '$province', '$id','$code', '$target_file','$price','$desc');";
    $_SESSION["house_id"] = $num;
    if($type == "full")
    {
      $sql2 = "INSERT INTO `house` (`ID`,`HOUSENO`, `STREETNAME`, `CITY`, `PROVINCE`, `OWNERID`, `CODE`, `PICTURE`, `PRICE`,`DESCRIPTION`) VALUES ('$num','$add', '$street', '$city', '$province', '$id','$code', '$target_file','$price','$desc');";
    
      mysqli_query($conn,$sql2);
      
    
      echo "<script>
      alert('house registration complete!');window.location = 'add pictures.php';</script>"; 
      
    }
    if($type == "single")    {
      mysqli_query($conn,$sql);
      $sql2 = "INSERT INTO `room` (`ROOMTYPE`, `ROOMDESC`, `PRICE`, `HOUSEID`) VALUES ('$type', '$desc', '$price','$num');";
      mysqli_query($conn,$sql2);
      
      echo "<script>
      alert('house registration complete!');window.location = 'add pictures.php';</script>";  
  }
  
}

?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<div class = "content">
 
    <form action="add house.php" method="post" enctype="multipart/form-data">
    <th><h1>add houses</h1></th><br>    
  Select image to upload:
  <input type="file" class= "form-control" name="fileToUpload" id="fileToUpload"><br>
    <td><b>enter the house number:</b></td>
    <td><input type="text" class= "form-control" name="address" id="address" placeholder = "enter house no." required></td><br>
    <td><b>enter province:</b></td>
    <td> <input type="text" class= "form-control" name = "province" placeholder = "enter province" required></td><br>
    <td><b>enter City:</b></td>
    <td><input type="text" class= "form-control" name = "city" placeholder = "enter city" required><br>
    <td><b>enter street name:</b></td>
    <td> <input type="text" class= "form-control" name = "street" placeholder = "street name" required><br>
    <td><b>enter the box code: </b></td>
    <td><input type="text" class= "form-control" name = "code" placeholder = "code here" required><br>
    <td><b>select room type: </b></td>  
    <td>
    <select name="role" class= "form-control" id="" value = "select role">
      <option value="single" id = "single">single room</option>
      <option value="full" id = "full">full house</option>
    </select><br>
    </td>
    <td><b>enter the ROOM DESCRIPTION: </b></td><br>
    <td><input type="text" class= "form-control" name = "desc" placeholder = "desc here"><br>
    <td><b>enter the ROOM/house price: </b></td><br>
    <td><input type="text" class= "form-control" name = "price" placeholder = "price" required><br>
    
    </td>
    <td><button type="submit" class="btn btn-primary">Save changes</button><br>        
    </form>
        
</div>
</body>
<footer>
</footer>
