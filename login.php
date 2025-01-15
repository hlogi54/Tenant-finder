<?php
include "login.html";
include "connect database.php";
@session_start();

if (isset($_POST['mail']))
{
$username = $_POST['mail'];
$password = $_POST['psswd'];
$sql = "SELECT * FROM `user` WHERE `EMAIL` = '$username'";
$qry = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($qry);
$role = $row["ROLE"];
if($username == $row["EMAIL"] && $password == $row["PASSWORD"])
{
    
    if ($role == "tenant")
    {
        $_SESSION["user_id"] = $row["ID"];
        $_SESSION["username"] = $row["NAME"];
        $_SESSION["logged_in"] = true;
        
    ?>

   <script>alert("tenant login complete!");
    window.location = "welcome tenant.php";
    </script>
    <?php
    }
    if ($role == "owner"){
        $_SESSION["user_id"] = $row["ID"];
        $_SESSION["username"] = $row["NAME"];
        $_SESSION["logged_in"] = true;
        ?>
        <script>alert("owner login complete!");
        window.location = "owner home.php";
    </script>
    <?php
    }
    if ($role == "admin"){
        $_SESSION["user_id"] = $row["ID"];
        $_SESSION["username"] = $row["NAME"];
        $_SESSION["logged_in"] = true;
        ?>
        <script>alert("admin login complete!");
        window.location = "admin home.php";
    </script>
    <?php
    }
    
}
if($username == $row["EMAIL"] && $password != $row["PASSWORD"])
{
    ?>
<script>
alert("wrong password, try entering your password again");
window.location = "login.html";
</script>
<?php

}
if($username != $row["EMAIL"])
{
    ?>
<script>
alert("account doesnt exist!!!");
window.location = "login.html";
</script>
<?php

}
}
?>
