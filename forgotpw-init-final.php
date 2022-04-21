<?php

session_start();
require_once 'dbh.php';
$codesent = $_SESSION['code'];
$usersId = $_SESSION['usersId'];


if (isset($_GET['error'])){
    if ($_GET["error"] == "passwordnotmatch"){
        echo '<script>alert("passwords dont match!!");</script>';
    }
}


?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in</title>
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
                <div id="roundedSquare">
                    <br><strong><label style="font-size: 40px;" id="signIn">Forgot Password</label></strong> </br></br></br>
                    <label style="margin-left: 76px;"> Type in New Password </label></br></br>
                    <div >
                        <input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="password" name="newpw" placeholder="New Password" class="defaultSize"> </br></br>
                        <input style="margin-left: 15%; width: 70%; padding: 12px 20px;" type="password"  name="confirmnewpw" placeholder="Confirm New Password" class="defaultSize"> </br></br>
                    </div >
                    <input style="margin-right: 15%;" type="submit" name="submit" value="Enter" class="btnLogin">	

                    <div>
                        <a style="  padding-top: 9%;
                                    padding-right: 41%;" id= "signUp" href="login.php"> Cancel</a>
                    </div>

                </div>
                    
                        
            </form>

            <?php
            if(isset($_POST['submit'])){

                $pwd = $_POST['newpw'];
                $confirmpwd = $_POST['confirmnewpw'];

                require_once 'functions.php';
    
    
                if(pwdMatch($pwd, $confirmpwd)){
                    header("location: forgotpw-init-final.php?error=passwordnotmatch");
                    exit();
                }

                $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET usersPwd = '".$hashedpwd."' WHERE usersID='".$usersId."';";
                $result = mysqli_query($conn, $sql);

                if($result){
                    session_unset();
                    session_destroy();
                    header("location: login.php?errro=none");
                }
                else{
                    echo "check query";
                }

    
            }
            ?>
    </body>