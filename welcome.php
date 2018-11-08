<?php
include("header.php");
if (isset($_POST['submit1'])){
    header("Location: userLogin.php");
} else if (isset($_POST['submit2'])) {
    header("Location: adminLogin.php");
} else if (isset($_POST['submit3'])) {
    header("Location: createNewUser.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
                            <h1 class="mb30">Login</h1>
                            <p>
                                <form method="post" name="form1" action="welcome.php">
                                    <input type="submit" name="submit1" class="btn btn-primary" value="Go to User Login">
                                </form>
                                <form method="post" name="form2" action="welcome.php">
                                    <input type="submit" name="submit2" class="btn btn-primary" value="Go to Admin Login">
                                </form>
                                <br><br>
                                <p>Don't have an account yet?</p>
                            <h1 class="mb30">Register</h1>
                            </p><form method="post" name="form3" action="welcome.php">
                                <input type="submit" name="submit3" class="btn btn-primary" value="Create New User Account">
                            </form></div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
