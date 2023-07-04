-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 11:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `category`, `img_url`, `product_name`, `price`) VALUES
(1, 'Kerajinan Khas Daerah Tradisional', 'https://images.tokopedia.net/img/cache/700/product-1/2020/1/21/3612883/3612883_7ed9e22e-3382-40a8-96b2-cd23c49e5941_1080_1080.jpg', 'Tas Rajut Rotan Khas Kalimantan', 50000),
(2, 'Kerajinan Khas Daerah Tradisional', 'https://images.tokopedia.net/img/cache/900/product-1/2020/2/6/batch-upload/batch-upload_f28c3fc4-7913-4c30-bb91-667f03e7088d.JPG', 'Tas Rotan Khas Kalimantan Utara', 50000),
(3, 'Kerajinan Khas Daerah Tradisional', 'https://cf.shopee.co.id/file/8a798c6667310122f1fe8b1cf6bac396', 'Tas Rajut Khas Bali', 75000),
(4, 'Makanan Khas Daerah Tradisional', 'https://kara-indonesia.com/img/recipes/biji_ketapang.jpg', 'Biji Ketapang', 25000),
(5, 'Makanan Khas Daerah Tradisional', 'https://cdn.idntimes.com/content-images/community/2021/07/fromandroid-ba33188ff3b212f94501886690864a6c.jpg', 'Kue Keukarah Khas Aceh', 30000),
(6, 'Makanan Khas Daerah Tradisional', 'https://kurio-img.kurioapps.com/20/07/20/ccadef39-ecca-4a55-82ec-11d938b2dce7.jpg', 'Kue Cucur', 20000),
(7, 'Makanan Khas Daerah Tradisional', 'https://down-id.img.susercontent.com/file/id-11134207-7qula-lhn0zrlmmv6j78_tn', 'Kue Mochi Khas Sukabumi', 25000),
(8, 'Makanan Khas Daerah Tradisional', 'https://images.tokopedia.net/img/cache/500-square/VqbcmM/2022/1/11/1d1de339-7c74-49ca-9b57-2faad0e3917b.jpg', 'Kue Semprong', 25000),
(9, 'Makanan Khas Daerah Tradisional', 'https://paxelmarket.co/wp-content/uploads/2022/03/kacang-hijau-ori-1.jpg', 'Bakpia Khas Jogjakarta', 35000),
(10, 'Pakaian Tradisional', 'https://cf.shopee.co.id/file/50c6a0b337d471c283e76c855d3ec6c6', 'Kain Ulos', 85000),
(11, 'Pakaian Tradisional', 'https://cf.shopee.co.id/file/1c81d15e3c924ca725298dd696ee5113', 'Kain Batik Solo', 73000),
(12, 'Pakaian Tradisional', 'https://down-id.img.susercontent.com/file/fa7c2b4f94f0559f48f9c0d902b3e962_tn', 'Blangkon Khas Jogjakarta', 175000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'Tes', 'tes@gmail.com', '$2y$10$uL3OaAOA.hHATrc7Ry5WmeLmBpjgTpr7CXOWGhogV/vHRXnvP3wEi'),
(2, 'teslagi', 'coba@gmail.com', '$2y$10$4N./dm7mBryAHa.G/Q2YhOITk3EkA0IIxhUvPlpheEa4bMBGieCm2'),
(3, 'tukang belanja', 'shopaholic@gmail.com', '$2y$10$7H/1676TD3tle09y/Bd8uuYXEAFjsB6q5E6tIJidtVAL90ggTqz/.'),
(5, 'udin', 'udinmaubelanja@gmail.com', '$2y$10$4Pi3UGqoxNxp9tJedIrlEOf3AEBFkqO5nAx6f7cDfv/n/txF4ErvK'),
(6, 'ayala', 'ayala@gmail.com', '$2y$10$k/1cm9GSfJwW7f7L0zC5OurGk.Zt36n12BrwNU8i00apvyODH469a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
