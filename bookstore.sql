-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2026 at 01:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore_prepare`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_tokens`
--

CREATE TABLE `api_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Abdelaziz', 'An Egyptian author with a strong interest in history and cultural studies.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(2, 'Mohamed Hassan', 'Author interested in psychology, personal development, and human behavior.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(3, 'Mahmoud Ezzat', 'A novelist who enjoys creating stories inspired by everyday life.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(4, 'Omar Fathy', 'An Egyptian author with a strong interest in history and cultural studies.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(5, 'Youssef Said', 'A literature enthusiast who has written several short stories.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(6, 'Mostafa Mansour', 'Writer interested in technology, innovation, and the future.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(7, 'Amr Abdelaziz', NULL, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(8, 'Khaled Hassan', 'Writer interested in technology, innovation, and the future.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(9, 'Hassan Mahmoud', 'A literature enthusiast who has written several short stories.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(10, 'Ibrahim Hassan', 'An independent author exploring modern society through fiction.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(11, 'Karim Hassan', 'A passionate writer interested in storytelling and contemporary literature.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(12, 'Tarek Nabil', 'Author interested in psychology, personal development, and human behavior.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(13, 'Mariam Hassan', 'A literature enthusiast who has written several short stories.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(14, 'Nour Said', 'A passionate writer interested in storytelling and contemporary literature.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(15, 'Aya Ragab', 'A passionate writer interested in storytelling and contemporary literature.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(16, 'Salma Farouk', NULL, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(17, 'Hana Mahmoud', 'An independent author exploring modern society through fiction.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(18, 'Farah Abdelaziz', 'A passionate storyteller who enjoys exploring different cultures.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(19, 'Menna Mostafa', NULL, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(20, 'Nada Hassan', 'A novelist who enjoys creating stories inspired by everyday life.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(21, 'Laila Farouk', 'An Egyptian author with a strong interest in history and cultural studies.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(22, 'Habiba Mahmoud', 'A novelist who enjoys creating stories inspired by everyday life.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(23, 'Yasmin Mostafa', 'A literature enthusiast who has written several short stories.', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(24, 'Dina Youssef', NULL, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(25, 'Sara Hassan', 'Author interested in psychology, personal development, and human behavior.', '2026-08-24 06:50:25', '2026-08-24 06:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author_id`, `title`, `image`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 6, 'The Silent Road', NULL, 'A captivating story about a young man who leaves his hometown searching for a new beginning and discovers unexpected truths along the way.', 180.00, 0, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(2, 7, 'Beyond the Horizon', 'book-4.png', 'An inspiring journey about ambition, failure, and the courage to start again when everything seems lost.', 220.50, 20, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(3, 1, 'Echoes of the Past', 'book-5.png', 'A historical novel that explores forgotten memories and the secrets hidden within an old Egyptian family.', 195.00, 12, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(4, 18, 'The Last Letter', 'book-5.png', 'A mysterious letter changes the life of its recipient and takes her on a journey through memories, relationships, and difficult choices.', 150.00, 12, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(5, 6, 'Between Two Worlds', 'book-1.png', 'A thought-provoking story about identity, belonging, and the challenges of living between two different cultures.', 275.00, 25, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(6, 12, 'A Different Beginning', 'book-2.png', 'A motivational story about overcoming failure and building a better life through persistence and self-belief.', 165.75, 0, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(7, 15, 'The Hidden Garden', 'book-4.png', 'A young girl discovers a forgotten garden that leads her to uncover a family secret that has remained hidden for decades.', 135.00, 15, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(8, 10, 'Letters Never Sent', 'book-2.png', 'A collection of emotional stories exploring love, friendship, regret, and the words people never find the courage to say.', 190.00, 3, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(9, 22, 'The Art of Thinking', 'book-4.png', 'A practical introduction to critical thinking, decision making, and understanding the way we process information.', 240.00, 0, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(10, 15, 'Inside the Human Mind', 'book-2.png', 'An accessible exploration of human behavior, emotions, habits, and the psychological factors behind everyday decisions.', 310.00, 15, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(11, 13, 'Modern Web Development', 'book-3.png', 'A practical guide to modern web development concepts, covering the fundamental technologies used to build websites and applications.', 450.00, 3, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(12, 7, 'JavaScript From Zero', 'book-1.png', 'A beginner-friendly book that introduces JavaScript programming through practical examples and real-world exercises.', 380.00, 0, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(13, 8, 'Understanding Databases', 'book-2.png', 'Learn the fundamentals of relational databases, SQL queries, relationships, indexing, and database design.', 420.00, 8, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(14, 21, 'Clean Code Principles', 'book-5.png', 'Practical techniques for writing readable, maintainable, and scalable code in modern software projects.', 500.00, 0, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(15, 11, 'The Developer\'s Journey', 'book-5.png', 'A practical and motivational guide for developers who want to improve their technical skills and grow their careers.', 350.00, 30, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(16, 12, 'Introduction to Artificial Intelligence', 'book-5.png', 'An introduction to artificial intelligence, machine learning, data, and the technologies shaping the future.', 475.00, 25, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(17, 19, 'The Egyptian Story', 'book-2.png', 'A collection of stories inspired by Egyptian society, traditions, relationships, and everyday life.', 210.00, 30, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(18, 16, 'Memories of Cairo', 'book-2.png', 'A nostalgic journey through the streets of Cairo and the memories of people who grew up among its old neighborhoods.', 185.00, 15, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(19, 24, 'The Forgotten City', 'book-4.png', 'An adventurous story about a mysterious city hidden beneath the desert and the people who are determined to uncover its secrets.', 260.00, 30, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(20, 6, 'Shadows in the Night', 'book-5.png', 'A suspenseful mystery where a detective follows a series of strange clues connected to an unsolved case.', 230.00, 0, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(21, 11, 'The Power of Habits', 'book-3.png', 'A practical exploration of how small daily habits can influence productivity, personal growth, and long-term success.', 290.00, 12, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(22, 15, 'Building Better Products', 'book-1.png', 'A practical guide to understanding users, solving problems, and creating digital products that people actually need.', 390.00, 5, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(23, 15, 'Stories After Midnight', 'book-1.png', 'A collection of short stories filled with mystery, emotion, unexpected endings, and unforgettable characters.', 175.00, 30, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(24, 7, 'The Road to Success', NULL, 'An inspiring book about discipline, persistence, learning from failure, and achieving meaningful goals.', 200.00, 15, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(25, 3, 'Beyond the Code', 'book-3.png', 'A developer-focused book about problem solving, communication, teamwork, and the skills required beyond writing code.', 365.00, 12, '2026-08-24 06:50:25', '2026-08-24 06:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','ordered','canceled','done') DEFAULT 'pending',
  `cancel_reason` text DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `status`, `cancel_reason`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 20, 'done', NULL, 720.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(2, 52, 'done', NULL, 1800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(3, 24, 'canceled', 'The requested books are currently unavailable.', 1060.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(4, 33, 'done', NULL, 2880.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(5, 25, 'done', NULL, 2800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(6, 24, 'done', NULL, 3675.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(7, 23, 'ordered', NULL, 780.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(8, 52, 'ordered', NULL, 990.50, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(9, 29, 'canceled', 'Order could not be processed.', 846.50, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(10, 24, 'done', NULL, 2258.25, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(11, 25, 'done', NULL, 1080.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(12, 2, 'ordered', NULL, 1460.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(13, 50, 'canceled', 'The requested books are currently unavailable.', 1160.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(14, 49, 'done', NULL, 2200.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(15, 34, 'pending', NULL, 2590.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(16, 23, 'done', NULL, 2573.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(17, 20, 'done', NULL, 1065.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(18, 52, 'canceled', 'Order could not be processed.', 1235.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(19, 39, 'ordered', NULL, 260.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(20, 39, 'done', NULL, 1170.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(21, 25, 'ordered', NULL, 1710.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(22, 33, 'ordered', NULL, 2355.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(23, 2, 'canceled', 'The requested books are currently unavailable.', 2550.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(24, 21, 'pending', NULL, 2830.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(25, 40, 'done', NULL, 185.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(26, 47, 'ordered', NULL, 2495.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(27, 45, 'ordered', NULL, 1040.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(28, 29, 'pending', NULL, 2470.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(29, 22, 'done', NULL, 1610.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(30, 49, 'ordered', NULL, 1300.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(31, 29, 'done', NULL, 795.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(32, 44, 'done', NULL, 3220.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(33, 47, 'done', NULL, 1650.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(34, 46, 'done', NULL, 2532.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(35, 2, 'done', NULL, 1390.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(36, 40, 'ordered', NULL, 740.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(37, 22, 'pending', NULL, 1796.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(38, 33, 'pending', NULL, 1350.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(39, 28, 'ordered', NULL, 2245.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(40, 31, 'ordered', NULL, 620.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(41, 35, 'done', NULL, 1525.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(42, 39, 'ordered', NULL, 3735.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(43, 51, 'ordered', NULL, 930.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(44, 20, 'ordered', NULL, 1350.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(45, 50, 'ordered', NULL, 1565.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(46, 24, 'done', NULL, 695.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(47, 19, 'canceled', 'Order was canceled by the administrator.', 190.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(48, 40, 'ordered', NULL, 3215.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(49, 18, 'done', NULL, 2182.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(50, 51, 'done', NULL, 585.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `book_id`, `quantity`, `unit_price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 3, 240.00, 720.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(2, 2, 22, 4, 390.00, 1560.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(3, 2, 9, 1, 240.00, 240.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(4, 3, 3, 3, 195.00, 585.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(5, 3, 16, 1, 475.00, 475.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(6, 4, 9, 4, 240.00, 960.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(7, 4, 7, 4, 135.00, 540.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(8, 4, 13, 2, 420.00, 840.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(9, 4, 1, 3, 180.00, 540.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(10, 5, 25, 4, 365.00, 1460.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(11, 5, 7, 4, 135.00, 540.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(12, 5, 24, 4, 200.00, 800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(13, 6, 24, 4, 200.00, 800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(14, 6, 10, 4, 310.00, 1240.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(15, 6, 25, 3, 365.00, 1095.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(16, 6, 1, 3, 180.00, 540.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(17, 7, 19, 3, 260.00, 780.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(18, 8, 21, 1, 290.00, 290.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(19, 8, 9, 2, 240.00, 480.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(20, 8, 2, 1, 220.50, 220.50, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(21, 9, 2, 3, 220.50, 661.50, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(22, 9, 18, 1, 185.00, 185.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(23, 10, 1, 1, 180.00, 180.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(24, 10, 6, 3, 165.75, 497.25, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(25, 10, 2, 2, 220.50, 441.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(26, 10, 12, 3, 380.00, 1140.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(27, 11, 3, 1, 195.00, 195.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(28, 11, 9, 2, 240.00, 480.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(29, 11, 7, 3, 135.00, 405.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(30, 12, 8, 4, 190.00, 760.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(31, 12, 9, 1, 240.00, 240.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(32, 12, 20, 2, 230.00, 460.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(33, 13, 19, 3, 260.00, 780.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(34, 13, 8, 2, 190.00, 380.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(35, 14, 13, 4, 420.00, 1680.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(36, 14, 19, 2, 260.00, 520.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(37, 15, 23, 1, 175.00, 175.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(38, 15, 16, 2, 475.00, 950.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(39, 15, 5, 4, 275.00, 1100.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(40, 15, 25, 1, 365.00, 365.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(41, 16, 17, 4, 210.00, 840.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(42, 16, 22, 2, 390.00, 780.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(43, 16, 21, 1, 290.00, 290.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(44, 16, 6, 4, 165.75, 663.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(45, 17, 3, 3, 195.00, 585.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(46, 17, 9, 2, 240.00, 480.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(47, 18, 24, 3, 200.00, 600.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(48, 18, 1, 2, 180.00, 360.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(49, 18, 5, 1, 275.00, 275.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(50, 19, 19, 1, 260.00, 260.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(51, 20, 9, 1, 240.00, 240.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(52, 20, 10, 3, 310.00, 930.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(53, 21, 19, 2, 260.00, 520.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(54, 21, 11, 1, 450.00, 450.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(55, 21, 18, 4, 185.00, 740.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(56, 22, 3, 2, 195.00, 390.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(57, 22, 12, 3, 380.00, 1140.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(58, 22, 5, 3, 275.00, 825.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(59, 23, 12, 2, 380.00, 760.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(60, 23, 21, 3, 290.00, 870.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(61, 23, 20, 4, 230.00, 920.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(62, 24, 3, 2, 195.00, 390.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(63, 24, 19, 4, 260.00, 1040.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(64, 24, 14, 1, 500.00, 500.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(65, 24, 11, 2, 450.00, 900.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(66, 25, 18, 1, 185.00, 185.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(67, 26, 20, 4, 230.00, 920.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(68, 26, 7, 1, 135.00, 135.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(69, 26, 24, 1, 200.00, 200.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(70, 26, 10, 4, 310.00, 1240.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(71, 27, 19, 4, 260.00, 1040.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(72, 28, 22, 1, 390.00, 390.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(73, 28, 12, 2, 380.00, 760.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(74, 28, 21, 3, 290.00, 870.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(75, 28, 11, 1, 450.00, 450.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(76, 29, 14, 1, 500.00, 500.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(77, 29, 8, 4, 190.00, 760.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(78, 29, 15, 1, 350.00, 350.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(79, 30, 16, 1, 475.00, 475.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(80, 30, 5, 3, 275.00, 825.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(81, 31, 23, 3, 175.00, 525.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(82, 31, 7, 2, 135.00, 270.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(83, 32, 16, 3, 475.00, 1425.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(84, 32, 15, 2, 350.00, 700.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(85, 32, 25, 3, 365.00, 1095.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(86, 33, 11, 3, 450.00, 1350.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(87, 33, 4, 2, 150.00, 300.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(88, 34, 18, 4, 185.00, 740.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(89, 34, 2, 4, 220.50, 882.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(90, 34, 4, 1, 150.00, 150.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(91, 34, 12, 2, 380.00, 760.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(92, 35, 14, 1, 500.00, 500.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(93, 35, 15, 2, 350.00, 700.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(94, 35, 8, 1, 190.00, 190.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(95, 36, 18, 4, 185.00, 740.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(96, 37, 18, 3, 185.00, 555.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(97, 37, 2, 2, 220.50, 441.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(98, 37, 24, 4, 200.00, 800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(99, 38, 11, 3, 450.00, 1350.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(100, 39, 7, 3, 135.00, 405.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(101, 39, 17, 4, 210.00, 840.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(102, 39, 14, 2, 500.00, 1000.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(103, 40, 10, 2, 310.00, 620.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(104, 41, 17, 3, 210.00, 630.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(105, 41, 18, 2, 185.00, 370.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(106, 41, 23, 3, 175.00, 525.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(107, 42, 25, 4, 365.00, 1460.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(108, 42, 16, 1, 475.00, 475.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(109, 42, 11, 4, 450.00, 1800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(110, 43, 10, 3, 310.00, 930.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(111, 44, 9, 3, 240.00, 720.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(112, 44, 17, 3, 210.00, 630.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(113, 45, 18, 1, 185.00, 185.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(114, 45, 21, 2, 290.00, 580.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(115, 45, 24, 4, 200.00, 800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(116, 46, 13, 1, 420.00, 420.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(117, 46, 5, 1, 275.00, 275.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(118, 47, 8, 1, 190.00, 190.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(119, 48, 15, 1, 350.00, 350.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(120, 48, 22, 4, 390.00, 1560.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(121, 48, 23, 3, 175.00, 525.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(122, 48, 19, 3, 260.00, 780.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(123, 49, 8, 1, 190.00, 190.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(124, 49, 10, 1, 310.00, 310.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(125, 49, 24, 4, 200.00, 800.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(126, 49, 2, 4, 220.50, 882.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(127, 50, 3, 3, 195.00, 585.00, '2026-08-24 06:50:25', '2026-08-24 06:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `is_banned` tinyint(1) DEFAULT 0,
  `gender` enum('male','female') NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `is_banned`, `gender`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Atya', 'matya032@gmail.com', '$2y$10$AullFGB2D3M/NmNwSjVKUuKDqmXrU6e6/81vRNctaPQhO947ii6ai', '01094891010', 0, 'male', 'admin', '2026-08-24 06:50:17', '2026-08-24 06:50:17'),
(2, 'Ahmed Customer', 'ac@gmail.com', '$2y$10$lHxEE78U7L4zBqlxifQyzepwXfs.spE93MnAes0h30wKevEJo78Hm', '01094891011', 0, 'male', 'customer', '2026-08-24 06:50:17', '2026-08-24 06:50:17'),
(3, 'Esraa Said', 'esraa.said1@gmail.com', '$2y$10$gU9kxmPpp/3wQySxf778lOfF9Os8jIPOODw/1xRw0lWQnFRxfak1a', '01598431501', 0, 'female', 'admin', '2026-08-24 06:50:17', '2026-08-24 06:50:17'),
(4, 'Nourhan Ragab', 'nourhan.ragab2@gmail.com', '$2y$10$nkP6uP1C0gi28./7XEYEtOoGbXcZ6Z6kfc8yJ7/V6rS7gVvA2MLZq', '01055679840', 0, 'female', 'admin', '2026-08-24 06:50:17', '2026-08-24 06:50:17'),
(5, 'Nada Mahmoud', 'nada.mahmoud3@gmail.com', '$2y$10$EkjhdlamodBFDb6r6a0Hj.rjQAFkPV2ZHRQ0eEFGtQF7kwU1zhERO', '01020944402', 0, 'female', 'admin', '2026-08-24 06:50:17', '2026-08-24 06:50:17'),
(6, 'Mohamed Mansour', 'mohamed.mansour4@gmail.com', '$2y$10$d.fEws/fL4.tKoVy7kUql.PXPbZEG29pww4Gly3jUkZAwRmaxOHrq', '01235829676', 0, 'male', 'admin', '2026-08-24 06:50:17', '2026-08-24 06:50:17'),
(7, 'Mariam Ibrahim', 'mariam.ibrahim5@gmail.com', '$2y$10$ehvuunmC9Kgr0fx2qKc4Ge6zvrNQWwJ6ZRwappKGU3oPteBtTlVFG', '01174709998', 0, 'female', 'admin', '2026-08-24 06:50:18', '2026-08-24 06:50:18'),
(8, 'Ahmed Ezzat', 'ahmed.ezzat6@gmail.com', '$2y$10$0JEqInn4IS/UtcfF/u032ew8YgdV70L9v1OeegXD7K4GlJbOiXGci', '01167696826', 0, 'male', 'admin', '2026-08-24 06:50:18', '2026-08-24 06:50:18'),
(9, 'Malak Mostafa', 'malak.mostafa7@gmail.com', '$2y$10$9tdDyliejmaH0ej8lAP0Ke87uKBzy1BojRXV6J7hPMjZa.dX37Izu', '01158270282', 0, 'female', 'admin', '2026-08-24 06:50:18', '2026-08-24 06:50:18'),
(10, 'Omar Mostafa', 'omar.mostafa8@gmail.com', '$2y$10$EWWa4.GlPSpbdDsF0J5Wle92RNkpiqzhfNL3TYqRbYEoU1j1Jh0U2', '01028864007', 0, 'male', 'admin', '2026-08-24 06:50:18', '2026-08-24 06:50:18'),
(11, 'Farah Mahmoud', 'farah.mahmoud9@gmail.com', '$2y$10$VIeSVgN6041Xtad.tgthAe1OLvWRXFQXjTTU5o6NRKMnI.mX/9Mxm', '01141702568', 1, 'female', 'admin', '2026-08-24 06:50:18', '2026-08-24 06:50:18'),
(12, 'Nour Ibrahim', 'nour.ibrahim10@gmail.com', '$2y$10$KwV0fW/8T9.BatZSORJUCuukJYpEINGn9Q4hjm.i3G0NeR9ZNpiYm', '01568563497', 0, 'female', 'admin', '2026-08-24 06:50:18', '2026-08-24 06:50:18'),
(13, 'Salma Farouk', 'salma.farouk11@gmail.com', '$2y$10$XaIWQY18sqJwJ0FfHg4qHO9JyyHdyfmOImpV2rDnpKMZFVEaSsao2', '01075290455', 0, 'female', 'admin', '2026-08-24 06:50:19', '2026-08-24 06:50:19'),
(14, 'Seif Mansour', 'seif.mansour12@gmail.com', '$2y$10$Zqg45nTq/yilKBoK1MUXAuXcPX8NR9VCWJUECYz6.vvokeL/fbH.i', '01162313928', 0, 'male', 'admin', '2026-08-24 06:50:19', '2026-08-24 06:50:19'),
(15, 'Mohamed Mohamed', 'mohamed.mohamed13@gmail.com', '$2y$10$Upt7OkQRRirjSWFA/zuZRuJKghViCH5HupMDGAPzECKhy5KxEUU3K', '01161372144', 0, 'male', 'admin', '2026-08-24 06:50:19', '2026-08-24 06:50:19'),
(16, 'Hana Ahmed', 'hana.ahmed14@gmail.com', '$2y$10$DIMRZXUNiPSUuT2PlAKlAeO46hGRFcDzwUw.qXwY7hHfl4SJrBq36', '01120326032', 0, 'female', 'admin', '2026-08-24 06:50:19', '2026-08-24 06:50:19'),
(17, 'Hager Abdelaziz', 'hager.abdelaziz15@gmail.com', '$2y$10$UWJlUT1Z2vS541B/LLnAKetBvTPagbW6EeKJIfm8uBAkOK6OF54Si', '01580270970', 1, 'female', 'admin', '2026-08-24 06:50:19', '2026-08-24 06:50:19'),
(18, 'Habiba Fathy', 'habiba.fathy16@gmail.com', '$2y$10$bWHPChwqUUTDseFAL38a6uDwotgB6P4/WqiwxCioogyAwJ5Lth3C6', '01139446519', 0, 'female', 'customer', '2026-08-24 06:50:19', '2026-08-24 06:50:19'),
(19, 'Ibrahim Ali', 'ibrahim.ali17@gmail.com', '$2y$10$uoIlXIp2DkGPazMS/B8ZweFlhFgXGEbeC2pbYeKw7Jp/VfQO3Ajhy', '01579217890', 0, 'male', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(20, 'Ibrahim Mansour', 'ibrahim.mansour18@gmail.com', '$2y$10$P/yxxUjsNC9ycBEFQYFXiuFO5bS4LlTyKesfqMfA2wOkLDrIiTLi.', '01216374575', 0, 'male', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(21, 'Nada Nabil', 'nada.nabil19@gmail.com', '$2y$10$ujuwHnFRkpGozOqFGX4yS.oT0qMVBVPb/JSyqrmIgW.5BD1Po4nMS', '01173027806', 0, 'female', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(22, 'Abdelrahman Ibrahim', 'abdelrahman.ibrahim20@gmail.com', '$2y$10$Y//yT6lQ98kJDqdWbaQ6qe09Xh0ZFOiAUXgnCk6FhGtWnfebGQ1OS', '01280952465', 0, 'male', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(23, 'Hana Ezzat', 'hana.ezzat21@gmail.com', '$2y$10$zvC8XcD/1dMg00JLtNw/buEvSx0Jf7nfFcfIftWunbcMASN/KrVRS', '01228603364', 0, 'female', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(24, 'Hassan Abdelaziz', 'hassan.abdelaziz22@gmail.com', '$2y$10$6GExb9kuhvLxlvBPYT3p/uEaEvYHylLKXC4U/H.45ahHY75.0tbuq', '01229537369', 0, 'male', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(25, 'Malak Said', 'malak.said23@gmail.com', '$2y$10$MLR8p39./.U3MUn0BtYZju3t6UR4TV3nr252EvlXIciI6Ku3xqDdW', '01187869453', 0, 'female', 'customer', '2026-08-24 06:50:20', '2026-08-24 06:50:20'),
(26, 'Mai Youssef', 'mai.youssef24@gmail.com', '$2y$10$8wz3ksw3OTPCO6/.9e7w/OzT/MTQyvtALmdlvfOU/PDQ0estV4NZG', '01158491005', 0, 'female', 'customer', '2026-08-24 06:50:21', '2026-08-24 06:50:21'),
(27, 'Tarek Ragab', 'tarek.ragab25@gmail.com', '$2y$10$BtDztlNRnq9M.n4Pyuq1.OIK1xrD0oRBPHpyDxx9xUvEX81XXXgSa', '01237443580', 0, 'male', 'customer', '2026-08-24 06:50:21', '2026-08-24 06:50:21'),
(28, 'Seif Salem', 'seif.salem26@gmail.com', '$2y$10$lbb3elT2tM7f7D.YRIJyB.Cxp0jxrhQYvnvIXlTpaXB.KPtcvKKSK', '01564500905', 0, 'male', 'customer', '2026-08-24 06:50:21', '2026-08-24 06:50:21'),
(29, 'Ibrahim Hassan', 'ibrahim.hassan27@gmail.com', '$2y$10$UymAOYW4TxSxBaEqU70d4ugvSp5Q3nFDk2P/qVjttP7A2BTJCMs2S', '01064449227', 0, 'male', 'customer', '2026-08-24 06:50:21', '2026-08-24 06:50:21'),
(30, 'Sara Samir', 'sara.samir28@gmail.com', '$2y$10$giSj1FLKexTBtgpt.TD3Iu00kWEzOI3Ew3LBbLF2UyWMxKr2od9wG', '01111643068', 1, 'female', 'customer', '2026-08-24 06:50:21', '2026-08-24 06:50:21'),
(31, 'Dina Nabil', 'dina.nabil29@gmail.com', '$2y$10$ooXgSs8bepxrRFQG/WPmHuTG.XU9eG90hVeWhCzfB6Z8S.3XTnOqC', '01052701042', 1, 'female', 'customer', '2026-08-24 06:50:21', '2026-08-24 06:50:21'),
(32, 'Tarek Mohamed', 'tarek.mohamed30@gmail.com', '$2y$10$0P3xFFxrT0KF1EmZvKna3ekvr5jULBi/YA6tFT1kZ5iMYRHKBVeW6', '01067914571', 0, 'male', 'customer', '2026-08-24 06:50:22', '2026-08-24 06:50:22'),
(33, 'Mohamed Mahmoud', 'mohamed.mahmoud31@gmail.com', '$2y$10$RqfVmSsaUGSZdSnYPMqSzuhgjFYkt43xUf6gSKa.wEW7Z8FnJocFa', '01029227558', 0, 'male', 'customer', '2026-08-24 06:50:22', '2026-08-24 06:50:22'),
(34, 'Dina Ahmed', 'dina.ahmed32@gmail.com', '$2y$10$Tz0.uKa2MTwxXTSIF2FttuYpcNXHhpVOPgkL/f1cQVVyGz0E.Nuti', '01052926012', 0, 'female', 'customer', '2026-08-24 06:50:22', '2026-08-24 06:50:22'),
(35, 'Habiba Khalil', 'habiba.khalil33@gmail.com', '$2y$10$2U.D0wZkjIrGtYryyCt8GOL.3Fx9BOd2MbDEdUxZIbudrWl81W89e', '01193774777', 0, 'female', 'customer', '2026-08-24 06:50:22', '2026-08-24 06:50:22'),
(36, 'Omar Ali', 'omar.ali34@gmail.com', '$2y$10$h6UZAdsI9gi.TaS4nkvYLeDeqH0LJ5dAfbcBy6CANRMLaZe0i6Pve', '01046777026', 0, 'male', 'customer', '2026-08-24 06:50:22', '2026-08-24 06:50:22'),
(37, 'Ahmed Ibrahim', 'ahmed.ibrahim35@gmail.com', '$2y$10$nVYgjDWw/AdvVei1/1FwTuoMgdwfVQg2178B8Gh.BV9XHxygm8D7.', '01199766377', 0, 'male', 'customer', '2026-08-24 06:50:22', '2026-08-24 06:50:22'),
(38, 'Menna Samir', 'menna.samir36@gmail.com', '$2y$10$c7vqr89WMZrIYMnpnPYZwO0SXGjxv7kCcVg3W4p/kRCn3b37G7Gpq', '01262245482', 0, 'female', 'customer', '2026-08-24 06:50:23', '2026-08-24 06:50:23'),
(39, 'Mariam Youssef', 'mariam.youssef37@gmail.com', '$2y$10$2cTZY7LVLXR.XNcZ2LmU/uVxcXhTDiFDhdM8vQujdaJgyAjo4b1Xa', '01069922689', 0, 'female', 'customer', '2026-08-24 06:50:23', '2026-08-24 06:50:23'),
(40, 'Youssef Gamal', 'youssef.gamal38@gmail.com', '$2y$10$qVQ/u1v9xYrua0CtmLVuJePOHiu2G61rxqN/Sy.vkQ/dtOLkUqRHC', '01057758543', 0, 'male', 'customer', '2026-08-24 06:50:23', '2026-08-24 06:50:23'),
(41, 'Jana Mansour', 'jana.mansour39@gmail.com', '$2y$10$UE6Ka4obuaE1.5Px2MvER.XrfVbRrT6XDIuo6CDFccgfBNsXczMxS', '01213158813', 0, 'female', 'customer', '2026-08-24 06:50:23', '2026-08-24 06:50:23'),
(42, 'Mariam Ezzat', 'mariam.ezzat40@gmail.com', '$2y$10$1cdQaFDKBWigLKOLZVsiTO4AxrT5roXS3WZSpveegbhOChqTVK/cq', '01082238569', 0, 'female', 'customer', '2026-08-24 06:50:23', '2026-08-24 06:50:23'),
(43, 'Aya Ezzat', 'aya.ezzat41@gmail.com', '$2y$10$9RsWPlDZnu1Ciqwnr/HXxeC5dVm9iV96KBA8h9uHs/emaSes6Jwvi', '01154269797', 0, 'female', 'customer', '2026-08-24 06:50:23', '2026-08-24 06:50:23'),
(44, 'Hassan Ahmed', 'hassan.ahmed42@gmail.com', '$2y$10$GUTU9aw2ELOdxZ4hIyA9ZuZ7k9QSFRRuvUMn3RBN2qyGdyL2GyvpO', '01296489222', 0, 'male', 'customer', '2026-08-24 06:50:24', '2026-08-24 06:50:24'),
(45, 'Laila Abdelaziz', 'laila.abdelaziz43@gmail.com', '$2y$10$p.857uPFCCwEoeWR7TUfJuDwk2ECV1Uw5/WPZpAexcPNJ2BCegihi', '01143384502', 1, 'female', 'customer', '2026-08-24 06:50:24', '2026-08-24 06:50:24'),
(46, 'Walid Khalil', 'walid.khalil44@gmail.com', '$2y$10$/Z9HfMGe6OHDJwPtUiEaEeg5WhQJnr9b5CDfP7juSatCUxQvPkjKK', '01020727296', 1, 'male', 'customer', '2026-08-24 06:50:24', '2026-08-24 06:50:24'),
(47, 'Youssef Ragab', 'youssef.ragab45@gmail.com', '$2y$10$BbDnQFt7fzRGedvzxpzgPOl.3thVZJwnPEf.qTGRx.n8DMZLLF2Bq', '01249759150', 0, 'male', 'customer', '2026-08-24 06:50:24', '2026-08-24 06:50:24'),
(48, 'Hana Ahmed', 'hana.ahmed46@gmail.com', '$2y$10$N.czoNooDbxS/5HMgFJABeEFbyBeduHxt5tLqsYO/oEpZwzSOy6ra', '01038121444', 0, 'female', 'customer', '2026-08-24 06:50:24', '2026-08-24 06:50:24'),
(49, 'Seif Ezzat', 'seif.ezzat47@gmail.com', '$2y$10$IVJUJ9SGdvuY8ItjNRlLl.Ilc.OkmKXciRDnRIC2ZRbqciqea3u5O', '01539066318', 0, 'male', 'customer', '2026-08-24 06:50:24', '2026-08-24 06:50:24'),
(50, 'Omar Mohamed', 'omar.mohamed48@gmail.com', '$2y$10$AWJgPScbjpEQDJpMsol7PuEImaEXrY9/8YdwHArgyNZQLVdw3HA6m', '01272092958', 0, 'male', 'customer', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(51, 'Habiba Nabil', 'habiba.nabil49@gmail.com', '$2y$10$C6mvfv3.XVt3HIjR2.IB4.HuBYjLLnf6BTvYyfowIxys8RiI1q3oG', '01535728182', 0, 'female', 'customer', '2026-08-24 06:50:25', '2026-08-24 06:50:25'),
(52, 'Abdelrahman Ali', 'abdelrahman.ali50@gmail.com', '$2y$10$NrkXXkWAk7nleh/iX1G/GuRI2O82scAAhukOHVsY3CIilNmFE2RRm', '01265432329', 1, 'male', 'customer', '2026-08-24 06:50:25', '2026-08-24 06:50:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author_id` (`author_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_id` (`customer_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id` (`order_id`),
  ADD KEY `fk_book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_tokens`
--
ALTER TABLE `api_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
