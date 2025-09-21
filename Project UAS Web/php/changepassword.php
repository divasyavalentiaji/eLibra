<?php
    session_start();
    include("config.php");

    $user_id = $_SESSION['user_id'];
    $Password = $_POST['Password'];
    $newPassword = $_POST['newPassword'];

    // Mengambil password pengguna dari basis data
    $getUserPasswordQuery = "SELECT password FROM user WHERE id_user = '$user_id'";
    $getUserPasswordResult = mysqli_query($conn, $getUserPasswordQuery);
    $row = mysqli_fetch_assoc($getUserPasswordResult);
    $userPassword = $row['password'];

    if ($Password !== $userPassword) {
        // Jika password yang dimasukkan tidak sama dengan password pengguna
        setcookie("message4", "Incorrect current password", time() + 60);
        header("location: profile.php");
    } else {
        if (strlen($newPassword) < 8 || !preg_match("/^(?=.*[a-zA-Z])(?=.*\d).+$/", $newPassword)) {
            // Jika password baru tidak memenuhi persyaratan
            setcookie("message4", "Password must be at least 8 characters long and include both letters and numbers", time() + 60);
            header("location: profile.php");
        } else {
            // Memperbarui password pengguna
            $updatePasswordQuery = "UPDATE user SET password = '$newPassword' WHERE id_user = '$user_id'";
            $updatePasswordResult = mysqli_query($conn, $updatePasswordQuery);

            setcookie("message4", "", time() - 60);
            header("location: profile.php");
        }
    }
?>