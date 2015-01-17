<?php
session_start();
if($_SESSION["sesionOK"]!="si"){
header('location:login.html');
}

session_destroy();
header('location:index.php');
?>