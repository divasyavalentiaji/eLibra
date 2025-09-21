<?php
    include('config.php');

    $id_publisher = $_POST['id_publisher'];
    $publisher_name = $_POST['publisher_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $updatePublisherQuery = "UPDATE publisher SET publisher_name='$publisher_name', address='$address', 
                            phone_number='$phone_number', email='$email' WHERE id_publisher='$id_publisher'";
    $updatePublisherResult = mysqli_query($conn, $updatePublisherQuery);

    if ($updatePublisherResult) {
        // Tampilkan pesan alert setelah publisher berhasil diubah
        echo '<script>alert("Publisher updated successfully!");</script>';

        // Arahkan pengguna ke halaman datapublisher.php
        echo '<script>window.location.href = "datapublisher.php";</script>';// redirect ke halaman datapublisher.php
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>