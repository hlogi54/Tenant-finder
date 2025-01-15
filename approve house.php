<?php
include "connect database.php";
@session_start();
$id = $_SESSION["house_id"];
$sqll = "UPDATE `house` SET `APPROVED` = 'TRUE' WHERE `house`.`ID` = ";
   while(mysqli_query($conn,$sqll))
   {
    echo "<script>alert('house approved');
    window.location = 'view houses admin.php';
</script>";
   }
 ?>