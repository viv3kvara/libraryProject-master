<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
if (!isset($_SESSION["uid"])) {
    header("location:admin_login.php");
  }
?>
<?php
//for delete faculties
if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM faculties WHERE f_id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){ 
        $_SESSION['status'] = "Faculty Record Deleted Successsfully!";
        $_SESSION['status_code'] = "success";
        echo "<script>window.location.href='add_faculties.php';</script>";
    }
    else{
        $_SESSION['status'] = "Failed To Delete Faculty Record!";
        $_SESSION['status_code'] = "error";
        echo "<script>window.location.href='add_faculties.php';</script>";
    }    
}

?>
<?php
// include('admin/scripts.php');
include('admin/footer.php');
?>