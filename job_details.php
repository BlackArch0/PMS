<?php
session_start();
error_reporting(0);

if (!isset($_REQUEST['jid'])) {
  header("location:index.php");
   include('include/header.php');
} else {
  include('include/header.php');
  ?>
  <!doctype html>
  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job detail - Page </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <!-- Preloader Start -->
    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="preloader-circle"></div>
          <div class="preloader-img pere-text">
            <img src="assets/img/logo/HIRE.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Preloader Start -->
    <main>

      <!-- Hero Area Start-->
      <!-- <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
          <div class="container">
            <div class="row">
              <div class="col-xl-12">
                <div class="hero-cap text-center">
                  <h2>UI/UX Designer</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <!-- Hero Area End -->
      <!-- job post company Start -->
      <!-- <div class="job-post-company pt-120 pb-120"> -->
      <div class="container">
        <div class="row justify-content-between">
          <!-- Left Content -->
          <div class="col-xl-7 col-lg-8">
            <!-- job single -->
            <div class="single-job-items mb-50">

              <?php $qry = "SELECT * FROM `joblist` WHERE job_id='" . $_REQUEST['jid'] . "'";
              $ans = mysqli_query($conn, $qry);

              while ($result = mysqli_fetch_array($ans)) {


                $sql1 = "SELECT `company_name`,`logo_loc`,`company_address`,`email` From `company_reg` WHERE `c_id`='" . $result['c_id'] . "' ";
                $result1 = mysqli_query($conn, $sql1);
                while ($ans1 = mysqli_fetch_array($result1)) {

              ?>
                  <div class="job-items">
                    <div class="company-img company-img-details">
                      <img src="<?php echo $folder . $ans1['logo_loc']; ?>" alt="" height="=95px" width="95px">
                    </div>
                    <div class="job-tittle">

                      <h4><?php echo $result['job_title']; ?></h4>
                      <ul>
                        <li><?php echo $ans1['company_name']; ?></li>
                        <li><i class="fas fa-map-marker-alt"></i><?php echo $ans1['company_address'];
                                                                  ?></li>
                        <li>₹<?php echo $result['salary']; ?></li>
                      </ul>
                    </div>
                  </div>
            </div>
            <!-- job single End -->

            <div class="job-post-details">
              <div class="post-details1 mb-50">
                <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                  <h4>Job Description</h4>
                </div>
                <p><?php echo $result['job_detail']; ?>
                </p>
              </div>
              <div class="post-details2  mb-50">
                <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                  <h4>Education</h4>
                </div>
                <ul>
                  <li><?php echo $result['qualification']; ?></li>

                </ul>
              </div>
              <div class="post-details2  mb-50">
                <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                  <h4>Experience</h4>
                </div>
                <ul>
                  <li><?php echo $result['work_expr']; ?></li>
                </ul>
              </div>
            </div>

          </div>
          <!-- Right Content -->
          <div class="col-xl-4 col-lg-4">
            <div class="post-details3  mb-50">
              <!-- Small Section Tittle -->
              <div class="small-section-tittle">
                <h4>Job Overview</h4>
              </div>
              <ul>
                <li>Posted date : <span><?php echo $result['job_posted']; ?></span></li>
                <li>Location : <span><?php echo $ans1['company_address'];
                                      ?></span></li>
                <li>Vacancy : <span><?php echo $result['req_emp']; ?></span></li>
                <li>Job nature : <span><?php echo $result['job_type']; ?></span></li>
                <li>Salary : <span>₹<?php echo $result['salary']; ?></span></li>
                <li>Last Date For Apply : <span><?php echo $result['last_date']; ?></span></li>
              </ul>


              <div class="apply-btn2">

                <?php
                  if (!isset($_SESSION['uid'])) {
                ?>
                  <a id="temp3" class="btn" data-toggle="modal" data-target="#loginModal">Apply Now</a>
                  <?php
                  } else {
                    $user_sql = "SELECT * FROM user_reg where username='" . $_SESSION['uname'] . "' ";
                    $user_sql_result = mysqli_query($conn, $user_sql);
                    if (mysqli_num_rows($user_sql_result) == 1) {
                      $user_sql_result_set = mysqli_fetch_array($user_sql_result);
                      $uid = $user_sql_result_set['u_id'];
                      mysqli_free_result($user_sql_result);
                    }
                    $sql = "SELECT * FROM `applicants_list` WHERE `job_id`='" . $_REQUEST['jid'] . "' AND `u_id`='" . $uid . "' ";
                    $result = mysqli_query($conn, $sql);

                    $sql5 = "SELECT * FROM `hired_applicants` WHERE `j_id`='" . $_REQUEST['jid'] . "' AND `u_id`='" . $uid . "' ";
                    $result5 = mysqli_query($conn, $sql5);

                    if (mysqli_num_rows($result) == 1 || mysqli_num_rows($result5) == 1) {
                      $set = mysqli_fetch_array($result);
                  ?>
                    <a href="" class="btn" onclick="exist_job()">Apply Now</a>
                    <script>
                      function exist_job() {
                        alert("You already applied for this job/vacancy ! ");
                      }
                    </script>
                  <?php
                    } else { ?>
                    <a href="apply.php?jid=<?php echo $_REQUEST['jid']; ?> " class="btn">Apply Now</a>
                <?php  }
                  }
                ?>

              </div>
            </div>
            <div class="post-details4  mb-50">
              <!-- Small Section Tittle -->
              <div class="small-section-tittle">
                <h4>Company Information</h4>
              </div>
              <span><?php echo $ans1['company_name'];
                    ?></span>
              <!-- <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
              </p> -->
              <ul>
                <li>Name: <span><?php echo $ans1['company_name'];
                                ?></span></li>

                <li>Email: <span><?php echo $ans1['email'];
                                  ?></span></li>

            <?php
                }
              } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- </div> -->
      <!-- job post company End -->

    </main>
    <?php
    include('include/footer.php');
    ?>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

  </body>

  </html>
<?php } ?>