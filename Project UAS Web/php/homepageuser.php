<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['user_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }

    include ('config.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Homepage User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/stylehomepageuser.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/bba8d041dd.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--Navbar-->
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepageuser.php">
                    <img src="../assets/logo.png" alt="logo" height="50px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="homepageuser.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="category.php?category=novel">Novel</a></li>
                        <li><a class="dropdown-item" href="category.php?category=biography">Biography</a></li>
                        <li><a class="dropdown-item" href="category.php?category=comic">Comic</a></li>
                        <li><a class="dropdown-item" href="category.php?category=magazine">Magazine</a></li>
                        <li><a class="dropdown-item" href="category.php?category=textbook">Textbook</a></li>
                    </ul>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="POST" role="search" autocomplete="off">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Search books" aria-label="Search">
                    <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="mylibrary.php">My Library</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <!--Opening-->
        <div class="pembuka">
            <img src="../assets/welcome.gif">
            <div class="tulisan-gambar">
                <span class="tulisan-gambar-satu">Easy Access to All<br>Categories Of Book</span>
                <span class="tulisan-gambar-dua">Expand your library with great<br>books you love <i class="fa-solid fa-heart"></i></span>
                <button class="tombol-discover">Discover Now</button>
            </div>
        </div>

        <!--New Release-->
        <div class="container1">
            <h2 class="title bg-dark">New Release</h2>
            <div class="new-results">
                <?php
                $query = "SELECT * FROM book ORDER BY publication_year DESC LIMIT 7";
                $result = mysqli_query($conn, $query);
                $covers = mysqli_fetch_all($result, MYSQLI_ASSOC);

                if (!empty($covers)) :
                    foreach ($covers as $cover) :
                ?>
                        <div class="book-cover">
                            <img src="cover/<?php echo $cover['cover']; ?>" alt="Book Cover">
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="book_files/<?php echo $cover['book_files']; ?>" class="btn-read" target="_blank">Read Book</a>
                                    <a href="add_to_library.php?id_book=<?php echo $cover['id_book']; ?>" class="btn-add-library">Add to Library</a>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                else :
                ?>
                    <p>No results found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!--Popular-->
        <div class="container2">
            <h2 class="title bg-dark">Popular</h2>
            <div class="popular-results">
                <?php
                $query = "SELECT book.*, COUNT(menyimpan.id_library) AS popularity
                          FROM book
                          JOIN menyimpan ON book.id_book = menyimpan.id_book
                          GROUP BY book.id_book
                          ORDER BY popularity DESC
                          LIMIT 7";
                $result = mysqli_query($conn, $query);
                $covers = mysqli_fetch_all($result, MYSQLI_ASSOC);

                if (!empty($covers)) :
                    foreach ($covers as $cover) :
                ?>
                        <div class="book-cover">
                            <img src="cover/<?php echo $cover['cover']; ?>" alt="Book Cover">
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="book_files/<?php echo $cover['book_files']; ?>" class="btn-read" target="_blank">Read Book</a>
                                    <a href="add_to_library.php?id_book=<?php echo $cover['id_book']; ?>" class="btn-add-library">Add to Library</a>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                else :
                ?>
                    <p>No results found.</p>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>