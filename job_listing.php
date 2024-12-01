<?php
$page="find job";
include('include/header.php');
//error_reporting(0);
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Find Jobs - Page</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="site.webmanifest">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

  <!-- CSS here -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/price_rangs.css">
  <link rel="stylesheet" href="assets/css/flaticon.css">
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

  <main>

    <!-- Hero Area Start-->
    <!-- <div class="slider-area ">
              <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="hero-cap text-center">
                        <h2>Get your job</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <!-- <div class="job-listing-area pt-120 pb-120"> -->
    <div class="container">
      <div class="row">
        <!-- Left content -->
        <div class="col-xl-3 col-lg-3 col-md-4">
          <div class="row">
            <div class="col-12">
              <div class="small-section-tittle2 mb-45">
                <div class="ion">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                    <path fill-rule="evenodd" fill="rgb(27, 207, 107)" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                  </svg>
                </div>
                <h4>Filter Jobs</h4>
              </div>
            </div>
          </div>
          <form action="" method="POST">

            <!-- Job Category Listing start -->
            <div class="job-category-listing mb-50">


              <!-- single one -->
              <div class="single-listing">
                <div class="small-section-tittle2">
                  <h4>Job Category</h4>
                </div>
                <!-- Select job items start -->
                <div class="select-job-items2">
                  <select name="category">
                    <option value="" selected>Select Category</option>

                    <option value="All Category" <?php if (isset($_REQUEST['category'])) {
                      if ($_REQUEST['category'] == "All Category") echo 'selected';
                    } ?>>
                      All Category

                      <?php $qry = "SELECT * FROM `joblist`";
                      $qry_ans = mysqli_query($conn, $qry);
                      echo "(" . mysqli_num_rows($qry_ans) . ")"; ?>
                    </option>



                    <?php $q = "SELECT * FROM category";
                    $r = mysqli_query($conn, $q);
                    while ($ans = mysqli_fetch_array($r)) {
                      ?>
                      <option value="<?php echo $ans['category']; ?>" <?php if (isset($_REQUEST['category'])) {
                        if ($_REQUEST['category'] == $ans['category']) echo 'selected';
                      } ?>>
                        <?php echo $ans['category']; ?>


                        <?php $qry = "SELECT * FROM `joblist` WHERE `category`= '" . $ans['category'] . "' ";
                        $qry_ans = mysqli_query($conn, $qry);
                        echo "(" . mysqli_num_rows($qry_ans) . ")"; ?>
                      </option>
                      <?php
                    } ?>
                    }
                  </select>


                </div>
                <!--  Select job items End-->
                <!-- select-Categories start -->
                <div class="select-Categories pt-80 pb-50">
                  <div class="small-section-tittle2">
                    <h4>Job Type</h4>
                  </div>
                  <label class="container">Full Time
                    <input type="checkbox" name="type[]" value="full time" <?php if (isset($_REQUEST['type'])) {
                      if (in_array("full time", $_REQUEST['type'])) {
                        echo 'checked';
                      }
                    } ?>>
                    <span class="checkmark"></span>
                  </label>
                  <label class="container">Part Time
                    <input type="checkbox" name="type[]" value="part time" <?php if (isset($_REQUEST['type'])) {
                      if (in_array("part time", $_REQUEST['type'])) {
                        echo 'checked';
                      }
                    } ?>>
                    <span class="checkmark"></span>
                  </label>
                  <label class="container">Part Time / Full Time
                    <input type="checkbox" name="type[]" value="part time/full time" <?php if (isset($_REQUEST['type'])) {
                      if (in_array("part time/full time", $_REQUEST['type'])) {
                        echo 'checked';
                      }
                    } ?>>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <!-- select-Categories End -->
              </div>
              <!-- single two -->
              <div class="single-listing">
                <div class="small-section-tittle2">
                  <h4>Job Location</h4>
                </div>
                <!-- Select job items start -->
                <div class="select-job-items2">
                  <select name="location">
                    <option value="">Select Location</option>
                    <option value="Anywhere" <?php if (isset($_REQUEST['location'])) {
                      if ($_REQUEST['location'] == "Anywhere") echo 'selected';
                    } ?>>
                      Anywhere
                      <?php
                      $qry = "SELECT * FROM `joblist`";
                      $qry_ans = mysqli_query($conn, $qry);
                      echo "(" . mysqli_num_rows($qry_ans) . ")"; ?>
                    </option>

                    <?php $q = "SELECT * FROM company_reg";
                    $r = mysqli_query($conn, $q);
                    while ($ans = mysqli_fetch_array($r)) {

                      ?>
                      <option value="<?php echo $ans['c_id']; ?>" <?php if (isset($_REQUEST['location'])) {
                        if ($_REQUEST['location'] == $ans['c_id']) echo 'selected';
                      } ?>>
                        <?php echo $ans['company_address']; ?>

                        <?php
                        $qry = "SELECT * FROM `joblist` WHERE `c_id`='" . $ans['c_id'] . "'";
                        $qry_ans = mysqli_query($conn, $qry);
                        echo "(" . mysqli_num_rows($qry_ans) . ")"; ?></option>

                      <?php

                    } ?>


                  </select>
                </div>
                <!--  Select job items End-->
                <!-- select-Categories start -->
                <div class="select-Categories pt-80 pb-50">
                  <div class="single-listing">
                    <!-- Range Slider Start -->
                    <!-- <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow"> -->
                    <div class="small-section-tittle2">
                      <h4>Filter Salary</h4>
                    </div>
                    <div class="widgets_inner">

                      <input type="number" name="min_amt" id="min_amt" onchange="myFunction1()" placeholder="Enter Minimum Amount" value="<?php if (isset($_REQUEST['min_amt']))
                        echo $_REQUEST['min_amt'];
                      ?>">
                      <input type="number" name="max_amt" id="max_amt" onchange="myFunction2()" placeholder="Enter Maximum Amount" value="<?php if (isset($_REQUEST['max_amt']))
                        echo $_REQUEST['max_amt'];
                      ?>">

                      <script>
                        <?php
                        // To find out the maximum salary from database starts here
                        $max_salary = "SELECT `salary` FROM `joblist` ORDER BY `salary` DESC";
                        $max_salary_result = mysqli_query($conn, $max_salary);
                        $max_salary_dataset = mysqli_fetch_array($max_salary_result);

                        // To find out the maximum salary from database ends here
                        ?>

                        function myFunction1() {
                          var model = document.getElementById('min_amt').value;
                          var max_sal = "<?php echo $max_salary_dataset['salary']; ?>";
                          document.getElementById("max_amt").value = max_sal;
                        }
                      </script>

                      <script>
                        <?php
                        // To find out the minimum salary from database starts here
                        $min_salary = "SELECT `salary` FROM `joblist` ORDER BY `salary` ";
                        $min_salary_result = mysqli_query($conn, $min_salary);
                        $min_salary_dataset = mysqli_fetch_array($min_salary_result);

                        // To find out the minimum salary from database ends here
                        ?>

                        function myFunction2() {
                          var model = document.getElementById('max_amt').value;
                          var min_sal = "<?php echo $min_salary_dataset['salary']; ?>";
                          document.getElementById("min_amt").value = min_sal;
                        }
                      </script>

                    </div>
                    <!-- </aside> -->
                    <!-- Range Slider End -->
                  </div>
                </div>
                <!-- select-Categories End -->
              </div>
              <!-- single three -->

              <div class="container" style="margin-top: 20px;">
                <button type="submit" name="Search" class="btn-primary"><i class="fa fa-search"></i>
                  Search</button>
                <button type="reset" class="btn-danger"><i class="fa fa-window-close"></i>
                  Reset</button>

              </div>
            </form>
          </div>
          <!-- Job Category Listing End -->
        </div>
        <!-- Right content -->
        <div class="col-xl-9 col-lg-9 col-md-8">
          <!-- Featured_job_start -->
          <section class="featured-job-area">
            <div class="container">
              <!-- Count of Job list Start -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="count-job mb-35">
                    <?php

                    if (isset($_REQUEST['Search'])) {
                      $cat = $_REQUEST['category'];
                      $id = $_REQUEST['location'];
                      $min_amt = $_REQUEST['min_amt'];
                      $max_amt = $_REQUEST['max_amt'];

                      //job type

                      if (isset($_REQUEST['type'])) {

                        $i = 0; //variable to find total no. of jobs according the type

                        foreach ($_REQUEST['type'] as $value) {

                          $job_type = $value;
                          if ($job_type != "" || $cat != "" || $id != "" || $min_amt != "" || $max_amt != "")
                            $type_qry = "SELECT * FROM `joblist` WHERE `job_type`= '$job_type' OR `category`= '$cat' OR `c_id`='$id' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                          else
                            $type_qry = "SELECT * FROM `joblist` WHERE `job_type`= '$job_type' ";
                          $type_qry_ans = mysqli_query($conn, $type_qry);
                          // $type_qry_ans_row = mysqli_num_rows($type_qry_ans);
                          // $i+=$type_qry_ans_row;
                          $i += mysqli_num_rows($type_qry_ans);
                        }
                        ?>
                        <section class="featured-job-area">
                          <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="count-job mb-35">

                                  <span><?php echo $i;
                                    ?> Jobs found</span>
                                </div>
                              </div>
                            </div>
                            <?php
                            foreach ($_REQUEST['type'] as $value) {
                              $job_type = $value;

                              if (isset($id)) {
                                $type_qry = "SELECT * FROM `joblist` WHERE `job_type`= '$job_type' OR `category`= '$cat' OR `c_id`='$id' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                                $type_qry_ans = mysqli_query($conn, $type_qry);
                                $type_qry_ans_row = mysqli_num_rows($type_qry_ans);
                              } else {
                                $type_qry = "SELECT * FROM `joblist` WHERE `job_type`= '$job_type' OR `category`= '$cat' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                                $type_qry_ans = mysqli_query($conn, $type_qry);
                                $type_qry_ans_row = mysqli_num_rows($type_qry_ans);
                              }
                              ?>

                              <?php
                              if ($i == 0) //if 0 rows - starts here
                              {
                                echo "Sorry no job found accrording to your preference.";
                              } else {

                                // while loop - ends here
                                while ($type_qry_result = mysqli_fetch_array($type_qry_ans)) {

                                  // to remove expired jobs
                                  if ($type_qry_result['status'] != 0) {


                                    $sql1 = "SELECT `company_name`,`logo_loc`,`company_address` From `company_reg` WHERE `c_id`='" . $type_qry_result['c_id'] . "' ";
                                    $result1 = mysqli_query($conn, $sql1);
                                    while ($ans1 = mysqli_fetch_array($result1)) {


                                      ?>
                                      <div class="single-job-items mb-30">
                                        <div class="job-items">
                                          <div class="company-img">
                                            <a href="job_details.php?jid=<?php echo $result['job_id']; ?>"><img src="<?php echo $folder . $ans1['logo_loc']; ?>" alt="" height="=85px" width="85px"></a>
                                          </div>
                                          <div class="job-tittle job-tittle2">
                                            <a href="job_details.php?jid=<?php echo $type_qry_result['job_id']; ?>">
                                              <h4><?php echo $type_qry_result['job_title'];
                        echo " (".$type_qry_result['category'].")";                      ?></h4>
                                            </a>
                                            <ul>
                                              <li><?php echo $ans1['company_name']; ?></li>
                                              <li><i class="fas fa-map-marker-alt"></i><?php echo $ans1['company_address'];
                                              } //inner while loop - ends here
                                              ?></li>
                                            <li>₹<?php echo $type_qry_result['salary']; ?></li>
                                          </ul>
                                        </div>
                                      </div>
                                      <div class="items-link items-link2 f-right">
                                        <a href="job_details.php?jid=<?php echo $type_qry_result['job_id']; ?>"><?php echo $type_qry_result['job_type']; ?></a>
                                        <span>Last Date For Apply -
                                          <?php echo $type_qry_result['last_date']; ?></span>
                                      </div>
                                    </div>
                                    <?php
                                  } //if 0 rows - ends here
                                  ?>
                                  <?php
                                } // while loop - ends here
                              }  // elseif ends here
                            }
                            ?>
                          </div>
                        </section>
                        <?php
                      }

                      //location
                      elseif ($id != "") {

                        if ($id == "Anywhere") {
                          $qry = "SELECT * FROM `joblist` WHERE `category`= '$cat' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                          $ans = mysqli_query($conn, $qry);
                          $row = mysqli_num_rows($ans);
                        } elseif (($id != "Anywhere") && ($id != "")) {
                          $qry = "SELECT * FROM `joblist` WHERE `category`= '$cat' OR `c_id`='$id' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                          $ans = mysqli_query($conn, $qry);
                          $row = mysqli_num_rows($ans);
                        }
                      }


                      //category
                      elseif ($cat != "") {

                        if ($cat == "All Category") {
                          // $qry = "SELECT * FROM `joblist` WHERE `c_id`='$id' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                          $qry = "SELECT * FROM `joblist`";
                          $ans = mysqli_query($conn, $qry);
                          $row = mysqli_num_rows($ans);
                        } else {
                          $qry = "SELECT * FROM `joblist` WHERE `category`= '$cat' OR `c_id`='$id' OR `salary` BETWEEN '$min_amt' AND '$max_amt' ";
                          $ans = mysqli_query($conn, $qry);
                          $row = mysqli_num_rows($ans);
                        }
                      } elseif ($min_amt != "" && $max_amt != "") {
                        $qry = "SELECT * FROM `joblist` WHERE `category`= '$cat' OR `c_id`='$id' OR`salary` BETWEEN '$min_amt' AND '$max_amt' ";
                        $ans = mysqli_query($conn, $qry);
                        $row = mysqli_num_rows($ans);
                      } else {
                        $qry = "SELECT * FROM `joblist`";
                        $ans = mysqli_query($conn, $qry);
                        $row = mysqli_num_rows($ans);
                      }
                    } else {
                      $qry = "SELECT * FROM `joblist`";
                      $ans = mysqli_query($conn, $qry);
                      $row = mysqli_num_rows($ans);
                    }

                    if (isset($row)) {
                      ?>


                      <span><?php echo $row;
                        ?> Jobs found</span>

                    </div>
                  </div>
                </div>
                <!-- Count of Job list End -->
                <!-- single-job-content -->

                <?php
                if ($row == 0) //if 0 rows - starts here
                {
                  echo "Sorry no job found accrording to your preference.";
                } else {

                  // while loop - ends here
                  while ($result = mysqli_fetch_array($ans)) {

                    // to remove expired jobs
                    if ($result['status'] != 0) {


                      $sql1 = "SELECT `company_name`,`logo_loc`,`company_address` From `company_reg` WHERE `c_id`='" . $result['c_id'] . "' ";
                      $result1 = mysqli_query($conn, $sql1);
                      while ($ans1 = mysqli_fetch_array($result1)) {


                        ?>
                        <div class="single-job-items mb-30">
                          <div class="job-items">
                            <div class="company-img">
                              <a href="job_details.php?jid=<?php echo $result['job_id']; ?>"><img src="<?php echo $folder . $ans1['logo_loc']; ?>" alt="" height="=85px" width="85px"></a>
                            </div>
                            <div class="job-tittle job-tittle2">
                              <a href="job_details.php?jid=<?php echo $result['job_id']; ?>">
                                <h4><?php echo $result['job_title'];
                                echo " (".$result['category'].")";
                                ?></h4>
                              </a>
                              <ul>
                                <li><?php echo $ans1['company_name']; ?></li>
                                <li><i class="fas fa-map-marker-alt"></i><?php echo $ans1['company_address'];
                                } ?></li>
                              <li>₹<?php echo $result['salary']; ?></li>
                            </ul>
                          </div>
                        </div>
                        <div class="items-link items-link2 f-right">
                          <a href="job_details.php?jid=<?php echo $result['job_id']; ?>"><?php echo $result['job_type']; ?></a>
                          <span>Last Date For Apply - <?php echo $result['last_date']; ?></span>
                        </div>
                      </div>
                      <?php
                    } //if 0 rows - ends here
                    ?>
                    <?php
                  } // to remove expired jobs
                }  // while loop - ends here
              }
              ?>
            </div>
          </section>
          <!-- Featured_job_end -->
        </div>
      </div>
    </div>
    <!-- </div> -->
    <!-- Job List Area End -->
    <!--Pagination Start  -->
    <!-- <div class="pagination-area pb-115 text-center">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="single-wrap d-flex justify-content-center">
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination justify-content-start">
                                                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
    <!--Pagination End  -->

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

  <!-- Jquery Slick , Owl-Carousel Range -->
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