<?php

session_start();
require_once 'dbh.php';

if(isset($_POST['submit']) && isset($_FILES['qrcode'])){
    $sellerId = $_SESSION['userId'];

    $img_name = $_FILES['qrcode']['name'];
	$img_size = $_FILES['qrcode']['size'];
	$tmp_name = $_FILES['qrcode']['tmp_name'];
	$error = $_FILES['qrcode']['error'];

    if ($error === 0) {
		if ($img_size > 1000000) {
			$em = "tooLarge";
		    header("Location: mop.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'qrcodes/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

                updateqr($conn, $new_img_name, $sellerId);

			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
    }
}
else{
    header('mop.php?error=somethingwentwrong');
    exit();
}

function updateqr($conn, $new_img_name, $sellerId){
    $sql = "UPDATE users SET qrcode = '".$new_img_name."' WHERE usersId='".$sellerId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: mop.php?error=none");
    }
    else{
        echo "check query";
    }
}