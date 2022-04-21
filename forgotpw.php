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
    <form action="forgotpw-init.php" method="post">
			<div style="height: 308px;" id="roundedSquare">
				<br><strong><label style="font-size: 40px;" id="signIn">Forgot Password</label></strong> </br></br></br></br></br>
				<div >
					<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="email" name="email" placeholder="Enter Email Address" class="defaultSize"> </br></br>
					<!--<input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="password"  name="pwd" placeholder="Password" class="defaultSize"> </br></br>-->
				</div >
					<input style="margin-right: 15%;" type="submit" name="submit" value="Enter" class="btnLogin">	
				<!--<div> </br></br></br></br>
					<a style="padding-left: 12%;" id="forPass" href="forgotpw.php"> Forgot password? </a>
				</div>
					<p style="padding-left: 12%;" id="line">___________________________________________</p>-->

				<div>
					<a style="  padding-top: 8%;
                                padding-right: 45%;" id= "signUp" href="login.php"> Back</a>
				</div>

			</div>
				
					
		</form>

        <?php
        if (isset($_GET['error'])){
            if ($_GET["error"] == "userdontexist"){
               echo '<script>alert("Email does not Exists!");</script>';
            }
            else if ($_GET["error"] == "invalidinput"){
                echo '<script>alert("code dont match!");</script>';
             }
        }
    ?>
</body>