<?php
session_start();
include 'includes/connect.php';
if (isset($_POST['submit'])) {
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    $license = htmlentities($_POST['license']);
    $select_query = "SELECT ContactID,C_username,C_pass, License_N FROM customer_contact WHERE C_username = ? ";
    $stmt = mysqli_prepare($conn, $select_query);
    if (!$stmt) {
        echo'no can do'.mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 's', $username);
        $Qresult = mysqli_execute($stmt);
        if (!$Qresult) {
            die($conn);
        } else {
            mysqli_stmt_bind_result($stmt, $id,$userN, $userP,$license_N);
            mysqli_stmt_store_result($stmt);
            $rows = mysqli_stmt_num_rows($stmt);
            if ($rows == 1) {
                while (mysqli_stmt_fetch($stmt)) {
                    if ($password == $userP && $license == $license_N ) {
                        $_SESSION['username'] = $userN;
                        $_SESSION['eid'] = $id;
                       
                     echo "<script>window.open('home_customer.php?id=".$id."', '_self')</script>";
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HelpDesk</title>
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header id="header">

<!--             NAVBAR -->
            <div class="navbar">
                <ul>
                    <li class="navbar__link"><a class="navbar__link--a" href="home.php">Homepage</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="FAQ.html">FAQ'S</a></li>
                </ul>
            </div>
        </header>

        <div class="title-image">
        </div>

        <!-- Content -->
        <div class="content__wrapper">
            <h1>Customer Login</h1>
            <div class="content__leftside">
                <form class="main-form" action="" method="POST">
                    <input class="input_text" type="text" placeholder="User Name" name="username" />
                    <input class="input_text" type="password" placeholder="password" name="password" />
                    <input class="input_text" type="text" placeholder="License Number" name="license" />
                    <input class="main__button__form" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
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