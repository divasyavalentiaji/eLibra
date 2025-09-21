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
        <title>Add Publisher</title>
        <link rel="stylesheet" type="text/css" href="../css/styletambahpublisher.css">
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
                        <span class="publisher-text">Add Publisher</span>
                    </h1>
                    <hr>
                    <form method = "POST" action = "tambahpublisher.php" enctype="multipart/form-data" autocomplete="off">
                        <div class="field">
                            <label>Publisher Name</label><br/>
                            <input type="text" name="publisher_name" id="publisher_name" placeholder="Enter publisher name">
                        </div>
                        <div class="field">
                            <label>Address</label><br/>
                            <input type="text" name="address" id="address" placeholder="Enter address">
                        </div>
                        <div class="field">
                            <label>Phone Number</label><br/>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Enter phone number">
                        </div>
                        <div class="field">
                            <label>Email</label><br/>
                            <input type="text" name="email" id="email" placeholder="Enter email">
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