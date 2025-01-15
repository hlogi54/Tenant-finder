<?php

session_start();

session_destroy();

echo "<script>
alert('successfully logged out');window.location = 'login.php';</script>"; 



?>