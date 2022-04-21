<?php
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["submit"])){

    $emailSearch = $_POST['email'];

    require_once 'dbh.php';
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";



    //echo $productId;
    
    
    
    $sql = "SELECT * FROM users WHERE usersEmail = '$emailSearch';";
    $result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

    if($resultCheck == 1){

        $row = mysqli_fetch_assoc($result);
        $usersId = $row['usersID'];


        $code = rand(999999, 111111);

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML(true);
        $mail->Username = 'berniceeinvoice@gmail.com';
        $mail->Password = 'capstonk04';
        $mail->setFrom('no-reply@easyinvoice.org');
        $mail->Subject = 'Email Verification Code';
        $mail->Body = "Your verification code is $code";
        $mail->addAddress($emailSearch);


        if($mail->send()){
            /*$insertSql = "INSERT INTO users (usersCode) VALUE (?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $insertSql)){
                header("location: inventory.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "i", $code);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);*/

            session_start();
            $_SESSION["code"] = $code;
            $_SESSION["usersId"] = $usersId;

            header("location: forgotpw-init-check.php?id=$usersId");
            exit();
        }
        else{
            header('location: forgotpw-init.php?error=wentwrong');
        }
        

    }
    else{
        header('location: forgotpw.php?error=userdontexist');
    }
}
?>