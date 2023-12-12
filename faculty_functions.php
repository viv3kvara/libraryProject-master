<?php
include('security.php');
// include('database/dbconfig.php');
// session_start();
    // function get_one_day_fines($connection){
    //     $output = 0;
    //     $query = "SELECT library_one_day_fine FROM settings 
    //     LIMIT 1";
    //     // $result = $connection->query($query);
    //     $result = mysqli_query($connection, $query);
    //     foreach($result as $row){
    //         $output = $row["library_one_day_fine"];
    //     }
    //     return $output;
    // }

    function get_book_issue_limit_per_user($connection){
        $output = '';
        $query = "SELECT library_issue_total_book_per_user FROM settings 
        LIMIT 1";
        // $result = $connection->query($query);
        $result = mysqli_query($connection, $query);
        foreach($result as $row){
            $output = $row["library_issue_total_book_per_user"];
        }
        return $output;     
    }

    function get_total_book_issue_day($connection){
        $output = 0;

        $query = "SELECT library_total_book_issue_day FROM settings 
        LIMIT 1";

        // $result = $connection->query($query);
        $result = mysqli_query($connection, $query);

        foreach($result as $row){
            $output = $row["library_total_book_issue_day"];
        }
        return $output;
    }

    function get_total_book_issue_per_user($connection, $user_unique_id){
        $output = 0;
        $query = "SELECT COUNT(issue_book_id) AS Total FROM f_issue_book 
        WHERE user_id = '$user_unique_id' 
        AND book_issue_status = 'Issue'";

        // $result = $connection->query($query);
        $result = mysqli_query($connection, $query);

        foreach($result as $row){
            $output = $row["Total"];
        }
        return $output;
    }

    function get_date_time($connection){
        return date("Y-m-d H:i:s",  STRTOTIME(date('h:i:sa')));
    }

    function convert_data($string, $action = 'encrypt'){
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') 
        {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } 
        else if ($action == 'decrypt') 
        {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
?>