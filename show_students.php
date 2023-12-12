<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
if (!isset($_SESSION["uid"])) {
  header("location:admin_login.php");
}
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Show Students: </h6>
  </div>
    
    
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
            <th> Registration Date </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM register";
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
            <td><?php  echo $row['date']; ?></td>
              <td>
                  <form action="modify_students.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['enrollment_number'];?>">
                    <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                  </form>
              </td>
            </tr>
          <?php
          } 
        }
        else{
          echo "No Record Found";
        }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->

<?php
// include('admin/scripts.php');
// include('admin/footer.php');
?>