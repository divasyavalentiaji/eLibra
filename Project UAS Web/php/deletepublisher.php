<?php
    include("config.php");

    $id_publisher = $_GET['id_publisher'];

    // hapus data dari table
    $deletePublisherQuery = "DELETE from publisher WHERE id_publisher=$id_publisher";
    $deletePublisherResult = mysqli_query($conn, $deletePublisherQuery);

    header("Location: datapublisher.php");
?>