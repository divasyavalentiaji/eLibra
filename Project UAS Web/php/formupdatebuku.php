<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['admin_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');
    $id_book = $_GET['id_book'];

    $checkBookQuery = "SELECT * FROM book WHERE id_book = '$id_book'";
    $checkBookResult = mysqli_query($conn, $checkBookQuery);
    $row = mysqli_fetch_assoc($checkBookResult);
?>
<html>
    <head>
        <title>Update Book</title>
        <link rel="stylesheet" type="text/css" href="../css/styleupdatebuku.css">
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('output_image');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
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
                        <span class="book-text">Update Book</span>
                    </h1>
                    <hr>
                    <form method = "POST" action = "updatebuku.php" enctype="multipart/form-data">
                        <div class="picture">
                            <img id="output_image" src="cover/<?php echo $row['cover']; ?>">
                        </div>
                        <div class="field">
                            <label>Title</label><br/>
                            <input type="hidden" name="id_book" value="<?php echo $id_book; ?>">
                            <input type="text" name="title" placeholder="Enter title" value="<?php echo $row['title']; ?>">
                        </div>
                        <div class="field">
                            <label>Cover</label><br/>
                            <input type="file" name="cover" onchange="previewImage(event)">
                        </div>
                        <div class="field">
                            <label>Book Files</label><br/>
                            <input type="file" name="book_files" id="book_files">
                        </div>
                        <div class="field">
                            <label>ISBN</label><br/>
                            <input type="text" name="isbn" placeholder="Enter ISBN" value="<?php echo $row['isbn']; ?>">
                        </div>    
                        <div class="field">
                            <label>Publication Year</label><br/>
                            <input type="text" name="publication_year" placeholder="Enter publication year" value="<?php echo $row['publication_year']; ?>">
                        </div>    
                        <div class="field">
                            <label>Categories</label><br/>
                            <select name="id_categories">
                                <?php
                                $sql_categories = "SELECT * FROM categories";
                                $result_categories = mysqli_query($conn, $sql_categories);
                                while ($row_categories = mysqli_fetch_assoc($result_categories)) {
                                    if ($row_categories['id_categories'] == $row['id_categories']) {
                                        echo "<option value='" . $row_categories['id_categories'] . "' selected>" . $row_categories['categories'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row_categories['id_categories'] . "'>" . $row_categories['categories'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>    
                        <div class="field">
                            <label>Publisher</label><br/>
                            <select name="id_publisher">
                                <?php
                                $sql_publisher = "SELECT * FROM publisher";
                                $result_publisher = mysqli_query($conn, $sql_publisher);
                                while ($row_publisher = mysqli_fetch_assoc($result_publisher)) {
                                    if ($row_publisher['id_publisher'] == $row['id_publisher']) {
                                        echo "<option value='" . $row_publisher['id_publisher'] . "' selected>" . $row_publisher['publisher_name'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row_publisher['id_publisher'] . "'>" . $row_publisher['publisher_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>    
                        <div class="field">
                            <label>Author</label><br/>
                            <select name="id_author">
                                <?php
                                $sql_author = "SELECT * FROM author";
                                $result_author = mysqli_query($conn, $sql_author);
                                while ($row_author = mysqli_fetch_assoc($result_author)) {
                                    if ($row_author['id_author'] == $row['id_author']) {
                                        echo "<option value='" . $row_author['id_author'] . "' selected>" . $row_author['author_name'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row_author['id_author'] . "'>" . $row_author['author_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>                      
                        <div class="button-container">
                            <input type="submit" name="update" id="update" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>