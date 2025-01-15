<?php

include "connect database.php";
include "index.html";
@session_start();
if(! isset($_SESSION["logged_in"])){
  echo "<script>
      alert('user not logged in');window.location = 'login.php';</script>"; 
  
}
$sql = "SELECT * FROM `house` WHERE `APPROVED` = 'TRUE'";
$rslt = mysqli_query($conn,$sql);
$rws = mysqli_num_rows($rslt);

?>
<div class="bgimg">
  <div class="topleft">
   
  </div>
  <div class="middle">
    <h1> WELCOME BACK <?php echo $_SESSION["username"] ?> WE CURRENTLY HAVE <?php echo $rws ?> HOUSES <br>
       </h1>
       <h2>
        search by location and / or price.
       </h2>
    <p>
    <form action="search.php" method="post">

        <input type="text" name="location" ><br>
        <label for="location">enter the location</label><br>
        <input type="text" name="price"><br>
        <label for="price">enter the price range</label><br>
        <button type = "submit" class = "btn btn-success" name = "sbmt">search</button>
</form>
    </p>
  </div>
  <div class="bottomleft">
    <p>Some text</p>
  </div>
</div>
<?php
if(isset($_POST["sbmt"]))
{

    $_SESSION["loc"] = $_POST["location"];
    $_SESSION["price"] = $_POST["price"];
    echo "<script>window.location = 'search rslt.php'</script>";
    

}
?>
<style>
/* Set height to 100% for body and html to enable the background image to cover the whole page: */
body, html {
  height: 100%
}

.bgimg {
  /* Background image */
  /* Full-screen */
  height: 100%;
  /* Center the background image */
  background-position: center;
  /* Scale and zoom in the image */
  background-size: cover;
  /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
  position: relative;
  /* Add a white text color to all elements inside the .bgimg container */
  color: black;
  /* Add a font */
  font-family: "Courier New", Courier, monospace;
  /* Set the font-size to 25 pixels */
  font-size: 25px;
}

/* Position text in the top-left corner */
.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

/* Position text in the bottom-left corner */
.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
  color: white;
}

/* Position text in the middle */
.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  
}

/* Style the <hr> element */
hr {
  margin: auto;
  width: 40%;
}
</style>