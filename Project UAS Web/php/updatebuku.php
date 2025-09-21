<?php
    include('config.php');

    $id_book = $_POST['id_book'];
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $publication_year = $_POST['publication_year'];
    $id_categories = $_POST['id_categories'];
    $id_publisher = $_POST['id_publisher'];
    $id_author = $_POST['id_author'];

    $cover = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    $book_files = $_FILES['book_files']['name'];
    $book_files_tmp = $_FILES['book_files']['tmp_name'];

    $checkCoverQuery = "SELECT cover FROM book WHERE id_book = '$id_book'";
    $checkCoverResult = mysqli_query($conn, $checkCoverQuery);
    $row_cover = mysqli_fetch_assoc($checkCoverResult);

    // Jika cover tidak diunggah, tetapkan nilai cover dari record sebelumnya
    if (empty($cover)) {
        $cover = $row_cover['cover'];
    } else {
        // Pemeriksaan untuk menghapus file cover lama
        $old_cover = $row_cover['cover'];

        if ($cover != $old_cover) {
            if (file_exists('cover/' . $old_cover)) {
                unlink('cover/' . $old_cover);
            }
        }

        // Pindahkan file gambar baru ke direktori "cover/"
        move_uploaded_file($cover_tmp, 'cover/' . $cover);
    }

    $checkBookFilesQuery = "SELECT book_files FROM book WHERE id_book = '$id_book'";
    $checkBookFilesResult = mysqli_query($conn, $checkBookFilesQuery);
    $row_book_files = mysqli_fetch_assoc($checkBookFilesResult);

    // Jika file buku tidak diunggah, tetapkan nilai file buku dari record sebelumnya
    if (empty($book_files)) {
        $book_files = $row_book_files['book_files'];
    }
    else {
        // Pemeriksaan untuk menghapus file buku lama
        $old_book_files = $row_book_files['book_files'];
 
        if ($book_files != $old_book_files) {
            if (file_exists('book_files/' . $old_book_files)) {
                unlink('book_files/' . $old_book_files);
            }
        }
 
        // Pindahkan file buku baru ke direktori "book_files/"
        move_uploaded_file($book_files_tmp, 'book_files/' . $book_files);
    }

    $updateBookQuery = "UPDATE book SET title='$title', cover='$cover', book_files='$book_files', isbn='$isbn', 
                        publication_year='$publication_year', id_categories='$id_categories', id_publisher='$id_publisher', 
                        id_author='$id_author' WHERE id_book='$id_book'";
    $updateBookResult = mysqli_query($conn, $updateBookQuery);

    if ($updateBookResult) {
        // Tampilkan pesan alert setelah buku berhasil diubah
        echo '<script>alert("Book updated successfully!");</script>';

        // Arahkan pengguna ke halaman databuku.php
        echo '<script>window.location.href = "databuku.php";</script>';// redirect ke halaman databuku.php
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>