<?php
session_start();
include('security.php');
include('faculties/header.php'); 
include('database/dbconfig.php');
error_reporting(0);
?>
<?php
//if user click login button
$errors = array();
$success = array();
if(isset($_POST['signinbtn'])){
    $userid = $_POST['uid'];
    $upassword = $_POST['upassword'];
    // if (empty($userid) || empty($upassword)) {
    //     $errors['fields'] = "<li>Empty Fields! Please Filled It!</li>"; 
    // }
    $checkuid = "SELECT * FROM faculties WHERE f_id = '$userid' and password = '$upassword' limit 1";
    $stmt = $connection->prepare($checkuid);
    $stmt->bind_param('ss',$userid,$upassword);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows>0) {
        $stmt->bind_result($f_id,$f_name,$l_name,$email,$contact,$password,$avatar);
        while ($stmt->fetch()) {
            if ($stmt) {
                $_SESSION['new'] = 'true';
                $_SESSION['userid'] = $userid;
                $_SESSION['upassword'] = $upassword;
                $_SESSION['name'] = $f_name;
                $_SESSION['avatar'] = $avatar;
                header('location: faculty_index.php');
            }
        }
    }
    else{
        $errors['details'] = "<li>Invalid Details!</li>";
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
                                        <h1 class="h4 text-gray-900 mb-4">Faculty Login</h1>
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
                                            elseif(count($errors) == 1){
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
                                    <form class="user" action="faculty_login.php" method="POST" autocomplete="">
                                        <div class="form-group">
                                            <input type="text" name="uid" class="form-control form-control-user" placeholder="Enter User Id" maxlength="3" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="upassword" class="form-control form-control-user" placeholder="Password" minlength="8" maxlength="15" required>
                                        </div>
                                        <button type="submit" name="signinbtn" class="btn btn-primary btn-user btn-block"> Login </button>
                                    </form>
                                    <hr>    
                                    <div class="text-center">
                                        <a class="small" href="faculty_forgot_password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Student Login</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="small" href="admin_login.php">Admin Login</a>
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
<!-- <?php
// include('includes/scripts.php'); 
?> -->