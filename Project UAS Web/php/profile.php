<?php
    session_start();
    if (!isset($_SESSION['user_username'])) {
        header("location: index.php");
    }

    include('config.php');

    $user_id = $_SESSION['user_id'];

    // Mengambil data profile_pic dari tabel user
    $profilePicQuery = "SELECT profile_pic FROM user WHERE id_user = $user_id";
    $profilePicResult = mysqli_query($conn, $profilePicQuery);
    $profilePicRow = mysqli_fetch_assoc($profilePicResult);
    $profilePic = $profilePicRow['profile_pic'];

    // Menentukan path gambar profil
    if (!empty($profilePic)) {
        $profilePicPath = "profile/" . $profilePic;
    } else {
        $profilePicPath = "profile/default.png";
    }

    // Mengambil data pengguna dari basis data
    $getUserQuery = "SELECT name, username, email, dateofbirth FROM user WHERE id_user = $user_id";
    $getUserResult = mysqli_query($conn, $getUserQuery);
    $userData = mysqli_fetch_assoc($getUserResult);

    // Mendapatkan nilai masing-masing kolom dari hasil query
    $name = $userData['name'];
    $username = $userData['username'];
    $email = $userData['email'];
    $dateofbirth = $userData['dateofbirth'];
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/styleprofile.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function checkForm() {
                var Password = document.getElementById("Password").value;
                var newPassword = document.getElementById("newPassword").value;
                var confirm = document.getElementById("confirm");

                if (Password == '' || newPassword == '') {
                    confirm.disabled = true;
                    confirm.classList.add("confirmDisabled");
                } else {
                    confirm.disabled = false;
                    confirm.classList.remove("confirmDisabled");
                }
            }

            function checkPassword() {
                var Password = document.getElementById("Password");
                var eyeOpen1 = document.getElementById("eyeOpen1");
                var eyeClosed1 = document.getElementById("eyeClosed1");

                if (Password.type === "password") {
                    Password.type = "text";
                    eyeOpen1.style.display = "inline";
                    eyeClosed1.style.display = "none";
                } else {
                    Password.type = "password";
                    eyeOpen1.style.display = "none";
                    eyeClosed1.style.display = "inline";
                }
            }

            function checkNewPassword() {
                var newPassword = document.getElementById("newPassword");
                var eyeOpen2 = document.getElementById("eyeOpen2");
                var eyeClosed2 = document.getElementById("eyeClosed2");

                if (newPassword.type === "password") {
                    newPassword.type = "text";
                    eyeOpen2.style.display = "inline";
                    eyeClosed2.style.display = "none";
                } else {
                    newPassword.type = "password";
                    eyeOpen2.style.display = "none";
                    eyeClosed2.style.display = "inline";
                }
            }
        </script>
    </head>
    <body>
        <!--Navbar-->
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepageuser.php">
                    <img src="../assets/logo.png" alt="logo" height="50px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="homepageuser.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="category.php?category=novel">Novel</a></li>
                        <li><a class="dropdown-item" href="category.php?category=biography">Biography</a></li>
                        <li><a class="dropdown-item" href="category.php?category=comic">Comic</a></li>
                        <li><a class="dropdown-item" href="category.php?category=magazine">Magazine</a></li>
                        <li><a class="dropdown-item" href="category.php?category=textbook">Textbook</a></li>
                    </ul>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="POST" role="search" autocomplete="off">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Search books" aria-label="Search">
                    <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="mylibrary.php">My Library</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <!--Profile Picture-->
        <div class="profile-pic bg-dark">
            <img src="<?php echo $profilePicPath; ?>" alt="Profile Picture">
        </div>

        <div class="profile-user bg-dark">
            <!-- Profile User -->
            <div class="data-user">
                <form method="POST" action="updateprofile.php" enctype="multipart/form-data">
                <h3 class="ha3">Profile</h3>
                <div class="warning" style="color: red;">
                    <?php
                    if (isset($_COOKIE['message3'])) {
                    echo $_COOKIE['message3'];
                    }
                    ?>
                </div>
                <table>
                    <tr>
                    <td>Profile Picture</td>
                    <td><input type="file" name="profile_pic"></td>
                    </tr>
                    <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="name" placeholder="Enter full name" id="name" autocomplete="off" value="<?php echo $name; ?>" /></td>
                    </tr>
                    <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter username" id="username" autocomplete="off" value="<?php echo $username; ?>" /></td>
                    </tr>
                    <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" placeholder="Enter email" id="email" autocomplete="off" value="<?php echo $email; ?>" /></td>
                    </tr>
                    <tr>
                    <td>Date of Birth</td>
                    <td><input type="date" name="dateofbirth" id="dateofbirth" value="<?php echo $dateofbirth; ?>" /></td>
                    </tr>
                </table>
                <div class="button-container">
                    <input type="submit" name="save" id="save" value="Save">
                </div>
                </form>
            </div>

            <!-- Change Password -->
            <div class="change-password">
                <form method="POST" action="changepassword.php">
                <h3>Change Password</h3>
                <div class="warning" style="color: red;">
                    <?php
                    if (isset($_COOKIE['message4'])) {
                    echo $_COOKIE['message4'];
                    }
                    ?>
                </div>
                <div class="field">
                    <label>Password</label><br />
                    <input type="password" name="Password" placeholder="Enter password" id="Password" oninput="checkForm()" />
                    <i class="fa-regular fa-eye" style="color: #000000; display:none;" id="eyeOpen1" onclick="checkPassword()"></i>
                    <i class="fa-regular fa-eye-slash" style="color: #000000;" id="eyeClosed1" onclick="checkPassword()"></i>
                </div>
                <div class="field">
                    <label>New Password</label><br />
                    <input type="password" name="newPassword" placeholder="Enter new password" id="newPassword" oninput="checkForm()" />
                    <i class="fa-regular fa-eye" style="color: #000000; display:none;" id="eyeOpen2" onclick="checkNewPassword()"></i>
                    <i class="fa-regular fa-eye-slash" style="color: #000000;" id="eyeClosed2" onclick="checkNewPassword()"></i>
                </div>
                <div class="field">
                    <div class="confirmButton">
                    <input type="submit" name="confirm" value="Confirm" id="confirm" class="confirmDisabled" disabled />
                    </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>