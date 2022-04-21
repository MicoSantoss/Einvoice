<?php

session_start();
require_once 'dbh.php';


if(isset($_GET['id'])){
	$customerId = $_GET['id'];
	$sql = "SELECT * FROM response WHERE usersId='".$customerId."';";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
    	$no1 = $row['no1'];
    	$no2 = $row['no2'];
        $no3 = $row['no3'];
    	$no4 = $row['no4'];
    	$no5 = $row['no5'];
        $no6 = $row['no6'];
        $no7 = $row['no7'];
        $no8 = $row['no8'];
        $no9 = $row['no9'];
        $no10 = $row['no10'];
        $no11 = $row['no11'];
        $no12 = $row['no12'];
        $no13 = $row['no13'];
        $no14 = $row['no14'];
        $comments = $row['comments'];
	}
}
else{
	header("location: customer.php?error=emptyinput");
}

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
    
    <title>Feedback</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="admin-index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <div class="profile">
            
            <img src="uploads/IMG-61b782f31fe929.42178131.png" alt="" class="profile-image">
            <p class="profile-name">
            
            <?php 

			echo 'admin';
			
			?></p>
        </div>
    </nav>

    <!--sidebar-->

    <input type="checkbox" id="toggle">
    <label for="toggle" class="side-toggle">
        <span class="fa fa-bars"></span>
    </label>

    <div class="sidebar">
        <a href="admin-index.php"><div class="sidebar-menu">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="users.php"><div class="sidebar-menu">
            <span class="fa fa-group"></span>
                <p>Users</p>
        </div></a>
        <a href="admin-feedback.php"><div class="sidebar-menu active-link">
            <span class="fa fa-question-circle"></span>
                <p>Feedback</p>
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
                        <h2>Feedback Survey Questionnaire Answer</h2>
                    </div>

                    <?php

                        $now = date('Y-m-d'); /* DATE TODAY */

                        
                    ?>


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
                                <td style="text-align: center;"><input type="radio" id="eoi1" name="eoi" value="1" <?php if($no1 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eoi2" name="eoi" value="2" <?php if($no1 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eoi3" name="eoi" value="3" <?php if($no1 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eoi4" name="eoi" value="4" <?php if($no1 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eoi5" name="eoi" value="5" <?php if($no1 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Ease of Use</td>
                                <td style="text-align: center;"><input type="radio" id="eou1" name="eou" value="1" <?php if($no2 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eou2" name="eou" value="2" <?php if($no2 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eou3" name="eou" value="3" <?php if($no2 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eou4" name="eou" value="4" <?php if($no2 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="eou5" name="eou" value="5" <?php if($no2 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Hardware Compatibility</td>
                                <td style="text-align: center;"><input type="radio" id="hc1" name="hc" value="1" <?php if($no3 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="hc2" name="hc" value="2" <?php if($no3 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="hc3" name="hc" value="3" <?php if($no3 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="hc4" name="hc" value="4" <?php if($no3 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="hc5" name="hc" value="5" <?php if($no3 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Operating System Compatibility</td>
                                <td style="text-align: center;"><input type="radio" id="osc1" name="osc" value="1" <?php if($no4 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="osc2" name="osc" value="2" <?php if($no4 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="osc3" name="osc" value="3" <?php if($no4 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="osc4" name="osc" value="4" <?php if($no4 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="osc5" name="osc" value="5" <?php if($no4 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Security</td>
                                <td style="text-align: center;"><input type="radio" id="sec1" name="sec" value="1" <?php if($no5 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="sec2" name="sec" value="2" <?php if($no5 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="sec3" name="sec" value="3" <?php if($no5 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="sec4" name="sec" value="4" <?php if($no5 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="sec5" name="sec" value="5" <?php if($no5 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Ability to merge finctions of other apps</td>
                                <td style="text-align: center;"><input type="radio" id="abm1" name="abm" value="1" <?php if($no6 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="abm2" name="abm" value="2" <?php if($no6 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="abm3" name="abm" value="3" <?php if($no6 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="abm4" name="abm" value="4" <?php if($no6 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="abm5" name="abm" value="5" <?php if($no6 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Consistency of inventory tracking</td>
                                <td style="text-align: center;"><input type="radio" id="cit1" name="cit" value="1" <?php if($no7 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="cit2" name="cit" value="2" <?php if($no7 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="cit3" name="cit" value="3" <?php if($no7 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="cit4" name="cit" value="4" <?php if($no7 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="cit5" name="cit" value="5" <?php if($no7 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Quality of Invoicing</td>
                                <td style="text-align: center;"><input type="radio" id="qoi1" name="qoi" value="1" <?php if($no8 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qoi2" name="qoi" value="2" <?php if($no8 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qoi3" name="qoi" value="3" <?php if($no8 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qoi4" name="qoi" value="4" <?php if($no8 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qoi5" name="qoi" value="5" <?php if($no8 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Ability to archive receipts</td>
                                <td style="text-align: center;"><input type="radio" id="aar1" name="aar" value="1" <?php if($no9 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aar2" name="aar" value="2" <?php if($no9 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aar3" name="aar" value="3" <?php if($no9 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aar4" name="aar" value="4" <?php if($no9 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aar5" name="aar" value="5" <?php if($no9 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Accessibility of product support</td>
                                <td style="text-align: center;"><input type="radio" id="aps1" name="aps" value="1" <?php if($no10 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aps2" name="aps" value="2" <?php if($no10 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aps3" name="aps" value="3" <?php if($no10 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aps4" name="aps" value="4" <?php if($no10 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="aps5" name="aps" value="5" <?php if($no10 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Quality of product support</td>
                                <td style="text-align: center;"><input type="radio" id="qps1" name="qps" value="1" <?php if($no11 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qps2" name="qps" value="2" <?php if($no11 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qps3" name="qps" value="3" <?php if($no11 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qps4" name="qps" value="4" <?php if($no11 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="qps5" name="qps" value="5" <?php if($no11 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>

                                <td>Value for Money</td>
                                <td style="text-align: center;"><input type="radio" id="vfm1" name="vfm" value="1" <?php if($no12 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="vfm2" name="vfm" value="2" <?php if($no12 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="vfm3" name="vfm" value="3" <?php if($no12 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="vfm4" name="vfm" value="4" <?php if($no12 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="vfm5" name="vfm" value="5" <?php if($no12 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Overall Reliability</td>
                                <td style="text-align: center;"><input type="radio" id="or1" name="or" value="1" <?php if($no13 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="or2" name="or" value="2" <?php if($no13 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="or3" name="or" value="3" <?php if($no13 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="or4" name="or" value="4" <?php if($no13 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="or5" name="or" value="5" <?php if($no13 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                            <tr>
                                <td>Overall Performance</td>
                                <td style="text-align: center;"><input type="radio" id="op1" name="op" value="1" <?php if($no14 == 'unsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="op2" name="op" value="2" <?php if($no14 == 'somewhatunsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="op3" name="op" value="3" <?php if($no14 == 'neutral'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="op4" name="op" value="4" <?php if($no14 == 'somewhatsatisfied'){?> checked='checked' <?php }?>></td>
                                <td style="text-align: center;"><input type="radio" id="op5" name="op" value="5" <?php if($no14 == 'satisfied'){?> checked='checked' <?php }?>></td>
                            </tr>
                        </table><br>
                        <input type="text" id="comments" class="defaultSize" style="height: 100px; width: 500px;" name="comments" placeholder="No Comments..." value="<?php echo $comments; ?>"><br>
                </div>
        </div>
    </main>

    <?php
    
    if (isset($_GET['error'])){
        if ($_GET["error"] == "none"){
            echo '<script>alert("Thank you for your support");</script>';
            echo '<script>alert("Thank you for your support hehe");</script>';
        }
    }
    ?>
    
</body>
</html>