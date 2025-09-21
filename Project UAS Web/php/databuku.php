<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa user telah melakukan login atau belum
    if (!isset($_SESSION['admin_username'])) { // jika tidak ada session username
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');

    // Fungsi untuk melakukan pencarian berdasarkan kolom
    function search($keyword, $conn)
    {
        // Query untuk mencari buku berdasarkan kolom pencarian
        $query = "SELECT book.*, publisher.publisher_name, author.author_name, categories.categories FROM book 
                    INNER JOIN publisher ON book.id_publisher = publisher.id_publisher 
                    INNER JOIN author ON book.id_author = author.id_author
                    INNER JOIN categories ON book.id_categories = categories.id_categories
                    WHERE
                    title LIKE '%$keyword%' OR
                    isbn LIKE '%$keyword%' OR
                    publication_year LIKE '%$keyword%' OR
                    categories.categories LIKE '%$keyword%' OR
                    publisher.publisher_name LIKE '%$keyword%' OR
                    author.author_name LIKE '%$keyword%'";

        // Eksekusi query dan simpan hasilnya dalam variabel $result
        $result = mysqli_query($conn, $query);

        // Mengembalikan nilai $result
        return $result;
    }

    if (isset($_POST["search"])) {
        $keyword = $_POST["keyword"];
        $result = search($keyword, $conn);
    } else {
        // Jika tombol pencarian tidak ditekan, ambil semua data buku
        $result = mysqli_query($conn, "SELECT book.*, publisher.publisher_name, author.author_name, categories.categories FROM book 
                                       INNER JOIN publisher ON book.id_publisher = publisher.id_publisher 
                                       INNER JOIN author ON book.id_author = author.id_author
                                       INNER JOIN categories ON book.id_categories = categories.id_categories");
        if (!$result) {
            die('Could not get data: ' . mysqli_error($conn));
        }
    }
?>

<html>
    <head>
        <title>Book Data</title>
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/styledatabuku.css">
        <script>
            function confirmDelete(idBook, coverName, bookFilesName) {
                if (confirm("Are you sure you want to delete this data?")) {
                    window.location.href = "deletebuku.php?id_book=" + idBook + "&cover_name=" + coverName + "&book_files_name=" + bookFilesName;
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
                    <div class="list-item-now">
                        <a href="databuku.php">
                        <i class="fa-solid fa-book" style="color: #ffffff;"></i>
                        <span class="description">Book</span>
                        </a>
                    </div>
                    <div class="list-item">
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
                        <i class="fa-solid fa-book" style="color: #black;"></i>
                        <span class="book-text">Book Data</span>
                    </h1>
                    <hr>
                    <div class="searchandadd">
                        <form action="" method="POST" class="search-form">
                            <input name="keyword" class="searchcolumn" type="search" placeholder="Search" autocomplete="off">
                            <button name="search" class="searchbutton" type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
                        </form>
                        <button class="addbutton">
                            <a href="formtambahbuku.php"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Add Data</a>
                        </button>
                    </div>
                    <table border="1">
                        <tr class="title">
                            <td>No</td>
                            <td>Title</td>
                            <td>Cover</td>
                            <td>Book Files</td>
                            <td>ISBN</td>
                            <td>Publication Year</td>
                            <td>Categories</td>
                            <td>Publisher</td>
                            <td>Author</td>
                            <td>Manage Data</td>
                        </tr>

                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><img src="cover/<?php echo $row['cover']; ?>" width="100"></td>
                            <td><?php echo $row['book_files']; ?></td>
                            <td><?php echo $row['isbn']; ?></td>
                            <td><?php echo $row['publication_year']; ?></td>
                            <td><?php echo $row['categories']; ?></td>
                            <td><?php echo $row['publisher_name']; ?></td>
                            <td><?php echo $row['author_name']; ?></td>
                            <td>
                                <div class="button-container">
                                    <button class="button update-button"><a href="formupdatebuku.php?id_book=<?php echo $row['id_book']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>   Update</a></button>
                                    <button class="button delete-button" onclick="confirmDelete(<?php echo $row['id_book']; ?>, '<?php echo $row['cover']; ?>', '<?php echo $row['book_files']; ?>')"><i class="fa-solid fa-trash" style="color: #ffffff;"></i>   Delete</button>
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