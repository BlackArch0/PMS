<?php
session_start();
error_reporting(0);
$page = "message";

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
        //to get the user id
        $user_sql = "SELECT * FROM user_reg where username='" . $_SESSION['uname'] . "' ";
    $user_sql_result = mysqli_query($conn, $user_sql);
    if (mysqli_num_rows($user_sql_result) == 1) {
      $user_sql_result_set = mysqli_fetch_array($user_sql_result);
      $uid = $user_sql_result_set['u_id'];
      mysqli_free_result($user_sql_result);
    }
    
        $qry = "SELECT * FROM `hired_applicants` WHERE u_id='".$uid."' ORDER BY `approved_datetime` DESC ";
        $ans = mysqli_query($conn, $qry);

        if(mysqli_num_rows($ans)==0) 
        {
echo '<div class="col-sm-12">
<p style="margin-left: 15px;"> Sorry , There are no messages.</p>
</div>';
        }
        else{

        }

        while ($result = mysqli_fetch_array($ans)) {              ?>

          <div class="row">
            <!-- <div class="col-sm-6"> -->
            <!-- <div class="card"> -->
            <div class="card-body col-sm-6">
              <h5 class="card-title">Job Details</h5>
              <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->

              <?php
              $sql1 = "SELECT job_title,req_emp,salary,job_duration,gender,category,job_detail,work_expr From `joblist` WHERE `job_id`='" . $result['j_id'] . "' ";
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
              <h5 class="card-title">Message Details</h5>
              <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
              <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->

              <?php $sql3 = "SELECT company_name,email From `company_reg` WHERE `c_id`='" .$result['c_id'] . "' ";
              $result3 = mysqli_query($conn, $sql3);
              while ($ans3 = mysqli_fetch_array($result3)) {

                echo '<div class="col-sm-6 content-body">
                         
                          <ul>
                            <li>From : ' . $ans3['company_name'] . ' - ' . $ans3['email'] . '</li>

                            <li>To : ' . $user_sql_result_set['name'] . ' - ' . $user_sql_result_set['email'] . '</li>
                          </ul>
                          <div class="col-sm-12">
                            <p style="font-weight: bold;">Message : </p>
                            <p style="margin-left: 15px;">' .$result['message'] . '</p>
                          </div>';
                          ?>  
                          <a href="<?php echo $folder; ?>/online%20job%20portal/" ><button type="button" class="btn btn-secondary" id="back">Back</button></a>                        
                          </div>
                          </div>
                          <?php
              }
              ?>
              <a href="<?php echo $folder; ?>/online%20job%20portal/"><button type="button" class="btn btn-secondary" id="back1" style="margin-left: 25px;">Back</button></a>
            </div>
          </div>

        <?php 
      $sql="UPDATE `hired_applicants` SET `read_stat` =1 WHERE u_id='".$uid."' ";
      $sql_result = mysqli_query($conn, $sql);
      
      
      } ?>



        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
      </div>
    </div>
    <script type="text/javascript" src="../assets/scripts/main.js"></script>

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