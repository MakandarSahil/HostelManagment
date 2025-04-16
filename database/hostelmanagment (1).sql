-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 09:29 AM
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
-- Database: `hostelmanagment`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostelrooms`
--

CREATE TABLE `hostelrooms` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(20) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `status` enum('available','booked','maintenance') DEFAULT 'available',
  `hostel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostelrooms`
--

INSERT INTO `hostelrooms` (`room_id`, `room_no`, `capacity`, `status`, `hostel_id`) VALUES
(1, '101', 2, 'available', 1),
(2, '102', 2, 'available', 1),
(3, '103', 3, 'available', 1),
(4, '104', 2, 'available', 1),
(5, '105', 4, 'available', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `hostel_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `no_of_rooms` int(11) DEFAULT 0,
  `remaining` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`hostel_id`, `name`, `address`, `contact`, `description`, `no_of_rooms`, `remaining`) VALUES
(1, 'Girls Hostel', 'DKTE RAJWADA', '9876543210', 'A well-equipped student hostel with spacious rooms.', 60, 20);

-- --------------------------------------------------------

--
-- Table structure for table `roombooking`
--

CREATE TABLE `roombooking` (
  `booking_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT curdate(),
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roombooking`
--

INSERT INTO `roombooking` (`booking_id`, `student_id`, `room_id`, `booking_date`, `start_date`, `end_date`, `status`) VALUES
(2, 7, 2, '2025-03-21', '2025-03-23', '2025-07-01', 'Approved'),
(3, 8, 3, '2025-03-22', '2025-03-24', '2025-06-15', 'Pending'),
(4, 9, 4, '2025-03-23', '2025-03-25', '2025-07-10', 'Pending'),
(5, 10, 5, '2025-03-24', '2025-03-26', '2025-06-20', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `parents_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `userId`, `room_id`, `admission_date`, `parents_no`) VALUES
(6, 4, 1, '2023-09-01', '9876543210'),
(7, 5, 2, '2023-09-02', '9876543211'),
(8, 6, 3, '2023-09-03', '9876543212'),
(9, 7, 4, '2023-09-04', '9876543213'),
(10, 8, 5, '2023-09-05', '9876543214');

-- --------------------------------------------------------

--
-- Table structure for table `studentlog`
--

CREATE TABLE `studentlog` (
  `log_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `out_time` datetime DEFAULT current_timestamp(),
  `in_time` datetime DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `status` enum('out','in') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentlog`
--

INSERT INTO `studentlog` (`log_id`, `student_id`, `room_id`, `out_time`, `in_time`, `purpose`, `status`) VALUES
(9, 6, 1, '2025-03-26 08:00:00', '2025-03-26 18:00:00', 'Library Visit', ''),
(10, 7, 2, '2025-03-26 09:30:00', NULL, 'Workshop', ''),
(11, 8, 3, '2025-03-25 14:00:00', '2025-03-25 19:00:00', 'Medical Appointment', ''),
(12, 9, 4, '2025-03-24 10:15:00', NULL, 'Project Work', ''),
(13, 10, 5, '2025-03-23 11:00:00', '2025-03-23 17:00:00', 'Personal Errand', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `gender` enum('m','f') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') NOT NULL DEFAULT 'student',
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `email`, `phone`, `password`, `role`, `isActive`) VALUES
(1, 'Admin', NULL, 'User', NULL, NULL, 'admin@example.com', '9876543210', '$2y$10$UawxsRkkyiagXMediv97f.WB6pVTIUIf1GwYdExPOnoo/Xq.5OZ46', 'admin', 1),
(2, 'Student', NULL, 'User', NULL, NULL, 'student@example.com', '9876543211', '$2y$10$edD113EKd/oOSBp5RH3peuNSYY.1GSsBu6WiGrVaNRBCqiQHLtHHG', 'student', 1),
(4, 'Rahul', '', 'Kumar', 'm', '2002-06-15', 'rahul@example.com', '9876543210', '$2y$10$1kpcsHRo4HTehODETG/tcu.n2doetI76eMhUFTeC6yPpxMJtN5rXu', 'student', 1),
(5, 'Sneha', '', 'Patil', 'f', '2003-04-10', 'sneha@example.com', '9876543211', '$2y$10$lTjJPeHXuNBrAiokyukDjuIOIesCRyo.4IXtDwOWBCbP09NsQlU.O', 'student', 1),
(6, 'Arjun', '', 'Mehta', 'm', '2001-12-01', 'arjun@example.com', '9876543212', '$2y$10$9Ij2Jc.fezWnDVfC4HNbZelaX9wZeCNMe3tW7xAIY7SOuRd7N31Yi', 'student', 1),
(7, 'Priya', '', 'Sharma', 'f', '2002-08-25', 'priya@example.com', '9876543213', '$2y$10$7IeMy3zCLsSD6tYP2s526Oc/L71YwB7Rm.apbpRHY32zH66dne0/W', 'student', 1),
(8, 'Amit', '', 'Verma', 'm', '2000-11-05', 'amit@example.com', '9876543214', '$2y$10$mcjWR670iQyqEm9xjTv5W.kstT2wgu07Ns3qZdSdqasJ8a47bcLkG', 'student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_no` (`room_no`),
  ADD KEY `hostel_id` (`hostel_id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`hostel_id`);

--
-- Indexes for table `roombooking`
--
ALTER TABLE `roombooking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `userId` (`userId`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `studentlog`
--
ALTER TABLE `studentlog`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `hostel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roombooking`
--
ALTER TABLE `roombooking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studentlog`
--
ALTER TABLE `studentlog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hostelrooms`
--
ALTER TABLE `hostelrooms`
  ADD CONSTRAINT `hostelrooms_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`) ON DELETE CASCADE;

--
-- Constraints for table `roombooking`
--
ALTER TABLE `roombooking`
  ADD CONSTRAINT `roombooking_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roombooking_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `hostelrooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `hostelrooms` (`room_id`) ON DELETE SET NULL;

--
-- Constraints for table `studentlog`
--
ALTER TABLE `studentlog`
  ADD CONSTRAINT `studentlog_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentlog_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `hostelrooms` (`room_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
