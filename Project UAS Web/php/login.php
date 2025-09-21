<?php
    session_start();
    include("config.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengecek login sebagai admin
    $checkAdminQuery = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $checkAdminResult = mysqli_query($conn, $checkAdminQuery);
    $adminData = mysqli_fetch_assoc($checkAdminResult);

    // Query untuk mengecek login sebagai pengguna (user)
    $checkUserQuery = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);
    $userData = mysqli_fetch_assoc($checkUserResult);
            
    if (mysqli_num_rows($checkAdminResult) > 0) {
        $_SESSION['admin_username'] = $adminData['username']; // Set session admin
        $_SESSION['admin_name'] = $adminData['name']; // Set session nama admin
    
        // Redirect ke halaman homepageadmin.php
        header("location: homepageadmin.php");
    } elseif (mysqli_num_rows($checkUserResult) > 0) {
        $_SESSION['user_username'] = $userData['username']; // Set session user
        $_SESSION['user_name'] = $userData['name']; // Set session nama user
        $_SESSION['user_id'] = $userData['id_user']; // Set session user ID
    
        setcookie("message1","",time()-60);// delete cookie message
        // Redirect ke halaman homepageuser.php
        header("location: homepageuser.php");
    } else {
        // Buat cookie untuk menampung pesan kesalahan
        setcookie("message1", "Username or password is incorrect.", time()+60);
        header("location: index.php"); // Redirect ke halaman index.php
    }
?>