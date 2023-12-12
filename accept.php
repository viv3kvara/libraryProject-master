<?php
session_start(); 
include('security.php');
error_reporting(0);
?>
<?php
    $id = $_GET['id'];
    $query = "SELECT * FROM requests WHERE enrollment_number='$id'";
    $query_run = mysqli_query($connection, $query);
    // $arr = mysqli_fetch_array($query_run);
    if(mysqli_fetch_array($query_run)){
        foreach($query_run as $row){
            $eno = $row['enrollment_number'];
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $email = $row['email'];
            $contact = $row['contact'];
            $password = $row['password'];
            $activation = $row['activation'];
            $avatar = $row['user_avatar'];
            $date = $row['date'];
    
            $insert = "INSERT INTO register(enrollment_number, first_name, last_name, email, contact, password, user_avatar, date) VALUES ('$eno','$fname','$lname','$email','$contact','$password','$avatar','$date')";
            $insert_run = mysqli_query($connection, $insert);

            if ($insert_run) {
              $_SESSION['status'] = "Account Has Been Accepted!";
              $_SESSION['status_code'] = "success";
              echo "<script>window.location.href='requests.php?msg=accept';</script>";
            }
        }
        $delete = "DELETE FROM requests WHERE enrollment_number='$id'";
        $delete_run = mysqli_query($connection, $delete);

        if ($delete_run) {
          $_SESSION['status'] = "Account Has Been Accepted!";
          $_SESSION['status_code'] = "success";
          echo "<script>window.location.href='requests.php?msg=accept';</script>";
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
    }
    else{
        // echo '<div class="alert alert-danger" role="alert">
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //       <span aria-hidden="true">×</span>
        //     </button>
        //       <span class="text-danger">"Error Occured!"</span>
        //     </div>';
        $_SESSION['status-error'] = "Error Occured!";
        $_SESSION['status_code-error'] = "error";
        echo "<script>window.location.href='requests.php?msg=error';</script>";
    }

?>