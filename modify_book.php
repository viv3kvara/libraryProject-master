<?php
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
if (!isset($_SESSION["uid"])) {
    header("location:admin_login.php");
}
?>
<?php
//For update book
if(isset($_POST['updatebtn'])){
    $book_id = $_POST['edit_book_id'];
    $book_title = $_POST['edit_book_title'];
    $catagory = $_POST['edit_catagory'];
    $author_name = $_POST['edit_author_name'];
    $price = $_POST['edit_price'];
    $publication = $_POST['edit_publication'];
    $purchase_date = $_POST['edit_purchase_date'];   
    $edition = $_POST['edit_edition'];   
    $semester = $_POST['edit_semester'];   
    $availability = 'available';   

    $updatequery = "UPDATE books SET book_id='$book_id', book_title='$book_title',catagory='$catagory',author_name='$author_name',price='$price',publication='$publication',purchase_date='$purchase_date', edition='$edition', semester='$semester', availability='$availability' WHERE book_id='$book_id'";
    $update_query_run = mysqli_query($connection, $updatequery);

    if($update_query_run){
        $_SESSION['status'] = "Book Record Updated Successsfully!";
        $_SESSION['status_code'] = "success";
        echo "<script>window.location.href='add_books.php';</script>";
    }
    else{
        $_SESSION['status'] = "Failed To Update Book Record!";
        $_SESSION['status_code'] = "error";
        echo "<script>window.location.href='add_books.php';</script>";
    }
}

//for delete book
if(isset($_POST['delete_btn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM books WHERE book_id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run){ 
        $_SESSION['status'] = "Book Record Deleted Successsfully!";
        $_SESSION['status_code'] = "success";
        echo "<script>window.location.href='add_books.php';</script>";
    }
    else{
        $_SESSION['status'] = "Failed To Delete Book Record!";
        $_SESSION['status_code'] = "error";
        echo "<script>window.location.href='add_books.php';</script>";
    }    
}

?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Book Records </h6>
        </div>
        
        <div class="card-body">
        <?php
            if(isset($_POST['edit_btn'])){
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM books WHERE book_id='$id' ";
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $row){
                    ?>
                        <form action="modify_book.php" method="POST" autocomplete="">
                        <div class="form-group">
                            <label> Book id </label>
                            <input type="text" name="edit_book_id" value="<?php echo $row['book_id']?>" class="form-control" placeholder="Enter Book's id">
                        </div>
                        <div class="form-group">
                            <label>Book Title</label>
                            <input type="text" name="edit_book_title" value="<?php echo $row['book_title'] ?>" class="form-control" placeholder="Enter Book's Title">
                        </div>
                        <div class="form-group">
                            <label>Catagory</label>
                            <input type="text" name="edit_catagory" value="<?php echo $row['catagory'] ?>" class="form-control" placeholder="Enter Book's Catagory">
                        </div>
                        <div class="form-group">
                            <label>Author Name</label>
                            <input type="text" name="edit_author_name" value="<?php echo $row['author_name'] ?>" class="form-control" placeholder="Enter Book Author's Name">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="edit_price" value="<?php echo $row['price'] ?>" class="form-control" placeholder="Enter Book's Price" >
                        </div>
                        <div class="form-group">
                            <label>Publication</label>
                            <input type="text" name="edit_publication" value="<?php echo $row['publication'] ?>" class="form-control" placeholder="Enter Book's Publication">
                        </div>
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type="date" name="edit_purchase_date" value="<?php echo $row['purchase_date'] ?>" class="form-control" placeholder="Enter Book's Purchase Date">
                        </div>
                        <div class="form-group">
                            <label>Edition</label>
                            <input type="number" name="edit_edition" value="<?php echo $row['edition'] ?>" class="form-control" placeholder="Enter Book's Edition">
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="number" pattern="[0-8]{1}" name="edit_semester" value="<?php echo $row['semester'] ?>" class="form-control" placeholder="Enter Book's semester">
                        </div>
                            <a href="add_books.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>



<?php
// include('admin/scripts.php');
include('admin/footer.php');
?>