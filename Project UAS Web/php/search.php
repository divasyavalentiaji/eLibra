<?php
    // session dimulai
    session_start();
    // cek session untuk memeriksa apakah sudah melakukan login atau belum
    if (!isset($_SESSION['user_username'])) { // jika tidak ada session username
        
        header("location: index.php"); // redirect ke halaman index.php
    }

    include('config.php');

    if (isset($_POST['keyword'])) {
        $keyword = $_POST['keyword'];

        // Query untuk mencari buku berdasarkan keyword
        $query = "SELECT book.title, book.cover, book.book_files, book.id_book FROM book 
                  INNER JOIN categories ON book.id_categories = categories.id_categories
                  INNER JOIN author ON book.id_author = author.id_author
                  WHERE book.title LIKE '%$keyword%' OR 
                  categories.categories LIKE '%$keyword%' OR 
                  author.author_name LIKE '%$keyword%'";
        $result = mysqli_query($conn, $query);

        // Mengambil data cover dari hasil pencarian
        $covers = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $covers[] = array(
                'id_book' => $row['id_book'],
                'cover' => $row['cover'],
                'book_files' => $row['book_files']
            );
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/stylesearch.css">
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
        
        <div class="container">
            <h1>Search Results</h1>

            <?php if (!empty($covers)) : ?>
                <p class="search-info">Showing <?php echo count($covers); ?> books for <b>"<?php echo $keyword; ?>"</b></p>
            <?php endif; ?>

            <div class="search-results">
                <?php if (!empty($covers)) : ?>
                    <?php foreach ($covers as $cover) : ?>
                        <div class="book-cover">
                        <img src="cover/<?php echo $cover['cover']; ?>" alt="Book Cover">
                            <div class="overlay">
                                <div class="overlay-content">
                                    <a href="book_files/<?php echo $cover['book_files']; ?>" class="btn-read" target="_blank">Read Book</a>
                                    <a href="add_to_library.php?id_book=<?php echo $cover['id_book']; ?>" class="btn-add-library">Add to Library</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No results found.</p>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>

