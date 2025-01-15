
<?php
@session_start();
include "index.html";
include "connect database.php";

$house_id = $_SESSION["house_id"];
//$sql = "SELECT * FROM `room` WHERE `HOUSEID` = $house_id";
//$rslt = mysqli_query($conn,$sql);
//$num = mysqli_num_rows($rslt);

    $sql2 = "SELECT * FROM `house pictures` WHERE `HOUSEID` = $house_id";
    $rslt2 = mysqli_query($conn,$sql2);
    
    while($row2 = mysqli_fetch_array($rslt2)){
    ?>
    <img src="<?php echo $row2["PICNAME"] ?>">
    <?php
    }

?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $houseID?>" onclick="return confirm('are you sure you want to edit house number <?php echo $houseID ?>')">
    set viewing appointment
   </button>
