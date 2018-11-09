<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$result = pg_query($db, "SELECT t.* FROM tasks t WHERE t.task_id = s.stask_ID AND t.task_allocated = 'FALSE'");

if (isset($_POST['return'])){
    header("Location: userPage.php");
}else if (isset($_POST['submit'])){
    $taskid = $_POST['taskid'];
    $bidUID = $_POST['bidUserID'];
    $bid = $_POST['bid'];
    $res = pg_query($db, "SELECT s.suser_ID FROM submits s WHERE s.stask_ID = '$taskid'");
    $submitid = pg_fetch_result($res, 0, 0);
    $bidSuccess = pg_query($db, "INSERT INTO bids VALUES ($bid_value, $bidUID, $taskid, $submitid)");

    $error = pg_last_error($db);
    if(!$BidSuccess){
        echo $error;
        console.log($error);
    }else
        echo "Bid successful";
        header('Location: adminPage.php');
    }
?>

<DOCTYPE! html>
<html>

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
                                echo "<br>There are no task to bid on currently!<br><br>";
                            }
                            ?>
                        </div><br>
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
                            <p><form method="post" name="form" action="adminBidSubmit.php">
                                <strong>Task ID*: </strong> <select name="taskid">
                                <?php 
                                    $use = pg_query($db, "SELECT t.* FROM tasks t WHERE t.task_id = s.stask_ID AND t.task_allocated = 'FALSE'");
                                    while ($rows = pg_fetch_array($use)){
                                        echo "<option value='".$rows[0]."'>".$rows[0]."</option>";
                                    }   
                                ?>
                                </select>
                                <br><br>
                                <div class='form-group'>
                                    <label for="inputUser">Bid User ID: </label>
                                    <input type="text" name="bidUserID" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Bid Amount: </label>
                                    <input type="number" name="bid" class="form-control" id="inputUser" required>
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit Bid">
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
</html>
