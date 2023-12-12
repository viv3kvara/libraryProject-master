<?php
// session_start();
include('security.php');
function make_avatar($character){
    $path = "avatar/". time() . ".png";
    $image = imagecreate(200, 200);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);  
    $textcolor = imagecolorallocate($image, 255,255,255);  

    imagettftext($image, 100, 0, 55, 150, $textcolor, 'E:\Wamp_server\www\DLMS\font\arial.ttf', $character);   
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}
    
function Get_user_avatar($eno_login, $connection){
    $query = "SELECT user_avatar FROM register WHERE enrollment_number = '".$eno_login."'";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)){
    // foreach($result as $row){
        echo '<img src="'.$row["user_avatar"].'" width="75" class="img-profile rounded-circle" />';
    }
}

function Get_faculty_avatar($userid, $connection){
    $query = "SELECT avatar FROM faculties WHERE f_id = '".$userid."'";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)){
        echo '<img src="'.$row["avatar"].'" width="75" class="img-profile rounded-circle" />';
    }
}

?>