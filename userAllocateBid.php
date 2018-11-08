<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$taskid = $_SESSION['temp'];
$result = pg_query($db, "SELECT b.buser_ID, b.bid_value FROM bids b WHERE b.btask_ID = $taskid");

if (isset($_POST['return'])){
    header("Location: userPage.php");
}else if (isset($_POST['submit'])){
    $allocid = $_POST['taskid'];
    $result2 = pg_query($db, "INSERT INTO allocated VALUES ('$allocid', '$taskid', $loginUID)");

    $error = pg_last_error($db);
    if(!$result2){
        echo $error;
        console.log($error);
    }else
        echo "Allocation successful";
        header("Location: userPage.php");
    }
?>

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
                            <h1 class="mb30">Current Bids:</h1>
                            <div style="height:250px;overflow:auto;">
                            <?php
                            if (pg_num_rows($result) > 0) {
                                echo "<table id='table' class='table1' style='width:100%'>
                                <thead>
                                    <tr>
                                        <th>Bid UID</th>
                                        <th>Bid Value</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                while($row = pg_fetch_array( $result )) {
                                    echo "<tr>";
                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[1] . "</td>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<br>You have not submitted any tasks currently!<br><br>";
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
                            <p><form method = "post" name="changes">
                                <strong>Bid User ID*: </strong> <select name="allocid">
                                <?php 
                                    $use = pg_query($db, "SELECT b.buser_ID, b.bid_value FROM bids b WHERE b.btask_ID = $taskid");
                                    while ($rows = pg_fetch_array($use)){
                                        echo "<option value='".$rows[0]."'>".$rows[0]."</option>";
                                    }   
                                ?>
                                </select>
                                <br><br>
                                <input type="submit" name="submit" class="btn btn-primary" value="Allocate for Selected">
                            </form>
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
