<html>
    <head>
        <title>Add Book</title>
    </head>
    <body>
        <?php
            include("config.php");

            date_default_timezone_set("Asia/Jakarta");
            $tgl = date("Ymd");
            // ambil informasi dari file yang diupload
            $tmp_cover = $_FILES['cover']['tmp_name'];
            $nm_cover = $_FILES['cover']['name'];
            $ukuran_cover = $_FILES['cover']['size'];
            $tmp_book_files= $_FILES['book_files']['tmp_name'];
            $nm_book_files = $_FILES['book_files']['name'];
            $ukuran_book_files = $_FILES['book_files']['size'];
            $title = $_POST['title'];
            $isbn = $_POST['isbn'];
            $publication_year = $_POST['publication_year'];
            $categories = $_POST['categories'];
            $publisher = $_POST['publisher'];
            $author = $_POST['author'];

            $dir_cover = "cover/$nm_cover";
            move_uploaded_file($tmp_cover, $dir_cover);
                        
            $dir_book_files = "book_files/$nm_book_files";
            move_uploaded_file($tmp_book_files, $dir_book_files);

            //menambahkan sebuah data DML
            $addBookQuery = "INSERT INTO book (title, cover, book_files, isbn, publication_year, id_categories, id_publisher, id_author)
                             VALUES ('$title', '$nm_cover', '$nm_book_files', '$isbn', '$publication_year', '$categories', '$publisher', '$author')";
            $addBookResult = mysqli_query($conn, $addBookQuery) or die(mysqli_error($conn));

            // Tampilkan pesan alert setelah buku berhasil ditambahkan
            echo '<script>alert("Book added successfully!");</script>';

            // Arahkan pengguna ke halaman databuku.php
            echo '<script>window.location.href = "databuku.php";</script>';// redirect ke halaman databuku.php
        ?>
    </body>
</html>