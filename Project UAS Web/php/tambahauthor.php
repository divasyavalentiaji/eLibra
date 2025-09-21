<html>
    <head>
        <title>Add Author</title>
    </head>
    <body>
        <?php
            include("config.php");

            date_default_timezone_set("Asia/Jakarta");
            $tgl = date("Ymd");
            // ambil informasi dari file yang diupload
            $author_name = $_POST['author_name'];
            $address = $_POST['address'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];

            $addAuthorQuery = "INSERT INTO author (author_name, phone_number, email)
                                  VALUES ('$author_name', '$phone_number', '$email')";
            $addAuthorResult = mysqli_query($conn, $addAuthorQuery) or die(mysqli_error($conn));
            
            // Tampilkan pesan alert setelah author berhasil ditambahkan
            echo '<script>alert("Author added successfully!");</script>';

            // Arahkan pengguna ke halaman dataauthor.php
            echo '<script>window.location.href = "dataauthor.php";</script>';// redirect ke halaman dataauthor.php
        ?>
    </body>
</html>