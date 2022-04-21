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
    
    <title>Users</title>
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
        <div class="customer-container">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Users List</h2>
                        <form action="" method="post">
                            <div class="search">
                                <input style="  padding: 5px 20px;
                                                width: 58%;" type="text" name="search" placeholder="Search Customer">

                                <input style="  padding: 3px 23px;
                                                font-size: 14px;
                                                height: 30px;
                                                width: 95px;
                                                border: 1px solid #89b76e;
                                                background-color: #89b76e;
                                                color: #f2f2f2;
                                                border-radius: 5px;
                                                cursor: pointer;
                                                transition: all 0.2s ease-in;" type="submit" name="customersearch" value="Search">
                            </div>
                        </form>
                        <!--<a href="customer-add.php" class="button"><button>Add Customer</button></a>-->
                    </div>

                    <?php

                        $now = date('Y-m-d'); /* DATE TODAY */


                        if (isset($_POST["customersearch"])){
                            $searchValue = $_POST["search"];

                            if (empty($searchValue)){
                                echo '<script>alert("Please Enter User Name!");</script>';
                                //exit();

                                $sql = "SELECT * FROM users ORDER BY usersID DESC;";
                                $result = mysqli_query($conn, $sql);
                                $resultCheck = mysqli_num_rows($result);

                                
                                if($resultCheck > 0){
                                    ?>
                                    
                                    <table>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th style="width: 0px;">Edit</th>
                                            <th style="width: 0px;">Delete</th>
                                        </tr>
                                        <?php while ($row = mysqli_fetch_assoc($result)){?>
                                        <tr>
                                            <td><?php echo $row['usersID'];?></td>
                                            <td><?php echo $row['usersEmail'];?></td>
                                            <td><?php echo $row['usersUid'];?></td>
                                            <td><?php echo $row['usersAdd'];?></td>
                                            <td><?php echo $row['usersDesc'];?></td>
                                            <td><a href="user-edit.php?id=<?php echo $row['usersID'];?>" class="editbutton">Edit</a></td>
                                            <td><a style="padding: 5px 20px" href="user-delete.php?id=<?php echo $row['usersID'];?>" onclick="return confirm('Warning! Are you sure you want to delete user <?php echo $row['usersUid'];?>?')" class="editbutton">Delete</a></td>
                                        </tr>
                                        <?php }?>
                                    </table>
                                    
                                    <?php 
                                }

                                exit();

                            }


                            $sql="SELECT * FROM users WHERE usersUid LIKE '%$searchValue%';";
                            $result = mysqli_query($conn, $sql);
                            


                            ?>
                            
                            <table>
                                <tr>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Description</th>
                                    <th style="width: 0px;">Edit</th>
                                    <th style="width: 0px;">Delete</th>
                                </tr>
                                <?php while ($row = mysqli_fetch_assoc($result)){?>
                                <tr>
                                    <td><?php echo $row['usersID'];?></td>
                                    <td><?php echo $row['usersEmail'];?></td>
                                    <td><?php echo $row['usersUid'];?></td>
                                    <td><?php echo $row['usersAdd'];?></td>
                                    <td><?php echo $row['usersDesc'];?></td>
                                    <td><a href="user-edit.php?id=<?php echo $row['usersID'];?>" class="editbutton">Edit</a></td>
                                    <td><a style="padding: 5px 20px" href="user-delete.php?id=<?php echo $row['usersID'];?>" onclick="return confirm('Warning! Are you sure you want to delete user <?php echo $row['usersUid'];?>?')" class="editbutton">Delete</a></td>
                                </tr>
                            </table>
                            
                            <?php }
                            ?>
                            
                            <?php 


                        exit(); 
                        }


			
			            $sql = "SELECT * FROM users ORDER BY usersID DESC;";
    		            $result = mysqli_query($conn, $sql);
			            $resultCheck = mysqli_num_rows($result);


                        if($resultCheck > 0){
                    ?>



                    <table>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th style="width: 0px;">Edit</th>
                                <th style="width: 0px;">Delete</th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)){?>
                            <tr>
                                <td><?php echo $row['usersID'];?></td>
                                <td><?php echo $row['usersEmail'];?></td>
                                <td><?php echo $row['usersUid'];?></td>
                                <td><?php echo $row['usersAdd'];?></td>
                                <td><?php echo $row['usersDesc'];?></td>
                                <td><a href="user-edit.php?id=<?php echo $row['usersID'];?>" class="editbutton">Edit</a></td>
                                <td><a style="padding: 5px 20px" href="user-delete.php?id=<?php echo $row['usersID'];?>" onclick="return confirm('Warning! Are you sure you want to delete user <?php echo $row['usersUid'];?>?')" class="editbutton">Delete</a></td>
                            </tr>
                            <?php }?>
                        </table>
                    <?php }?>
                </div>
        </div>
    </main>
</body>
</html>