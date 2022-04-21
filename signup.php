<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="login-signup.css">
    <link rel="stylesheet" type="text/css" href="signup.css">
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
    </div>		<form action="signup-init.php" method="post">
			<div id="roundedSquare">
            <br><strong><label style="font-size: 40px;" id="signUp">Sign Up</label></strong> </br></br></br>
				<div >
					<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="email" name="email" placeholder="Email" class="defaultSize"> </br></br>
					<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="text" name="username" placeholder="Username" class="defaultSize"> </br></br>
					<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="password"  name="pwd" placeholder="Password" class="defaultSize"> </br></br>
					<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="password"  name="confirmpwd" placeholder="Confirm Password" class="defaultSize"> </br></br>
				</div >
					<input style="margin-right: 15%;" type="submit" name="submit" value="Sign Up" class="btnSignUp">	
				<div> </br></br></br></br>
					<a style="margin-left: -50px;" id="accLog" href="Login.php">Already have an account? <span style="color: #f7b82a;">Log in </span></a>
				
				

			</div>
				
					
		</form>

		<?php
        if (isset($_GET['error'])){
            if ($_GET["error"] == "emptyinput"){
               echo '<script>alert("Fill in all Fields!");</script>';
            }
            else if ($_GET["error"] == "usernametaken"){
                echo '<script>alert("Username/Email Already Taken!");</script>';
             }
			 else if ($_GET["error"] == "invalidemail"){
                echo '<script>alert("Please emter valid Email Address!");</script>';
             }
			 else if ($_GET["error"] == "passwordnotmatch"){
                echo '<script>alert("Password does not match!");</script>';
             }
        }
    ?>
	</body> 
</html>