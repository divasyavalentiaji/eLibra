<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa user telah melakukan login atau belum
    if (!isset($_SESSION['admin_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }
    
    include ('config.php');

    // Fungsi untuk melakukan pencarian berdasarkan kolom pada tabel "publisher"
    function searchPublisher($keyword, $conn)
    {
        // Query untuk mencari penerbit berdasarkan kolom pencarian
        $query = "SELECT * FROM publisher WHERE 
                publisher_name LIKE '%$keyword%' OR
                address LIKE '%$keyword%'";

        // Eksekusi query dan simpan hasilnya dalam variabel $result
        $result = mysqli_query($conn, $query);

        // Mengembalikan nilai $result
        return $result;
    }

    if (isset($_POST["search"])) {
        $keyword = $_POST["keyword"];
        $result = searchPublisher($keyword, $conn);
    } else {
        // Jika tombol pencarian tidak ditekan, ambil semua data penerbit
        $result = mysqli_query($conn, "SELECT * FROM publisher");
        if (!$result) {
            die('Could not get data: ' . mysqli_error($conn));
        }
    }
?>

<html>
    <head>
        <title>Publisher Data</title>
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/styledatapublisher.css">
        <script>
            function confirmDelete(idPublisher) {
                if (confirm("Are you sure you want to delete this data?")) {
                    window.location.href = "deletepublisher.php?id_publisher=" + idPublisher;
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="header">
                    <div class="list-item">
                        <img src="../assets/logo.png" width="70%"><br>
                    </div>
                </div>
                <div class="admin">
                    <div class="list-item">
                        <img src="../assets/admin.png" width="40%"><br>
                        <span class="description-admin">Hello,</span><br>
                        <span class="description-admin-name"><?php echo $_SESSION['admin_name']; ?>!</span>
                    </div>
                </div>
                <div class="main">
                    <div class="list-item">
                        <a href="homepageadmin.php">
                        <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                        <span class="description">Dashboard</span>
                        </a>
                    </div>
                    <div class="list-item">
                        <a href="databuku.php">
                        <i class="fa-solid fa-book" style="color: #ffffff;"></i>
                        <span class="description">Book</span>
                        </a>
                    </div>
                    <div class="list-item-now">
                        <a href="datapublisher.php">
                        <i class="fa-solid fa-building" style="color: #ffffff;"></i>
                        <span class="description">Publisher</span>
                        </a>
                    </div>
                    <div class="list-item">
                        <a href="dataauthor.php">
                        <i class="fa-solid fa-feather" style="color: #ffffff;"></i>
                        <span class="description">Author</span>
                        </a>
                    </div>
                </div>
                <div class="bottom">
                <div class="list-item">
                    <a href="logout.php">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                        <span class="description">Log Out</span>
                    </a>                
                </div>
            </div>
            </div>
            <div class="main-content">
                <div class="wrapper">
                    <h1>
                        <i class="fa-solid fa-building" style="color: #black;"></i>
                        <span class="publisher-text">Publisher Data</span>
                    </h1>
                    <hr>
                    <div class="searchandadd">
                        <form action="" method="POST" class="search-form">
                            <input name="keyword" class="searchcolumn" type="search" placeholder="Search" autocomplete="off">
                            <button name="search" class="searchbutton" type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                        </form>
                        <button class="addbutton">
                            <a href="formtambahpublisher.php"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Add Data</a>
                        </button>
                    </div>
                    <table border="1">
                        <tr class="title">
                            <td>No</td>
                            <td>Publisher Name</td>
                            <td>Address</td>
                            <td>Phone Number</td>
                            <td>Email</td>
                            <td>Manage Data</td>
                        </tr>

                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['publisher_name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <div class="button-container">
                                    <button class="button update-button"><a href="formupdatepublisher.php?id_publisher=<?php echo $row['id_publisher']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>   Update</a></button>
                                    <button class="button delete-button" onclick="confirmDelete(<?php echo $row['id_publisher']; ?>)"><i class="fa-solid fa-trash" style="color: #ffffff;"></i>   Delete</button>
                                </div>
                            </td>
                        </tr>

                        <?php
                            $i++;
                        }
                        ?>
                    </table>
                    <?php
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>