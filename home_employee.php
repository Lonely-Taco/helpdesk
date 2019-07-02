
<?php
session_start();
echo "emplyee login page";
include 'includes/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home Employee</title>
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
        <?php
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];
            $id = $_GET['id'];
           
           echo '<div class="content__wrapper">
            <h1>Welcome '.$user.'</h1>
            <div class="content__leftside">

                <form class="main-form" action="" method="POST">';
                            
                                        echo '<button id="employee_buttons" class="btn btn-info btn-lg" name="signup">Ticket Input</button>';
					if(isset($_POST['signup'])){
						echo "<script>window.open('ticket_input.php?id=".$id."','_self')</script>";
					}
				
                                        echo '<button id="employee_buttons" class="btn btn-info btn-lg" name="login">Assigned Ticket Overview</button><br><br>';
				
					if(isset($_POST['login'])){
						echo "<script>window.open('ticket_overview.php?id=".$id."','_self')</script>";
					}
				
                echo '</form>
            </div>
        </div>';

             echo '<p>You are logged in</p>
             <a href="home.php?page=logout">click here to log out</a>';
           
        } elseif(isset ($_SESSION['Manager'])){
            $user = $_SESSION['Manager'];
            $id = $_GET['id'];
            echo '<div class="content__wrapper">
            <h1>Welcome '.$user.'</h1>
            <div class="content__leftside">
                <form class="main-form" action="" method="POST">';
                            
                                        echo '<button id="employee_buttons" class="btn btn-info btn-lg" name="signup">Ticket Assign</button>';
					if(isset($_POST['signup'])){
						echo "<script>window.open('ticket_assign.php?id=".$id."','_self')</script>";
					}
				
                                        echo '<button id="employee_buttons" class="btn btn-info btn-lg" name="login">Assigned Ticket Overview</button><br><br>';
				
					if(isset($_POST['login'])){
						echo "<script>window.open('ticket_overview.php?id=".$id."','_self')</script>";
					}
                echo '</form>
            </div>
        </div>';
        }else {
            echo "session not set<br /><br />";
            echo ' <div class="content__wrapper">
            <h1>You are logged out.</h1>
            <div class="col-sm-6" style="left:8%:">

                <form method="post" action="">';

                    echo '<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>';
                
                    if (isset($_POST['login'])) {
                        
                        echo "<script>window.open('home.php','_self')</script>";
               echo '</form>
            </div>';
        }
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