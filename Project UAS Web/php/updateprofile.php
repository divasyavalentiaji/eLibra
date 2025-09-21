<?php
    session_start();
    include("config.php");

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dateofbirth = $_POST['dateofbirth'];

    // Memeriksa apakah username sudah digunakan oleh pengguna lain
    $checkUsernameQuery = "SELECT id_user FROM user WHERE username = '$username' AND id_user != '$user_id'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($checkUsernameResult) > 0) {
        // Jika username sudah digunakan oleh pengguna lain, set cookie pesan kesalahan
        setcookie("message3", "Username is already taken by another user", time() + 60);
        header("location: profile.php");
    } else {
        $profile_pic = $_FILES['profile_pic']['name'];
        $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];

        $checkProfilePicQuery = "SELECT profile_pic FROM user WHERE id_user = '$user_id'";
        $checkProfilePicResult = mysqli_query($conn, $checkProfilePicQuery);
        $row_profile_pic = mysqli_fetch_assoc($checkProfilePicResult);

        // Jika gambar profil tidak diunggah, tetapkan nilai gambar profil dari record sebelumnya
        if (empty($profile_pic)) {
            $profile_pic = $row_profile_pic['profile_pic'];
        } else {
            // Pindahkan file gambar profil baru ke direktori "profile/"
            move_uploaded_file($profile_pic_tmp, 'profile/' . $profile_pic);
        }

        $updateProfileQuery = "UPDATE user SET name='$name', username='$username', email='$email', dateofbirth='$dateofbirth', profile_pic='$profile_pic' WHERE id_user='$user_id'";
        $updateProfileResult = mysqli_query($conn, $updateProfileQuery);

        if ($updateProfileResult) {
            setcookie("message3", "", time() - 60);
            header("Location: profile.php");
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>