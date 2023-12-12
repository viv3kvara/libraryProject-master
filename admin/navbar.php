<?php
  session_start();
  // error_reporting(0);
  include('security.php');
  if (!isset($_SESSION["uid"])) {
    header("location:admin_login.php");
  }
 ?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
    <div class="sidebar-brand-icon">
      <i class="fas fa-user"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
  </a>

  <!-- <span style="text-align:center">
<img src="img/gpp.jpg" style="width: 200px; height: auto; padding-top: 20px; padding-bottom: 20px;"></span> -->

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="home.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <!-- <hr class="sidebar-divider"> -->

  <!-- Heading -->
  <!-- <div class="sidebar-heading">
  About Profiles
</div> -->

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="requests.php">
      <i class="fa fa-bell"></i>
      <?php
          require 'database/dbconfig.php';
          $query = "SELECT enrollment_number FROM requests ORDER BY enrollment_number DESC";  
          $query_run = mysqli_query($connection, $query);
          $nrow = mysqli_num_rows($query_run);
      ?>
      <span>Requests<span class="badge badge-danger badge-counter"><?php echo $nrow;?></span></span>
    </a>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="show_students.php">
      <i class="fa fa-graduation-cap"></i>
      <span>Students</span>
    </a>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="add_faculties">
      <i class="fas fa-chalkboard-teacher"></i>
      <span>Faculties</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="add_books.php">
      <i class="fas fa-fw fa-book"></i>
      <span>Books</span>
    </a>
    <!-- <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Utilities:</h6>
      <a class="collapse-item" href="utilities-color.html">Colors</a>
      <a class="collapse-item" href="utilities-border.html">Borders</a>
      <a class="collapse-item" href="utilities-animation.html">Animations</a>
      <a class="collapse-item" href="utilities-other.html">Other</a>
    </div>
  </div> -->
  </li>

  <!-- Divider -->
  <!-- <hr class="sidebar-divider"> -->

  <!-- Heading -->
  <!-- <div class="sidebar-heading">
  About Books
</div> -->


  <!-- Nav Item - Pages Collapse Menu -->
  <!-- <li class="nav-item">
  <a class="nav-link" href="">
  <i class="fa fa-check"></i>
    <span>Issued Books</span>
  </a> -->
  <!-- <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Login Screens:</h6>
      <a class="collapse-item" href="login.html">Login</a>
      <a class="collapse-item" href="register.html">Register</a>
      <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Other Pages:</h6>
      <a class="collapse-item" href="404.html">404 Page</a>
      <a class="collapse-item" href="blank.html">Blank Page</a>
    </div>
  </div> -->
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
      aria-controls="collapsePages">
      <i class="fa fa-check "></i>
      <span>Issue Books</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Issued Books:</h6>
        <a class="collapse-item" href="issue_book.php">Issue For Students</a>
        <a class="collapse-item" href="faculty_issue_book.php">Issue For Faculties</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="charts.html">
      <i class="fa fa-thumbs-up"></i>
      <span>Return Books</span></a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fa fa-thumbs-up"></i>
      <span>Return Books</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Returned Books:</h6>
        <a class="collapse-item" href="return_books.php">Return For Students</a>
        <a class="collapse-item" href="faculty_return_books.php">Return For Faculties</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="charts.html">
      <i class="fa fa-thumbs-down"></i>
      <span>Not Return Books</span></a>
  </li> -->

  <!-- Nav Item - Tables -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="charts.html">
      <i class="fas fa-rupee-sign"></i>
      <span>Collect Fines</span></a>
  </li> -->

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="modify_admin_profile.php">
      <i class="fas fa-user"></i>
      <span>My Profile</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="setting.php">
      <i class="fas fa-cogs"></i>
      <span>Settings</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      <!-- <form action="" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
        method="GET">
        <div class="input-group">
          <input type="text" name="search" required class="form-control bg-light border-0 small"
            placeholder="Search for..." value="<?php if (isset($_GET['search'])) {echo $_GET['search'];}?>">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form> -->


      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                  aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <?php
                  require 'database/dbconfig.php';
                  $query = "SELECT enrollment_number FROM requests ORDER BY enrollment_number DESC";  
                  $query_run = mysqli_query($connection, $query);
                  $nrow = mysqli_num_rows($query_run);
                  // echo '<h4> Total Students: '.$row.'</h4>';
                ?>
            <span class="badge badge-danger badge-counter"><?php echo $nrow;?></span>
          </a>
          <!-- Dropdown - Alerts -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
              Alerts Center
            </h6>
            <?php
                  $query = "SELECT * FROM requests";
                  $query_run = mysqli_query($connection, $query);

                  // $arr = mysqli_fetch_array($query_run);

                  // if(count($arr) > 0){
                  if(mysqli_fetch_array($query_run)){
                    foreach($query_run as $row){
                      ?>
            <div class="dropdown-item d-flex align-items-center">
              <div class="mr-3">
                <div class="icon-circle bg-primary">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </div>
              </div>
              <div>
                <div class="big font-weight-bold">
                  <small><i><?php echo $row['date']?></i></small>
                </div>

                <span class="text-gray-700"><b class="font-weight-bold">
                    <?php echo $row['enrollment_number']?>
                  </b> Hello! Please Accept My Request!</span>
                <div class="d-flex justify-content-end">
                  <a href="accept.php?id=<?php echo $row['enrollment_number']?>" class="btn btn-primary btn-sm my-2 mr-2 ">Accept</a>
                  <a href="reject.php?id=<?php echo $row['enrollment_number']?>" class="btn btn-danger btn-sm my-2 mr-2">Reject</a>
                </div>
              </div>

            </div>

            <?php
                    }
                  }
                  else{
                    echo '<div class="text-center font-weight-bold text-gray-700">
                            <i>No Pending Requests!</i>
                          </div>';
                  }
                ?>
            <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a> -->
            <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> -->

          </div>
        </li>

        <!-- Nav Item - Messages -->
        <!-- <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i> -->
            <!-- Counter - Messages -->
            <!-- <span class="badge badge-danger badge-counter">7</span>
          </a> -->
          <!-- Dropdown - Messages -->
          <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
              Message Center
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                <div class="status-indicator bg-success"></div>
              </div>
              <div class="font-weight-bold">
                <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.
                </div>
                <div class="small text-gray-500">Emily Fowler · 58m</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                <div class="status-indicator"></div>
              </div>
              <div>
                <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent
                  to you?</div>
                <div class="small text-gray-500">Jae Chun · 1d</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                <div class="status-indicator bg-warning"></div>
              </div>
              <div>
                <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far,
                  keep up the good work!</div>
                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                <div class="status-indicator bg-success"></div>
              </div>
              <div>
                <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say
                  this to all dogs, even if they aren't good...</div>
                <div class="small text-gray-500">Chicken the Dog · 2w</div>
              </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
          </div>
        </li> -->

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="mr-1 d-none d-lg-inline text-gray-600 small">
              <?php 
                    echo $_SESSION['uid']; 
              ?>
            </span>
            <img height="40px" width="40px"
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVVLvF-Ju09woaELw47g_fgxI6h9JU707Twg&usqp=CAU">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="modify_admin_profile.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="setting.php">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <!-- <a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
            </a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <?php
if(isset($_POST['logoutbtn'])){
  session_destroy();
  unset($_SESSION['uid']);
  header('Location: admin_login.php');
}
?>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            <form action="logout.php" method="POST">

              <button type="submit" name="logoutbtn" class="btn btn-primary">Logout</button>

            </form>


          </div>
        </div>
      </div>
    </div>

    <?php
      include('scripts.php');
    ?>