<?php

    session_start();
    session_destroy();

 
    if(isset($_GET['error']))
        header("Location:../index.php?error=".$_GET['error']);
    else 
        header("Location:../index.php");

?>