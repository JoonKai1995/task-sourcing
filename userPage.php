
<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$result1 = pg_query($db, "SELECT * FROM tasks t WHERE t.task_completion = false");
$result2 = pg_query($db, "SELECT t.* FROM tasks t, submits s WHERE t.task_id = s.stask_ID AND s.suser_ID = $loginUID");
$result3 = pg_query($db, "SELECT t.* FROM tasks t, allocated a WHERE t.task_id = a.atask_ID AND a.auser_ID = $loginUID");

if(isset($_POST['submit1'])){
    header("Location: userBidSubmit.php");
}else if(isset($_POST['submit2'])){
    header("Location: userCreateTask.php");
}else if(isset($_POST['edit'])){
    header("Location: userEditTask.php");
}else if(isset($_POST['delete'])){
    header("Location: userDeleteTask.php");
} else if(isset($_POST['Allocate'])){
    header("Location: userSelectTask.php");
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home Page</title>
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

    <header id="fh5co-header" class="fh5co-cover-table" role="banner">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <h1 class="mb30">Tasks Available:</h1>
                            <div style="height:250px;overflow:auto;">
                            <?php
                            if (pg_num_rows($result1) > 0) {
                                echo "<table id='table' class='table1' style='width:100%'>
                                <thead>
                                    <tr>
                                        <th>Task ID</th>
                                        <th>Task Description</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                while($row = pg_fetch_array( $result1 )) {
                                    echo "<tr>";
                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[1] . "</td>";
                                    echo "<td>" . $row[2] . "</td>";
                                    echo "<td>" . $row[3] . "</td>";
                                    echo "<td>" . $row[4] . "</td>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<br>There are no availble tasks currently!<br><br>";
                            }
                            ?>
                        </div><br>
                        <div style="display: table-row">
                            <div style="width: 170px; display: table-cell;">
                                <form method="post" name="form1" action="welcome.php">
                                    <input type="submit" name="submit1" class="btn btn-primary" value="Submit a Bid">
                                </form>
                            </div>
                            <div style="display: table-cell;">
                                <form method="post" name="form1" action="welcome.php">
                                    <input type="submit" name="submit2" class="btn btn-primary" value="Create a Task">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br>
    <header id="fh5co-header" class="fh5co-cover-table2" role="banner">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                        <h1 class="mb30">Submitted Tasks:</h1>
                        <div style="height:250px;overflow:auto;">
                            <?php
                            if (pg_num_rows($result2) > 0) {
                                echo "<table id='table' class='table1' style='width:100%'>
                                <thead>
                                    <tr>
                                        <th>Task ID</th>
                                        <th>Task Description</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                while($row = pg_fetch_array( $result2 )) {
                                    echo "<tr>";
                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[1] . "</td>";
                                    echo "<td>" . $row[2] . "</td>";
                                    echo "<td>" . $row[3] . "</td>";
                                    echo "<td>" . $row[4] . "</td>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<br>You have not submitted any tasks currently!<br><br>";
                            }
                            ?>
                        </div><br>
                        <div style="display: table-row">
                            <div style="width: 170px; display: table-cell;">
                                <form method="post" name="form" action="userPage.php">
                                    <input type="submit" name="edit" class="btn btn-primary" value="Edit Tasks">
                                </form>
                            </div>
                            <div style="display: table-cell;">
                                <form method="post" name="form" action="userPage.php">
                                    <input type="submit" name="delete" class="btn btn-primary" value="Delete Tasks">
                                </form>
                            </div>
                            <div>
                                <form method="post" name="form" action="userPage.php">
                                    <input type="submit" name="Allocate" class="btn btn-primary" value="Select Task to Allocate">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br>
    <header id="fh5co-header" class="fh5co-cover-table" role="banner">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                        <h1 class="mb30">Allocated Tasks:</h1>
                        <div style="height:250px;overflow:auto;">
                            <?php
                            if (pg_num_rows($result3) > 0) {
                                echo "<table id='table' class='table1' style='width:100%'>
                                <thead>
                                    <tr>
                                        <th>Task ID</th>
                                        <th>Task Description</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                while($row = pg_fetch_array( $result3 )) {
                                    echo "<tr>";
                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[1] . "</td>";
                                    echo "<td>" . $row[2] . "</td>";
                                    echo "<td>" . $row[3] . "</td>";
                                    echo "<td>" . $row[4] . "</td>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<br>You are not allocated any tasks currently!<br><br>";
                            }
                            ?>
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
