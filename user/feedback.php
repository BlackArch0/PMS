<?php
session_start();
error_reporting(0);
$page = "u_feedback";

// include_once('../admin/include/dbconnect.php');


if ((!isset($_SESSION['uid']))) {
  header("location:../index.php");
  include('../include/header.php');
} else {
  include('../include/header.php');

  if (isset($_POST['ins'])) {
    $feedback = $_REQUEST['feedback'];

    $qry = "SELECT * FROM `user_reg` WHERE `username`='" . $_SESSION['uname'] . "' ";
    $qry_result = mysqli_query($conn, $qry);
    $qry_result_set = mysqli_fetch_array($qry_result);

    $id = $qry_result_set['u_id'];


    $s = "SET FOREIGN_KEY_CHECKS = 0; ";
    $s_result = mysqli_query($conn, $s);

    if ($s_result) {
      $sql = "INSERT INTO `feedback` (`u_id`,`c_id`, `feedback`) VALUES ('" . $id . "', '0','" . $feedback . "') ";
      $sql_result = mysqli_query($conn, $sql);

      if ($sql_result) {
        $feed = "Your Feedback submitted successfully!";
      } else {
        $cfeed = "Your Feedback not submitted successfully!!!";
      }

    } else {
      $cfeed = "Your Feedback not submitted successfully!!!";
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
    <title>Online Job-Portal Feedback Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.min.css">
    <script type="text/javascript" src="../plugins/jQuery/jQuery-2.1.4.min.js">
    </script>
    <script type="text/javascript" src="../plugins/dataTables/dataTables.bootstrap.min.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <link href="../admin/main.css" rel="stylesheet">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/price_rangs.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
@media screen and (max-width: 768px) {

      #feedback {
        width: 150%;
      }
    }
    </style>
  </head>

  <body>
    <div class="container" style="background: #f1f4f6;">
      <div class="row">

        <?php

        if (isset($feed)) {
          echo "<div class='alert-success col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $feed . "</b></div>";
        } else if (isset($cfeed)) {
          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $cfeed . "</b></div>";
        }

        unset($feed);
        unset($cfeed);
        ?>
        <!-- left side -->
        <div class="col-sm-4">
        </div>

        <!-- right side -->
        <div class="col-8">
          <h1><strong>Give Your Valueable Feedback</strong></h1>
          <form class="form-horizontal span6" method="POST">


            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="feedback">Feedback:</label>

                <div class="col-md-8">
                  <textarea class="input-sm" id="feedback" name="feedback" placeholder="Give your Valueable feedback." cols="30" rows="10" required tabindex="1"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8">

                  <button class="btn btn-primary btn-sm pull-right" name="ins" value="ins" type="submit"><span class="fa fa-save"></span>Save</button>

                    <a href="<?php echo $folder; ?>/online%20job%20portal/index.php"><button class="btn btn-primary btn-sm pull-left" name="back" type="button"><span class="fa fa-arrow-left"></span>Back</button></a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>


      </div>
    </div>
    <!--/contanier-->
  </body>
  <!-- JS here -->
  <!-- All JS Custom Plugins Link Here here -->
  <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>

  <!-- Jquery Mobile Menu -->
  <script src="../assets/js/jquery.slicknav.min.js"></script>

  <!-- Jquery Plugins, main Jquery -->
  <script src="../assets/js/plugins.js"></script>
  <script src="../assets/js/main.js"></script>
  <script type="text/javascript" src="../admin/assets/scripts/main.js"></script>
</html>

<?php
}
?>