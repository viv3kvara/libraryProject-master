<?php
session_start();
include('security.php');
include('includes/header.php');
require "Send_Mail/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
?>
<?php
//email system start for forget password
include('security.php');    
$errors=array();
    $mail="";
    if(isset($_POST['rstbtn'])){
        $f_mail=  ($_POST['email']);
        $_SESSION['f_email']=$f_mail;
        if($f_mail){
            if(filter_var($f_mail, FILTER_VALIDATE_EMAIL)) {
                $sql=("select email,first_name,enrollment_number from register where email='$f_mail' ") or die (mysql_error());
                $results = mysqli_query($connection, $sql);
                $q=  mysqli_affected_rows($connection);
                if($q<1){
                    // echo'<div class="alert alert-danger absolue center text-center" role="alert">
                    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    //             <span aria-hidden="true">×</span>
                    //         </button>
                    //             <span class="text-danger">E-mail addresses did not match!</span>
                    //     </div>';
                    $errors['not-match-email'] = 'E-mail addresses did not match!'; 
                }
                else 
                if($q > 1){
                    // echo'<div class="alert alert-danger absolue center text-center" role="alert">
                    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    //             <span aria-hidden="true">×</span>
                    //         </button>
                    //             <span class="text-danger">Duplicate e-mail address found!</span>
                    //     </div>';
                    $errors['dup-email'] = 'Duplicate e-mail address found!'; 
                }
                else 
                    if($q == 1){
                        $res=mysqli_fetch_array($results);
                        
                        // $id=$res['enrollment_number'];
                        
                        // $rid= md5(uniqid(rand(),true));
                        
                        // $key=md5($rid);

                        // $key .= $rid;
                        
                        // $sql=("UPDATE register SET activation='$key' where enrollment_number='$id' ") or die (mysql_error());
                        
                        $email=base64_encode($f_mail);
                        
                        $name=$res['first_name'];

                        $to = $res['email']; 
                        $mail = new PHPMailer(true);
                        $subject='Password Reset | GP Porbandar Department Library';
                        $message="Hello $name,<br> 
                                Someone requested to reset your password.<br>
                                If this was you,<a href='localhost/DLMS /new_password.php'>click here</a>to reset your password,
			                    
                                if not just ignore this email.
                                <br><br>
			                Thank you,
                                <br><br>
                                GP Porbandar Department Library
                                <br><br>";
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
                            
                        if($m)
                        {
                            $mail="";
                            $_SESSION['new']='true';
                            header("Location:#");
                            echo "<script type='text/javascript'> document.location = '#'; </script>";
                            exit();
                            
                        }
                        else{
                            // echo'<div class="alert alert-danger absolue center text-center" role="alert">
                            //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            //             <span aria-hidden="true">×</span>
                            //         </button>
                            //             <span class="text-danger">Error occured while trying to send e-mail</span>
                            //     </div>';
                            $errors['err-occur'] = 'Error occured while trying to send e-mail!';
                        }
                    }          
            }
            else {
                // echo'<div class="alert alert-danger absolue center text-center" role="alert">
                //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //             <span aria-hidden="true">×</span>
                //         </button>
                //             <span class="text-danger">Invalid Format!</span>
                //     </div>';
                $errors['invalid-format'] = 'Invalid Format!';
            }
        }
        // else {
        //         echo'<div class="alert alert-danger absolue center text-center" role="alert">
        //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                 <span aria-hidden="true">×</span>
        //             </button>
        //                 <span class="text-danger">Enter your e-mail!</span>
        //         </div>';
        // }
    }
?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="POST">
                                    <?php                   
                                        if(isset($_SESSION['new'])=="true"){
                                        echo '<div class="alert alert-success absolue center text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                            <span class="text-success">A password reset link was sent to your e-mail</span>
                                            </div>';
                                            unset($_SESSION['new']); 
                                        }
                                    ?>
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
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." required>
                                        </div>
                                        <button type="submit" name="rstbtn" class="btn btn-primary btn-user btn-block"> Reset Password </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<?php
include('includes/scripts.php'); 
?>