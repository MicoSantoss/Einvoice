<?php

session_start();
require_once 'dbh.php';

$usersId = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login-signup.css">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-menu">
                <div class="title"><img src="images/logo.jpg" alt=""><span>⠀⠀⠀E</span>asy <span>I</span>nvoice</div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post">
			<div style="height: 308px;" id="roundedSquare">
				<br><strong><label style="font-size: 40px;" id="signIn">Forgot Password</label></strong> </br></br></br>
                <label style="margin-left: 76px;"> A confirmation code has been sent to your Email </label></br></br>
                
				<div >
					<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="text" name="confirmcode" placeholder="Enter Code" class="defaultSize"> </br></br>
					<!--<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="password"  name="pwd" placeholder="Password" class="defaultSize"> </br></br>-->
				</div >
					<input style="margin-right: 15%;" type="submit" name="submit" value="Enter" class="btnLogin">	
				<!--<div> </br></br></br></br>
					<a style="padding-left: 12%;" id="forPass" href="forgotpw.php"> Forgot password? </a>
				</div>
					<p style="padding-left: 12%;" id="line">___________________________________________</p>-->

				<div>
					<a style="  padding-top: 8%;
                                padding-right: 42%;" id= "signUp" href="login.php"> Cancel</a>
				</div>

			</div>
				
					
		</form>

        <?php
        if(isset($_POST['submit'])){
            $codesent = $_SESSION['code'];
            $confirmcode = $_POST['confirmcode'];

            $codesent = (int)$codesent;
            $confirmcode = (int)$confirmcode;

            if($codesent == $confirmcode){
                header("location: forgotpw-init-final.php?id=$usersId");
            }
            else{
                header('location: forgotpw.php?error=invalidinput');
            }



            /*$sql = "SELECT * FROM users WHERE usersID = '$usersId';";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck == 1){
                
            }*/

        }
    ?>
</body>