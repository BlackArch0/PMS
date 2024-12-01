<?php
session_start();

include_once('include/dbconnect.php');

if (isset($_SESSION['id'])) {
    header("location:index.php");
}

if (isset($_POST['btnLogin'])) {
    $username = trim($_POST['username']);
    $password  = $_POST['password'];

    $sql = "SELECT a_id,username,password FROM `admin` where username='" . $username . "'";
    $result = mysqli_query($conn, $sql);

    #password_verify($upass,$databse);
    if (mysqli_num_rows($result) == 0) {
        $msg = 'Username does not exist!';
    } else {
        while ($ans = mysqli_fetch_array($result)) {
            if (password_verify($password, $ans[2])) {

                $_SESSION['id'] = $ans[0];
                date_default_timezone_set("Asia/Kolkata");
                $_SESSION['last_log'] = date('Y-m-d H:i:s');;

                $_SESSION['msg'] = "You successfully logon as " . $ans[1];
                #session_destroy($_SESSION['id']);
                header("location:index.php");
            } else {
                $msg = "Password does not match!";
            }
        }
    }
}
?>

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

    <link href="../main.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins//bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plugins/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins//blue.css">
</head>

<body class="hold-transition login-page" onload="time()">
    <div class="login-box">
        <div class="login-box-body" style="min-height: 400px;">
            <h1 class="login-box-msg">Admin Login</h1>
            <hr />


            <p>
                <?php if (isset($msg)) {
                    echo  '<div class="alert alert-danger" style="height:30px;text-align:center;padding:5px">' . $msg . '</div>';
                }
                unset($msg);

                if (isset($_SESSION['msg'])) {
                    echo  '<div class="alert alert-danger" style="height:30px;text-align:center;padding:5px">' . $_SESSION['msg'] . '</div>';
                }

                unset($_SESSION['msg']);
                ?>
            </p>

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" autocomplete="off" placeholder=" Enter Username " name="username" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder=" Enter Password " name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
        </div>
        </form>

        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
</body>

</html>