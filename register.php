<?php
include "register.html";
include "connect database.php";

$name = strval($_GET["nme"]); 
$surname = strval($_GET["srnam"]); 
$ID = strval($_GET["id"]); 
$address = strval($_GET["Address"]);
$DoB = strval($_GET["birth"]); 
$cntct = strval($_GET['cntct']); 
$mail = strval($_GET['mail']); 
$psswd = strval($_GET['psswd']);
$psswd2 = strval($_GET['passwd']);
$role = strval($_GET["role"]);

$rslt = mysqli_query($conn,"SELECT * FROM `user`");
$num = mysqli_num_rows($rslt);


$num2 = $num + 1;
if ($psswd == $psswd2)
    {
        
        $sql2 = "INSERT INTO `user` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `CONTACT`, `BIRTHDATE`, `ADDRESS`, `PASSWORD`, `IDENTITYNUMBER`,`ROLE`) VALUES ($num2, '$name', '$surname', '$mail', '$cntct', '$DoB', '$address', '$psswd', '$ID', '$role')";
      
        if(mysqli_query($conn,$sql2))
        {  
            if ($role == "tenant")
            {
            ?>
           <script>alert("tenant registration complete!");
            window.location = "index.html";
            </script>
            <?php
            if ($role == "owner"){
                ?>
                <script>alert("owner registration complete!");
            window.location = "owner home.html";
            </script>
            <?php
            }    
        }
    }
}
if($psswd != $psswd2)
{
        
        ?>
            <script>
            alert("cant register...passwords dont match");
            window.location = "register.html";
            </script>
            <?php
        
}

?>