
<?php
session_start();
include 'includes/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ticket Input</title>
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
                    <li class="navbar__link"><a class="navbar__link--a" href="#"></a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="home_employee.php?id=<?php echo $id;?>">Home</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="FAQ.html">FAQ'S</a></li>
                    <li class="navbar__link--enroll"><a class="navbar__link--a" href="logout.php">Log out</a></li>
                </ul>
            </div>
        </header>


        <div class="title-image">

        </div>
        <?php
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
          
           echo'<div class="content__wrapper">
            <h1>Hello '.$user.'</h1>
            <div class="content__leftside">';
           include 'includes/functions.php';
               echo '<form class="main-form" action="'. setIncidentemployee($conn).'" method="POST">
                    <textarea class="input_textarea" rows="10" cols="20" type="text" placeholder="description" name="description"></textarea>
                    <select class="input_text" name="incident_id">
                        <option value="">-error-</option>
                        <option value="399">Hardware</option>
                        <option value="400">Software</option>
                        <option value="401">Network</option>
                        <option value="402">Administrator</option>
                        <option value="403">Display</option>
                        <option value="404">Server</option>
                     </select>
                     <select class="input_text" name="contact">
                        <option value="">-contact name-</option>
                        <option value="1">Edward Renteria</option>
                        <option value="2">Albert Jimenez</option>
                        <option value="3">James Stine</option>
                        <option value="4">Jacob Stine</option>
                        <option value="5">Floorian Paardens</option>
                        <option value="6">Katrien Swillen</option>
                        <option value="7">Michael Scott</option>
                        <option value="8">Dwight Schrute</option>
                        <option value="9">Kevin Licon</option>
                        <option value="10">Kent Lawrence</option>
                     </select>
                    <input class="main__button__form" type="submit" name="submit_ticket" value="Submit">
                </form>
            </div>

        </div>';
            
             echo '<p>You are logged in</p>
             <a href="home.php?page=logout">click here to log out</a>';
           
        } else {
            //If SESSION['loggedIn'] has not been set -> give feedback and include login script
            echo "session not set<br /><br />";
//            include("home.php");
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