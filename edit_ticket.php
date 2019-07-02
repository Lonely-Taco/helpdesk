
<?php
session_start();
echo 'emplyee login page';
include 'includes/connect.php';
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ticket Solution</title>
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
        $id = $_SESSION['eid'];
        ?>
        <header id="header">
            <!-- NAVBAR -->
            <div class="navbar">
                <ul>
                    <li class="navbar__link"><a class="navbar__link--a" href="home_employee.php?id=<?php echo $id; ?>">Homepage</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="FAQ.html">FAQ'S</a></li>
                    <li class="navbar__link--enroll"><a class="navbar__link--a" href="logout.php">Log out</a></li>
                </ul>
            </div>
        </header>

        <div class="title-image">
        </div>

        <!-- Content -->
        <?php
        //No GET present -> Check if user is logged in via SESSION
        if (isset($_SESSION['username']) || isset($_SESSION['Manager'])) {
            echo'<div class="content__wrapper">
                                <h1>Edit/Delete Ticket</h1>';
            echo '<div class="content__leftside">';
            //Delete function
            if(isset($_POST['delete'])){
                $sql_delete = "DELETE FROM ticket WHERE ticket.TicketID=? ";
                $statement = mysqli_prepare($conn, $sql_delete);
                if(!$statement){
                    echo "unable to prepare". mysqli_error($conn);
                }else{
                    mysqli_stmt_bind_param($statement, 'i', $_GET['id']);
                    $delete = mysqli_stmt_execute($statement);
                    if(!$delete){
                        echo 'unable to delete'. mysqli_error($conn);
                    }else{
                        echo'Delete Succesfull';
                    }
                }
            }
            
        //  if the the edit/send button is pressed, update that row.   
            if (isset($_POST['edit'])) {
                $incident = htmlentities($_POST['incident']);
                $sol = htmlentities($_POST['solution']);
                $desc = htmlentities($_POST['description']);
                $stat = $_POST['status'];
                if (empty($sol) || empty($desc) || empty($stat)) {
                    echo 'Fill in all the fields of press back on your browser';
                } else {
                    $sql_update = "UPDATE ticket SET IncidentID=?,Description=?,Status=?,Solution=? WHERE TicketID=?";
                    $stmt = mysqli_prepare($conn, $sql_update);
                    if (!$stmt) {
                        echo 'unable to prepare' . mysqli_error($conn);
                    } else {
                        mysqli_stmt_bind_param($stmt, 'issss', $incident, $desc, $stat, $sol, $_GET['id']);
                        $result = mysqli_stmt_execute($stmt);
                        if (!$result) {
                            echo 'Unable to execute ' . mysqli_error($conn);
                        } else {
                            echo 'success';
                        }
                    }

                    mysqli_stmt_close($stmt);
                }
            }
//start new stmt to select the information for a specific ticket.
            $sql_select = "SELECT IncidentID, Description, Status, Solution FROM `ticket` WHERE TicketID=?";
            $stmt = mysqli_prepare($conn, $sql_select);
            if (!$stmt) {
                echo 'Unable to Prepare' . mysqli_error($conn);
            } else {
                mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    echo'Unable to execute' . mysqli_error($conn);
                } else {
                    mysqli_stmt_bind_result($stmt, $incidentid, $desc, $status,$solution);
                    mysqli_stmt_store_result($stmt);
                    while (mysqli_stmt_fetch($stmt)) {

                        echo '<form class="main-form" action="" method="POST">
                  IncidentID:<select class="input_text" name="incident">
                                <option value="' . $incidentid . '">' . $incidentid . '</option>
                                <option value="399">Hardware</option>
                                <option value="400">Software</option>
                                <option value="401">Network</option>
                                <option value="402">Administrator</option>
                                <option value="403">Display</option>
                                <option value="404">Server</option>
                              </select>
                           Status:<select class="input_text" name="status">
                                <option value='.$status.'>'.$status.'</option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="PENDING">PENDING</option>
                                <option value="CLOSED">CLOSED</option>
                                <option value="FORWARD TO">FORWARD</option>
                                
                              </select>
                          Description:<textarea class="input_textarea" rows="10" cols="20" type="text" name="description" >'. $desc.'</textarea>
                          Solution:<textarea class="input_textarea" rows="10" cols="20" type="text" name="solution" >'.$solution.'</textarea>
                          <input class="main__button__form" type="submit" name="edit" value="Send"><br><br>
                          <input class="main__button__form" type="submit" name="delete" value="Delete Ticket">
                         </form>
                        </div>
                  </div>';
                    }
                }
            }
         
             echo'<p><a href="home.php?page=logout">click here to log out</a></p>';
        } else {
          
            echo "session not set<br /><br />";

            echo ' <div class="content__wrapper">
            <h1>You are logged out.</h1>
            <div class="col-sm-6" style="left:8%:">

                <form method="post" action="">';
            echo '<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>';
            if (isset($_POST['login'])) {
                echo "<script>window.open('home.php','_self')</script>";
            }
            echo '</form>
            </div>';
        }
        ?>
        <!-- Footer -->
        <footer id="footer">
            <div class="footer__wrapper">
                <div class="footer__left">
                    <a href="#">Privacy Statement</a>&nbsp;|&nbsp;<a href="#">Cookie Policy</a>&nbsp;|&nbsp;<a href="#">Disclaimer</a>
                </div>
                <div class="footer__right">
                    <p>Basic template Support Desk</p>
                </div>
            </div>
        </footer>
    </body>

</html>

