-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2022 at 02:04 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18679329_jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(90) NOT NULL,
  `profile_loc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `username`, `password`, `lastlogin`, `email`, `profile_loc`) VALUES
(1, 'admin', '$2y$10$xYBMi6zVC543GXpZbM8Xq.FwjSTWuTD01ABcLT0vESpu2TA5m5/I2', '2022-04-27 18:10:25', 'harsh.t.mistry@gmail.com', '/online%20job%20portal/admin/profile/pic/20210827_22_31_577.png');

-- --------------------------------------------------------

--
-- Table structure for table `applicants_list`
--

CREATE TABLE `applicants_list` (
  `ap_id` int(5) NOT NULL,
  `job_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  `c_id` int(5) NOT NULL,
  `applied_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants_list`
--

INSERT INTO `applicants_list` (`ap_id`, `job_id`, `u_id`, `c_id`, `applied_date`) VALUES
(25, 33, 18, 52, '2022-04-21 12:00:36'),
(26, 35, 21, 53, '2022-04-27 17:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(44, 'chemical'),
(45, 'Engineering'),
(46, 'Mechanical'),
(43, 'tech');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `c_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logo_loc` varchar(255) NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `username`, `password`, `logo_loc`, `lastlogin`) VALUES
(17, 'redix', '$2y$10$egeC6uMSGDzrGx3FEJVgwO.p7pY4hzBDGTslxAu.M31JM81SMsE5e', '/online%20job%20portal/admin/company/logo/3511433.jpg', '2022-04-21 12:03:32'),
(18, 'newport', '$2y$10$uC1sZFzCSuYHHYmgPKB8ZeeCcTxvbVAxrvQQ.QpBaZCcZ.aFefD42', '/online%20job%20portal/admin/company/logo/dm-engineering-02.jpg', '2022-04-21 07:32:37'),
(19, 'codercube', '$2y$10$6rn1KbBLLBvA0aJU0K9iTuEYQ4Hmcyn49fXNB8ieX56lWNecJ2RTO', '/online%20job%20portal/admin/company/logo/Screenshot_20220418-222351.jpeg', '0000-00-00 00:00:00'),
(20, 'tcs', '$2y$10$v3eImfEjYV/f1j4ShxoK.O04hTUzD4D073InruynUTg2dg5D/RvQy', '/online%20job%20portal/admin/company/logo/20210827_22_31_5826.png', '2022-04-27 17:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `company_reg`
--

CREATE TABLE `company_reg` (
  `c_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_name` varchar(90) NOT NULL,
  `company_address` varchar(90) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `mission` text NOT NULL,
  `reg_year` int(4) NOT NULL,
  `email` varchar(90) NOT NULL,
  `logo_loc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_reg`
--

INSERT INTO `company_reg` (`c_id`, `username`, `password`, `company_name`, `company_address`, `contact_no`, `mission`, `reg_year`, `email`, `logo_loc`) VALUES
(52, 'redix', '$2y$10$egeC6uMSGDzrGx3FEJVgwO.p7pY4hzBDGTslxAu.M31JM81SMsE5e', 'Redixweb', 'Surat', 8776656790, 'to become a best IT company in the world. and rule the entire IT industry in the world.', 1990, 'redixweb@gmail.com', '/online%20job%20portal/admin/company/logo/3511433.jpg'),
(53, 'newport', '$2y$10$uC1sZFzCSuYHHYmgPKB8ZeeCcTxvbVAxrvQQ.QpBaZCcZ.aFefD42', 'NewPort', 'London, UK', 7896542581, 'To Become Best Engineering Company in Global Market', 1998, 'newport@gmail.com', '/online%20job%20portal/admin/company/logo/dm-engineering-02.jpg'),
(54, 'codercube', '$2y$10$6rn1KbBLLBvA0aJU0K9iTuEYQ4Hmcyn49fXNB8ieX56lWNecJ2RTO', 'CoderCube', 'Los Angelous                        ', 1472583695, 'to become a best IT company in the world. and rule the entire IT industry in the world.', 1995, 'coderxube@gmail.com', '/online%20job%20portal/admin/company/logo/Screenshot_20220418-222351.jpeg'),
(55, 'tcs', '$2y$10$v3eImfEjYV/f1j4ShxoK.O04hTUzD4D073InruynUTg2dg5D/RvQy', 'TCS', 'banglore               ', 7895214826, 'To rule the cyber security industry over the world', 1998, 'tcs@gmail.com', '/online%20job%20portal/admin/company/logo/20210827_22_31_5826.png');

-- --------------------------------------------------------

-- 
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  `c_id` int(5) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `u_id`, `c_id`, `feedback`) VALUES
(27, 0, 53, 'Hello World'),
(28, 18, 0, 'Best Job Portal Website');

-- --------------------------------------------------------

--
-- Table structure for table `hired_applicants`
--

CREATE TABLE `hired_applicants` (
  `h_id` int(5) NOT NULL,
  `c_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  `j_id` int(5) NOT NULL,
  `approved_datetime` datetime NOT NULL,
  `message` text NOT NULL,
  `read_stat` tinyint(1) NOT NULL COMMENT '0 - unread\r\n1 - read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hired_applicants`
--

INSERT INTO `hired_applicants` (`h_id`, `c_id`, `u_id`, `j_id`, `approved_datetime`, `message`, `read_stat`) VALUES
(9, 53, 17, 35, '2022-04-20 19:58:42', 'Congratulations You are Hired', 1),
(10, 52, 17, 33, '2022-04-21 07:12:39', 'Congratulations You are Hired', 0),
(11, 53, 18, 36, '2022-04-21 07:15:35', 'Congratulations You are Hired', 1),
(12, 52, 18, 34, '2022-05-02 13:00:03', 'Congratulations You are Hired', 0);

-- --------------------------------------------------------

--
-- Table structure for table `joblist`
--

CREATE TABLE `joblist` (
  `job_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  `category` varchar(255) NOT NULL,
  `c_id` int(5) NOT NULL,
  `job_title` varchar(90) NOT NULL,
  `req_emp` int(5) NOT NULL,
  `salary` int(10) NOT NULL,
  `job_duration` int(3) NOT NULL,
  `qualification` text NOT NULL,
  `work_expr` text NOT NULL,
  `job_detail` text NOT NULL,
  `gender` varchar(11) NOT NULL,
  `job_posted` date NOT NULL DEFAULT current_timestamp(),
  `last_date` date NOT NULL,
  `job_type` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 - job hasn''t expired\r\n0 - job expired'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `joblist`
--

INSERT INTO `joblist` (`job_id`, `category_id`, `category`, `c_id`, `job_title`, `req_emp`, `salary`, `job_duration`, `qualification`, `work_expr`, `job_detail`, `gender`, `job_posted`, `last_date`, `job_type`, `status`) VALUES
(33, 43, 'tech', 52, 'blockchain developer', 5, 50000, 3, 'BCA, MCA', '2 Years', 'The World’s Most Powerful Blockchain Development Suite', 'male/female', '2022-04-20', '2022-04-30', 'full time', 1),
(34, 45, 'Engineering', 52, 'Software Developer', 10, 30000, 3, 'BTECH, MTECH', '2 Years', 'Develop and drive QA tests, formulate testing strategy and test plans, and implement them across our product offerings and client projects\r\nReview requirements, specifications and technical design documents to provide timely and meaningful feedback', 'male', '2022-04-20', '2022-04-22', 'part time/full time', 1),
(35, 44, 'chemical', 53, 'Chemical Engineer', 20, 45000, 2, 'BE, ME', '4 Years', 'Support the tech transfer and production team by implementing the Corporate PSM standards, procedures.\r\nAwareness on standards and codes on Process Safety, CCPS and applicable NFPA guidelines\r\nKnowledge and understanding of data from Process tests involving DSC, RC, TSU and material safety data involving Dust explosion, MIE, Powder Resistivity, Layer ignition, Ignition sensitivity, Explosion severity', 'male/female', '2022-04-20', '2022-05-01', 'part time', 1),
(36, 46, 'Mechanical', 53, 'Mechanical Engineer', 43, 30000, 4, 'BE, ME, BTECH, MTECH', '2 Years', 'Role:Mechanical Engineer\r\nIndustry Type:Engineering & Construction\r\nFunctional Area:Construction & Site Engineering\r\nEmployment Type:Full Time, Permanent\r\nRole Category:Construction Engineering', 'female', '2022-04-20', '2022-04-28', 'part time/full time', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pic_loc` varchar(255) NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `password`, `pic_loc`, `lastlogin`) VALUES
(9, 'harsh', '$2y$10$.rN3T0/szpujfPADjL3NqOJUahCKEM/ydPYifkM58cYvrao0RP5/S', '/online%20job%20portal/admin/user/profile_pic/my image.jpg', '2022-04-21 07:10:19'),
(10, 'raj', '$2y$10$669xTL9yQ2KavhBhZqOYL.VA0PXgtPLs3X8xzLFn2GnrjmEW1VTLa', '/online%20job%20portal/admin/user/profile_pic/20210827_22_31_572.png', '2022-04-21 06:47:55'),
(11, 'kevin', '$2y$10$9k9wuH2WB0UFX5GRjrCz2uFnZeH.uATvoEy9Ftq37CXtvL7ricPvG', '/online%20job%20portal/admin/user/profile_pic/20210827_22_32_02182.png', '0000-00-00 00:00:00'),
(12, 'vipul', '$2y$10$mQEiNbrHmWrK6YDIhEx9Ze4QL3Vz/xWDY5AfbOLCd2W6OS.mQb5Sa', '/online%20job%20portal/admin/user/profile_pic/Screenshot_20220418-222414.jpeg', '0000-00-00 00:00:00'),
(13, 'dhruv', '$2y$10$Wawss.JGX9mNtcKs7ojMguEs1aODboWhZgK/Gm.GwCWh0ghQioHn.', '/online%20job%20portal/admin/user/profile_pic/20210827_22_31_577.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--

CREATE TABLE `user_reg` (
  `u_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(90) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `marital_status` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(2) NOT NULL,
  `email` varchar(90) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `pic_loc` varchar(255) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `degree` text NOT NULL,
  `resume_loc` varchar(255) DEFAULT NULL,
  `edu_qualification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_reg`
--

INSERT INTO `user_reg` (`u_id`, `username`, `password`, `name`, `address`, `gender`, `marital_status`, `birthdate`, `age`, `email`, `contact_no`, `pic_loc`, `nationality`, `degree`, `resume_loc`, `edu_qualification`) VALUES
(17, 'harsh', '$2y$10$.rN3T0/szpujfPADjL3NqOJUahCKEM/ydPYifkM58cYvrao0RP5/S', 'Harsh Mistry', 'Bilimora                  ', 'male', 'unmarried', '2002-04-22', 19, 'harshmistry539@gmail.com', 7041414497, '/online%20job%20portal/admin/user/profile_pic/my image.jpg', 'indian', 'Bachelor', '/online%20job%20portal/admin/user/resume/VIVEK CMAT.pdf', 'BCA'),
(18, 'raj', '$2y$10$669xTL9yQ2KavhBhZqOYL.VA0PXgtPLs3X8xzLFn2GnrjmEW1VTLa', 'Raj Kedariya', 'Wageshwar', 'male', 'unmarried', '2002-10-20', 19, 'rajkedariya007@gmail.com', 7621072787, '/online%20job%20portal/admin/user/profile_pic/20210827_22_31_572.png', 'indian', 'Bachelor', '/online%20job%20portal/admin/user/resume/ANIS CMAT.pdf', 'MCA'),
(19, 'kevin', '$2y$10$9k9wuH2WB0UFX5GRjrCz2uFnZeH.uATvoEy9Ftq37CXtvL7ricPvG', 'kevin soni', 'chikhli', 'male', 'unmarried', '2002-04-21', 20, 'harshmistry539@gmail.com', 6565768798, '/online%20job%20portal/admin/user/profile_pic/20210827_22_32_02182.png', 'indian', 'bachelor', '', 'hacker'),
(20, 'vipul', '$2y$10$mQEiNbrHmWrK6YDIhEx9Ze4QL3Vz/xWDY5AfbOLCd2W6OS.mQb5Sa', 'Vipul Gamta', 'Dharampur', 'male', 'unmarried', '2000-04-22', 22, 'vipulgamta@gmail.com', 4569871232, '/online%20job%20portal/admin/user/profile_pic/Screenshot_20220418-222414.jpeg', 'indian', 'bachelor', '', 'hacker'),
(21, 'dhruv', '$2y$10$Wawss.JGX9mNtcKs7ojMguEs1aODboWhZgK/Gm.GwCWh0ghQioHn.', 'dhruv', 'khergam                                    ', 'male', 'unmarried', '2002-04-27', 20, 'dhruv@gmail.com', 1234567895, '/online%20job%20portal/admin/user/profile_pic/20210827_22_31_577.png', 'indian', 'bachelor', '/online%20job%20portal/admin/user/resume/FINAL SEMINAR CERTI 2021 22.docx', 'graduate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `applicants_list`
--
ALTER TABLE `applicants_list`
  ADD PRIMARY KEY (`ap_id`),
  ADD KEY `user_fk1` (`u_id`),
  ADD KEY `company_fk1` (`c_id`),
  ADD KEY `job_fk1` (`job_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `company_reg`
--
ALTER TABLE `company_reg`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `company_name` (`company_name`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `user_fk3` (`u_id`),
  ADD KEY `company_fk3` (`c_id`);

--
-- Indexes for table `hired_applicants`
--
ALTER TABLE `hired_applicants`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `user_fk2` (`u_id`),
  ADD KEY `company_fk2` (`c_id`),
  ADD KEY `job_fk2` (`j_id`);

--
-- Indexes for table `joblist`
--
ALTER TABLE `joblist`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `category_fk` (`category_id`),
  ADD KEY `company_fk` (`c_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_reg`
--
ALTER TABLE `user_reg`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants_list`
--
ALTER TABLE `applicants_list`
  MODIFY `ap_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `company_reg`
--
ALTER TABLE `company_reg`
  MODIFY `c_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `hired_applicants`
--
ALTER TABLE `hired_applicants`
  MODIFY `h_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `joblist`
--
ALTER TABLE `joblist`
  MODIFY `job_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_reg`
--
ALTER TABLE `user_reg`
  MODIFY `u_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants_list`
--
ALTER TABLE `applicants_list`
  ADD CONSTRAINT `company_fk1` FOREIGN KEY (`c_id`) REFERENCES `company_reg` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_fk1` FOREIGN KEY (`job_id`) REFERENCES `joblist` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk1` FOREIGN KEY (`u_id`) REFERENCES `user_reg` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hired_applicants`
--
ALTER TABLE `hired_applicants`
  ADD CONSTRAINT `company_fk2` FOREIGN KEY (`c_id`) REFERENCES `company_reg` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_fk2` FOREIGN KEY (`j_id`) REFERENCES `joblist` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk2` FOREIGN KEY (`u_id`) REFERENCES `user_reg` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `joblist`
--
ALTER TABLE `joblist`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_fk` FOREIGN KEY (`c_id`) REFERENCES `company_reg` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
