<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['user_username'])) { // jika tidak ada session username
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');

    if (isset($_GET['id_book'])) {
        $id_book = $_GET['id_book'];

        if (isset($_SESSION['user_id'])) {
            $id_user = $_SESSION['user_id']; // Ubah sesuai dengan nama kolom ID pengguna di tabel basis data Anda

            // Periksa apakah buku sudah ada di My Library
            $check_query = "SELECT * FROM menyimpan WHERE id_user = $id_user AND id_book = $id_book";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Buku sudah ada di My Library
                header("location: mylibrary.php");
            } else {
                // Tambahkan buku ke My Library
                $insert_query = "INSERT INTO menyimpan (id_user, id_book, date_added) VALUES ($id_user, $id_book, NOW())";
                mysqli_query($conn, $insert_query);

                header("location: mylibrary.php");
            }
        } else {
            echo "User ID not found.";
        }
    } else {
        echo "Invalid request.";
    }
?>