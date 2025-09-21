<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['user_username'])) { // jika tidak ada session username
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');

    $user_id = $_SESSION['user_id'];

    if (isset($_GET['id_book'])) {
        $id_book = $_GET['id_book'];

        // Hapus buku dari My Library
        $delete_query = "DELETE FROM menyimpan WHERE id_user = $user_id AND id_book = $id_book";
        mysqli_query($conn, $delete_query);

        header("location: mylibrary.php");
    } else {
        echo "Invalid request.";
    }
?>