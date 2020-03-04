-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for timetrack_new
CREATE DATABASE IF NOT EXISTS `timetrack_new` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `timetrack_new`;

-- Dumping structure for table timetrack_new.disciplines
CREATE TABLE IF NOT EXISTS `disciplines` (
  `discipline_id` int(50) NOT NULL AUTO_INCREMENT,
  `discipline_number` varchar(50) DEFAULT NULL,
  `discipline_type` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`discipline_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table timetrack_new.disciplines: ~13 rows (approximately)
/*!40000 ALTER TABLE `disciplines` DISABLE KEYS */;
REPLACE INTO `disciplines` (`discipline_id`, `discipline_number`, `discipline_type`, `updated_at`, `created_at`) VALUES
	(1, '001', 'Highways', '2019-10-09 06:47:25', '2019-09-04 19:47:09'),
	(2, '002', 'Bridges', '2019-09-04 19:53:54', '2019-09-04 19:53:54'),
	(3, '003', 'Utilities', '2019-09-12 16:31:29', '2019-09-12 16:31:29'),
	(4, '004', 'Architectrual', '2019-09-12 16:31:39', '2019-09-12 16:31:39'),
	(5, '005', 'Structural', '2019-09-12 16:31:47', '2019-09-12 16:31:47'),
	(6, '006', 'MEP', '2019-09-12 16:31:55', '2019-09-12 16:31:55'),
	(7, '007', 'Landscaping', '2019-09-12 16:32:32', '2019-09-12 16:32:32'),
	(8, '008', 'Traffic', '2019-09-12 16:32:45', '2019-09-12 16:32:45'),
	(9, '009', 'Contracts/QS', '2019-09-13 01:14:39', '2019-09-13 01:14:39'),
	(10, '10', 'Master Planning', '2019-10-10 09:30:21', '2019-10-10 09:30:21'),
	(11, '011', 'Accounts / HR', '2019-10-13 07:04:02', '2019-10-13 07:03:12'),
	(12, '012', 'Admin', '2019-10-13 07:04:12', '2019-10-13 07:03:31'),
	(13, '13', 'admin/hr', '2019-10-16 05:27:27', '2019-10-16 05:27:18');
/*!40000 ALTER TABLE `disciplines` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
