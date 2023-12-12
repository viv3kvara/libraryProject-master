<?php
error_reporting(0);
include('admin/header.php'); 
include('admin/navbar.php'); 
include('security.php'); 
include('function.php');
if (!isset($_SESSION["uid"])) {
  header("location:admin_login.php");
} 
?>
<?php
  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Writer\Xls;
  use PhpOffice\PhpSpreadsheet\Writer\Csv;

  if (isset($_POST["download_file_btn"])) {

    $file_ext_name = $_POST['export_file_type'];
    $fileName = "student_return_book_sheet";
    
    $sql = "SELECT * FROM issue_book WHERE book_issue_status = 'Return'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
      $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Book ID');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Issue Date Time');
        $sheet->setCellValue('D1', 'Expected Return Date');
        $sheet->setCellValue('E1', 'Return Date Time');
        $sheet->setCellValue('F1', 'Book Status');

        $rowCount = 2;
        foreach($result as $data){
          $sheet->setCellValue('A'.$rowCount, $data['book_id']);
          $sheet->setCellValue('B'.$rowCount, $data['user_id']);
          $sheet->setCellValue('C'.$rowCount, $data['issue_date_time']);
          $sheet->setCellValue('D'.$rowCount, $data['expected_return_date']);
          $sheet->setCellValue('E'.$rowCount, $data['return_date_time']);
          $sheet->setCellValue('F'.$rowCount, $data['book_issue_status']);
          $rowCount++;
        }
        if($file_ext_name == 'xlsx'){
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';
        }
        elseif($file_ext_name == 'xls'){
            $writer = new Xls($spreadsheet);
            $final_filename = $fileName.'.xls';
        }
        elseif($file_ext_name == 'csv'){
            $writer = new Csv($spreadsheet);
            $final_filename = $fileName.'.csv';
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
        $writer->save($final_filename);

        echo '<div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
          <span class="text-success">Report Has Been Successfully Downloaded!</span>
        </div>';
    }
    else {
      echo '<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
          <span class="text-danger">"No Record Found!"</span>
        </div>';
    }
  }
?>


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Return Book Records:</h6>
    </div>
    <form action="return_books.php" method="POST" enctype="multipart/form-data">
                <!-- <input type="file" accept=".xls, .csv, .xlsx" name="import_file" class="uploadlabel d-sm-inline-block shadow-sm" required> -->
                    <select name="export_file_type" class="uploadlabel d-sm-inline-block shadow-sm mt-3" required>
                      <option value="xlsx">XLSX</option>
                      <option value="xls">XLS</option>
                      <option value="csv">CSV</option>
                    </select>
                    <button type="submit" name="download_file_btn" class="btn btn-primary uploadbutton d-sm-inline-block btn shadow-sm mt-2">
                      <i class="fas fa-download" aria-hidden="true"></i>
                      Download Report
                    </button>
            </form>
      <div class="card-body">
      
        <div class="table-responsive">
          <table class="table table-bordered" id="datatableid" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th> Book Id </th>
                <th> Enrollment Number </th>
                <th> Book Issue Date</th>
                <th> Book Expected Return Date</th>
                <th> Book Return Date</th>
                <th> Book Fines</th>
                <th> Book Status</th>
                <th> Days</th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = "SELECT * FROM issue_book WHERE book_issue_status = 'Return'";
                $query_run = mysqli_query($connection, $query);
                if(mysqli_num_rows($query_run) > 0){
                  while($row = mysqli_fetch_assoc($query_run)){
                    $status = $row["book_issue_status"];
                    
          // if($status == 'Issue'){
          //   $status = '<h5><span class="badge badge-success">Issue</span></h5>';
          // }

          // if($status == 'Not Return'){
          //   $status = '<h5><span class="badge badge-danger">Not Return</span></h5>';
          // }          

                if($status == 'Return'){
                  $status = '<h5><span class="badge badge-warning">Return</span></h5>';
                }

                          $issue_date = $row['issue_date_time'];

                          $cur_date = $row['return_date_time'];

                          $days = strtotime($cur_date)-strtotime($issue_date); 

                          $expected_date = $row['expected_return_date']; 

                          $res = strtotime($expected_date)-strtotime($issue_date); 

                          $fine = null;

                          if ($days <= $res) {
                            $status = '<h5><span class="badge badge-warning">Return</span></h5>';
                          }
                          elseif ($days > $res) {
                            $late = strtotime($cur_date)-strtotime($expected_date); 
                            $status = '<h5><span class="badge badge-danger">'.floor($late/(24*60*60)).' Day Late Return</span></h5>';

                            $fine_func = get_one_day_fines($connection);

                            $fine = floor($late/(24*60*60)) * $fine_func;
                          }

                    // $update_query = "UPDATE issue_book SET book_issue_status = '$status' AND book_fines = '$fine'";

                    // $run = mysqli_query($connection, $update_query);
              ?>
              <tr>
                <td>
                  <?php  echo $row['book_id']; ?>
                </td>
                <td>
                  <?php  echo $row['user_id']; ?>
                </td>
                <td>
                  <?php  echo $row['issue_date_time']; ?>
                </td>
                <td>
                  <?php  echo $row['expected_return_date']; ?>
                </td>
                <td>
                  <?php  echo $row['return_date_time']; ?>
                </td>
                <td>
                  <?php  echo $fine; ?>
                </td>
                <td>
                  <?php  echo $status; ?>
                </td>
                <td>
                  <?php  echo floor($days/(24*60*60)); ?>
                </td>
                <td>
                  <?php
          echo'
          <a href="issue_book.php?action=view&code='.convert_data($row["issue_book_id"]).'" class="btn btn-primary">
            View
          </a>'
        ?>
                </td>
              </tr>
              <?php
      } 
    }
      ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>

  </div>
</div>
</div>

<?php
// include('admin/footer.php');
?>