<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$result = pg_query($db, "SELECT u.* FROM users u");
if (isset($_POST['return'])){
    header("Location: adminPage.php");
}else if (isset($_POST['submit'])){
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $updateResult = pg_query($db, "UPDATE users 
    SET username = '$username', password = '$password' WHERE user_id = '$userid'");

    $error = pg_last_error($db);
    if(!$updateResult){
        echo $error;
        console.log($error);
    }else {
        echo "Update successful";
        header("Location: adminEditUserPage.php");
    }
}

if (isset($_POST['delete'])){
    header("Location: adminDeleteUserPage.php");
}
?>

<body>
    
    <div class="fh5co-loader"></div>
    
    <div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 text-left">
                    <div id="fh5co-logo"><a href="welcome.php">TaskSourcing<span>.</span></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                    <li class="active"><a href="welcome.php"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </div>

    <header id="fh5co-header" class="fh5co-cover-table" role="banner">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <h1 class="mb30">Users List:</h1>
                            <div style="height:250px;overflow:auto;">
                            <?php
                            if (pg_num_rows($result) > 0) {
                                echo "<table id='table' class='table1' style='width:100%'>
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                while($row = pg_fetch_array( $result )) {
                                    echo "<tr>";
                                    echo "<td>" . $row[1] . "</td>";
                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[2] . "</td>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<br>There are no Administrator accounts?<br><br>";
                            }
                            ?>
                        </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header id="fh5co-header" class="fh5co-cover-table" role="banner">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <p><form method="post" name="form" action="adminEditUserPage.php">
                                    <strong>user ID*: </strong> <select name="userid">
                                    <?php 
                                        $use = pg_query($db, "SELECT u.* FROM users u");
                                        while ($rows = pg_fetch_array($use)){
                                            echo "<option value='".$rows[1]."'>".$rows[1]."</option>";
                                        }   
                                    ?>
                                    </select>
                                    <br><br>
                                    <label for="inputUser">Username: </label>
                                    <input type="text" name="username" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Password: </label>
                                    <input type="password" name="password" class="form-control" id="inputUser" required><br>
                                    <input type="submit" class="btn btn-primary" name="submit" value="Edit User">
                                </form>
                                <form method="post" name="form" action="adminEditUserPage.php">
                                    <input type="submit" name="delete" class="btn btn-primary" value="Delete User Page">
                                </form>
                            </p>
                            <p>Go Back?</p>
                            <p><a href="adminPage.php" class="btn btn-primary">Return to Admin Page</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- countTo -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Stellar -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>
</body>
