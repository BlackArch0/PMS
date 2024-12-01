<?php
$page="home";
include_once('include/header.php');


if (isset($_POST['upd'])) {

  // $jobid = $_POST['jid'];
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
    // $cupd_format = "Sorry, only PDF & Word file is allowed.";
    echo "<script>alert('Sorry, only PDF & Word file is allowed.') </script>";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // $cupd_err = "Sorry, your file was not uploaded.";
    echo "<script>alert('Sorry, your file was not uploaded.') </script>";
    // if everything is ok, try to upload file

  } else {
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
      // $_SESSION['upd']= "The file " . htmlspecialchars(basename($_FILES["logo_loc"]["name"])) . " has been uploaded.";
    } else {
      // $cupd = "Sorry, there was an error uploading your file.";
      echo "<script>alert('Sorry, there was an error uploading your file.') </script>";
    }
  }
  //file upload and validation coode finished here

  if ($uploadOk != 0) {

    $resume_loc = "/online%20job%20portal/" . $target_file;
    $query = "UPDATE `user_reg` SET `resume_loc` = '$resume_loc' WHERE `username` =  '" . $_SESSION['uname'] . "' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $upd = "User Resume uploaded successfully!";
      echo "<script>alert('User Resume uploaded successfully! ') </script>";
    } else {
      $cupd = "User Resume has not been updated successfully!!!";
      echo "<script>alert('User Resume has not been updated successfully!!! ') </script>";
    }
  } else {
    $cupd = "User Resume has not been updated successfully!!!";
    echo "<script>alert('User Resume has not been updated successfully!!! ') </script>";
  }
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>HIRE HUNT</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

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
  <?php
  //include('include/header.php');

  if (isset($_SESSION['msg'])) {
    echo "<div class='alert-danger col-12' style='height:30px;text-align:center;padding:5px' ><b>" . $_SESSION['msg'] . "</b></div>";
  }

  if (isset($_SESSION['log_msg'])) {
    echo  '<div class="alert alert-danger" style="height:30px;text-align:center;padding:5px">' . $_SESSION['log_msg'] . '</div>';
  }
  unset($_SESSION['msg']);
  unset($_SESSION['log_msg']);
  ?>
  <main>
    <!-- slider Area Start-->
    <div class="slider-area ">
      <!-- Mobile Menu -->
      <div class="slider-active" style="height:450px;">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" height="450" width="100vw" src="img/1.jpg" alt="First slide">
            </div>
             <div class="carousel-item">
              <img class="d-block w-100" height="450" width="100vw" src="img/2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" height="450" width="100vw" src="img/3.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!-- slider Area End-->
    <!-- Our Services Start -->

    <div class="our-services pt-30">

    </div>

    <!-- Our Services End -->
    <!-- Online CV Area Start -->

    <?php
    if (!isset($_SESSION['cid'])) {
      ?>

      <div class="online-cv cv-bg section-overly pt-90 pb-120" data-background="assets/img/gallery/cv_bg.jpg">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-10">
              <div class="cv-caption text-center">
                <p class="pera1">
                  FEATURED TOURS Packages
                </p>
                <p class="pera2">
                  Make a Difference with Your Online Resume!
                </p>
                <?php
                if (isset($_SESSION['uid'])) {
                  $sql = "SELECT `resume_loc` FROM `user_reg` WHERE `username`= '" . $_SESSION['uname'] . "' ";
                  $result = mysqli_query($conn, $sql);
                  $set = mysqli_fetch_array($result);
                  $resume = $set['resume_loc'];

                  if ($resume != "") {
                    ?>
                    <a href="#" class="border-btn2 border-btn4" onclick="myFunction()">Upload your cv</a>
                    <script>
                      function myFunction() {
                        alert("You already uploaded your resume ! ");
                      }
                    </script>
                    <?php
                  } else {
                    ?>
                    <!-- <a href="" data-toggle="modal" data-target="#uploadcv" class="border-btn2 border-btn4">Upload your cv</a> -->
                    <a data-target="#uploadcv" data-toggle="modal" href="" class="border-btn2 border-btn4">Upload your cv
                    </a>

                    <!-- Modal start here-->
                    <div class="modal fade" id="uploadcv" tabindex="-1" data-backdrop="false" style="margin-top:50px;" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Upload Resume</h4>
                          </div>

                          <form enctype="multipart/form-data" method="post">
                            <div class="modal-body">
                              <div class="form-group">
                                <div class="rows">
                                  <div class="col-md-12">
                                    <div class="rows">
                                      <div class="col-md-8">
                                        <!-- <input id="photo" name="photo" type="file" required=""> -->
                                        <input name="resume" id="resume" placeholder="Select Resume File" type="file" class="form-control" required tabindex="1">
                                      </div>

                                      <div class="col-md-4"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer">
                              <button class="btn btn-default" data-dismiss="modal">Close</button> <button class="btn btn-primary" name="upd" type="submit">Upload Resume</button>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- Modal ends here -->
              
                    <?php
                  } ?>
                  <?php
                } else {
                  ?><a href="" data-toggle="modal" data-target="#loginModal" class="border-btn2 border-btn4">Upload your cv</a>
                  <?php
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
    <!-- Online CV Area End-->
    <!-- Featured_job_start -->
    <section class="featured-job-area feature-padding" style="margin-top:-70px;">
      <div class="container">
        <!-- Section Tittle -->
        <div class="row">
          <div class="col-lg-12">
            <div class="section-tittle text-center">
              <span>Recent Job</span>
              <h2>Featured Jobs</h2>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-xl-10">

            <?php $qry = "SELECT * FROM `joblist` ORDER BY `job_posted` DESC LIMIT 3";
            $ans = mysqli_query($conn, $qry);


            while ($result = mysqli_fetch_array($ans)) {
              if ($result['status'] != 0) {


                $sql1 = "SELECT `company_name`,`logo_loc`,`company_address` From `company_reg` WHERE `c_id`='" . $result['c_id'] . "' ";
                $result1 = mysqli_query($conn, $sql1);
                while ($ans1 = mysqli_fetch_array($result1)) {

                  ?>

                  <!-- single-job-content -->
                  <div class="single-job-items mb-30">
                    <div class="job-items">

                      <div class="company-img">
                        <a href="job_details.php?jid=<?php echo $result['job_id']; ?>"><img src="<?php echo $folder . $ans1['logo_loc']; ?>" alt="" height="=85px" width="85px"></a>
                      </div>

                      <div class="job-tittle">
                        <a href="job_details.php?jid=<?php echo $result['job_id']; ?>">
                          <h4><?php echo $result['job_title'];
                            echo " (".$result['category'].")";
                            ?></h4>
                        </a>
                        <ul>
                          <li><?php echo $ans1['company_name']; ?></li>
                          <li><i class="fas fa-map-marker-alt"></i><?php echo $ans1['company_address'];
                          } ?></li>
                        <li>₹<?php echo $result['salary'] ?></li>
                      </ul>
                    </div>
                  </div>
                  <div class="items-link f-right">
                    <a href="job_details.php?jid=<?php echo $result['job_id']; ?>"><?php echo $result['job_type']; ?></a>
                    <span>Last Date For Apply - <?php echo $result['last_date']; ?></span>
                  </div>
                </div>
                <?php
              }
            } ?>
            <div class="cv-caption text-center">
              <a href="<?php echo $folder; ?>/online%20job%20portal/job_listing.php" class="border-btn2 border-btn4">Browse All Jobs/Vacancy</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Featured_job_end -->
    <!-- How  Apply Process Start-->
    <div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets/img/gallery/how-applybg.png">
      <div class="container">
        <!-- Section Tittle -->
        <div class="row">
          <div class="col-lg-12">
            <div class="section-tittle white-text text-center">
              <span>Apply process</span>
              <h2> How it works</h2>
            </div>
          </div>
        </div>
        <!-- Apply Process Caption -->
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="single-process text-center mb-30">
              <div class="process-ion">
                <span class="flaticon-search"></span>
              </div>
              <div class="process-cap">
                <h5>1. Search a job</h5>
                <p>
                  Search latest job openings online including IT, Sales, Banking, Fresher, Walk-ins, Part time, Govt jobs,etc. on MonsterIndia.com. Post your resume to apply ...
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="single-process text-center mb-30">
              <div class="process-ion">
                <span class="flaticon-curriculum-vitae"></span>
              </div>
              <div class="process-cap">
                <h5>2. Apply for job</h5>
                <p>
                  To Apply for a Job, Attach a file of your resume. Many applications allow you to browse for a file on your computer or USB drive. Once you find one, click the "Apply for Job".
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="single-process text-center mb-30">
              <div class="process-ion">
                <span class="flaticon-tour"></span>
              </div>
              <div class="process-cap">
                <h5>3. Get your job</h5>
                <p>
                  You will get a Interview Call from Company for Particular Job Then after Apply. If you Passed the interview, your job is confirmed. And You Received offer latter from Company.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- How  Apply Process End-->
    <!-- Testimonial Start -->
    <!-- <div class="testimonial-area testimonial-padding">
              <div class="container">
                <div class="row d-flex justify-content-center">
                  <div class="col-xl-8 col-lg-8 col-md-10">
                    <div class="h1-testimonial-active dot-style">
                      <div class="single-testimonial text-center">
                        <div class="testimonial-caption ">
                          <div class="testimonial-founder  ">
                            <div class="founder-img mb-30">
                              <img src="assets/img/testmonial/testimonial-founder.png" alt="">
                              <span>Margaret Lawson</span>
                              <p>
                                Creative Director
                              </p>
                            </div>
                          </div>
                          <div class="testimonial-top-cap">
                            <p>
                              “I am at an age where I just want to be fit and healthy our bodies are our
                              responsibility! So start caring for your body and it will care for you. Eat
                              clean it will care for you and workout hard.”
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="single-testimonial text-center">
                        <div class="testimonial-caption ">
                          <div class="testimonial-founder  ">
                            <div class="founder-img mb-30">
                              <img src="assets/img/testmonial/testimonial-founder.png" alt="">
                              <span>Margaret Lawson</span>
                              <p>
                                Creative Director
                              </p>
                            </div>
                          </div>
                          <div class="testimonial-top-cap">
                            <p>
                              “I am at an age where I just want to be fit and healthy our bodies are our
                              responsibility! So start caring for your body and it will care for you. Eat
                              clean it will care for you and workout hard.”
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="single-testimonial text-center">
                        <div class="testimonial-caption ">
                          <div class="testimonial-founder  ">
                            <div class="founder-img mb-30">
                              <img src="assets/img/testmonial/testimonial-founder.png" alt="">
                              <span>Margaret Lawson</span>
                              <p>
                                Creative Director
                              </p>
                            </div>
                          </div>
                          <div class="testimonial-top-cap">
                            <p>
                              “I am at an age where I just want to be fit and healthy our bodies are our
                              responsibility! So start caring for your body and it will care for you. Eat
                              clean it will care for you and workout hard.”
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

    <!-- <div class="support-company-area support-padding fix">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="right-caption">
                                        <div class="section-tittle section-tittle2">
                                            <span>What we are doing</span>
                                            <h2>24k Talented people are getting Jobs</h2>
                                        </div>
                                        <div class="support-caption">
                                            <p class="pera-top">Mollit anim laborum duis au dolor in voluptate velit ess cillum dolore eu lore dsu quality mollit anim laborumuis au dolor in voluptate velit cillum.</p>
                                            <p>Mollit anim laborum.Duis aute irufg dhjkolohr in re voluptate velit esscillumlore eu quife nrulla parihatur. Excghcepteur signjnt occa cupidatat non inulpadeserunt mollit aboru. temnthp incididbnt ut labore mollit anim
                                                laborum suis aute.</p>
                                            <a href="about.php" class="btn post-btn">Post a job</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="support-location-img">
                                        <img src="assets/img/service/support-img.jpg" alt="">
                                        <div class="support-img-cap text-center">
                                            <p>Since</p>
                                            <span>1994</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
    <!-- Support Company End-->
    <!-- Blog Area Start -->
    <!-- <div class="home-blog-area blog-h-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-tittle text-center">
                                        <span>Our latest blog</span>
                                        <h2>Our recent news</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="home-blog-single mb-30">
                                        <div class="blog-img-cap">
                                            <div class="blog-img">
                                                <img src="assets/img/blog/home-blog1.jpg" alt="">
                                                <div class="blog-date text-center">
                                                    <span>24</span>
                                                    <p>Now</p>
                                                </div>
                                            </div>
                                            <div class="blog-cap">
                                                <p>| Properties</p>
                                                <h3><a href="single-blog.php">Footprints in Time is perfect House in Kurashiki</a></h3>
                                                <a href="#" class="more-btn">Read more »</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="home-blog-single mb-30">
                                        <div class="blog-img-cap">
                                            <div class="blog-img">
                                                <img src="assets/img/blog/home-blog2.jpg" alt="">
                                                <div class="blog-date text-center">
                                                    <span>24</span>
                                                    <p>Now</p>
                                                </div>
                                            </div>
                                            <div class="blog-cap">
                                                <p>| Properties</p>
                                                <h3><a href="single-blog.php">Footprints in Time is perfect House in Kurashiki</a></h3>
                                                <a href="#" class="more-btn">Read more »</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
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




