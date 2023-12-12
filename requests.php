<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
error_reporting(0);
if (!isset($_SESSION["uid"])) {
  header("location:admin_login.php");
}
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Show Students Requests: </h6>
    <?php
              if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
                  // echo '<h4 class="bg-primary"> '.$_SESSION['success'].' </h4>';
                  echo '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                      <span class="text-success">'.$_SESSION['success'].'</span>
                    </div>';
                  unset($_SESSION['success']);
              }

              if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                  // echo '<h4 class="bg-danger"> '.$_SESSION['status'].' </h4>';
                  echo '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                      <span class="text-success">'.$_SESSION['status'].'</span>
                    </div>';
                  unset($_SESSION['status']);
              }
    ?>
    <?php
              if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
                  // echo '<h4 class="bg-primary"> '.$_SESSION['success'].' </h4>';
                  echo '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                      <span class="text-danger">'.$_SESSION['error'].'</span>
                    </div>';
                  unset($_SESSION['error']);
              }

              if(isset($_SESSION['status-error']) && $_SESSION['status-error'] != ''){
                  // echo '<h4 class="bg-danger"> '.$_SESSION['status'].' </h4>';
                  echo '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                      <span class="text-danger">'.$_SESSION['status-error'].'</span>
                    </div>';
                  unset($_SESSION['status-error']);
              }
    ?>
</div>

  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="datatableid" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Enrollment Number </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Email </th>
            <th> Contact </th>
            <th> Password </th>
            <th> Registration Date </th>
            <th> Accept </th>
            <th> Reject </th>
          </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM requests";
        $query_run = mysqli_query($connection, $query);
        if(mysqli_num_rows($query_run) > 0){
          while($row = mysqli_fetch_assoc($query_run)){
          ?>
            <tr>
            <td><?php  echo $row['enrollment_number']; ?></td>
            <td><?php  echo $row['first_name']; ?></td>
            <td><?php  echo $row['last_name']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['contact']; ?></td>
            <td><?php  echo $row['password']; ?></td>
            <td><?php  echo $row['date']; ?></td>
            <td>
                <a href="accept.php?id=<?php echo $row['enrollment_number']?>" class="btn btn-primary btn-sm my-2 mr-2 ">Accept</a>
            </td>
            <td>
                <a href="reject.php?id=<?php echo $row['enrollment_number']?>" class="btn btn-danger btn-sm my-2 mr-2">Reject</a>
            </td>
            </tr>
          <?php
          } 
        }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</div>
      </div>
</div>
<!-- /.container-fluid -->

<?php
// include('admin/scripts.php');
include('admin/footer.php');
?>