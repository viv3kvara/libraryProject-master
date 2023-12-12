<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
include('profile_pic.php');
if (!isset($_SESSION["uid"])) {
  // header("location:admin_login.php");
  header("location:index.php");
}
require "Send_Mail/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
?>
<?php
//for add Faculties
$email = "";
$name = "";
$errors = array();
$success = array();
if(isset($_POST['savebtn'])){
  $f_id = $_POST['f_id'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password = $_POST['password'];
  $avatar = make_avatar(strtoupper($f_name[0]));

  $fid_query = "SELECT * FROM faculties WHERE f_id='$f_id' ";
  $fid_query_run = mysqli_query($connection, $fid_query);
  if(mysqli_num_rows($fid_query_run) > 0){ 
      $errors['f_id'] = "Faculty ID that you have entered is already exist!";
  }

  $email_query = "SELECT * FROM faculties WHERE email='$email'";
  $email_query_run = mysqli_query($connection, $email_query);
  if(mysqli_num_rows($email_query_run) > 0){
      $errors['email_err'] = "E-mail that you have entered is already exist!"; 
  }

  $phone_query = "SELECT * FROM faculties WHERE contact='$contact'";
  $phone_query_run = mysqli_query($connection, $phone_query);
  if(mysqli_num_rows($phone_query_run) > 0){
      $errors['contact_err'] = "Contact Number that you have entered is already exist!"; 
  }

  if(count($errors) === 0){
    //   $query = "INSERT INTO books(book_id, book_title, catagory, author_name, price, publication, purchase_date) VALUES ('$book_id','$book_title','$catagory','$author_name','$price','$publication','$purchase_date')";
      $query = "INSERT INTO faculties(f_id, f_name, l_name, email, contact, password, avatar) VALUES (?,?,?,?,?,?,?)";
      
      $stmt=$connection->prepare($query);
      if ($stmt == false) {
        $errors['db-error'] = "Failed while inserting data into database!";
      }

        $stmt->bind_param('sssssss',$f_id,$f_name,$l_name,$email,$contact,$password,$avatar);
        $stmt->execute();
        $stmt->close();
        // $connection->close();

      if($stmt){
        // $subject = "Registration For Library | GP Porbandar Department Library";
        //     $message="Hello '$f_name',
        //                 You Are Successfully Registered! in GP Porbandar Computer Department Library.
			        
        //                 Thank you,
        //                 GP Porbandar Department Library";
        //     $sender = "From: denisruparel28@gmail.com";
        $to = $email; 
        $mail = new PHPMailer(true);
        $subject='Registration For Library | GP Porbandar Department Library';
        $message='Hello <b>'.$f_name.'</b>,
                        <br>You Are Successfully Registered!</br>
                        <br>in GP Porbandar Computer Department Library!</br>
                        <br>Your User Name is <b>'.$f_id.'</b> and Your Password is <b>'.$password.'</b></br>
                        <br>
                        Thank you,
                        <br>GP Porbandar Department Library</br>';
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->AddReplyTo("denisruparel28@gmail.com");
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = "denisruparel28@gmail.com";
        $mail->Password = "tvyzbzxvpaeeohux";

        $mail->setFrom("denisruparel28@gmail.com","GP Porbandar Department Library");
        $mail->addAddress($to, "");

        $mail->Subject = $subject;  
        $mail->Body = $message;

        $m = $mail->send();
            if($m){
                $_SESSION['status'] = "Faculty Added Successsfully! We've sent a mail to - $email";
                $_SESSION['status_code'] = "success";
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                echo "<script>window.location.href='add_faculties.php';</script>";
                exit();
            }
      }
      else{
        $errors['add-error'] = "Failed To Add Faculty Record!";
      }
    }
  }
  
?>

<div class="modal fade" id="addfaculty" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Add Faculty Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="add_faculties.php" method="POST" autocomplete="">

        <div class="modal-body">

            <div class="form-group">
                <label> Faculty id </label>
                <input type="text" name="f_id" class="form-control" placeholder="Enter Faculty's id" maxlength="3" required>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="f_name" class="form-control" placeholder="Enter Faculty's First Name" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="l_name" class="form-control" placeholder="Enter Faculty's Last Name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Faculty's Email" required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="tel" name="contact" class="form-control" placeholder="Enter Faculty's Contact" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Faculty's Password" minlength="8" maxlength="15" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="savebtn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Add Faculty Records: &nbsp;
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addfaculty">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
              Add
            </button>
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
    </h6>
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
  </div>

  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="datatableid" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Faculty id </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Email </th>
            <th> Contact </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM faculties";
        $query_run = mysqli_query($connection, $query);
        if(mysqli_num_rows($query_run) > 0){
          while($row = mysqli_fetch_assoc($query_run)){
          ?>
            <tr>
            <td><?php  echo $row['f_id']; ?></td>
            <td><?php  echo $row['f_name']; ?></td>
            <td><?php  echo $row['l_name']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td><?php  echo $row['contact']; ?></td>
              <td>
                  <form action="modify_faculty.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['f_id'];?>">
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
<!-- /.container-fluid -->

<!-- <script>
    $(document).ready(function () {
      $('#datatableid').DataTable();
    });
  </script> -->

<?php
// include('admin/scripts.php');
include('admin/footer.php');
?>

