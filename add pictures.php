
<?php
include_once "owner home.html";
include "connect database.php";
@session_start();
if(! isset($_SESSION["logged_in"])){
    echo "<script>
        alert('user not logged in');window.location = 'login.php';</script>"; 
    
  }
if (isset($_FILES["myFiles"]["name"]))
{
    $dd =  $_SESSION["house_id"];
    $totalfiles = count($_FILES["myFiles"]["name"]);
    $target_dir = "houses/";
    $target_file2 = $target_dir . basename($_FILES["myFile"]["name"]);
    $uploadOk1 = 1;
    $imageFileType1 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
    $sql2 = "UPDATE `house` SET `DOCUMENT` = '$target_file2' WHERE `house`.`ID` = '$dd';";
    if(mysqli_query($conn,$sql2))
    {

for ($i = 0;$i < $totalfiles;$i++)
{
$target_file = $target_dir . basename($_FILES["myFiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


$sql = "INSERT INTO `house pictures` (`HOUSEID`, `PICNAME`) VALUES ('$dd', '$target_file');";
if(mysqli_query($conn,$sql))
{
echo "<script>
      alert('house pictures added!!');window.location ='view houses.php';</script>";
}
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>add house pictures</title>
    <div>
    
    <table>
    <form action="add pictures.php" method="post" enctype="multipart/form-data">
    <tr>
    
    </tr>     
    <tr>
        <td> <b><input type='file' name="myFiles[]" id='upld' multiple>upload pictures here</td> </b>
             </tr>
      
    <tr>
    <td> <b><input type='file' name="myFile" id='upld1'> uplaoad documents here</td> </b>
             </tr>
      
    <tr>

    <td><b><input type="submit" value="upload pictures"><td><b>

    </tr>
    </form>
    </table>
    </div>
</head>
<body>
    
</body>
</html>