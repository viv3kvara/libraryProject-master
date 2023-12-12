<?php
// session_start();
include('security.php');
include('admin/header.php'); 
include('admin/navbar.php'); 
include('function.php');

if (!isset($_SESSION["uid"])) {
  header("location:admin_login.php");
} 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<?php
  if(isset($_SESSION['new'])=="true"){
    echo '<div class="alert alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
        <span class="text-success">Hello! '.$_SESSION['uid'].' Now You are logged in!</span>
      </div>';
    unset($_SESSION['success']); 
   }
  ?>
  

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="home.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div> -->

  <!-- Content Row -->
  <div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                  require 'database/dbconfig.php';
                  $query = "SELECT enrollment_number FROM requests ORDER BY enrollment_number";  
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h4> Total Requests: '.$row.'</h4>';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-bell fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Students</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <?php
                  require 'database/dbconfig.php';
                  $query = "SELECT enrollment_number FROM register ORDER BY enrollment_number";  
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h4> Total Students: '.$row.'</h4>';
                ?>
          
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Faculty</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                  require 'database/dbconfig.php';
                  $query = "SELECT f_id FROM faculties ORDER BY f_id";  
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h4> Total Faculties: '.$row.'</h4>';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Issued Books</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Books</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                  require 'database/dbconfig.php';
                  $query = "SELECT book_id FROM books ORDER BY book_id";  
                  $query_run = mysqli_query($connection, $query);
                  $row = mysqli_num_rows($query_run);
                  echo '<h4> Total Books: '.$row.'</h4>';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-book fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->


<?php
// include('includes/scripts.php');
include('admin/footer.php');
?>