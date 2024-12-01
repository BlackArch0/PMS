<?php
session_start();
error_reporting(0);
$page = "profile";

// include_once('../admin/include/dbconnect.php');


if ((!isset($_SESSION['uid']))) {
  header("location:../index.php");
  include('../include/header.php');
} else {
  include('../include/header.php');
  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Online Job-Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="../admin/main.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
      /* <style type="text/css"> */
      .content-header {
        min-height: 50px;
        border-bottom: 1px solid #ddd;
        font-size: 15px;
        font-weight: bold;
      }

      .content-body {
        min-height: 350px;
      }

      .content-body>p {
        padding: 10px;
        font-size: 12px;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
      }

      @media screen and (max-width: 768px) {
        #back1 {
          display: none;
        }
      }

      @media (min-width: 769px) and (max-width: 1440px) {
        #back {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
      <?php #include("../include/header.php"); 
      ?>

      <div class="card-body">

        <div class="col-sm-12 content-header">View Details</div>

        <?php
        $qry = "SELECT * FROM `applicants_list` where ap_id='" . $_SESSION['apid'] . "'";
        $ans = mysqli_query($conn, $qry);
        while ($result = mysqli_fetch_array($ans)) {              ?>

          <div class="row">
            <!-- <div class="col-sm-6"> -->
            <!-- <div class="card"> -->
            <div class="card-body col-sm-6">
              <h5 class="card-title">Job Details</h5>
              <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->

              <?php
              $sql1 = "SELECT job_title,req_emp,salary,job_duration,gender,category,job_detail,work_expr From `joblist` WHERE `job_id`='" . $result[1] . "' ";
              $result1 = mysqli_query($conn, $sql1);
              while ($ans1 = mysqli_fetch_array($result1)) {

                echo '<div class="col-sm-6 content-body">
                          <h4>' . $ans1[0] . '</h4>';
                echo '<div class="col-sm-12">
                          <ul>
                          <li><i class="fp-ht-bed"></i>Required Employees:' . $ans1[1] . '</li>
                          <li><i class="fp-ht-food"></i>Salary:' . number_format($ans1[2], 2) . '</li>
                          <li><i class="fa fa-sun-"></i>Job Duration:' . $ans1[3] . '</li>
                          </ul>
                          </div>
                          <div class="col-sm-12">
                          <ul>
                          <li><i class="fp-ht-tv"></i>Prefered Gender : ' . $ans1[4] . '</li>
                          <li><i class="fp-ht-computer"></i>Sector of Vacancy : ' . $ans1[5] . '</li>
                          </ul>
                          </div>
                          <div class="col-sm-12">
                          <p style="font-weight: bold;">Job Description : </p>
                          <p style="margin-left: 15px; color:black;">' . $ans1[6] . '</p>
                          </div>
                          <div class="col-sm-12">
                          <p style="font-weight: bold;">Qualification/Work Experience : </p>
                          <p style="margin-left: 15px; color:black;">' . $ans1[7] . '</p>
                          </div>';

                echo '</div>';
              } ?>

              <!-- </div> -->
              <!-- </div> -->
            </div>
            <!-- <div class="col-sm-6"> -->
            <!-- <div class="card"> -->
            <div class="card-body col-sm-6">
              <h5 class="card-title">Applicant Infomation</h5>
              <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->

              <?php $sql3 = "SELECT name,address,contact_no,email,gender,age,degree From `user_reg` WHERE `u_id`='" . $result[2] . "' ";
              $result3 = mysqli_query($conn, $sql3);
              while ($ans3 = mysqli_fetch_array($result3)) {
                // echo '<td>' . $ans3[0] . '</td>';


                echo '<div class="col-sm-6 content-body">
                          <h4> ' . $ans3[0] . '</h4>
                          <ul>
                            <li>Address : ' . $ans3[1] . '</li>
                            <li>Contact No. : ' . $ans3[2] . '</li>
                            <li>Email Address. :' . $ans3[3] . '</li>
                            <li>Gender: ' . $ans3[4] . '</li>
                            <li>Age : ' . $ans3[5] . '</li>
                          </ul>
                          <div class="col-sm-12">
                            <p style="font-weight: bold;">Educational Attainment : </p>
                            <p style="margin-left: 15px;">' . $ans3[6] . '</p>
                          </div>    
                          <a href="appliedjob.php"><button type="button" class="btn btn-secondary" id="back">Back</button></a>                        
                          </div>
                          </div>';
              }
              ?>
              <a href="appliedjob.php"><button type="button" class="btn btn-secondary" id="back1" style="margin-left: 25px;">Back</button></a>
            </div>
          </div>

        <?php } ?>



        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
      </div>
    </div>
    <script type="text/javascript" src="../assets/scripts/main.js"></script>

  </body>

  </html>
<?php
}
?>