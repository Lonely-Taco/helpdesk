
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
            <!-- NAVBAR -->
            <div class="navbar">
                <ul>
                    <li class="navbar__link"><a class="navbar__link--a" href="index.php">Homepage</a></li>
                    <li class="navbar__link"><a class="navbar__link--a" href="FAQ.html">FAQ'S</a></li>
                    <!--<li class="navbar__link--enroll"><a class="navbar__link--a" href="#">LogIn</a></li>-->
                </ul>
            </div>
        </header>

        <div class="title-image">
        </div>

        <!-- Content -->
        <div class="content__wrapper">
            <h1>Welcome to our Online Helpdesk</h1>
            <div class="col-sm-6" style="left:8%;">

                <form method="post" action="">
                    <button id="signup" class="btn btn-info btn-lg" name="signup">Customer Login</button><br><br>
                    <?php
                    if (isset($_POST['signup'])) {
                        echo "<script>window.open('logincustomer.php','_blank')</script>";
                    }
                    ?>
                    <button id="login" class="btn btn-info btn-lg" name="login">Employee Login</button><br><br>
                    <?php
                    if (isset($_POST['login'])) {
                        echo "<script>window.open('loginemployee.php','_blank')</script>";
                    }
                    ?>
                </form>
            </div>
            <div class="content__rightside--35">
                <div class="contact__social-media">
                    <h2>For more information</h2>
                    <p class="p__margin-bottom">
                        Tel: +31 23 271 5322<br />
                    </p>
                    <p class="p__margin-bottom">
                        Help Desk<br />
                    </p>
                </div>
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
