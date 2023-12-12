<?php
session_start();
include('security.php');
include('includes/header.php'); 
?>
<?php
//if user click login button
$email = "";
$name = "";
$errors = array();
$success = array();
if(isset($_POST['signinbtn'])){
    $uid = $_POST['uid'];
    $upassword = $_POST['upassword'];
    // if (empty($uid) || empty($upassword)) {
    //     $errors['fields'] = "Empty Fields! Please Filled It!"; 
    // }
    $checkuid = "SELECT * FROM admin WHERE user_id = '$uid' and password = '$upassword' limit 1";
    $res = mysqli_query($connection, $checkuid);
    if(mysqli_num_rows($res) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $status = $fetch['status'];
        $_SESSION['new'] = 'true';
        $_SESSION['uid'] = $uid;
        $_SESSION['upassword'] = $upassword;
        header('location: home.php');
    }
    else{
        $errors['incorrect-info'] = "Incorrect user id or password!";
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
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                        <p class="text-center">Login with your user id and password!
                                        </p>
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
                                    <form class="user" action="admin_login.php" method="POST" autocomplete="">
                                        <div class="form-group">
                                            <input type="text" name="uid" class="form-control form-control-user" placeholder="Enter User Id" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="upassword" class="form-control form-control-user" placeholder="Password" minlength="8" maxlength="15" required>
                                        </div>
                                        <button type="submit" name="signinbtn" class="btn btn-primary btn-user btn-block"> Login </button>
                                    </form>
                                    <hr>    
                                    <div class="text-center">
                                        <a class="small" href="admin_forgot_password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Student Login</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="small" href="faculty_login.php">Faculty Login</a>
                                    </div>
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