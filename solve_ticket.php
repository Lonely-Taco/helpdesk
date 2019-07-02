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
                    <li class="navbar__link"><a class="navbar__link--a" href="home_employee.php?id=<?php echo $id;?>">Homepage</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="FAQ.html">FAQ'S</a></li>
                    <li class="navbar__link--enroll"><a class="navbar__link--a" href="logout.php">Log out</a></li>
                </ul>
            </div>
        </header>

        <div class="title-image">

        </div>

        <!-- Content -->
        <?php
        if (isset($_SESSION['username']) || isset($_SESSION['Manager'])) {
            $user = $_SESSION['username'];
            echo'<div class="content__wrapper">
                    <h1>Welcome ' . $user . '</h1>';
                echo '<div class="content__leftside">';
                getTicket($conn);
                $date = date('Y-m-d');
                    echo '<form class="main-form" action="'.setSolution($conn).'" method="POST">
                            <input type="hidden" name="date" value="'.$date.'"> 
                          <textarea class="input_textarea" rows="10" cols="20" type="text" name="solution" placeholder="Solution"></textarea>
                          <input class="main__button__form" type="submit" name="solve" value="Send">
                         </form>
                        </div>
                  </div>';
 
            echo '<p>You are logged in</p>
             <a href="home.php?page=logout">click here to log out</a>';
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

