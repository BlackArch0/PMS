<?php
session_start();
// include_once('../include/header.php');
include_once('../admin/include/dbconnect.php');
if (!isset($_SESSION['uid'])) {
    header("location:../index.php");
} else {

    if (isset($_REQUEST['apid'])) {
        $sql = "DELETE from applicants_list where ap_id='" . $_REQUEST['apid'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['del'] = true;
            header('location:appliedjob.php');
        } else {
            $_SESSION['cdel'] = true;
            header('location:appliedjob.php');
        }
    }
    else
    header('location:appliedjob.php');    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Online Job-Portal Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="This is an example dashboard created using build-in elements and components.">
        <meta name="msapplication-tap-highlight" content="no">
        <link href="../admin/main.css" rel="stylesheet">
    </head>

    <body>
    </body>

    </html>
<?php
}
?>