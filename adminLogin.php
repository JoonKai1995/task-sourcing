<?php
include("header.php");
$userError="";
$passwordError="";
if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = pg_query_params($db, 'SELECT password, admin_id FROM administrators WHERE username = $1', array($username));
    $row = pg_fetch_array($result);
    $error = pg_last_error($db);
    if (!isset($row[0])) {
        $userError = 'There is no such user in use.';
    } else if(!($password == $row[0])){
        $passwordError = "Wrong password!";
    } else {
        $_SESSION['u_id']= $row[1];
        header("Location: adminPage.php");
    }
}
if (isset($_POST['submit1'])){
    header("Location: userLogin.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>

<body>
        
    <div class="fh5co-loader"></div>
    
    <div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 text-left">
                    <div id="fh5co-logo"><a href="index.html">TaskSourcing<span>.</span></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                    <li class="active"><a href="index.html"><i class="icon-home"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </div>

    <header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(images/background.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <h1 class="mb30">Administrator Login</h1>
                            <form method="post" name="form" action="adminLogin.php">
                                <div class='form-group'>
                                    <label for="inputUser">Username: </label>
                                    <input type="text" name="username" class="form-control" id="inputUser" required>
                                    <span style="color:red"><?php echo $userError;?></span>
                                </div>
                                <div class='form-group'>
                                    <label for="inputPassword">Password: </label>
                                    <input type="password" name="password" class="form-control" id="inputPassword" required>
                                    <span style="color:red"><?php echo $passwordError;?></span>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary">
                            </form>
                            <br>
                            <p>Not an Administrator?</p>
                            <form method="post" name="form1" action="welcome.php">
                                <input type="submit" name="submit1" class="btn btn-primary" value="Go to User Login">
                            </form>
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
