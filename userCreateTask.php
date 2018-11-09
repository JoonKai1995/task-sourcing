<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$result = pg_query($db, "SELECT t.* FROM tasks t, submits s WHERE t.task_id = s.stask_ID AND s.suser_ID = $loginUID");

if (isset($_POST['return'])){
    header("Location: userPage.php");
}
if (isset($_POST['submit'])){
    $taskdescription = $_POST['description'];
    $place = $_POST['place'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $result1 = pg_query($db, 'SELECT MAX(task_id) FROM tasks');
    $old_tid = pg_fetch_result($result1, 0, 0);
    $new_tid = $old_tid + 1;
    $updateResult1 = pg_query($db, "INSERT INTO tasks VALUES('$new_tid', '$taskdescription', '$place', '$date', '$time')");
    $updateResult2 = pg_query($db, "INSERT INTO submits VALUES('$loginUID', '$new_tid')");

    $error = pg_last_error($db);
    if(!($updateResult1 && $updateResult2)){
        echo $error;
        console.log($error);
    }else {
        echo "Task Submission successful";
        header("Location: userPage.php");
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create A New Task</title>
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
    </div>
    <form method="post" name="form" action="userCreateTask.php">
        <header id="fh5co-header" class="fh5co-cover-table2" role="banner">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 text-left">
                        <div class="display-t">
                            <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                                <h1 class="mb30">Create a Task</h1>
                                <p>
                                    <div class='form-group'>
                                        <label for="inputUser">Task Description: </label>
                                        <input type="text" name="description" class="form-control" id="description" required>
                                    </div>
                                    <div class='form-group'>
                                        <label for="inputPassword">Location: </label>
                                        <input type="text" name="place" class="form-control" id="location" required>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <header id="fh5co-header" class="fh5co-cover-table2" role="banner">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 text-left">
                        <div class="display-t">
                            <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                                <p>
                                    <div class='form-group'>
                                        <label for="inputPassword">Date: </label>
                                        <input type="date" name="date" class="form-control" id="date" required>
                                    </div>
                                    <div class='form-group'>
                                        <label for="inputPassword">Start Time: </label>
                                        <input type="time" name="time" class="form-control" id="time" required>
                                    </div>
                                    
                                <input type="submit" class="btn btn-primary" name="submit"><br><br>
                                <p>Go Back?</p>
                                <p><a href="userPage.php" class="btn btn-primary">Return to User Page</a></p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </form>
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
