<?php
include "connect database.php";
include "admin.html";
@session_start();
if(! isset($_SESSION["logged_in"])){
    echo "<script>
        alert('user not logged in');window.location = 'login.php';</script>"; 
    
  }
$user = $_SESSION['user_id'];

$sql1 = "SELECT * FROM `house`";
$rslt = mysqli_query($conn,$sql1);
$rws = mysqli_num_rows($rslt);
?>
<div class="bgimg">
  <div class="topleft">
   
  </div>
  <div class="middle">
    <h1> WELCOME BACK ADMIN YOU CURRENTLY HAVE <?php echo $rws ?> HOUSES <br>
       </h1>
       <h2>
        what would you like to do?.
       </h2>
    <p>
        SELECT AN ACTION : <br>
       <a href = "view users.php">
        <button type="button" class="btn btn-success" >
      VIEW USERS
     </button></a>     
     <a href = "view houses admin.php">
     <button type="button" class="btn btn-secondary" >
      VIEW HOUSES
     </button></a>
    
     
    </p>
  </div>
  <div class="bottomleft">
    <p>Some text</p>
  </div>
</div>
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