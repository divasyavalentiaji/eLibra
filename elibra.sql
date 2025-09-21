-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 02:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elibra`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dateofbirth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `username`, `email`, `password`, `dateofbirth`) VALUES
(1, 'Admin 1', 'admin1', 'admin1@gmail.com', 'admin112345', '1987-01-02'),
(2, 'Admin 2', 'admin2', 'admin2@gmail.com', 'admin212345', '1992-12-13'),
(3, 'Admin 3', 'admin3', 'admin3@gmail.com', 'admin312345', '1996-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id_author` int(11) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `author_name`, `phone_number`, `email`) VALUES
(1, 'Tere Liye', '081315732156', 'tereliye@gmail.com'),
(2, 'Donny Dhirgantoro', '081315827463', 'donnydirghantoro@gmail.com'),
(3, 'J. K. Rowling', '081513475874', 'jkrowling@gmail.com'),
(4, 'Eka Kurniawan', '081214835768', 'ekakurniawan@gmail.com'),
(5, 'Andrea Hirata', '081215843435', 'andreahirata@gmail.com'),
(6, 'Leila Salikha Chudori', '0815124865623', 'leilaschudori@gmail.com'),
(7, 'Pidi Baiq', '081213284759', 'pidibaiq@gmail.com'),
(8, 'Rintik Sedu', '081214283254', 'rintiksedu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cover` varchar(50) NOT NULL,
  `book_files` varchar(50) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `publication_year` year(4) NOT NULL,
  `id_categories` int(11) NOT NULL,
  `id_publisher` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `title`, `cover`, `book_files`, `isbn`, `publication_year`, `id_categories`, `id_publisher`, `id_author`) VALUES
(1, 'Bumi', 'Buku Bumi.jpg', 'Buku Bumi.pdf', '9786020301129', '2014', 1, 1, 1),
(2, 'Matahari', 'Buku Matahari.jpg', 'Buku Matahari.pdf', '9786020324784', '2020', 1, 1, 1),
(3, 'Cantik itu Luka', 'Buku Cantik Itu Luka.jpg', 'Buku Cantik Itu Luka.pdf', '9786020312583', '2015', 1, 1, 4),
(4, '5cm', 'Buku 5cm.jpg', 'Buku 5cm.pdf', '9797591514 ', '2005', 1, 3, 2),
(5, 'Sang Pemimpi', 'Buku Sang Pemimpi.jpg', 'Buku Sang Pemimpi.pdf', '9793062924', '2006', 1, 2, 5),
(6, 'Pergi', 'Buku Pergi.jpg', 'Buku Pergi.pdf', '9786025734052', '2018', 1, 5, 1),
(7, 'Laut Bercerita', 'Buku Laut Bercerita.jpg', 'Buku Laut Bercerita.pdf', '9786024246945', '2017', 1, 1, 6),
(8, 'Dilan 1990', 'Buku Dilan 1990.jpg', 'Buku Dilan 1990.pdf', '9786027870864', '2014', 1, 6, 7),
(9, 'Geez and Ann #1', 'Buku Geez and Ann 1.jpg', 'Buku Geez and Ann 1.pdf', '9789799102', '2017', 1, 7, 8),
(10, 'Ayah', 'Buku Ayah.jpg', 'Buku Ayah.pdf', '9786022911029', '2015', 1, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_categories` int(11) NOT NULL,
  `categories` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_categories`, `categories`) VALUES
(1, 'Novel'),
(2, 'Biography'),
(3, 'Comic'),
(4, 'Magazine'),
(5, 'Textbook');

-- --------------------------------------------------------

--
-- Table structure for table `menyimpan`
--

CREATE TABLE `menyimpan` (
  `id_library` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menyimpan`
--

INSERT INTO `menyimpan` (`id_library`, `id_user`, `id_book`, `date_added`) VALUES
(1, 1, 3, '2023-06-11'),
(2, 1, 5, '2023-06-11'),
(3, 1, 2, '2023-06-11'),
(4, 1, 1, '2023-06-11'),
(5, 1, 7, '2023-06-11'),
(6, 1, 8, '2023-06-11'),
(7, 1, 10, '2023-06-11'),
(8, 2, 9, '2023-06-11'),
(9, 2, 3, '2023-06-11'),
(10, 2, 5, '2023-06-11'),
(11, 2, 10, '2023-06-11'),
(12, 2, 2, '2023-06-11'),
(13, 2, 7, '2023-06-11'),
(14, 2, 1, '2023-06-11'),
(15, 3, 6, '2023-06-11'),
(16, 4, 6, '2023-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id_publisher` int(11) NOT NULL,
  `publisher_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id_publisher`, `publisher_name`, `address`, `phone_number`, `email`) VALUES
(1, 'Gramedia Pustaka Utama', 'Jl. Palmerah Barat No.29-37, Jakarta, 10270', '02153650110', 'redaksi@gramediapustakautama.id'),
(2, 'Bentang Pustaka', 'Jl. Pesanggrahan No.8, Daerah Istimewa Yogyakarta, 55584', '021747370635', 'promosi@bentangpustaka.com'),
(3, 'Grasindo', 'Jl. Palmerah Barat No. 29-37, Jakarta, 10270', '02153650110', 'redaksi@grasindo.id'),
(4, 'Bloomsburry', '1385 Broadway, Fifth Floor, New York, NY 10018 USA', '02076315600', 'contact@bloomsbury.com'),
(5, 'Republika Penerbit', 'Jl. Kavling Polri Blok I No. 65, Jakarta, 12620', '021781912728', 'redaksi@bukurepublika.id'),
(6, 'Mizan', 'Jl. TB Simatupang No.2, Jakarta, 12560', '02130408570', 'publicrelation@mizan.com'),
(7, 'Gagasmedia', 'Jl. H. Montong No. 57, Jakarta, 12360', '02178883030', 'redaksi@gagasmedia.net');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dateofbirth` date NOT NULL,
  `profile_pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `username`, `email`, `password`, `dateofbirth`, `profile_pic`) VALUES
(1, 'Rani Putri', 'raniputri', 'raniputri@gmail.com', 'rani12345', '2000-05-23', ''),
(2, 'Andi Pratama', 'andipratama', 'andipratama@gmail.com', 'andi12345', '2001-08-16', ''),
(3, 'Dika Saputra', 'dikasaputra', 'dikasaputra@gmail.com', 'dika12345', '2002-05-22', ''),
(4, 'Lila Sari', 'lilasari', 'lilasari@gmail.com', 'lila12345', '2001-10-31', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_publisher` (`id_publisher`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_categories` (`id_categories`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categories`);

--
-- Indexes for table `menyimpan`
--
ALTER TABLE `menyimpan`
  ADD PRIMARY KEY (`id_library`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_book` (`id_book`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_publisher`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categories` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menyimpan`
--
ALTER TABLE `menyimpan`
  MODIFY `id_library` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_publisher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_publisher`) REFERENCES `publisher` (`id_publisher`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categories`);

--
-- Constraints for table `menyimpan`
--
ALTER TABLE `menyimpan`
  ADD CONSTRAINT `menyimpan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `menyimpan_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
