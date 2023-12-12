<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
if (!isset($_SESSION["uid"])) {
    header("location:admin_login.php");
}
?>
<?php

//for delete student
if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE enrollment_number='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){ 
        $_SESSION['status'] = "Student Record Deleted Successsfully!";
        $_SESSION['status_code'] = "success";
        echo "<script>window.location.href='show_students.php';</script>";
    }
    else{
        $_SESSION['status'] = "Failed To Delete Student Record!";
        $_SESSION['status_code'] = "error";
        echo "<script>window.location.href='show_students.php';</script>";
    }    
}

?>
<?php
// include('admin/scripts.php');
include('admin/footer.php');
?>