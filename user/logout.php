<?php
session_start();
 include_once('../admin/include/dbconnect.php');
$date=$_SESSION['last_log'];
$id=$_SESSION['uid'];
//date("Y-m-d h:i:s A");
mysqli_query($conn,"UPDATE `user` SET lastlogin = '$date' WHERE u_id = '$id' ");
session_unset();
//session_destroy();
$_SESSION['log_msg']="You have successfully logout";
header("location:../index.php");
