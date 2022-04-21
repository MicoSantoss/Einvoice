<?php

session_start();
require_once 'dbh.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
    
    <title>Utilities</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <a href="invoice.php"><button>Add Sale Invoice</button></a>
        <div class="profile">
            <!--<span class="fa fa-search"></span>-->

            <?php
            
            $sql = "SELECT * FROM users WHERE usersId = '$_SESSION[userId]';";
            $imgresult = mysqli_query($conn, $sql);
            $image = mysqli_fetch_assoc($imgresult);

            
            ?>

            <img src="uploads/<?php echo $image['usersImage'];?>" alt="" class="profile-image">
            <p class="profile-name"><?php 
			
			if(isset($_SESSION['userId']) && isset($_SESSION['username'])){
				echo $_SESSION['username'];
			}
			else{
				echo '<script>alert("Login Failed!");</script>';
				header('location: login.php');
			}

			?></p>
        </div>
    </nav>

    <!--sidebar-->

    <input type="checkbox" id="toggle">
    <label for="toggle" class="side-toggle">
        <span class="fa fa-bars"></span>
    </label>

    <div class="sidebar">
        <a href="index.php"><div class="sidebar-menu">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="compinfo.php"><div class="sidebar-menu">
            <span class="fa fa-building"></span>
                <p>Company</p>
        </div></a>
        <a href="inventory.php"><div class="sidebar-menu">
            <span class="fa fa-archive"></span>
                <p>Inventory</p>
        </div></a>
        <a href="customer.php"><div class="sidebar-menu">
            <span class="fa fa-group"></span>
                <p>Customers</p>
        </div></a>
        <a href="receipts.php"><div class="sidebar-menu">
            <span class="fa fa-clipboard"></span>
                <p>Saved Invoice</p>
        </div></a>
        <a href="mop.php"><div class="sidebar-menu">
            <span class="fa fa-credit-card"></span>
                <p>Mode of Payment</p>
        </div></a>

        <!--<a href="#"><div class="sidebar-menu">
            <span class="fa fa-gear"></span>
                <p>Settings</p>
        </div></a>-->
        <a href="utility.php"><div class="sidebar-menu active-link">
            <span class="fa fa-briefcase"></span>
                <p>Utilities</p>
        </div></a>
        <a href="feedback.php"><div class="sidebar-menu">
            <span class="fa fa-question-circle"></span>
                <p>Help & Support</p>
        </div></a>
        <a href="logout-init.php"><div class="sidebar-menu">
            <span class="fa fa-sign-out"></span>
                <p>Logout</p>
        </div></a>
    </div>

    <!--main dashboard-->

    <main>
        <div class="compinfo-container">        
                <div style="grid-area: detail;
                            overflow-x: auto;
                            background-color: #fff;
                            padding: 1rem;
                            border-radius: 10px;
                            margin-right: 533px;" class="card detail">
                    <div class="detail-header">
                        <h2>Utilities</h2>
                    </div>
                    <span class="details">Calculator</span><br><br>
                    <div class="calcmain">
                        <div class="calc">
                            <div class="calcrow">
                                <div style="width: 50px;
                                            height: 63px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            cursor: pointer;
                                            transition: 0.15s;" class="calcbtn" id="clear">C</div>
                                <div id="calcdisplay">0</div>
                            </div>
                    
                            <div class="calcrow">
                                <div id="7" class="calcbtn">7</div>
                                <div id="8" class="calcbtn">8</div>
                                <div id="9" class="calcbtn">9</div>
                                <div id="add" class="calcbtn">+</div>
                            </div>
                    
                            <div class="calcrow">
                                <div id="4" class="calcbtn">4</div>
                                <div id="5" class="calcbtn">5</div>
                                <div id="6" class="calcbtn">6</div>
                                <div id="subtract" class="calcbtn">-</div>
                            </div>
                    
                            <div class="calcrow">
                                <div id="1" class="calcbtn">1</div>
                                <div id="2" class="calcbtn">2</div>
                                <div id="3" class="calcbtn">3</div>
                                <div id="multiply" class="calcbtn">*</div>
                            </div>
                    
                            <div class="calcrow">
                                <div id="0" class="calcbtn zero">0</div>
                                <div id="dot" class="calcbtn">.</div>
                                <div id="equal" class="calcbtn">=</div>
                                <div id="divide" class="calcbtn">/</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
</body>
</html>