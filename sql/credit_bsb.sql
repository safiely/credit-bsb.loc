-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2016 at 01:08 AM
-- Server version: 5.5.42
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `credit_bsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  ` access_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (` access_id`, `name`) VALUES
(1, 'Нет доступа'),
(2, 'Пользователь'),
(3, 'Администратор');

-- --------------------------------------------------------

--
-- Table structure for table `age`
--

CREATE TABLE `age` (
  `age_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `age`
--

INSERT INTO `age` (`age_id`, `name`, `points`) VALUES
(1, 'до 20 лет', 15),
(2, '21-26 лет', 34),
(3, '27-30 лет', 90),
(4, '31-35 лет', 114),
(5, '36-50 лет', 97),
(6, '51-60 лет', 55),
(7, 'более 61 года', 15);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `name`, `points`) VALUES
(1, 'Не выбрано', 0),
(2, 'Нет', 70),
(3, 'Отечественный', 53),
(4, 'Иномарка', 115);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clients_id` int(11) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passport_serial` int(11) NOT NULL,
  `passport_number` int(11) NOT NULL,
  `code_podrazd` varchar(255) NOT NULL,
  `date_vydachi` date NOT NULL,
  `date_rozhd` date NOT NULL,
  `mesto_rozhd` varchar(255) NOT NULL,
  `kem_vydan` text NOT NULL,
  `index_address_reg` int(11) NOT NULL,
  `address_reg` text NOT NULL,
  `index_address_fact` int(11) NOT NULL,
  `address_fact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `count_child`
--

CREATE TABLE `count_child` (
  `count_child_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `count_child`
--

INSERT INTO `count_child` (`count_child_id`, `name`, `points`) VALUES
(1, 'Нет', 64),
(2, 'Один', 87),
(3, 'Два', 52),
(4, 'Три и более', 4);

-- --------------------------------------------------------

--
-- Table structure for table `credit_request`
--

CREATE TABLE `credit_request` (
  `credit_request_id` int(11) NOT NULL COMMENT '№',
  `date_open` date NOT NULL COMMENT 'Дата открытия заявки',
  `date_close` date NOT NULL COMMENT 'Дата закрытия заявки',
  `status_request_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Статус заявки',
  `employees_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Ответственный сотрудник',
  `clients_id` int(11) NOT NULL,
  `sum_credit` int(11) NOT NULL COMMENT 'Сумма кредита',
  `srok_credit` int(11) NOT NULL COMMENT 'Срок кредита',
  `proc_credit` float NOT NULL COMMENT 'Процент по кредиту',
  `platezh_credit` float NOT NULL COMMENT 'Ежемесячный платеж по кредиту',
  `purpose_credit` varchar(255) NOT NULL COMMENT 'Цель кредита',
  `type_employ_id` int(11) NOT NULL COMMENT 'Типа занятости (№)',
  `name_org` varchar(255) NOT NULL COMMENT 'Название организации',
  `experience_id` int(11) NOT NULL COMMENT 'Стаж',
  `position_employ_id` int(11) NOT NULL,
  `count_child_id` int(11) NOT NULL COMMENT 'Количество детей (№)',
  `marital_status_id` int(11) NOT NULL COMMENT 'Семейное положение (№)',
  `education_id` int(11) NOT NULL COMMENT 'Образование (№)',
  `age_id` int(11) NOT NULL,
  `monthly_income_id` int(11) NOT NULL,
  `fixed_income` float NOT NULL COMMENT 'Постоянные доходы',
  `additional_income` float NOT NULL COMMENT 'Дополнительные доходы',
  `fixed_outcome` float NOT NULL COMMENT 'Постоянные расходы',
  `car_id` int(11) NOT NULL COMMENT 'Автомобиль (№)',
  `conclusion` text NOT NULL COMMENT 'Заключение',
  `sum_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education_id`, `name`, `points`) VALUES
(1, 'Не выбрано', 0),
(2, 'Начальное, среднее', 7),
(3, 'Неполное высшее', 20),
(4, 'Высшее', 30),
(5, 'Второе высшее', 36),
(6, 'Ученая степень', 30);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employees_id` int(11) NOT NULL COMMENT '№',
  `fio` varchar(255) NOT NULL COMMENT 'ФИО сотрудника',
  `email` varchar(255) NOT NULL COMMENT 'email',
  `tel` varchar(255) NOT NULL COMMENT 'Телефон',
  `password` varchar(255) NOT NULL COMMENT 'Пароль',
  `access_id` int(11) NOT NULL COMMENT 'Доступ к системе (№)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `experience_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`experience_id`, `name`, `points`) VALUES
(1, 'До одного года', 6),
(2, 'До двух лет', 28),
(3, 'До трех лет', 51),
(4, 'До пяти лет', 62),
(5, 'Более пяти лет', 89);

-- --------------------------------------------------------

--
-- Table structure for table `history_request`
--

CREATE TABLE `history_request` (
  `history_request_id` int(11) NOT NULL,
  `credit_request_id` int(11) NOT NULL,
  `datetime_message` datetime NOT NULL,
  `employees_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `fileName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `marital_status_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`marital_status_id`, `name`, `points`) VALUES
(1, 'Не выбрано', 0),
(2, 'Холост/не замужем', 87),
(3, 'Разведен(а)', 70),
(4, 'Гражданский брак', 30),
(5, 'Женат/замужем', 115),
(6, 'Вдовец/вдова', 65);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_income`
--

CREATE TABLE `monthly_income` (
  `monthly_income_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `from_diapazon` int(11) NOT NULL,
  `to_diapazon` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monthly_income`
--

INSERT INTO `monthly_income` (`monthly_income_id`, `name`, `points`, `from_diapazon`, `to_diapazon`) VALUES
(1, 'До 15 000 рублей', 57, 0, 15000),
(2, '15 001 - 25 000 рублей', 94, 15001, 25000),
(3, '25 001 - 40 000 рублей', 140, 25001, 40000),
(4, '40 001 - 100 000 рублей', 164, 40001, 100000),
(5, 'Более 100 001 рублей', 198, 100001, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `position_employ`
--

CREATE TABLE `position_employ` (
  `position_employ_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position_employ`
--

INSERT INTO `position_employ` (`position_employ_id`, `name`, `points`) VALUES
(1, 'Нет квалификации', 3),
(2, 'Стажер', 17),
(3, 'Специалист', 72),
(4, 'Начальник', 83),
(5, 'Руководитель', 122);

-- --------------------------------------------------------

--
-- Table structure for table `status_request`
--

CREATE TABLE `status_request` (
  `status_request_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_request`
--

INSERT INTO `status_request` (`status_request_id`, `name`) VALUES
(1, 'Новая заявка'),
(2, 'Заявка принята на рассмотрение'),
(3, 'Ожидание доп.информации от клиента'),
(4, 'Обработка информации'),
(5, 'Приглашение клиента в БСБ'),
(6, 'Отказ в выдаче кедита'),
(7, 'Заявка закрыта');

-- --------------------------------------------------------

--
-- Table structure for table `type_employ`
--

CREATE TABLE `type_employ` (
  `type_employ_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_employ`
--

INSERT INTO `type_employ` (`type_employ_id`, `name`, `points`) VALUES
(1, 'Работаю в организации', 124),
(2, 'Собственный бизнес', 47),
(3, 'Военнослужащий по контракту', 93),
(4, 'Пенсионер', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (` access_id`);

--
-- Indexes for table `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`age_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clients_id`);

--
-- Indexes for table `count_child`
--
ALTER TABLE `count_child`
  ADD PRIMARY KEY (`count_child_id`);

--
-- Indexes for table `credit_request`
--
ALTER TABLE `credit_request`
  ADD PRIMARY KEY (`credit_request_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employees_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`experience_id`);

--
-- Indexes for table `history_request`
--
ALTER TABLE `history_request`
  ADD PRIMARY KEY (`history_request_id`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`marital_status_id`);

--
-- Indexes for table `monthly_income`
--
ALTER TABLE `monthly_income`
  ADD PRIMARY KEY (`monthly_income_id`);

--
-- Indexes for table `position_employ`
--
ALTER TABLE `position_employ`
  ADD PRIMARY KEY (`position_employ_id`);

--
-- Indexes for table `status_request`
--
ALTER TABLE `status_request`
  ADD PRIMARY KEY (`status_request_id`);

--
-- Indexes for table `type_employ`
--
ALTER TABLE `type_employ`
  ADD PRIMARY KEY (`type_employ_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY ` access_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `age`
--
ALTER TABLE `age`
  MODIFY `age_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clients_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `count_child`
--
ALTER TABLE `count_child`
  MODIFY `count_child_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `credit_request`
--
ALTER TABLE `credit_request`
  MODIFY `credit_request_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№';
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employees_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№';
--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `experience_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `history_request`
--
ALTER TABLE `history_request`
  MODIFY `history_request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `marital_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `monthly_income`
--
ALTER TABLE `monthly_income`
  MODIFY `monthly_income_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `position_employ`
--
ALTER TABLE `position_employ`
  MODIFY `position_employ_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status_request`
--
ALTER TABLE `status_request`
  MODIFY `status_request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `type_employ`
--
ALTER TABLE `type_employ`
  MODIFY `type_employ_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
