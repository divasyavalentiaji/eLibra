<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['admin_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }
?>
<html>
    <head>
        <title>Add Book</title>
        <link rel="stylesheet" type="text/css" href="../css/styletambahbuku.css">
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('preview');
                    output.style.display = 'block';
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
                        <span class="book-text">Add Book</span>
                    </h1>
                    <hr>
                    <form method = "POST" action = "tambahbuku.php" enctype="multipart/form-data" autocomplete="off">
                        <div class="picture">
                            <img id="preview" src="#" style="display: none;">
                        </div>
                        <div class="field">
                            <label>Title</label><br/>
                            <input type="text" name="title" id="title" placeholder="Enter title">
                        </div>
                        <div class="field">
                            <label>Cover</label><br/>
                            <input type="file" name="cover" id="cover" onchange="previewImage(event)">
                        </div>
                        <div class="field">
                            <label>Book Files</label><br/>
                            <input type="file" name="book_files" id="book_files">
                        </div>
                        <div class="field">
                            <label>ISBN</label><br/>
                            <input type="text" name="isbn" id="isbn" placeholder="Enter ISBN">
                        </div>    
                        <div class="field">
                            <label>Publication Year</label><br/>
                            <input type="text" name="publication_year" id="publication_year" placeholder="Enter publication year">
                        </div>    
                        <div class="field">
                            <label>Categories</label><br/>
                            <select name="categories" id="categories">
                                <option disabled selected>Choose Categories</option>
                                <?php
                                include("config.php");
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id_categories'] . "'>" . $row['categories'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>    
                        <div class="field">
                            <label>Publisher</label><br/>
                            <select name="publisher" id="publisher">
                                <option disabled selected>Choose Publisher</option>
                                <?php
                                    include("config.php");
                                    $query = "SELECT * FROM publisher";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id_publisher'] . "'>" . $row['publisher_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>    
                        <div class="field">
                            <label>Author</label><br/>
                            <select name="author" id="author">
                                <option disabled selected>Choose Author</option>
                                <?php
                                $query = "SELECT * FROM author";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id_author'] . "'>" . $row['author_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="button-container">
                            <input type="reset" name="cancel" id="cancel" value="Cancel">
                            <input type="submit" name="upload" id="upload" value="Upload"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>