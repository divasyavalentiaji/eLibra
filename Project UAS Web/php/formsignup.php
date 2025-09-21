<html>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesignup.css">
    <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function checkForm() {
            var name = document.getElementById("name").value;
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var dateofbirth = document.getElementById("dateofbirth").value;
            var signUp = document.getElementById("signUp");

            if (name == '' || username == '' || email == '' || password == '' || dateofbirth == '') {
                signUp.disabled = true;
                signUp.classList.add("signUpDisabled");
            } else {
                signUp.disabled = false;
                signUp.classList.remove("signUpDisabled");
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
                <h1>Sign Up</h1>
            </div>

            <div class="warning" style="color:red;">
                <?php
                    if(isset($_COOKIE['message2'])){
                        echo $_COOKIE['message2'];
                    }
                ?>
            </div>
        
            <form method="POST" action="signup.php" autocomplete="off">
                <div class="field">
                    <label>Full Name</label><br/>
                    <input type="text" name="name" placeholder="Enter full name" id="name" oninput="checkForm()" /><br/>
                </div>
                <div class="field"> 
                    <label>Username</label><br/>
                    <input type="text" name="username" placeholder="Enter username" id="username" oninput="checkForm()" /><br/>
                </div> 
                <div class="field">    
                    <label>Email</label><br/>
                    <input type="email" name="email" placeholder="Enter email" id="email" oninput="checkForm()" /><br/>
                </div>
                <div class="field">     
                    <label>Password</label><br/>
                    <input type="password" name="password" placeholder="Enter password" id="password" oninput="checkForm()"/>
                    <i class="fa-regular fa-eye" style="color: #000000; display:none;" id="eyeOpen" onclick="checkPassword()"></i>
                    <i class="fa-regular fa-eye-slash" style="color: #000000;" id="eyeClosed" onclick="checkPassword()"></i>
                </div>
                <div class="field">    
                    <label>Date of Birth</label><br/>
                    <input type="date" name="dateofbirth" id="dateofbirth" oninput="checkForm()" /><br/>
                </div>
                <div class="signUpButton">    
                    <input type="submit" name="signup" value="SIGN UP" id="signUp" class="signUpDisabled" disabled /><br/>
                </div>
                <div class="bottom">
                <label>Already have an account? <a href="index.php"><b>Login</b></a>
                </div>
            </form>
        </div>
    </body>
</html>