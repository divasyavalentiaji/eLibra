<?php
    session_start();

    if (isset($_SESSION['admin_username'])) {
        // Jika pengguna adalah admin, redirect ke halaman homepageadmin.php
        header('location: homepageadmin.php');
        exit();
    } elseif (isset($_SESSION['user_username'])) {
        // Jika pengguna adalah user, redirect ke halaman homepageuser.php
        header('location: homepageuser.php');
        exit();
    }
?>

<html>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
    <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function checkForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var login = document.getElementById("login");

            if (username == '' || password == '') {
                login.disabled = true;
                login.classList.add("loginDisabled");
            } else {
                login.disabled = false;
                login.classList.remove("loginDisabled");
            }
        }

        function checkPassword() {
            var password = document.getElementById("password");
            var eyeOpen = document.getElementById("eyeOpen");
            var eyeClosed = document.getElementById("eyeClosed");

            if (password.type === "password") {
                password.type = "text";
                eyeOpen.style.display = "inline";
                eyeClosed.style.display = "none";
            } else {
                password.type = "password";
                eyeOpen.style.display = "none";
                eyeClosed.style.display = "inline";
            }
        }
    </script>
    <body>
        <div class="wrapper">
            <div class="title">
                <h1>Login</h1>
            </div>

            <div class="warning" style="color:red;">
                <?php
                    if(isset($_COOKIE['message1'])){
                        echo $_COOKIE['message1'];
                    }
                ?>
            </div>

            <form method="POST" action="login.php" autocomplete="off">
                <div class="field">
                    <label>Username</label><br/>
                    <input type="text" name="username" placeholder="Enter username" id="username" oninput="checkForm()"/>
                </div>
                <div class="field">
                    <label>Password</label><br/>
                    <input type="password" name="password" placeholder="Enter password" id="password" oninput="checkForm()"/>
                    <i class="fa-regular fa-eye" style="color: #000000; display:none;" id="eyeOpen" onclick="checkPassword()"></i>
                    <i class="fa-regular fa-eye-slash" style="color: #000000;" id="eyeClosed" onclick="checkPassword()"></i>
                </div>
                <div class="loginButton">
                    <input type="submit" name="login" value="LOGIN" id="login" class="loginDisabled" disabled/>
                </div>
                <div class="bottom">
                    <label>Don't have an account yet? <a href="formsignup.php"><b>Sign up</b></a>
                </div>
            </form>
        </div>
    </body>
</html>