<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
if (!isset($_SESSION["uid"])) {
  header("location:admin_login.php");
}

$errors = array();
$success = array();

if(isset($_POST['edit_setting'])){
	$library_admin = $_POST['library_admin'];
	$library_contact = $_POST['library_contact'];
	$library_email = $_POST['library_email'];
	$library_total_book_issue_day = $_POST['library_total_book_issue_day'];
	$library_one_day_fine = $_POST['library_one_day_fine'];
	$library_issue_total_book_per_user = $_POST['library_issue_total_book_per_user'];
	

	$query = "UPDATE settings SET library_admin = '$library_admin',library_contact = '$library_contact',library_email = '$library_email',library_total_book_issue_day = '$library_total_book_issue_day',library_one_day_fine = '$library_one_day_fine',library_issue_total_book_per_user = '$library_issue_total_book_per_user' WHERE 1";

  $query_run = mysqli_query($connection, $query); 

  $admin_query = "UPDATE admin SET first_name = '$library_admin',contact = '$library_contact',email = '$library_email' WHERE 1";

  $admin_query_run = mysqli_query($connection, $admin_query);

	if($query_run || $admin_query_run){
        $success['update'] = "Data Updated Successsfully!";
    }
    else{
        $errors['update-err'] = "Failed To Update Data!";
    }
}

$query = "SELECT * FROM settings LIMIT 1";

$result = $connection->query($query);

// include '../header.php';

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header text-primary font-weight-bold">
            <i class="fas fa-cogs text-primary"></i> Library Settings
        </div>

        <?php
        if(count($errors) == 1){
      ?>
        <div class="alert alert-danger text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <?php
            foreach($errors as $showerror){
              echo $showerror;
            }
          ?>
        </div>
        <?php
      }
      elseif(count($errors) > 1){
          ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <?php
          foreach($errors as $showerror){
            ?>
            <li>
                <?php echo $showerror; ?>
            </li>
            <?php
          }
            ?>
        </div>
        <?php
      }
      elseif(count($success) == 1){
        ?>
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <?php
        foreach($success as $showsuccess){
          ?>
          <li><?php echo $showsuccess; ?></li>
          <?php
        }
          ?>
      </div>
      <?php
    }
      ?>

        <div class="card-body">
            <?php
                $query = "SELECT * FROM settings";
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $row){
                    ?>
            <form action="setting.php" method="POST" autocomplete="">
                <div class="mb-3">
                    <label class="form-label">Library Admin</label>
                    <input type="text" name="library_admin" id="library_name" class="form-control"
                        value="<?php echo $row['library_admin']; ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Library Contact</label>
                    <input type="tel" name="library_contact" id="library_contact" class="form-control"
                        value="<?php echo $row['library_contact']; ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Library Email</label>
                    <input type="email" name="library_email" id="library_email" class="form-control"
                        value="<?php echo $row['library_email']; ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Books Issue Per Day</label>
                    <input type="number" name="library_total_book_issue_day" id="library_total_book_issue_day" class="form-control"
                        value="<?php echo $row['library_total_book_issue_day']; ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label">library One Day Fine</label>
                    <input type="number" name="library_one_day_fine" id="library_one_day_fine" class="form-control"
                        value="<?php echo $row['library_one_day_fine']; ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Issue Total Book Per User</label>
                    <input type="number" name="library_issue_total_book_per_user" id="library_issue_total_book_per_user" class="form-control"
                        value="<?php echo $row['library_issue_total_book_per_user']; ?>" />
                </div>
                <a href="home.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="edit_setting" class="btn btn-primary" value=""> Update </button>
            </form>
            <?php
                }
        ?>
        </div>
    </div>
</div>

</div>


<?php
// include('admin/scripts.php');
include('admin/footer.php');
?>