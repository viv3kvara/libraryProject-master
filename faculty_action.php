<?php 
include('security.php'); 
// if (!isset($_SESSION["uid"])) {
//     header("location:admin_login.php");
// }

if(isset($_POST["action"])){
	if($_POST["action"] == 'search_book_id'){
		$query = "SELECT book_id, book_title FROM books 
		WHERE book_id LIKE '%".$_POST["request"]."%' 
		AND Availability = 'Available'
		";

		$result = $connection->query($query);

		$data = array();

		foreach($result as $row){
			$data[] = array(
				'id'		=>	str_replace($_POST["request"], '<b>'.$_POST["request"].'</b>', $row["book_id"]),
				'book_title'		=>	$row['book_title']
			);
		}
		echo json_encode($data);
	}

	if($_POST["action"] == 'search_user_id'){
		$query = "SELECT f_id, f_name, l_name FROM faculties 
		WHERE f_id LIKE '%".$_POST["request"]."%'";

		$result = $connection->query($query);

		$data = array();

		foreach($result as $row){
			$data[] = array(
				'f_id'	    =>	str_replace($_POST["request"], '<b>'.$_POST["request"].'</b>', $row["f_id"]),
				'f_name'	=>	$row["f_name"],
				'l_name'	=>	$row["l_name"]
			);
		}

		echo json_encode($data);
	}
}

?>