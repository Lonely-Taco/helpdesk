<?php
session_start();
echo "customer home page";
include 'includes/connect.php';
date_default_timezone_set(timezone_name_from_abbr("CEST"));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home </title>
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
<!--             NAVBAR -->
            <div class="navbar">
                <ul>
                    <li class="navbar__link"><a class="navbar__link--a" href="mytickets.php?id=<?php echo $id;?>">MyTickets</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="home_customer.php?id=<?php echo $_GET['id']; ?>">Homepage</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="FAQ.html">FAQ'S</a></li>
                    <li class="navbar__link--enroll"><a class="navbar__link--a" href="logout.php">Log Out</a></li>
                </ul>
            </div>
        </header>

        <div class="title-image">
        </div>

        <!-- Content -->
        <?php
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
            echo'<div class="content__wrapper">
            <h1>Hello '.$user.'</h1>
            <div class="content__leftside">';
           include 'includes/functions.php';
               echo '<form class="main-form" action="'. setIncident($conn).'" method="POST">
                    <textarea class="input_textarea" rows="10" cols="20" type="text" placeholder="description" name="description"></textarea>
                    <select class="input_text" name="incident_id">
                        <option value=""></option>
                        <option value="399">Hardware</option>
                        <option value="400">Software</option>
                        <option value="401">Network</option>
                        <option value="402">Administrator</option>
                        <option value="403">Display</option>
                        <option value="404">Server</option>
                     </select>
                    <input class="main__button__form" type="submit" name="submit_ticket" value="Submit">
                </form>
            </div>

        </div>';
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
                    <p>Stenden Support Desk</p>
                </div>
            </div>
        </footer>
    </body>

</html>
