<?php
include('faculties/header.php'); 
include('faculties/navbar.php'); 
include('security.php'); 
error_reporting(0);
if (!isset($_SESSION["username"])) {
  header("location:faculty_login.php");
}
?>
<?php
//For update book
$errors = array();
$success = array();
if(isset($_POST['updatebtn'])){
    $f_id = $_POST['edit_f_id'];
    $f_name = $_POST['edit_first_name'];
    $l_name = $_POST['edit_last_name'];
    $email = $_POST['edit_email'];
    $contact = $_POST['edit_contact'];
    $password = $_POST['edit_password'];  

    // $email_query = "SELECT * FROM faculties WHERE email='$email'";
    // $email_query_run = mysqli_query($connection, $email_query);
    // if(mysqli_num_rows($email_query_run) > 0){
    //     $errors['email_err'] = "E-mail that you have entered is already exist!"; 
    // }

    // $phone_query = "SELECT * FROM faculties WHERE contact='$contact'";
    // $phone_query_run = mysqli_query($connection, $phone_query);
    // if(mysqli_num_rows($phone_query_run) > 0){
    //     $errors['contact_err'] = "Contact Number that you have entered is already exist!"; 
    // }

    if(count($errors) === 0){
        
        $updatequery = "UPDATE faculties SET f_name='$f_name',l_name='$l_name',email='$email',contact='$contact',password='$password' WHERE f_id='$f_id'";
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
                $query = "SELECT * FROM faculties WHERE f_id='".$_SESSION['userid']."' ";
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $row){
                            ?>
                        <form action="modify_faculty_profile.php" method="POST" autocomplete="">
                            <div class="form-group">
                                <label>Faculty ID</label>
                                <input type="text" name="edit_f_id" value="<?php echo $row['f_id'];?>" class="form-control" placeholder="Enter Faculty's ID">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="edit_first_name" value="<?php echo $row['f_name']; ?>" class="form-control" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="edit_last_name" value="<?php echo $row['l_name']; ?>" class="form-control" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="edit_email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" pattern="[0-9]{10}" name="edit_contact" value="<?php echo $row['contact']; ?>" class="form-control" placeholder="Enter Contact" >
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="edit_password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Enter Password" minlength="8" maxlength="15">
                            </div>
                                <a href="faculty_index.php" class="btn btn-danger"> CANCEL </a>
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
// include('includes/scripts.php');
include('faculties/footer.php');
?>