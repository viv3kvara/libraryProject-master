<?php
// session_start();
include('security.php');
include('includes/header.php'); 
?>
<?php
if($_SESSION['info'] == false){
    header('Location: login.php');  
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
                                        <h1 class="h4 text-gray-900 mb-2">Your Password Changed!</h1>
                                    </div>
                                    <?php 
                                        if(isset($_SESSION['info'])){
                                            ?>
                                            <div class="alert alert-success text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <?php echo $_SESSION['info']; ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <form class="user" method="POST" action="login.php">
                                        <div class="form-group">
                                            <button type="submit" name="rstbtn" class="btn btn-primary btn-user btn-block"> Back To Login! </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<?php
// include('includes/scripts.php'); 
?>