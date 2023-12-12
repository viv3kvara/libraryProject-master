<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
if (!isset($_SESSION["uid"])) {
  header("location:admin_login.php");
} 
?>
<?php
//For update profile
$errors = array();
$success = array();
if(isset($_POST['updatebtn'])){
    $user_id = $_POST['edit_user_id'];
    $first_name = $_POST['edit_first_name'];
    $last_name = $_POST['edit_last_name'];
    $email = $_POST['edit_email'];
    $contact = $_POST['edit_contact'];
    $password = $_POST['edit_password'];  

    $email_query = "SELECT * FROM admin WHERE email='$email'";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0){
        $errors['email_err'] = "E-mail that you have entered is already exist!"; 
    }

    $phone_query = "SELECT * FROM admin WHERE contact='$contact'";
    $phone_query_run = mysqli_query($connection, $phone_query);
    if(mysqli_num_rows($phone_query_run) > 0){
        $errors['contact_err'] = "Contact Number that you have entered is already exist!"; 
    }

    if(count($errors) === 0){ 
      $updatequery = "UPDATE admin SET user_id='$user_id', first_name='$first_name',last_name='$last_name',email='$email',contact='$contact',password='$password' WHERE user_id='$user_id'";
      $update_query_run = mysqli_query($connection, $updatequery);

      if($update_query_run){
          $success['update'] = "Profile Updated Successsfully!";
      }
      else{
          $errors['update-err'] = "Failed To Update Profile!";
      }
  }
}

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header text-primary font-weight-bold">
            <i class="fas fa-user-edit text-primary"></i> Edit My Profile
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
            <li><?php echo $showerror; ?></li>
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
                $query = "SELECT * FROM admin WHERE user_id='".$_SESSION['uid']."' ";
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $row){
                    ?>
                        <form action="modify_admin_profile.php" method="POST" autocomplete="">
                        <div class="form-group">
                            <label> User id </label>
                            <input type="text" name="edit_user_id" value="<?php echo $row['user_id']?>" class="form-control" placeholder="Enter id">
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="edit_first_name" value="<?php echo $row['first_name']?>" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="edit_last_name" value="<?php echo $row['last_name']?>" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                            <label>Eamil</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email']?>" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" pattern="[0-9]{10}" name="edit_contact" value="<?php echo $row['contact']?>" class="form-control" placeholder="Enter Contact Number" >
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password']?>" class="form-control" placeholder="Enter Password" minlength="8" maxlength="15">
                        </div>
                            <a href="home.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
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