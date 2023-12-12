<?php
session_start(); 
include('security.php');
?>
<?php
    $id = $_GET['id'];

    $delete = "DELETE FROM requests WHERE enrollment_number='$id'";
        $delete_run = mysqli_query($connection, $delete);
        if($delete_run){
            // echo '<div class="alert alert-danger" role="alert">
            // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //   <span aria-hidden="true">×</span>
            // </button>
            //   <span class="text-danger">"Account Has Been Rejected!"</span>
            // </div>';
            $_SESSION['status-error'] = "Account Has Been Rejected!";
            $_SESSION['status_code-error'] = "error";
            echo "<script>window.location.href='requests.php?msg=reject';</script>";
        }
        else{
            // echo '<div class="alert alert-danger" role="alert">
            //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //       <span aria-hidden="true">×</span>
            //     </button>
            //       <span class="text-danger">"Unknown Error Occured!"</span>
            //     </div>';
            $_SESSION['status-error'] = "Unknown Error Occured!";
            $_SESSION['status_code-error'] = "error";
            echo "<script>window.location.href='requests.php?msg=error';</script>";
        }
?>

<?php
include('admin/footer.php');
?>