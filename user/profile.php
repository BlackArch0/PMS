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


  <?php
  if (isset($_POST['save'])) {
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $married_stat = $_POST['married'];
    $dob = $_POST['birthdate'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $nationality = $_POST['nationality'];

    $degree = $_POST['degree'];
    $education = $_POST['edu'];

    $sql1 = "SELECT 1 FROM `user` WHERE `username` = '$uname' AND `u_id` != '" . $_SESSION['uid'] . "' ";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
      $msg = 'username already exists';
    } else {

      $query = "UPDATE `user_reg` SET `name`='$name',`address`='$address',`gender`='$gender',`marital_status`='$married_stat',`birthdate`='$dob',`age`='$age',`email`='$email',`contact_no`='$contact',`nationality`='$nationality',`degree`='$degree',`edu_qualification`='$education' WHERE username='" . $_SESSION['uname'] . "'";
      $result = mysqli_query($conn, $query);

      if ($result1) {
        $upd = "User Profile Details has been updated successfully!";
      } else {
        echo "<script>alert('!!! User Profile Details has been not updated successfully!!!')</script>";
      }

      // username and password changing start
      if (($_POST['password'] != "") || ($_POST['cpassword'] != "")) {
        if (($_POST['password'] != "") && ($_POST['cpassword'] != "")) {
          $password = $_POST['password'];
          $cpassword = $_POST['cpassword'];

          if ($password != $cpassword) {
            ?><script>
              alert("passwords doesn't match")
            </script>
            <?php
          } else {

            echo "<script>alert('pass 1 -'" . $password . "' - and pass 2 - '" . $cpassword . "' ')</script>";
            $passwd = password_hash("$password", PASSWORD_DEFAULT);

            $sql1 = "SELECT u_id from user_reg where username='" . $_SESSION['uname'] . "'";
            $result1 = mysqli_query($conn, $sql1);
            $ans1 = mysqli_fetch_array($result1);

            //to update info in main table
            $sql2 = "UPDATE `user_reg` SET username='$uname',password='$passwd' WHERE `u_id`='" . $ans1['u_id'] . "' ";
            $result2 = mysqli_query($conn, $sql2);

            // Free result set
            $result1->free_result();

            //to update info in login table
            $sql3 = "UPDATE `user` SET username='$uname',password='$passwd' WHERE `u_id`='" . $_SESSION['uid'] . "' ";
            $result3 = mysqli_query($conn, $sql3);

            if (($result2) && ($result3)) {
              $upd1 = "Username and Password updated successfully!";
            } else {
              echo "<script>
          alert('!!! Username and Password not updated successfully!!!')
      </script>";
            }
          }
        }
      }
      // username and password changing ends

      // resume upload code starts
      if ($_FILES['resume']['name'] != "") {
        
        $target_dir = "../admin/user/resume/";
        $target_file = $target_dir . basename($_FILES["resume"]["name"]);
        $uploadOk = 1;
        $resumeFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        if ($resumeFileType != "pdf" && $resumeFileType != "docx") {
          $resume_format = "Sorry, only PDF & Word file is allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          $resume_err = "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file

        } else {
          $resume_delete = "SELECT * FROM `user_reg` WHERE `username` = '" . $_SESSION['uname'] . "' ";
          
          $resume_delete_res = mysqli_query($conn, $resume_delete);
          
          $resume_delete_res_ans = mysqli_fetch_array($resume_delete_res);
          
          $delete = $resume_delete_res_ans['resume_loc'];

          //to find the location of file in string
          $str_position = strrpos($delete, '/');
          //to find the particular name through location
          $del_str = substr($delete, $str_position+1);
          //to locate the file in server's location
          $del_str = $target_dir.$del_str;
          if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {

            $resume_loc = "/online%20job%20portal/admin/user/resume/" . basename($_FILES["resume"]["name"]);
            $query = "UPDATE `user_reg` SET `resume_loc` = '$resume_loc' WHERE `username` = '" . $_SESSION['uname'] . "' ";
            $result = mysqli_query($conn, $query);

            if ($result) {

              //code to remove previous resume file
              unlink($del_str);
              $resume = "User Resume uploaded successfully!";
            } else {
              $c_resume = "User Resume has not been updated successfully!!!";
            }
          } else {
            $c_resume = "Sorry, there was an error uploading your file.";
          }
        }
      }
      // resume upload code ends
    }
  }


  // Profile pic upload code
  if (isset($_POST['savephoto'])) {
    //file upload and validation coode started here

    $target_dir = "../admin/user/profile_pic/";

    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
      // $org= "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $org = true;
      $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      $exist = true;
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 2097152) {
      $size = true;
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
      $format = true;
      $uploadOk = 0;
    }

    if ($uploadOk != 0) {
      $image_delete = "SELECT * FROM `user_reg` WHERE `username` = '" . $_SESSION['uname'] . "' ";
          
          $image_delete_res = mysqli_query($conn, $image_delete);
          
          $image_delete_res_ans = mysqli_fetch_array($image_delete_res);
          
          $delete = $image_delete_res_ans['pic_loc'];

          //to find the location of file in string
          $str_position = strrpos($delete, '/');
          //to find the particular name through location
          $del_str = substr($delete, $str_position+1);
          //to locate the file in server's location
          $del_str = $target_dir.$del_str;
      if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $loc = "/online%20job%20portal/admin/user/profile_pic/" . $_FILES["photo"]["name"];

        //to update profile in main table
        $sql1 = "UPDATE `user_reg` SET `pic_loc` = '$loc' WHERE `username`='" . $_SESSION['uname']  . "'";
        $result1 = mysqli_query($conn, $sql1);

        //to update info in login table
        $sql2 = "UPDATE `user` SET `pic_loc` = '$loc' WHERE `u_id` ='" . $_SESSION['uid'] . "'";
        $result2 = mysqli_query($conn, $sql2);

        if (($result1) && ($result2)) {
          unlink($del_str);
          $img = "Profile pic updated successfully";
        } else {
          $cimg = true;
        }
      } else {
        $cimg = true;
      }
    } else {
      $cimg = true;
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
      .img-thumbnail {
        display: inline;
        max-width: 100%;
        height: auto;
        padding: 4px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
      }

      .img-circle {
        border-radius: 50%;
      }

@media screen and (max-width: 768px) {

        #uname,
        #password,
        #cpassword,
        #last_login {
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

        if (isset($msg)) {
          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $msg . "</b></div>";
        }

        // user profile details
        if (isset($upd)) {
          echo "<div class='alert-success col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $upd . "</b></div>";
        }

        // username and password
        if (isset($upd1)) {
          echo "<div class='alert-success col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $upd1 . "</b></div>";
        }

        unset($upd);
        unset($upd1);

        if (isset($exist)) {
          echo "<script>alert('Sorry, file already exists.');</script>";
        } elseif (isset($size)) {
          $size = $_FILES['photo']['size'] / 1048576;
          $length = strpos($size, '.') + 3;
          echo "<script>alert('Sorry, your file is too large. Your image size is :" . substr($size, 0, $length) . "MB. Your image size must be less than or equal to 2 MB.');</script>";
        } elseif (isset($format)) {
          echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.');</script>";
        } elseif (isset($org)) {
          echo "<script>alert('File is not an image.');</script>";
        }

        if (isset($img)) {
          echo "<div class='alert-success col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $img . "</b></div>";
        } elseif (isset($cimg)) {
          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b> Profile pic not updated successfully.</b></div>";
        }
        unset($org);
        unset($exist);
        unset($size);
        unset($format);
        unset($img);
        unset($cimg);

        // resume upload variables
        if (isset($resume_format)) {
          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $resume_format . "</b></div>";
        }
        if (isset($resume_err)) {

          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $resume_err . "</b></div>";
        }

        if (isset($resume)) {
          echo "<div class='alert-success col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $resume . "</b></div>";
        } else if (isset($c_resume)) {
          echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $c_resume . "</b></div>";
        }

        unset($resume_format);
        unset($resume_err);
        unset($resume);
        unset($c_resume);
        ?>


        <?php
        $sql = "SELECT * FROM user where u_id='" . $_SESSION['uid'] . "' ";
        $result = mysqli_query($conn, $sql);
        $ans = mysqli_fetch_array($result);
        ?>
        <!-- left side -->
        <div class="col-sm-4">
          <a data-target="#myModal" data-toggle="modal" href="" title="Click here to Change Image." style="display: inline-block;">
            <img alt="" style="width:250px; height:250px;" title="" class="img-circle img-thumbnail" src="<?php echo $ans['pic_loc']; ?>" data-original-title=" Usuario">
          </a>
        </div>

        <!-- right side -->
        <div class="col-8">
          <h1><strong>User Profile</strong></h1><br>
          <form class="form-horizontal span6" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="uname">Username:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="uname" name="uname" placeholder="Enter Username" autocomplete="off" type="text" required value="<?php echo $ans['username']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="password">Password:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="password" name="password" placeholder="Account Password" type="Password">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="cpassword">Confirm Password:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="cpassword" name="cpassword" placeholder="Account Password" type="Password">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="last_login">Last Login</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="last_login" name="last_login" placeholder="Last Login" type="text" value="<?php echo $ans['lastlogin']; ?>" readonly>
                </div>
              </div>
            </div>

            <?php
            $qry = "SELECT * FROM user_reg where username='" . $_SESSION['uname'] . "' ";
            $qry_result = mysqli_query($conn, $qry);
            $ans1 = mysqli_fetch_array($qry_result);
            ?>
            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Name:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" id="name" name="name" placeholder="Enter Name" type="text" required value="<?php echo $ans1['name']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="address">Address:</label>

                <div class="col-md-8">
                  <textarea class="form-control input-sm" id="address" name="address" placeholder="Enter Address" type="text" required><?php echo $ans1['address']; ?>
                  </textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="gender">Gender:</label>

                <div class="col-md-8">

                  <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" <?php if ($ans1['gender'] == "male") echo "selected"; ?>>Male</option>
                    <option value="female" <?php if ($ans1['gender'] == "female") echo "selected"; ?>>Female</option>
                    <option value="male/female" <?php if ($ans1['gender'] == "male/female") echo "selected"; ?>>Male/Female</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="married">Married Status:</label>

                <div class="col-md-8">

                  <select id="married" name="married" required>
                    <option value="">Select Marital Status </option>
                    <option value=married <?php if ($ans1['marital_status'] == "married") echo "selected"; ?>>Married</option>
                    <option value=unmarried <?php if ($ans1['marital_status'] == "unmarried") echo "selected"; ?>>Unmarried</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="birthdate">Birthdate:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" type="date" name="birthdate" id="birthdate" placeholder="Enter Birthdate" required value="<?php echo $ans1['birthdate']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="age">Age:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="age" id="age" placeholder="Enter Your Age" type="number" maxlength="2" min="18" required value="<?php echo $ans1['age']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="email">Email:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="email" id="email" placeholder="Enter Your Email" type="email" required value="<?php echo $ans1['email']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="contact">Contact No.:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="contact" id="contact" placeholder="Enter Contact No." type="number" maxlength="10" min="0000000000" max="9999999999" required value="<?php echo $ans1['contact_no']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="nationality">Nationality:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="nationality" id="nationality" placeholder="Enter Your Nationality" type="text" required value="<?php echo $ans1['nationality']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="degree">Degree:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="degree" id="degree" placeholder="Enter Your Degree details" type="text" required value="<?php echo $ans1['degree']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="edu">Educational Qualification:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="edu" id="edu" placeholder="Enter Edu. Qualification" type="text" required value="<?php echo $ans1['edu_qualification']; ?>">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="resume">Resume:</label>

                <div class="col-md-8">
                  <input class="form-control input-sm" name="resume" id="resume" placeholder="Upload Resume" type="file"> <br>

<?php if($ans1['resume_loc']!="")
{
?>
                  <a href="<?php echo  $folder . $ans1['resume_loc']; ?>" target="_blank">
                    <p style="font-weight: bold;">
                      <button type="button" class="btn-secondary">View File</button>
                    </p>
                  </a>
                  
                  <?php } ?>

                </div>
              </div>
            </div>

            <?php // Free result set
            $result->free_result();
            $qry_result->free_result(); ?>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for="idno"></label>

                <div class="col-md-8">
                  <button class="btn btn-primary " name="save" type="submit"><span class="fa fa-save"></span> Save</button>

                  <a href="<?php echo $folder; ?>/online%20job%20portal/index.php"><button class="btn btn-primary " name="back" type="button"><span class="fa fa-arrow-left"></span>Back</button></a>
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


<!-- Modal start here-->
<div class="modal fade" id="myModal" tabindex="-1" data-backdrop="false" style="margin-top:50px;" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
      </div>

      <form enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="rows">
              <div class="col-md-12">
                <div class="rows">
                  <div class="col-md-8">
                    <input id="photo" name="photo" type="file" required="">
                  </div>

                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button> <button class="btn btn-primary" name="savephoto" type="submit">Upload Photo</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal ends here -->

</div>
</div>
<!-- JS here -->
<!-- All JS Custom Plugins Link Here here -->
<script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>

<!-- Jquery Mobile Menu -->
<script src="../assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>
<script type="text/javascript" src="../admin/assets/scripts/main.js"></script>
</div>
</div>
</body>

</html>
<?php
}
?>