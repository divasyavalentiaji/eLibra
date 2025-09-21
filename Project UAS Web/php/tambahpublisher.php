<html>
    <head>
        <title>Add Publisher</title>
    </head>
    <body>
        <?php
            include("config.php");

            date_default_timezone_set("Asia/Jakarta");
            $tgl = date("Ymd");
            // ambil informasi dari file yang diupload
            $publisher_name = $_POST['publisher_name'];
            $address = $_POST['address'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];

            $addPublisherQuery = "INSERT INTO publisher (publisher_name, address, phone_number, email)
                                  VALUES ('$publisher_name', '$address', '$phone_number', '$email')";
            $addPublisherResult = mysqli_query($conn, $addPublisherQuery) or die(mysqli_error($conn));
            
            // Tampilkan pesan alert setelah publisher berhasil ditambahkan
            echo '<script>alert("Publisher added successfully!");</script>';

            // Arahkan pengguna ke halaman datapublisher.php
            echo '<script>window.location.href = "datapublisher.php";</script>';// redirect ke halaman datapublisher.php
        ?>
    </body>
</html>