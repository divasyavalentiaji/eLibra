<?php
    include('config.php');

    $id_author = $_POST['id_author'];
    $author_name = $_POST['author_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $updateAuthorQuery = "UPDATE author SET author_name='$author_name', phone_number='$phone_number', email='$email' WHERE id_author='$id_author'";
    $updateAuthorResult = mysqli_query($conn, $updateAuthorQuery);

    if ($updateAuthorResult) {
        // Tampilkan pesan alert setelah author berhasil diubah
        echo '<script>alert("Author updated successfully!");</script>';

        // Arahkan pengguna ke halaman dataauthor.php
        echo '<script>window.location.href = "dataauthor.php";</script>';// redirect ke halaman dataauthor.php
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>