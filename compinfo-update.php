<?php

session_start();
require_once 'dbh.php';

if(isset($_POST['submit']) && isset($_FILES['profileImage'])){
    $sellerId = $_SESSION['userId'];
    $businessName = $_POST['businessName'];
    $businessAdd = $_POST['businessAdd'];
    $businessEmail = $_POST['businessEmail'];
    $businessDesc = $_POST['businessDesc'];
    echo "Hello";

    $img_name = $_FILES['profileImage']['name'];
	$img_size = $_FILES['profileImage']['size'];
	$tmp_name = $_FILES['profileImage']['tmp_name'];
	$error = $_FILES['profileImage']['error'];

	if ($error === 0) {
		if ($img_size > 1000000) {
			$em = "tooLarge";
		    header("Location: compinfo.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

                updateuser($conn, $businessName, $businessAdd, $businessEmail, $businessDesc, $new_img_name, $sellerId);

			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
    }

}
else{
    header("location: compinfo.php?error=");
    exit();
}

function updateuser($conn, $businessName, $businessAdd, $businessEmail, $businessDesc, $new_img_name, $sellerId){
    $sql = "UPDATE users SET usersUid = '".$businessName."',  usersEmail = '".$businessEmail."', usersAdd = '".$businessAdd."', usersDesc = '".$businessDesc."', usersImage = '".$new_img_name."' WHERE usersId='".$sellerId."';";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: logout-init.php");
    }
    else{
        echo "check query";
    }
}