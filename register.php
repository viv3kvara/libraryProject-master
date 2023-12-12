<?php
include('security.php');  
include('profile_pic.php'); 
include('includes/header.php'); 
require "Send_Mail/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
?>

<?php
session_start();
$email = "";
$name = "";
$errors = array();
$success = array();

if(isset($_POST['registerbtn'])){
    $eno = $_POST['enrollmentnumber'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $rpassword = $_POST['repeatpassword'];
    $avatar = make_avatar(strtoupper($fname[0]));

    // if (empty($eno) || empty($fname) || empty($lname) || empty($email) || empty($contact) || empty($password) || empty($rpassword)) {
    //     $errors['fields'] = "Empty Fields! Please Filled It!"; 
    // }
    
    if($password !== $rpassword){
        $errors['password'] = "Confirm password not matched!";
    }

    $eno_query = "SELECT * FROM register WHERE enrollment_number='$eno'";
    $eno_query_run = mysqli_query($connection, $eno_query);
    if(mysqli_num_rows($eno_query_run) > 0){
        $errors['en_number'] = "Enrollment Number that you have entered is already exist!"; 
    }

    $email_query = "SELECT * FROM register WHERE email='$email'";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0){
        $errors['email_err'] = "E-mail that you have entered is already exist!"; 
    }

    $phone_query = "SELECT * FROM register WHERE contact='$contact'";
    $phone_query_run = mysqli_query($connection, $phone_query);
    if(mysqli_num_rows($phone_query_run) > 0){
        $errors['contact_err'] = "Contact Number that you have entered is already exist!"; 
    }

    if(count($errors) === 0){
      $insert_data = "INSERT INTO requests(enrollment_number, first_name, last_name, email, contact, password, user_avatar) 
                      VALUES (?,?,?,?,?,?,?)";
      $stmt=$connection->prepare($insert_data);
      if ($stmt == false) {
        $errors['db-error'] = "Failed while inserting data into database!";
      }
      $stmt->bind_param('sssssss',$eno,$fname,$lname,$email,$contact,$password,$avatar);
      $stmt->execute();
      $stmt->close();
      // $connection->close();

      if ($stmt) {
        $to = $email; 
        $mail = new PHPMailer(true);
        $subject='Registration For Library | GP Porbandar Department Library';
        $message='Hello <b>'.$eno.'</b>,
                        <br>You Are Successfully Registered!</br>
                        <br>in GP Porbandar Computer Department Library, But Your Account Request is Pending Meet Admin</br>
                        <br>For Approvel Request Once Admin Accept The Request, You Can Login in GP Porbandar Computer Department Library</br>
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
                $_SESSION['status'] = "Your Account Request is pending! We've sent a mail to your email - $email";
                $_SESSION['status_code'] = "success";
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: register.php'); 
                exit();
            }
      }
      header('location: register.php'); 
    }
}
?>
<body class="bg-gradient-primary">
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
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
                    }elseif(count($errors) > 1){
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
              ?>
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
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="register.php" method="POST" autocomplete="">
                <div class="form-group">
                  <input type="text" name="enrollmentnumber" class="form-control form-control-user"
                    id="enrollmentnumber" placeholder="Enrollment Number" pattern="[0-9]{12}" title="Enrollment Number" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="firstname" class="form-control form-control-user" id="firstname"
                      placeholder="First Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="lastname" class="form-control form-control-user" id="lastname"
                      placeholder="Last Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="email"
                    placeholder="Email Address" required>
                </div>
                <div class="form-group">
                  <input type="text" name="contact" class="form-control form-control-user" id="contact"
                    placeholder="Contact" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user" id="password"
                      placeholder="Password" minlength="8" maxlength="15" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="repeatpassword" class="form-control form-control-user"
                      id="repeatpassword" placeholder="Repeat Password" minlength="8" maxlength="15" required> 
                  </div>
                </div>
                <button type="submit" name="registerbtn" class="btn btn-primary btn-user btn-block">Register</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php
// include('includes/scripts.php');
?>