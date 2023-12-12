<?php
include('faculties/header.php'); 
include('faculties/navbar.php'); 
include('security.php'); 
error_reporting(0);
if (!isset($_SESSION["username"])) {
  header("location:faculty_login.php");
} 
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Show Books: </h6>
  </div>


  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="datatableid" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Book id </th>
            <th> Book Title </th>
            <th> Catagory </th>
            <th> Author Name</th>
            <th> Price </th>
            <th> Publication </th>
            <th> Purchase Date </th>
            <th> Edition </th>
            <th> Semester </th>
            <th> Availability </th>
          </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM books";
        $query_run = mysqli_query($connection, $query);
        if(mysqli_num_rows($query_run) > 0){
          while($row = mysqli_fetch_assoc($query_run)){
            $availabel = '';
            if($row['availability'] == 'Available'){
							$availabel = '<h5><span class="badge badge-success">Available</span></h5>';
						}
						else{
							$availabel = '<h5><span class="badge badge-danger">Not Availabel</span></h5>';
						}
          ?>
            <tr>
            <td><?php  echo $row['book_id']; ?></td>
            <td><?php  echo $row['book_title']; ?></td>
            <td><?php  echo $row['catagory']; ?></td>
            <td><?php  echo $row['author_name']; ?></td>
            <td><?php  echo $row['price']; ?></td>
            <td><?php  echo $row['publication']; ?></td>
            <td><?php  echo $row['purchase_date']; ?></td>
            <td><?php  echo $row['edition']; ?></td>
            <td><?php  echo $row['semester']; ?></td>
            <td><?php  echo $availabel; ?></td>
            </tr>
          <?php
          } 
        }
        else{
          echo "No Record Found";
        }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</div>
      </div>
</div>
<!-- /.container-fluid -->

<?php
// include('includes/scripts.php');
include('faculties/footer.php');
?>