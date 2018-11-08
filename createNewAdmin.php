<?php
include("header.php");
$userError="";
if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result1 = pg_query($db, 'SELECT MAX(admin_id) FROM administrators');
    $old_uid = pg_fetch_result($result1, 0, 0);
    $new_uid = $old_uid + 1;
    $result2 = pg_query($db, "INSERT INTO administrators values('$new_uid', '$username', '$password')");
    if (!$result2) {
        $userError = 'Invalid username.';
    } else {
        echo 'User creation succesful!';
        header("Location: adminPage.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create A New Admin</title>
</head>

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
                    <li class="active"><a href="welcome.php"><i class="icon-home"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(images/background.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 text-left">
                        <div class="display-t">
                            <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                                <h1 class="mb30">Register</h1>
                                <form method="post" name="form" action="createNewAdmin.php">
                                    <div class='form-group'>
                                        <label for="inputUser">Username: </label>
                                        <input type="text" name="username" class="form-control" id="inputUser" required>
                                        <span style="color:red"><?php echo $userError;?></span>
                                    </div>
                                    <div class='form-group'>
                                        <label for="inputPassword">Password: </label>
                                        <input type="password" name="password" class="form-control" id="inputPassword" required>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Create new Admin">
                                </form>  
                            </div>
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
</html>
