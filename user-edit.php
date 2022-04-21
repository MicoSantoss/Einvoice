<?php

session_start();
require_once 'dbh.php';

if(isset($_GET['id'])){
	$customerId = $_GET['id'];
	$sql = "SELECT * FROM users WHERE usersID='".$customerId."';";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
    	$customerId = $row['usersID'];
    	$customerName = $row['usersUid'];
        $customerAdd = $row['usersAdd'];
    	$customerEmail = $row['usersEmail'];
    	$customerDesc = $row['usersDesc'];
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
    
    <title>Edit Customer</title>
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
        <a href="users.php"><div class="sidebar-menu active-link">
            <span class="fa fa-group"></span>
                <p>Users</p>
        </div></a>
        <a href="admin-feedback.php"><div class="sidebar-menu">
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
        <div class="compinfo-container">
            <form action="user-update.php?id=<?php echo $customerId;?>" method="post">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Edit User Information</h2>
                    </div>
                    <div class="compform">
                        <div class="input box1">
                            <span class="details">User Name</span>
                            <input type="text" name="customerName" placeholder="Enter User Name" value="<?php echo $customerName;?>">
                        </div>
                        <div class="input box3">
                            <span class="details">User Address</span>
                            <input type="text" name="customerAdd" placeholder="Enter Address" value="<?php echo $customerAdd;?>">
                        </div>
                        <div class="input box4">
                            <span class="details">Email Address</span>
                            <input type="text" name="customerNo" placeholder="Enter Quantity" value="<?php echo $customerEmail;?>">
                        </div>
                        <div class="input box5">
                            <span class="details">Description</span>
                            <input type="text" name="customerStatus" placeholder="Enter Description" value="<?php echo $customerDesc;?>">
                        </div>
                        <input style="width: 30%;" type="submit" name="submit" value="Update" class="editbutton">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>