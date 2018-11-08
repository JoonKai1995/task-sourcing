<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$result = pg_query($db, "SELECT t.* FROM tasks t, submits s WHERE t.task_id = s.stask_ID AND s.suser_ID <> $loginUID AND t.task_allocated = 'FALSE'");

if (isset($_POST['return'])){
    header("Location: userPage.php");
}else if (isset($_POST['submit'])){
    $taskid = $_POST['taskid'];
    $bid = $_POST['bid'];
    $submitid = pg_query($db, "SELECT s.suser_ID FROM submits s WHERE s.stask_ID = $1", array($taskid));
    $bidSuccess = pg_query($db, "INSERT INTO bids VALUES ($bid_value, $loginUID, $taskid, $submitid)");

    $error = pg_last_error($db);
    if(!$BidSuccess){
        echo $error;
        console.log($error);
    }else
        echo "Bid successful";
        header("Location: userPage.php");
    }
?>
<DOCTYPE! html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Bid</title>
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
                                if (pg_num_rows($result) > 0) {
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
                                    while($row = pg_fetch_array( $result )) {
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
                                    echo "<br>You cannot bid on any tasks currently!<br><br>";
                                }
                                ?>
                        </div><br>
                            <form method = "post" name="bid" action="userBidSubmit.php">
                                <strong>Task ID*: </strong> <select name="taskid">
                                    <?php 
                                        $use = pg_query($db, "SELECT t.* FROM tasks t, submits s WHERE t.task_id = s.stask_ID AND s.suser_ID <> $loginUID AND t.task_allocated = 'FALSE'");
                                        while ($rows = pg_fetch_array($use)){
                                            echo "<option value='".$rows[0]."'>".$rows[0]."</option>";
                                        }   
                                    ?>
                                </select><br>
                            </form>
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
                            <p><form method="post" name="form" action="userBidSubmit.php">
                                <div class='form-group'>
                                    <label for="inputUser">Bid Amount: </label>
                                    <input type="number" name="bid" class="form-control" id="inputUser" required>
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit">
                            </p>
                            <p>Go Back?</p>
                            <p><a href="userPage.html" class="btn btn-primary">Return to User Page</a></p>
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
