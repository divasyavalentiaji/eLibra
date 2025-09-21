<?php
    include("config.php");

    // fungsi PHP untuk menghapus file
    $path_cover = "cover/";
    $path_book_files = "book_files/";
    $id_book = $_GET['id_book'];

    // Hapus entri terkait dari tabel menyimpan
    $deleteRelatedQuery = "DELETE FROM menyimpan WHERE id_book=$id_book";
    $deleteRelatedResult = mysqli_query($conn, $deleteRelatedQuery);
    
    // hapus data dari table
    $deleteBookQuery = "DELETE from book WHERE id_book=$id_book";
    $deleteBookResult = mysqli_query($conn, $deleteBookQuery);

    if($deleteBookResult) {
        // hapus data dari direktori
        unlink($path_cover . $_GET['cover_name']);
        unlink($path_book_files . $_GET['book_files_name']);
        header("Location: databuku.php");
    } else {
        die("Failed to Delete Data");
    }
?>