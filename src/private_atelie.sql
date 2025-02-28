-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Дек 22 2024 г., 16:00
-- Версия сервера: 5.7.24
-- Версия PHP: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `private_atelie`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accessories`
--

CREATE TABLE `accessories` (
  `accessoriesID` int(11) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `acc_pic` varchar(255) NOT NULL,
  `acc_unit_price` decimal(10,2) NOT NULL,
  `acc_quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `categoriesID` int(11) NOT NULL,
  `categories_name` varchar(50) NOT NULL,
  `categories_pic` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `clientID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `third_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone_num` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `corder`
--

CREATE TABLE `corder` (
  `orderID` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_price` decimal(10,2) DEFAULT '0.00',
  `categoriesID` int(11) DEFAULT NULL,
  `clientID` int(11) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `serviceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Триггеры `corder`
--
DELIMITER $$
CREATE TRIGGER `before_insert_corder` BEFORE INSERT ON `corder` FOR EACH ROW BEGIN
    DECLARE randomEmployeeID INT;
    
    -- Выбор случайного employeeID из таблицы employee
    SELECT employeeID 
    INTO randomEmployeeID
    FROM employee 
    ORDER BY RAND() 
    LIMIT 1;

    -- Установка случайного employeeID в новую запись
    SET NEW.employeeID = randomEmployeeID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `third_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_num` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fitting`
--

CREATE TABLE `fitting` (
  `fittingID` int(11) NOT NULL,
  `fit_results` varchar(100) DEFAULT 'изменений не требуется',
  `plane_date` date DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Триггеры `fitting`
--
DELIMITER $$
CREATE TRIGGER `after_fitting_update` AFTER UPDATE ON `fitting` FOR EACH ROW BEGIN
    -- Все переменные объявляются в начале
    DECLARE material_total DECIMAL(10, 2) DEFAULT 0.00;
    DECLARE service_total DECIMAL(10, 2) DEFAULT 0.00;

    -- Проверяем, установлено ли значение fit_results как одно из допустимых
    IF NEW.fit_results IN ('выполнен', 'одобрено', 'завершено') THEN

        -- Получаем сумму material_price из таблицы material для текущего orderID
        SELECT SUM(material_price) INTO material_total
        FROM material
        WHERE orderID = NEW.orderID;

        -- Получаем цену услуги service_price из таблицы service для текущего orderID
        SELECT service_price INTO service_total
        FROM service
        WHERE serviceID = (
            SELECT serviceID FROM corder WHERE orderID = NEW.orderID
        );

        -- Обновляем значение order_price в таблице corder
        UPDATE corder
        SET order_price = IFNULL(material_total, 0) + IFNULL(service_total, 0)
        WHERE orderID = NEW.orderID;

    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `materialID` int(11) NOT NULL,
  `tex_q` decimal(10,2) DEFAULT '0.00',
  `acc_q` int(11) DEFAULT '0',
  `material_price` decimal(10,2) DEFAULT '0.00',
  `textileID` int(11) DEFAULT '0',
  `accessoriesID` int(11) DEFAULT '0',
  `orderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Триггеры `material`
--
DELIMITER $$
CREATE TRIGGER `after_material_update_acc_q` AFTER UPDATE ON `material` FOR EACH ROW BEGIN
    -- Проверяем, изменилось ли значение acc_q и больше ли оно нуля
    IF NEW.acc_q != OLD.acc_q AND NEW.acc_q > 0 THEN
        UPDATE accessories
        SET acc_quantity = acc_quantity - (NEW.acc_q - OLD.acc_q)
        WHERE accessoriesID = NEW.accessoriesID;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_material_update_tex_q` AFTER UPDATE ON `material` FOR EACH ROW BEGIN
    -- Проверяем, изменилось ли значение tex_q и больше ли оно нуля
    IF NEW.tex_q != OLD.tex_q AND NEW.tex_q > 0 THEN
        UPDATE textile
        SET tex_quantity = tex_quantity - (NEW.tex_q - OLD.tex_q)
        WHERE textileID = NEW.textileID;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_material_price` BEFORE UPDATE ON `material` FOR EACH ROW BEGIN
    DECLARE tex_price DECIMAL(10, 2);
    DECLARE acc_price DECIMAL(10, 2);

    -- Получаем цену текстиля
    SELECT tex_unit_price INTO tex_price
    FROM textile
    WHERE textileID = NEW.textileID;

    -- Получаем цену аксессуаров
    SELECT acc_unit_price INTO acc_price
    FROM accessories
    WHERE accessoriesID = NEW.accessoriesID;

    -- Рассчитываем material_price
    SET NEW.material_price = (tex_price * NEW.tex_q) + (acc_price * NEW.acc_q);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `measurements`
--

CREATE TABLE `measurements` (
  `measID` int(11) NOT NULL,
  `shirina_plech` varchar(50) DEFAULT 'не померено',
  `poluobhvat_grudi` varchar(50) DEFAULT 'не померено',
  `dlina_rukava` varchar(50) DEFAULT 'не померено',
  `dlina_izdeliya` varchar(50) DEFAULT 'не померено',
  `dlina_bokovogo_shva` varchar(50) DEFAULT 'не померено',
  `poluobhvat_talii` varchar(50) DEFAULT 'не померено',
  `poluobhvat_beder` varchar(50) DEFAULT 'не померено',
  `orderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `serviceID` int(11) NOT NULL,
  `service_name` varchar(50) DEFAULT NULL,
  `service_comm` varchar(150) DEFAULT NULL,
  `service_price` decimal(10,2) DEFAULT NULL,
  `categoriesID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `textile`
--

CREATE TABLE `textile` (
  `textileID` int(11) NOT NULL,
  `tex_name` varchar(100) NOT NULL,
  `tex_pic` varchar(255) NOT NULL,
  `tex_unit_price` decimal(10,2) NOT NULL,
  `tex_quantity` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`accessoriesID`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoriesID`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_num` (`phone_num`);

--
-- Индексы таблицы `corder`
--
ALTER TABLE `corder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `categoriesID` (`categoriesID`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Индексы таблицы `fitting`
--
ALTER TABLE `fitting`
  ADD PRIMARY KEY (`fittingID`),
  ADD KEY `orderID` (`orderID`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`materialID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `accessoriesID` (`accessoriesID`),
  ADD KEY `textileID` (`textileID`);

--
-- Индексы таблицы `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measID`),
  ADD KEY `orderID` (`orderID`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceID`),
  ADD KEY `categoriesID` (`categoriesID`);

--
-- Индексы таблицы `textile`
--
ALTER TABLE `textile`
  ADD PRIMARY KEY (`textileID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accessories`
--
ALTER TABLE `accessories`
  MODIFY `accessoriesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `categoriesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `clientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `corder`
--
ALTER TABLE `corder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fitting`
--
ALTER TABLE `fitting`
  MODIFY `fittingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `materialID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `textile`
--
ALTER TABLE `textile`
  MODIFY `textileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `corder`
--
ALTER TABLE `corder`
  ADD CONSTRAINT `corder_ibfk_1` FOREIGN KEY (`categoriesID`) REFERENCES `categories` (`categoriesID`),
  ADD CONSTRAINT `corder_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`),
  ADD CONSTRAINT `corder_ibfk_3` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`);

--
-- Ограничения внешнего ключа таблицы `fitting`
--
ALTER TABLE `fitting`
  ADD CONSTRAINT `fitting_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `corder` (`orderID`);

--
-- Ограничения внешнего ключа таблицы `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `corder` (`orderID`),
  ADD CONSTRAINT `material_ibfk_2` FOREIGN KEY (`accessoriesID`) REFERENCES `accessories` (`accessoriesID`),
  ADD CONSTRAINT `material_ibfk_3` FOREIGN KEY (`textileID`) REFERENCES `textile` (`textileID`);

--
-- Ограничения внешнего ключа таблицы `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `corder` (`orderID`);

--
-- Ограничения внешнего ключа таблицы `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`categoriesID`) REFERENCES `categories` (`categoriesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
