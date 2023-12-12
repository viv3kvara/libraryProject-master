<?php
session_start();
include('security.php');
include('database/dbconfig.php');
include('includes/header.php'); 
error_reporting(0);
?>
<?php
$email = "";
$name = "";
$errors = array();
$success = array();
if(isset($_POST['login_btn'])){
    $eno_login = $_POST['enrollment_number'];
    $password_login = $_POST['password'];
    // if (empty($eno_login) || empty($password_login)) {
    //     $errors['fields'] = "Empty Fields! Please Filled It!"; 
    // }
    $check_eno = "SELECT * FROM register WHERE enrollment_number = '$eno_login' and password = '$password_login' limit 1";
    $stmt = $connection->prepare($check_eno);
    $stmt->bind_param('ss',$eno_login,$password_login);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows>0) {
        $stmt->bind_result($eno,$fname,$lname,$email,$contact,$password,$avatar);
        while ($stmt->fetch()) {
            if ($stmt) {
                $_SESSION['new'] = 'true';
                $_SESSION['user_name'] = $eno_login;
                $_SESSION['name'] = $fname;
                $_SESSION['password'] = $password_login;
                $_SESSION['avatar'] = $avatar;
                header('location: student_index.php');
            }
        }
    }
    else{
        $errors['details'] = "Invalid Details!";
    }
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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Student Login</h1>
                                        <p class="text-center">Login with your enrollment number and password.</p>
                                        <?php
                                            if(isset($_SESSION['info']) && $_SESSION['info'] != ''){
                                                // echo '<h4 class="bg-primary"> '.$_SESSION['success'].' </h4>';
                                                echo '<div class="alert alert-success" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                    <span class="text-success">'.$_SESSION['info'].'</span>
                                                    </div>';
                                                unset($_SESSION['info']);
                                            }

                                            // if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                                            //     // echo '<h4 class="bg-danger"> '.$_SESSION['status'].' </h4>';
                                            //     echo '<div class="alert alert-success" role="alert">
                                            //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            //         <span aria-hidden="true">×</span>
                                            //         </button>
                                            //         <span class="text-success">'.$_SESSION['status'].'</span>
                                            //         </div>';
                                            //     unset($_SESSION['status']);
                                            // }
                                        ?>
                                            <?php
                                            if(count($errors) > 0){
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
                                            ?>
                                    </div>
                                    <form class="user" action="login.php" method="POST" autocomplete="">
                                        <div class="form-group">
                                            <input type="text" name="enrollment_number" class="form-control form-control-user" placeholder="Enter Enrollment Number"  pattern="[0-9]{12}" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password" minlength="8" maxlength="15" required>
                                        </div>
                                        <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                                    </form>
                                    <hr>    
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">New User? Create an Account!</a>
                                    </div>
                                    <!-- <div class="text-center">
                                        <a class="small" href="admin_login.php">Admin Login</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="small" href="faculty_login.php">Faculty Login</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>
<?php
include('includes/scripts.php'); 
?>