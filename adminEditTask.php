<?php
include("header.php");
//echo 'DB is connected';
$loginUID = $_SESSION['u_id'];
$result = pg_query($db, "SELECT t.*, u.user_id, u.username FROM tasks t, users u, submits s WHERE s.stask_ID = t.task_id AND s.suser_ID = u.user_id");

if (isset($_POST['return'])){
    header("Location: adminPage.php");
}else if (isset($_POST['edit'])){
    $taskid = $_POST['taskid'];
    $taskdescription = $_POST['description'];
    $place = $_POST['place'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $updateResult = pg_query($db, "UPDATE tasks 
    SET task_description = '$taskdescription', location = '$place', task_date ='$date', task_time='$time'
    WHERE task_id = '$taskid'");
    $error = pg_last_error($db);
    if(!$updateResult){
        echo $error;
        console.log($error);
    }else{
        echo "Update successful";
        header("Location: adminEditTask.php");
    }
}else if (isset($_POST['delete'])){
    $taskid2 = $_POST['taskid2'];
    $updateResult = pg_query($db, "DELETE FROM tasks
    WHERE task_id = '$taskid2'");
    $error = pg_last_error($db);
    if(!$updateResult){
        echo $error;
        console.log($error);
    }else{
        echo "Update successful";
        header("Location: adminEditTask.php");
    }
}else if(isset($_POST['create'])){
    $uid = $_POST['sUID1'];
    $taskid1 = $_POST['taskid1'];
    $taskdescription1 = $_POST['description1'];
    $place1 = $_POST['place1'];
    $date1 = $_POST['date1'];
    $time1 = $_POST['time1'];
    $updateResult1 = pg_query($db, "INSERT INTO tasks VALUES ('$taskid1','$taskdescription1','$place1','$date1','$time1')"); 
    $updateResult2 = pg_query($db, "INSERT INTO submits VALUES ('$uid','$taskid1')");
    $error = pg_last_error($db);
    if(!$updateResult){
        echo $error;
        console.log($error);
    }else{
        echo "Update successful";
        header("Location: adminEditTask.php");
    }
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
                            <h1 class="mb30">All Tasks Submitted:</h1>
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
                                        <th>Task Completion Status</th>
                                        <th>Submitted UID</th>
                                        <th>Submitted Username</th>
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
                                    echo "<td>" . $row[5] . "</td>";
                                    echo "<td>" . $row[6] . "</td>";
                                    echo "<td>" . $row[7] . "</td>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<br>There are no availble tasks currently!<br><br>";
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
                            <p><form method="post" name="form" action="adminEditTask.php">
                                    <label for="inputUser">Task ID: </label>
                                    <input type="text" name="taskid" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Task Description: </label>
                                    <input type="text" name="description" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Location: </label>
                                    <input type="text" name="place" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Date: </label>
                                    <input type="date" name="date" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Start Time: </label>
                                    <input type="time" name="time" class="form-control" id="inputUser" required><br>
                                    <input type="submit" class="btn btn-primary" name="edit" value="Edit Task">
                                </form>
                            </p>
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
                            <form method = "post" name="changes">
                            <strong>Task ID*: </strong> <input type="number" name="taskid2">
                            <br><br>
                            <input type="submit" name="delete" class="btn btn-primary" value="Delete Task">
                        </form>
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
                            <p><form method="post" name="form" action="adminEditTask.php">
                                    <label for="inputUser">Submit User ID: </label>
                                    <input type="text" name="sUID1" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Task ID: </label>
                                    <input type="text" name="taskid1" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Task Description: </label>
                                    <input type="text" name="description1" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Location: </label>
                                    <input type="text" name="place1" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Date: </label>
                                    <input type="date" name="date1" class="form-control" id="inputUser" required>
                                    <label for="inputUser">Start Time: </label>
                                    <input type="time" name="time1" class="form-control" id="inputUser" required><br>
                                    <input type="submit" class="btn btn-primary" name="create" value="Create New Task">
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
