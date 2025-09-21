<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['admin_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');

    // Query SQL untuk mengambil jumlah data buku
    $countBookQuery = "SELECT COUNT(*) AS total FROM book";
    $countBookResult = mysqli_query($conn, $countBookQuery);

    if ($countBookResult) {
        $row = mysqli_fetch_assoc($countBookResult);
        $totalBooks = $row['total'];
    } else {
        $totalBooks = 0;
    }

    // Query SQL untuk mengambil jumlah data publisher
    $countPublisherQuery = "SELECT COUNT(*) AS total FROM publisher";
    $countPublisherResult = mysqli_query($conn, $countPublisherQuery);

    if ($countPublisherResult) {
        $row = mysqli_fetch_assoc($countPublisherResult);
        $totalPublishers = $row['total'];
    } else {
        $totalPublishers = 0;
    }

    // Query SQL untuk mengambil jumlah data author
    $countAuthorQuery = "SELECT COUNT(*) AS total FROM author";
    $countAuthorResult = mysqli_query($conn, $countAuthorQuery);
    
    if ($countAuthorResult) {
        $row = mysqli_fetch_assoc($countAuthorResult);
        $totalAuthors = $row['total'];
    } else {
        $totalAuthors = 0;
    }
    mysqli_close($conn);
?>

<html>    
    <head>
        <title>Homepage Admin</title>
        <link rel="stylesheet" type="text/css" href="../css/stylehomepageadmin.css">
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
                    <div class="list-item-now">
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
                        <i class="fa-solid fa-house" style="color: #black;"></i>
                        <span class="dashboard-text">Dashboard</span>
                    </h1>
                    <hr>
                    <div class="box1">
                        <div class="box-body1">
                        <h2><?php echo $totalBooks; ?></h2>
                            <p class="jmlh">Count of Books</p>
                        </div>
                        <div class="box-body-icon">
                            <i class="fa-solid fa-book mr-2"></i>
                        </div>
                        <div class="box-content">
                            <a href="databuku.php" class="box-link1">More Info<i class="fas fa-arrow-circle-right"></i></i></a>
                        </div>

                    <div class="box2">
                        <div class="box-body2">
                        <h2><?php echo $totalPublishers; ?></h2>
                            <p class="jmlh">Count of Publisher</p>
                        </div>
                        <div class="box-body-icon">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div class="box-content">
                            <a href="datapublisher.php" class="box-link2">More Info<i class="fas fa-arrow-circle-right"></i></i></a>
                        </div>  
                        
                    <div class="box3">
                        <div class="box-body3">
                        <h2><?php echo $totalAuthors; ?></h2>
                            <p class="jmlh">Count of Author</p>
                        </div>
                        <div class="box-body-icon">
                            <i class="fa-solid fa-feather"></i>
                        </div>
                        <div class="box-content">
                            <a href="dataauthor.php" class="box-link3">More Info<i class="fas fa-arrow-circle-right"></i></i></a>
                        </div>    
                    </div>             
                </div>
            </div>  
        </div>       
    </body>
</html>