-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 03:44 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wu_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dayofwork`
--

CREATE TABLE IF NOT EXISTS `tb_dayofwork` (
  `dowid` int(11) NOT NULL AUTO_INCREMENT,
  `dow_name` varchar(250) DEFAULT NULL,
  `dow_des` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`dowid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_dayofwork`
--

INSERT INTO `tb_dayofwork` (`dowid`, `dow_name`, `dow_des`) VALUES
(1, 'Monday - Friday', 'Day of work as government'),
(2, 'Monday - Saturday', '6 days/week');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dept`
--

CREATE TABLE IF NOT EXISTS `tb_dept` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(500) DEFAULT NULL,
  `deptdescription` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`deptid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_dept`
--

INSERT INTO `tb_dept` (`deptid`, `deptname`, `deptdescription`) VALUES
(1, 'Department of Foundation Year', 'Foundation Year'),
(2, 'Department of Administrative', 'Administrator'),
(3, 'Department of Economics and Business', 'Economic and Business');

-- --------------------------------------------------------

--
-- Table structure for table `tb_doc`
--

CREATE TABLE IF NOT EXISTS `tb_doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(250) DEFAULT NULL,
  `doc_description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobtype`
--

CREATE TABLE IF NOT EXISTS `tb_jobtype` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(50) DEFAULT NULL,
  `job_des` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_jobtype`
--

INSERT INTO `tb_jobtype` (`job_id`, `job_name`, `job_des`) VALUES
(1, 'Full Time', 'This work is 8h/day'),
(2, 'Part time', '4h or less than 8h/day'),
(3, 'Internship', 'Internship');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position`
--

CREATE TABLE IF NOT EXISTS `tb_position` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(500) DEFAULT NULL,
  `pos_des` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_position`
--

INSERT INTO `tb_position` (`pos_id`, `pos_name`, `pos_des`) VALUES
(1, NULL, 'Assistant to Registrar, Assistant to Department of Administrative'),
(2, NULL, ''),
(3, NULL, 't1'),
(4, NULL, 't1'),
(5, 'Assistant', 'Assistant to Registrar, Assistant to Department of Administrative'),
(6, 'Testing', 'testing too'),
(7, 'test2222', '222222'),
(8, 'test222255555555555', '2222225555555555555');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE IF NOT EXISTS `tb_role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(150) DEFAULT NULL,
  `roledescription` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`roleid`, `rolename`, `roledescription`) VALUES
(1, 'Administrator', 'Control full option of this System'),
(2, 'Manager', 'Control any option of this System'),
(3, 'Guest', 'Update their profile');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff`
--

CREATE TABLE IF NOT EXISTS `tb_staff` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_photo` varchar(150) DEFAULT NULL,
  `s_code_prefix` varchar(10) DEFAULT NULL,
  `s_codeid` int(11) DEFAULT NULL,
  `s_codeurl` varchar(250) DEFAULT NULL,
  `s_namekh` varchar(250) DEFAULT NULL,
  `s_nameEn` varchar(150) DEFAULT NULL,
  `s_gender` varchar(5) DEFAULT NULL,
  `s_study_level` varchar(150) DEFAULT NULL,
  `skillnoted` varchar(1000) DEFAULT NULL,
  `s_phone` varchar(100) DEFAULT NULL,
  `s_phone_home` varchar(100) DEFAULT NULL,
  `s_email` varchar(100) DEFAULT NULL,
  `s_start_work` date DEFAULT NULL,
  `s_end_word` date DEFAULT NULL,
  `s_added_by` int(11) DEFAULT NULL,
  `s_dateadded` date DEFAULT NULL,
  `s_roleid_insys` int(11) DEFAULT NULL,
  `s_dayofworkid` int(11) DEFAULT NULL,
  `su_pass` varchar(250) DEFAULT NULL,
  `s_work_as` varchar(100) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_staff`
--

INSERT INTO `tb_staff` (`s_id`, `s_photo`, `s_code_prefix`, `s_codeid`, `s_codeurl`, `s_namekh`, `s_nameEn`, `s_gender`, `s_study_level`, `skillnoted`, `s_phone`, `s_phone_home`, `s_email`, `s_start_work`, `s_end_word`, `s_added_by`, `s_dateadded`, `s_roleid_insys`, `s_dayofworkid`, `su_pass`, `s_work_as`) VALUES
(1, 'borey.jpg', 'WU', 0, NULL, 'បូរី', 'Borey Sean', 'M', 'MBA', 'Web Programming, Technician, Application', '070211422', NULL, 'boreykh2011@gmail.com', '2009-01-01', NULL, 1, '2016-08-28', 1, 2, '96f6056b20bfa4ee2bdfbe3d885026b70b0aee8bb1ef70436571dd22cd127e74', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_staffdoc`
--

CREATE TABLE IF NOT EXISTS `tb_staffdoc` (
  `sd_id` int(11) NOT NULL AUTO_INCREMENT,
  `sd_staffid` int(11) DEFAULT NULL,
  `sd_file` varchar(150) DEFAULT NULL,
  `sd_added_date` date DEFAULT NULL,
  `sd_doctypeid` int(11) DEFAULT NULL,
  `sd_noted` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`sd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_staff_pos_his`
--

CREATE TABLE IF NOT EXISTS `tb_staff_pos_his` (
  `ph_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_deptid` int(11) DEFAULT NULL,
  `p_posid` int(11) DEFAULT NULL,
  `pstaff_id` int(11) DEFAULT NULL,
  `p_start_work` date DEFAULT NULL,
  `p_end_work` date DEFAULT NULL,
  `time_workid` int(11) DEFAULT NULL,
  `p_jobtypeid` int(11) DEFAULT NULL,
  `noted` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ph_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_timework`
--

CREATE TABLE IF NOT EXISTS `tb_timework` (
  `tw_id` int(11) NOT NULL AUTO_INCREMENT,
  `tw_time` varchar(50) DEFAULT NULL,
  `tw_des` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`tw_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_timework`
--

INSERT INTO `tb_timework` (`tw_id`, `tw_time`, `tw_des`) VALUES
(1, '7:00 AM - 11:00 AM', 'Morning Part-time'),
(2, '7:00 AM - 5:00 PM', 'Full-Time'),
(3, '8:00 AM - 12:00 PM', 'test'),
(4, '5:00 PM - 8:30 PM', 'Part-time'),
(5, '8:00 AM - 5:00 PM', 'Full-Time'),
(6, 'hjgjgjguyg', 'hjhjgvjhvhjv'),
(7, 'iooo', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_photo` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `s_namekh` varchar(50) CHARACTER SET utf8 NOT NULL,
  `s_nameEn` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `s_email` varchar(50) NOT NULL,
  `su_pass` varchar(150) NOT NULL,
  `s_roleid_insys` int(30) NOT NULL,
  `ustatus` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 NOT NULL,
  `update_by` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `username` (`s_email`),
  KEY `name` (`s_namekh`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `s_photo`, `s_namekh`, `s_nameEn`, `s_email`, `su_pass`, `s_roleid_insys`, `ustatus`, `date_created`, `created_by`, `update_by`, `update_date`) VALUES
(1, 'borey.jpg', 'Borey', 'Sean Borey', 'boreykh2011@gmail.com', '96f6056b20bfa4ee2bdfbe3d885026b70b0aee8bb1ef70436571dd22cd127e74', 1, 1, '2016-03-29', '1', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
