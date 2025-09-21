<?php
    include("config.php");

    $id_author = $_GET['id_author'];

    // hapus data dari table
    $deleteAuthorQuery = "DELETE from author WHERE id_author=$id_author";
    $deleteAuthorResult = mysqli_query($conn, $deleteAuthorQuery);

    header("Location: dataauthor.php");
?>