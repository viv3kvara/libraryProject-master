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
    <h6 class="m-0 font-weight-bold text-primary">Your Issued Books: </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="datatableid" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Book Id </th>
            <th> Book Title </th>
            <th> Book Issue Date</th>
            <th> Book Return Date</th>
            <th> Book Status</th>
            <th> Days</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $query = "SELECT * FROM f_issue_book 
          INNER JOIN books 
          ON books.book_id = f_issue_book.book_id 
          WHERE f_issue_book.user_id = '".$_SESSION['userid']."' and book_issue_status = 'Issue'
          ORDER BY f_issue_book.issue_book_id DESC";
          $query_run = mysqli_query($connection, $query);
          if(mysqli_num_rows($query_run) > 0){
            while($row = mysqli_fetch_assoc($query_run)){
              $status = $row["book_issue_status"];
						
              if($status == 'Issue'){
                $status = '<h5><span class="badge badge-success">Issue</span></h5>';
              }

              if($status == 'Not Return'){
                $status = '<h5><span class="badge badge-danger">Not Return</span></h5>';
              }

              if($status == 'Return'){
                $status = '<h5><span class="badge badge-warning">Return</span></h5>';
              }
              $issue_date = $row['issue_date_time'];

              $cur_date = date('Y-m-d H:i:s');

              $days = strtotime($cur_date)-strtotime($issue_date);
            ?>
              <tr>
              <td><?php  echo $row['book_id']; ?></td>
              <td><?php  echo $row['book_title']; ?></td>
              <td><?php  echo $row['issue_date_time']; ?></td>
              <td><?php  echo $row['expected_return_date']; ?></td>
              <td><?php  echo $status; ?></td>
              <td><?php  echo floor($days/(24*60*60)); ?></td>
              </tr>
            <?php
            } 
          }
          // else{
          //   echo "No Record Found";
          // }
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