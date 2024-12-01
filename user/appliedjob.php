<?php
session_start();
error_reporting(0);
$page = "appliedjob";

// include_once('../admin/include/dbconnect.php');


if ((!isset($_SESSION['uid']))) {
  header("location:../index.php");
  include('../include/header.php');
} else {
  include('../include/header.php');
?>


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
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
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

    </head>

    <body>
        <?php
        if (isset($_SESSION['del'])) {
            echo "<div class='alert alert-success alert-dismissible fade show col-12' role='alert'>
                <strong>Success!</strong> Applicant Detail has been deleted successfully
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
                </button>
            </div>";
        } elseif (isset($_SESSION['cdel'])) {
            echo "<div class='alert alert-danger alert-dismissible fade show col-12' role='alert'>
						<strong>Error!</strong> Applicant Detail has not been deleted successfully
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						  <span aria-hidden='true'>×</span>
						</button>
					  </div>";
        }
        unset($_SESSION['del']);
        unset($_SESSION['cdel']);
        ?>
        <div class="col-lg-12">
            <h2 class="page-header" style="display: inline;">Applied Jobs</h2>
            <h3 style="display: inline;"> <a href="../job_listing.php" class="btn btn-primary btn-md"> <i class="fa fa-plus-circle fw-fa"></i> Apply</a></h3>


        </div>
        </div>
        <div class="table-responsive">
            <table id="dash-table" class="table table-striped table-hover" style="font-size:12px" cellspacing="0">

                <thead>
                    <tr>
                        <!-- <th>No.</th> -->
                        <th>Job Title</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Applied Date</th>
                        <th width="10%" align="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // to find the currosponding record from `applicants_list` table
                    $sql1 = "SELECT u_id from user_reg where username='" . $_SESSION['uname'] . "'";
                    $result1 = mysqli_query($conn, $sql1);
                    $ans1 = mysqli_fetch_array($result1);

                    // Free result set
                    $result1->free_result();

                    $qry = "SELECT * FROM `applicants_list` WHERE u_id = ' " . $ans1['u_id'] . "' ";
                    $ans = mysqli_query($conn, $qry);

                    while ($result = mysqli_fetch_array($ans)) {
                        echo '<tr>';

                        $_SESSION['apid'] = $result[0];

                        $sql1 = "SELECT job_title From `joblist` WHERE `job_id`='" . $result[1] . "' ";
                        $result1 = mysqli_query($conn, $sql1);
                        while ($ans1 = mysqli_fetch_array($result1)) {
                            echo '<td>' . $ans1[0] . '</td>';
                        }

                        $sql2 = "SELECT name From `user_reg` WHERE `u_id`='" . $result[2] . "' ";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($ans2 = mysqli_fetch_array($result2)) {
                            echo '<td>' . $ans2[0] . '</td>';
                        }



                        $sql3 = "SELECT company_name From `company_reg` WHERE `c_id`='" . $result[3] . "' ";
                        $result3 = mysqli_query($conn, $sql3);
                        while ($ans3 = mysqli_fetch_array($result3)) {
                            echo '<td>' . $ans3[0] . '</td>';
                        }

                        echo '<td>' . $result[4] . '</td>';

                        echo '<td align="center"><a style="color:white;" href="view.php"><button class="delete btn-sm fa fa-info fw-fa btn-info">  View</button> </a> 
									
                        <button class="delete btn-sm pe-7s-trash btn-danger" style="color:white;" onclick=confirmation("' . $result[0] . '")>Delete</button>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
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
        <script>
            $(function() {
                $("#dash-table").DataTable();
                $('#dash-table2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });

            function confirmation(delName) {
                var del = confirm("Do you want to remove applied job data?");
                if (del == true) {
                    window.location.href = "delete.php?apid=" + delName;
                }
                return del;
            }
        </script>
    </body>

<?php
}
?>