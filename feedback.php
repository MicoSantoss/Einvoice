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
    
    <title>Support</title>
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
        <!--<br><br>
        <br><br>
        <br><br>-->
        <!--break-->

        <!--<a href="#"><div class="sidebar-menu">
            <span class="fa fa-gear"></span>
                <p>Settings</p>
        </div></a>-->
        <a href="utility.php"><div class="sidebar-menu">
            <span class="fa fa-briefcase"></span>
                <p>Utilities</p>
        </div></a>
        <a href="feedback.php"><div class="sidebar-menu active-link">
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
        <div class="customer-container">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>User Feedback Survey Questionnaire</h2>
                    </div>

                    <?php

                        $now = date('Y-m-d'); /* DATE TODAY */

                        
                    ?>


                    <form action="feedback-init.php" method="POST">
                    <table>
                            <tr>
                                <th style="text-align: center;"></th>
                                <th style="text-align: center;">Unsatisfied</th>
                                <th style="text-align: center;">Somewhat Unsatisfied</th>
                                <th style="text-align: center;">Neutral</th>
                                <th style="text-align: center;">Somewhat Satisfied</th>
                                <th style="text-align: center;">Satisfied</th>
                            </tr>
                            <tr>
                                <td>Ease of installation</td>
                                <td style="text-align: center;"><input type="radio" id="eoi1" name="eoi" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="eoi2" name="eoi" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="eoi3" name="eoi" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="eoi4" name="eoi" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="eoi5" name="eoi" value="5"></td>
                            </tr>
                            <tr>
                                <td>Ease of Use</td>
                                <td style="text-align: center;"><input type="radio" id="eou1" name="eou" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="eou2" name="eou" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="eou3" name="eou" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="eou4" name="eou" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="eou5" name="eou" value="5"></td>
                            </tr>
                            <tr>
                                <td>Hardware Compatibility</td>
                                <td style="text-align: center;"><input type="radio" id="hc1" name="hc" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="hc2" name="hc" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="hc3" name="hc" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="hc4" name="hc" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="hc5" name="hc" value="5"></td>
                            </tr>
                            <tr>
                                <td>Operating System Compatibility</td>
                                <td style="text-align: center;"><input type="radio" id="osc1" name="osc" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="osc2" name="osc" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="osc3" name="osc" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="osc4" name="osc" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="osc5" name="osc" value="5"></td>
                            </tr>
                            <tr>
                                <td>Security</td>
                                <td style="text-align: center;"><input type="radio" id="sec1" name="sec" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="sec2" name="sec" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="sec3" name="sec" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="sec4" name="sec" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="sec5" name="sec" value="5"></td>
                            </tr>
                            <tr>
                                <td>Ability to merge finctions of other apps</td>
                                <td style="text-align: center;"><input type="radio" id="abm1" name="abm" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="abm2" name="abm" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="abm3" name="abm" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="abm4" name="abm" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="abm5" name="abm" value="5"></td>
                            </tr>
                            <tr>
                                <td>Consistency of inventory tracking</td>
                                <td style="text-align: center;"><input type="radio" id="cit1" name="cit" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="cit2" name="cit" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="cit3" name="cit" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="cit4" name="cit" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="cit5" name="cit" value="5"></td>
                            </tr>
                            <tr>
                                <td>Quality of Invoicing</td>
                                <td style="text-align: center;"><input type="radio" id="qoi1" name="qoi" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="qoi2" name="qoi" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="qoi3" name="qoi" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="qoi4" name="qoi" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="qoi5" name="qoi" value="5"></td>
                            </tr>
                            <tr>
                                <td>Ability to archive receipts</td>
                                <td style="text-align: center;"><input type="radio" id="aar1" name="aar" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="aar2" name="aar" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="aar3" name="aar" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="aar4" name="aar" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="aar5" name="aar" value="5"></td>
                            </tr>
                            <tr>
                                <td>Accessibility of product support</td>
                                <td style="text-align: center;"><input type="radio" id="aps1" name="aps" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="aps2" name="aps" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="aps3" name="aps" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="aps4" name="aps" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="aps5" name="aps" value="5"></td>
                            </tr>
                            <tr>
                                <td>Quality of product support</td>
                                <td style="text-align: center;"><input type="radio" id="qps1" name="qps" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="qps2" name="qps" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="qps3" name="qps" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="qps4" name="qps" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="qps5" name="qps" value="5"></td>
                            </tr>
                            <tr>

                                <td>Value for Money</td>
                                <td style="text-align: center;"><input type="radio" id="vfm1" name="vfm" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="vfm2" name="vfm" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="vfm3" name="vfm" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="vfm4" name="vfm" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="vfm5" name="vfm" value="5"></td>
                            </tr>
                            <tr>
                                <td>Overall Reliability</td>
                                <td style="text-align: center;"><input type="radio" id="or1" name="or" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="or2" name="or" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="or3" name="or" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="or4" name="or" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="or5" name="or" value="5"></td>
                            </tr>
                            <tr>
                                <td>Overall Performance</td>
                                <td style="text-align: center;"><input type="radio" id="op1" name="op" value="1"></td>
                                <td style="text-align: center;"><input type="radio" id="op2" name="op" value="2"></td>
                                <td style="text-align: center;"><input type="radio" id="op3" name="op" value="3" checked='checked'></td>
                                <td style="text-align: center;"><input type="radio" id="op4" name="op" value="4"></td>
                                <td style="text-align: center;"><input type="radio" id="op5" name="op" value="5"></td>
                            </tr>
                        </table><br>
                        <input type="text" id="comments" class="defaultSize" style="height: 100px; width: 500px;" name="comments" placeholder="Place your comments and suggestions here...."><br>
                        <input style="float: right;
                                        margin:13px 75px;
                                        padding: 17px 55px;" type="submit" name="submit" value="Submit" class="editbutton">
                    </form>
                </div>
        </div>
    </main>

    <?php
    
    if (isset($_GET['error'])){
        if ($_GET["error"] == "none"){
            echo '<script>alert("Thank you for your support");</script>';
        }
    }
    ?>
    
</body>
</html>