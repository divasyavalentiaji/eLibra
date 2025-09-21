<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['admin_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');
    $id_author = $_GET['id_author'];

    $checkAuthorQuery = "SELECT * FROM author WHERE id_author = '$id_author'";
    $checkAuthorResult = mysqli_query($conn, $checkAuthorQuery);
    $row = mysqli_fetch_assoc($checkAuthorResult);
?>
<html>
    <head>
        <title>Update Author</title>
        <link rel="stylesheet" type="text/css" href="../css/styleupdateauthor.css">
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
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
                    <div class="list-item">
                        <a href="datapublisher.php">
                        <i class="fa-solid fa-building" style="color: #ffffff;"></i>
                        <span class="description">Publisher</span>
                        </a>
                    </div>
                    <div class="list-item-now">
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
                        <i class="fa-solid fa-feather" style="color: #black;"></i>
                        <span class="author-text">Update Author</span>
                    </h1>
                    <hr>
                    <form method = "POST" action = "updateauthor.php" enctype="multipart/form-data">
                        <div class="field">
                            <label>Author Name</label><br/>
                            <input type="hidden" name="id_author" value="<?php echo $id_author; ?>">
                            <input type="text" name="author_name" placeholder="Enter author name" value="<?php echo $row['author_name']; ?>">
                        </div>
                        <div class="field">
                            <label>Phone Number</label><br/>
                            <input type="text" name="phone_number" placeholder="Enter phone number" value="<?php echo $row['phone_number']; ?>">
                        </div>
                        <div class="field">
                            <label>Email</label><br/>
                            <input type="text" name="email" placeholder="Enter email" value="<?php echo $row['email']; ?>">
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