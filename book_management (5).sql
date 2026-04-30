-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 04:06 PM
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
-- Database: `book_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com\r\n', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) NOT NULL,
  `AuthorName` varchar(255) NOT NULL,
  `BookNo` varchar(100) NOT NULL,
  `img` varchar(50) NOT NULL,
  `availability` varchar(20) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `BookName`, `AuthorName`, `BookNo`, `img`, `availability`) VALUES
(26, 'DREAM\'S', 'KALPESH GHEDIYA', '2323', 'img/Dream.png', 'Available'),
(27, 'THE UNTOLD STORY', 'KALPESH GHEDIYA', '2324', 'img/Story.jpg', 'Available'),
(28, 'Winning the EGO Game', 'KALPESH GHEDIYA', '4545', 'img/Ego.png', 'Available'),
(29, 'Softly, I Rise', 'KALPESH GHEDIYA', '5050', 'img/Rise.jpg', 'Available'),
(30, 'CALM', 'KALPESH GHEDIYA', '2346', 'img/Calm.jpg', 'Available'),
(31, 'BUILD THE LAGACY', 'KALPESH GHEDIYA', '1530', 'img/Build.jpg', 'Available'),
(32, 'MONEY WITHOUT MATH', 'KALPESH GHEDIYA', '4050', 'img/Money.png', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `book_talk`
--

CREATE TABLE `book_talk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `presentation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_talk_participants`
--

CREATE TABLE `book_talk_participants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `presentation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Kalpesh Ghediya', 'ghediyak3@gmail.com', 'LIBRARY FEED BACK', 'all over good pls improve the chekin check out app problems', '2025-07-21 16:26:35'),
(3, 'Harshal Dhokiya', 'Harshal23@gmail.com', 'LIBRARY FEED BACK', ' GOOD ', '2025-07-28 03:17:17'),
(4, 'Harshal Dhokiya', 'Harshal23@gmail.com', 'LIBRARY FEED BACK', ' GOOD ', '2025-07-28 03:19:02'),
(5, 'Kalpesh Ghediya', 'ghediyak3@gmail.com', 'LIBRARY FEED BACK', 'sdfSFgFS', '2025-08-05 06:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `title`, `author`, `pdf_file`) VALUES
(1, 'Learn PHP Basics', 'Kalpesh Ghediya', 'uploads/my_ebook.pdf\r\n'),
(2, 'Mastering MySQL', 'Pratik Ghediya', 'uploads/my_ebook2.pdf\r\n'),
(3, 'HTML & CSS Guide', 'Bhavyesh Vishavadiya', 'uploads/my_ebook3.pdf\r\n'),
(4, 'Lines He Wouldn’t Cross', 'Kalpesh Ghediya', 'file:///C:/Users/Kalpesh/Music/C9_230801186.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `status` enum('Issued','Returned') DEFAULT 'Issued'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`id`, `book_id`, `user_id`, `issue_date`, `return_date`, `status`) VALUES
(143, 27, 73, '2025-09-25 08:57:49', '2025-10-09 00:00:00', 'Returned');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `title`, `publisher`) VALUES
(1, 'Journal of Modern Science', 'Springer'),
(2, 'International Journal of Technology', 'Elsevier'),
(3, 'Advanced Computing Journal', 'IEEE'),
(4, 'Mathematics and Statistics Review', 'Wiley'),
(5, 'Physics Today', 'AIP Publishing'),
(6, 'LearnScape: Journal of Modern Education', 'Kalpesh Ghediya');

-- --------------------------------------------------------

--
-- Table structure for table `proceedings`
--

CREATE TABLE `proceedings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proceedings`
--

INSERT INTO `proceedings` (`id`, `title`, `year`) VALUES
(1, 'Proceedings of AI Conference', 2023),
(2, 'Cyber Security Symposium', 2022),
(3, 'Data Science Summit', 2021),
(4, 'Green Tech Conference', 2024),
(5, 'National Conference on Education', 2020),
(6, 'Living with Honor: A Discourse on Self-Respect and Society', 2025);

-- --------------------------------------------------------

--
-- Table structure for table `thesis`
--

CREATE TABLE `thesis` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thesis`
--

INSERT INTO `thesis` (`id`, `title`, `student_name`, `year`) VALUES
(1, 'A Comprehensive Study on Artificial Intelligence and Its Impact on Modern Educational Systems in Developing Countries', 'Ankit Patel', 2022),
(2, 'Exploring the Role of Renewable Energy Resources in Reducing Carbon Footprint: A Case Study of Rural India', 'Bhavna Shah', 2023),
(3, 'The Influence of Social Media Usage on Academic Performance Among Undergraduate Students', 'Chetan Joshi', 2021),
(4, 'A Deep Dive into Blockchain Technology and Its Potential Applications Beyond Cryptocurrency', 'Disha Mehta', 2024),
(5, 'Developing an Efficient Machine Learning Model to Predict Student Dropout Rates in Higher Education', 'Esha Solanki', 2020),
(6, '\"A Man’s True Identity Lies in His Limits and His Respect for Women\"', 'Kalpesh Ghediya', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT 'user',
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `role`, `profile_image`) VALUES
(73, 'Kalpesh', 'Ghediya', 'ghediyak3@gmail.com', '$2y$10$5AoSvEWxQaMVnagt4adcSujawD/k2sCN6SvsMA1SHZW.csxyfir8O', 'user', '1758770859_Gemini_Generated_Image_ylykjsylykjsylyk.png'),
(74, 'Kalpesh', 'Ghediya', 'ghediyak23@gmail.com', '$2y$10$LO26ERNRujE/DvZPfEjG0OdnfXnnbqxVVAwRSAYcwgasY5A5WXvMe', 'user', '1760017840_Gemini_Generated_Image_54fxd154fxd154fx (1).png'),
(75, 'Kalpesh', 'Ghediya', 'ghediyak33@gmail.com', '$2y$10$4cE2KesEKkzz9TGg3luqDOvq3DG7ka4sK79zWQBRQOco9NvZ2Z9qG', 'user', '1760364355_Code Carnival - Season 2-team-qr-code.png');

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `BookNo` (`BookNo`);

--
-- Indexes for table `book_talk`
--
ALTER TABLE `book_talk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `book_talk_participants`
--
ALTER TABLE `book_talk_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issued_books_ibfk_1` (`book_id`),
  ADD KEY `issued_books_ibfk_2` (`user_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proceedings`
--
ALTER TABLE `proceedings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thesis`
--
ALTER TABLE `thesis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `book_talk`
--
ALTER TABLE `book_talk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `book_talk_participants`
--
ALTER TABLE `book_talk_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `proceedings`
--
ALTER TABLE `proceedings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `thesis`
--
ALTER TABLE `thesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_talk`
--
ALTER TABLE `book_talk`
  ADD CONSTRAINT `book_talk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_talk_participants`
--
ALTER TABLE `book_talk_participants`
  ADD CONSTRAINT `book_talk_participants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `issued_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issued_books_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
