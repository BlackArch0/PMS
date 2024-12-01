<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['uid'])) {
  header("location:index.php");
} elseif (!isset($_REQUEST['jid'])) {
  header("location:index.php");
} else {
  include_once('include/header.php');
  if (isset($_POST['upd'])) {

    $jobid = $_POST['jid'];

    $user_sql = "SELECT * FROM user_reg where username='" . $_SESSION['uname'] . "' ";
    $user_sql_result = mysqli_query($conn, $user_sql);
    if (mysqli_num_rows($user_sql_result) == 1) {
      $user_sql_result_set = mysqli_fetch_array($user_sql_result);
      $uid = $user_sql_result_set['u_id'];
      mysqli_free_result($user_sql_result);
    }

    $sql = "SELECT * FROM `applicants_list` WHERE `job_id`= '" . $jobid . "' AND `u_id`='".$uid."' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<script>
                        alert('You already applied for this job ! ')</script>";
    } else
    {


      //file upload and validation coode started here

      $user_sql = "SELECT * FROM user_reg where username='" . $_SESSION['uname'] . "' ";
      $user_sql_result = mysqli_query($conn, $user_sql);
      if (mysqli_num_rows($user_sql_result) == 1) {
        $user_sql_result_set = mysqli_fetch_array($user_sql_result);
        $uid = $user_sql_result_set['u_id'];
        mysqli_free_result($user_sql_result);
      }

      $target_dir = "admin/user/resume/";
      $target_file = $target_dir . basename($_FILES["resume"]["name"]);
      $uploadOk = 1;
      $resumeFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


      // Allow certain file formats
      if ($resumeFileType != "pdf" && $resumeFileType != "docx") {
        $cupd_format = "Sorry, only PDF & Word file is allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        $cupd_err = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file

      } else {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
          // $_SESSION['upd']= "The file " . htmlspecialchars(basename($_FILES["logo_loc"]["name"])) . " has been uploaded.";
        } else {
          $cupd = "Sorry, there was an error uploading your file.";
        }
      }
      //file upload and validation coode finished here

      if ($uploadOk != 0) {

        $resume_loc = "/online%20job%20portal/" . $target_file;
        $query = "UPDATE `user_reg` SET `resume_loc` = '$resume_loc' WHERE `username` =  '" . $_SESSION['uname'] . "' ";
        $result = mysqli_query($conn, $query);

        if ($result) {

          $com_sql = "SELECT * FROM joblist where job_id='" .  $jobid . "' ";
          $com_sql_result = mysqli_query($conn, $com_sql);
          if (mysqli_num_rows($com_sql_result) == 1) {
            $com_sql_result_set = mysqli_fetch_array($com_sql_result);
            $cid = $com_sql_result_set['c_id'];
            mysqli_free_result($com_sql_result);
          }
          date_default_timezone_set('Asia/Calcutta');
          $date = date("Y-m-d H:i:s");
          echo $jobid."<br>".$uid."<br>".$cid."<br>".$date;

          $sql = "INSERT INTO `applicants_list` (`job_id`, `u_id`, `c_id`, `applied_date`) VALUES ('$jobid','$uid','$cid','$date') ";
          $sql_result = mysqli_query($conn, $sql);

          if ($sql_result) {
            $upd = "User Resume uploaded successfully!";
          } else {
            $cupd = "User Resume has not been updated successfully!!!";
          }
        } else {
          $cupd = "outer User Resume has not been updated successfully!!!";
        }
      }


    }
  }

  if (isset($_POST['upd1'])) {

    $jobid = $_POST['jid'];

    $user_sql = "SELECT * FROM user_reg where username='" . $_SESSION['uname'] . "' ";
    $user_sql_result = mysqli_query($conn, $user_sql);
    if (mysqli_num_rows($user_sql_result) == 1) {
      $user_sql_result_set = mysqli_fetch_array($user_sql_result);
      $uid = $user_sql_result_set['u_id'];
      mysqli_free_result($user_sql_result);
    }

    $sql = "SELECT * FROM `applicants_list` WHERE `job_id`= '" . $jobid . "' AND `u_id`='".$uid."' ";
    $result = mysqli_query($conn, $sql);

    $sql5 = "SELECT * FROM `hired_applicants` WHERE `j_id`='" . $jobid. "' AND `u_id`='" . $uid . "' ";
    $result5 = mysqli_query($conn, $sql5);

    if (mysqli_num_rows($result) == 1 || mysqli_num_rows($result5) == 1) {
      echo "<script>
                        alert('You already applied for this job ! ')</script>";
    } else
    {


      $com_sql = "SELECT * FROM joblist where job_id='" .  $jobid . "' ";
      $com_sql_result = mysqli_query($conn, $com_sql);
      if (mysqli_num_rows($com_sql_result) == 1) {
        $com_sql_result_set = mysqli_fetch_array($com_sql_result);
        $cid = $com_sql_result_set['c_id'];
        mysqli_free_result($com_sql_result);
      }
      date_default_timezone_set('Asia/Calcutta');
      $date = date("Y-m-d H:i:s");
      // echo $date;

      $sql = "INSERT INTO `applicants_list` (`job_id`, `u_id`, `c_id`, `applied_date`) VALUES ('$jobid','$uid','$cid','$date') ";
      $sql_result = mysqli_query($conn, $sql);

      if ($sql_result) {
        $upd = "Application for job submitted successfully !";

      } else {
        $cupd = "Application for job not submitted!!!";
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
    <title>Online Job-Portal Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css">
    <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js">
    </script>
    <script type="text/javascript" src="plugins/dataTables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <link href="admin/main.css" rel="stylesheet">
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>

@media screen and (max-width: 768px) {

      #resume,
      #name,
      #address,
      #gender,
      #age,
      #email,
      #contact {
        width: 150%;
      }
    }
    </style>
  </head>

  <body>
    <!-- <div class="container" style="margin-top: 10px;min-height: 600px;"> -->

    <!-- </div> -->
    <div class="container" style="background: #f1f4f6;">
      <div class="row">

        <?php
        if (isset($cupd_format)) {

          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $cupd_format . "</b></div>";
        }
        if (isset($cupd_err)) {

          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $cupd_err . "</b></div>";
        }

        if (isset($upd)) {
          echo "<div class='alert-success col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $upd . "</b></div>";
        } else if (isset($cupd)) {
          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $cupd . "</b></div>";
        }

        unset($cupd_format);
        unset($cupd_err);
        unset($upd);
        unset($cupd);
        ?>

        <!-- left side -->
        <div class="col-sm-4">
        </div>

        <!-- right side -->
        <div class="col-8">
          <h1><strong>Apply For Job</strong></h1><br>
          <form class="form-horizontal span6" method="POST" enctype="multipart/form-data">

            <?php
            $sql = "SELECT `resume_loc` FROM `user_reg` WHERE `username`= '" . $_SESSION['uname'] . "' ";
            $result = mysqli_query($conn, $sql);
            $set = mysqli_fetch_array($result);
            $resume = $set['resume_loc'];

            if ($resume == "") {
              ?>
              <div class="form-group">
                <div class="col-md-8">
                  <label class="col-md-4 control-label" for="resume">Resume File:</label>

                  <div class="col-md-8">
                    <input class="form-control input-sm" id="resume" name="resume" placeholder="Select Resume File" type="file" required tabindex="1">
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
            <!--  getting for job id for inserting in appicants_list table -->
            <input type="hidden" name="jid" value="<?php echo $_REQUEST['jid'] ?>">

            <?php
            $sql = "SELECT * FROM `user_reg` WHERE `username`= '" . $_SESSION['uname'] . "' ";
            $result = mysqli_query($conn, $sql);
            $set = mysqli_fetch_array($result);
            ?>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Name:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="name" name="name" placeholder="Enter Name" type="text" readonly value="<?php echo $set['name']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="address">Address:</label>

                <div class="col-md-8">
                  <textarea class="form-control input-sm" id="address" name="address" placeholder="Enter Address" type="text" readonly required><?php echo $set['address']; ?></textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="gender">Gender:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="gender" name="gender" placeholder="Enter Your Gender" type="text" readonly value="<?php echo $set['gender']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="age">Age:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="age" name="age" placeholder="Enter Your Age" type="number" readonly value="<?php echo $set['age']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="email">Email:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="email" name="email" placeholder="Enter Your Email" type="email" readonly value="<?php echo $set['email']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="contact">Contact:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="contact" name="contact" placeholder="Enter Your Contact" type="number" readonly value="<?php echo $set['contact_no']; ?>">
                </div>
              </div>
            </div>

            <?php
            $resume = $set['resume_loc'];
            ?>
            <div class="form-group">
              <div class="col-md-8">
                <?php
                if ($resume != "") {
                  ?>
                  <button class="btn btn-primary btn-sm pull-right" value="upd1" name="upd1" type="submit">Submit <span class="fa fa-arrow-right"></span></button>

                  <?php
                } else {
                  ?>
                  <button class="btn btn-primary btn-sm pull-right" value="upd" name="upd" type="submit">Submit <span class="fa fa-arrow-right"></span></button>
                  
                  <?php
                }
                ?>

                <a href="<?php echo $folder; ?>/online%20job%20portal/job_details.php?jid=<?php echo $_REQUEST['jid']; ?>" class="btn btn-primary btn-sm pull-left"><span class="fa fa-arrow-left"></span><strong>Back</strong></a>
              </div>
            </div>
          </div>
        </form>
      </div>


    </div>
  </div>
  <!--/contanier-->
</body>

</html>



</div>
</div>
<!-- JS here -->
<!-- All JS Custom Plugins Link Here here -->
<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>

<!-- Jquery Mobile Menu -->
<script src="assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script type="text/javascript" src="admin/assets/scripts/main.js"></script>
</div>
</div>
</body>

</html>
<?php
}
?>