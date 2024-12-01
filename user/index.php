<?php
session_start();

if ((!isset($_SESSION['uid']))) {
  header("location:../index.php");
} else {
    header("location:profile.php");
}
  ?>