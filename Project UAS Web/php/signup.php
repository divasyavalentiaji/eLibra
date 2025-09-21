<?php
    include("config.php");

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dateofbirth = $_POST['dateofbirth'];

    // query untuk mengecek apakah ada username yang sama di database
    $checkUsernameQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
        
    // query untuk mengecek apakah ada email yang sama di database
    $checkEmailQuery = "SELECT * FROM user WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if(mysqli_num_rows($checkUsernameResult) > 0) {
        setcookie("message2", "Username is already taken.", time()+60);
        header("location: formsignup.php");
    } else if(mysqli_num_rows($checkEmailResult) > 0) {
        setcookie("message2", "Email is already taken.", time()+60);
        header("location: formsignup.php");
    } else {
        if($username !== strtolower($username)) {
            setcookie("message2", "Username must be in lowercase.", time()+60);
            header("location: formsignup.php");
        } else if (strpos($username, ' ') !== false) {
            setcookie("message2", "Username cannot contain spaces.", time()+60);
            header("location: formsignup.php");
        } else if(strlen($password) < 8 || !preg_match("/^(?=.*[a-zA-Z])(?=.*\d).+$/", $password)) {
            setcookie("message2", "Password must be at least 8 characters long and include both letters and numbers.", time()+60);
            header("location: formsignup.php");
        } else {
            // query untuk menambahkan data ke dalam database
            $insertQuery = "INSERT INTO user (name, username, email, password, dateofbirth)
                            VALUES ('$name', '$username', '$email', '$password', '$dateofbirth')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
                echo '<script>alert("Account created successfully!");</script>';
                setcookie("message2","",time()-60);// delete cookie message
                echo '<script>window.location.href = "index.php";</script>';// redirect ke halaman index.php
            } 
        }
    }
?>