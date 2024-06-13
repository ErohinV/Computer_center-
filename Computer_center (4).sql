-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 13 2024 р., 21:17
-- Версія сервера: 8.0.30
-- Версія PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `Computer_center`
--

-- --------------------------------------------------------

--
-- Структура таблиці `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `removal_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `removal_date`) VALUES
(10, 1, 26, 1, NULL),
(11, 4, 34, 1, NULL),
(12, 1, 34, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `purchase_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `created_at`) VALUES
(1, 'Материнська плата MSI A320M-A PRO', 'сокет - AM4, чіпсет - AMD A320, DDR4, макс. об’єм оперативної пам’яті - 32 ГБ, макс. частота оперативної пам’яті - 3200 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 1 x TPM, 4 x Sata 6.0 Gb/s, Micro-ATX', '2389.00', 'img/msi-a320m-a-pro.png', '2024-06-01 14:37:50'),
(2, 'Материнська плата Asus Prime B450-Plus', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3200 MHz, DVI, HDMI, внутрішні - 1 x M.2 Socket 3, 6 x Sata 6.0 Gb/s, ATX', '3337.00', 'img/asus-prime-b450-plus.png', '2024-06-01 14:43:30'),
(3, 'Материнська плата Asus Prime A320M-K (90MB0TV0-M0EAY0)', 'сокет - AM4, чіпсет - AMD A320, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3200 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), HDMI, внутрішні - 1 x M.2, 4 x Sata 6.0 Gb/s, Micro-ATX', '2419.00', 'img/asus-prime-a320m-k.png', '2024-06-01 14:45:57'),
(4, 'Материнська плата ASUS PRIME H510M-A H510', 'сокет - 1200, чіпсет - Intel H510, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3200 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DisplayPort, HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '3328.00', 'img/asus-prime-h510m-a-h510.png', '2024-06-01 14:49:29'),
(5, 'Материнська плата ASUS PRIME H510M-K', 'сокет - 1200, чіпсет - Intel H510, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3200 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '2787.00', 'img/asus-prime-h510m-k.png', '2024-06-01 14:51:33'),
(6, 'Материнська плата ASUS TUF GAMING B550M-PLUS', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4800 MHz, швидкість LAN - 2,5 Гбіт/с, DisplayPort, HDMI, внутрішні - 2 x M.2 Socket 3, 4 x Sata 6.0 Gb/s, Micro-ATX', '5175.00', 'img/asus-tuf-gaming-b550m-plus-127709.png', '2024-06-01 14:54:04'),
(7, 'Материнська плата ASUS PRIME B450M-A II', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4400 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x M.2 Socket 3, 6 x Sata 6.0 Gb/s, Micro-ATX', '3302.00', 'img/asus-prime-b450m-a-ii.png', '2024-06-01 14:56:23'),
(8, 'Материнська плата MSI B450M PRO-VDH MAX', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3866 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 4 x Sata 6.0 Gb/s, Micro-ATX', '2916.00', 'img/msi-b450m-pro-vdh-max.png', '2024-06-01 14:58:02'),
(9, 'Материнська плата Asus TUF GAMING A520M-PLUS II', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4866 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DisplayPort, HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '3240.00', 'img/asus-tuf-gaming-a520m-plus-ii.png', '2024-06-01 15:00:19'),
(10, 'Материнська плата MSI B450 GAMING PLUS MAX', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 4133 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 1 x M.2, 6 x Sata 6.0 Gb/s, ATX', '3773.00', 'img/msi-b450-gaming-plus-max.png', '2024-06-01 15:01:57'),
(11, 'Материнська плата ASUS TUF GAMING B450M-PRO II', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4400 MHz, швидкість LAN - 1 Гбіт/с, DisplayPort, HDMI, внутрішні - 2 x M.2 2280, 6 x Sata 6.0 Gb/s, Micro-ATX', '4308.00', 'img/asus-tuf-gaming-b450m-pro-ii.png', '2024-06-01 15:03:27'),
(12, 'Материнська плата GIGABYTE B550M AORUS ELITE', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4733 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 2 x M.2 Socket 3, 4 x Sata 6.0 Gb/s, Micro-ATX', '4399.00', 'img/gigabyte-b550m-aorus-elite.png', '2024-06-01 15:05:09'),
(13, 'Материнська плата MSI B550-A PRO', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4400 MHz, швидкість LAN - 1 Гбіт/с, DisplayPort, HDMI, внутрішні - 1 x M.2 22110, 1 x M.2 2280, 6 x Sata 6.0 Gb/s, ATX', '5346.00', 'img/msi-b550-a-pro.png', '2024-06-01 15:06:48'),
(14, 'Материнська плата Asus PRIME A520M-K', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 4600 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '2658.00', 'img/asus-prime-a520m-k.png', '2024-06-01 15:12:59'),
(15, 'Материнська плата ASRock B450M-HDV R4.0', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 32 ГБ, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x Ultra M.2, 4 x Sata 6.0 Gb/s, Micro-ATX', '2461.00', 'img/asrock-b450m-hdv-r4-0.png', '2024-06-01 15:39:48'),
(16, 'Материнська плата GIGABYTE A520M K V2', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3200 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '2474.00', 'img/gigabyte-a520m-k-v2.png', '2024-06-02 07:17:02'),
(17, 'Материнська плата ASRock X370 Pro4', 'сокет - AM4, чіпсет - AMD X370, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x M.2, 1 x Ultra M.2, 1 x TPM, 4 x Sata 6.0 Gb/s, ATX', '3509.00', 'img/asrock-x370-pro4.png', '2024-06-02 07:18:33'),
(18, 'Материнська плата MSI H510M PRO-E', 'сокет - 1200, чіпсет - Intel H510, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 3200 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), HDMI, внутрішні - 4 x Sata 6.0 Gb/s, Micro-ATX', '2749.00', 'img/msi-h510m-pro-e.png', '2024-06-02 07:19:53'),
(19, 'Материнська плата Gigabyte B450 AORUS ELITE V2', 'сокет – AM4, чіпсет – AMD B450, DDR4, макс. обсяг оперативної пам’яті – 128 ГБ, швидкість LAN – 1 Гбіт/с, DVI, HDMI, внутрішні – 1 x TPM, 1 x M.2 22110, 1 x M.2 2280, 6 x Sata 6.0 Gb/s, ATX', '3758.00', 'img/gigabyte-b450-aorus-elite-v2-228877.png', '2024-06-02 07:21:14'),
(20, 'Материнська плата AMD B550 SAM4 ATX B550 GAMING X V2 GIGABYTE', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4733 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 1 x TPM, 2 x M.2 22110, 4 x Sata 6.0 Gb/s, ATX', '4899.00', 'img/amd-b550-sam4-atx-b550-gaming-x-v2-gigab.png', '2024-06-02 07:23:17'),
(21, 'Материнська плата MSI B450M-A Pro Max Socket AM4', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 32 ГБ, макс. частота оперативної пам’яті - 4133 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 1 x M.2, 4 x Sata 6.0 Gb/s, Micro-ATX', '2465.00', 'img/msi-b450m-a-pro-max-socket-am4.png', '2024-06-02 07:24:30'),
(22, 'Материнська плата ASUS TUF GAMING B450M-PLUS II (90MB1620-M0EAY0)', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4400 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 1 x M.2 Socket 3, 6 x Sata 6.0 Gb/s, Micro-ATX', '3985.00', 'img/asus-tuf-gaming-b450m-plus-ii.png', '2024-06-02 07:26:25'),
(23, 'Материнська плата ASRock B450 PRO4 R2.0', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DisplayPort, HDMI, внутрішні - 1 x M.2 22110, 1 x M.2 2280, 4 x Sata 6.0 Gb/s, ATX', '3209.00', 'img/asrock-b450-pro4-r2-0.png', '2024-06-02 07:30:13'),
(24, 'Материнська плата ASRock X570 Steel Legend Socket AM4', 'сокет - AM4, чіпсет - AMD X570, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4666 MHz, швидкість LAN - 1 Гбіт/с, DisplayPort, HDMI, внутрішні - 2 x Hyper M.2, 8 x Sata 6.0 Gb/s, ATX', '8499.00', 'img/asrock-x570-steel-legend-socket-am4.png', '2024-06-02 07:31:33'),
(25, 'Материнська плата ASUS TUF GAMING B450-PLUS II (90MB1650-M0EAY0)', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4400 MHz, DisplayPort, HDMI, внутрішні - 1 x M.2 22110, 1 x M.2 2280, 6 x Sata 6.0 Gb/s, ATX', '4352.00', 'img/asus-tuf-gaming-b450-plus-ii-sam4-b450.png', '2024-06-02 07:49:07'),
(26, 'Материнська плата ASRock H310CM-DVS', 'сокет - 1151, чіпсет - Intel H310, DDR4, макс. об’єм оперативної пам’яті - 32 ГБ, макс. частота оперативної пам’яті - 2666 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, внутрішні - 1 x TPM, 4 x Sata 6.0 Gb/s, Micro-ATX', '1957.00', 'img/asrock-h310cm-dvs.png', '2024-06-02 07:51:10'),
(27, 'Материнська плата ASUS TUF GAMING B660M-PLUS WIFI D4', 'сокет - 1700, чіпсет - Intel B660, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 5333 MHz, швидкість LAN - 2,5 Гбіт/с, DisplayPort, HDMI, внутрішні - 2 x M.2 2280, 4 x Sata 6.0 Gb/s, Wi-Fi (802.11 a/b/g/n/ac/ax), Bluetooth 5.2, Micro-ATX', '6698.00', 'img/asus-tuf-gaming-b660m-plus-wifi-d4.png', '2024-06-02 07:52:24'),
(28, 'Материнська плата GIGABYTE B760M GAMING X DDR4', 'сокет - 1700, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 5333 MHz, швидкість LAN - 2,5 Гбіт/с, DisplayPort, HDMI, внутрішні - 1 x M.2 22110, 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '5699.00', 'img/gigabyte-b760m-gaming-x-ddr4.png', '2024-06-02 08:02:07'),
(29, 'Материнська плата GIGABYTE B550M DS3H', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4733 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 2 x M.2 Socket 3, 4 x Sata 6.0 Gb/s, Micro-ATX', '4176.00', 'img/gigabyte-b550m-ds3h-141030.png', '2024-06-02 08:36:49'),
(30, 'Материнська плата MSI A520M-A PRO', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 4600 MHz, швидкість LAN - 1 Гбіт/с, DVI, HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '2299.00', 'img/msi-a520m-a-pro.png', '2024-06-02 08:44:18'),
(31, 'Материнська плата ASRock A520M-HDV', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 4733 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '2483.00', 'img/asrock-a520m-hdv.png', '2024-06-02 08:46:06'),
(32, 'Материнська плата ASUS PRIME B550M-A/CSM', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4600 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x M.2 22110, 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '4288.00', 'img/asus-prime-b550m-a-csm.png', '2024-06-02 08:47:44'),
(33, 'Материнська плата ASUS PRIME B550M-A WIFI II', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4866 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x M.2 22110, 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Wi-Fi (802.11 a/b/g/n/ac/ax), Bluetooth 5.2, Micro-ATX', '4867.00', 'img/asus-prime-b550m-a-wifi-ii-188729.png', '2024-06-02 08:50:04'),
(34, 'Материнська плата ASRock A520M-HVS', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Micro-ATX', '2360.00', 'img/asrock-a520m-hvs.png', '2024-06-02 08:52:19'),
(35, 'Материнська плата ASUS PRIME B550M-A', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4600 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 2 x M.2 Socket 3, 4 x Sata 6.0 Gb/s, Micro-ATX', '4423.00', 'img/asus-prime-b550m-a-127710.png', '2024-06-02 08:53:48'),
(36, 'Материнська плата MSI B550 GAMING GEN3', 'сокет - AM4, чіпсет - AMD B550, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4400 MHz, DVI, HDMI, внутрішні - 1 x M.2 22110, 6 x Sata 6.0 Gb/s, ATX', '4293.00', 'img/msi-b550-gaming-gen3.png', '2024-06-02 08:55:39'),
(37, 'Материнська плата Asus TUF Gaming A520M-Plus WIFI Socket AM4', 'сокет - AM4, чіпсет - AMD A520, DDR4, макс. об’єм оперативної пам’яті - 128 ГБ, макс. частота оперативної пам’яті - 4866 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DisplayPort, HDMI, внутрішні - 1 x M.2 2280, 4 x Sata 6.0 Gb/s, Wi-Fi (802.11 a/b/g/n/ac), Bluetooth, Micro-ATX', '3853.00', 'img/asus-tuf-gaming-a520m-plus-wifi-socket-a.png', '2024-06-02 08:57:11'),
(38, 'Материнська плата MSI MPG X670E Carbon WIFI AM5', 'сокет – AM5, чіпсет – AMD X670, DDR5, макс. обсяг оперативної пам’яті – 128 ГБ, швидкість LAN – 2,5 Гбіт/с, DisplayPort, HDMI, внутрішні – 4 x M.2 Socket 3, 6 x Sata 6.0 Gb/s, Wi-Fi (802.11 a/b/g/ n/ac/ax), Bluetooth 5.2, ATX', '21279.00', 'img/msi-mpg-x670e-carbon-wifi-am5.png', '2024-06-02 09:02:51'),
(39, 'Материнська плата MSI A520M_PRO A520', 'Сокет: AM4\r\n- чіпсет: AMD A520\r\n- Формфактор: Micro-ATX\r\n- Підтримка процесорів: 3-е покоління AMD Ryzen\r\n- Підтримка пам’яті: 64 ГБ до 4600 МГц', '2385.00', 'img/msi-a520m-pro-a520.png', '2024-06-02 09:08:17'),
(40, 'Материнська плата ASUS PRIME_B450M-K_II', 'сокет - AM4, чіпсет - AMD B450, DDR4, макс. об’єм оперативної пам’яті - 64 ГБ, макс. частота оперативної пам’яті - 4400 MHz, швидкість LAN - 1 Гбіт/с, D-Sub (VGA), DVI, HDMI, внутрішні - 1 x M.2 Socket 3, 4 x Sata 6.0 Gb/s, Micro-ATX', '3065.00', 'img/asus-prime-b450m-k-ii.png', '2024-06-02 09:10:17');

-- --------------------------------------------------------

--
-- Структура таблиці `Reviews`
--

CREATE TABLE `Reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(1, 'bret213@gmail.com', 'Bret', '$2y$10$oQFRrpeLTCzLNvc5nq4tX.UTIACn8Tls8.oFYs5GCPrShUfuTPnq.', 'user'),
(2, 'daygrenn52@gmail.com', 'Admin', '$2y$10$Quur54wNgAwMjumrKUgMD.qZ05p67uTHJWlWPv3AKH3mcdXhszJzW', 'admin'),
(3, 'Kate_brestsyng@gmail.com', 'Kate Bretsyng', '$2y$10$V2mFItNUeg/OUWX764w8t.qQHQvX5diIJ1z71f8BS2YJCFCQ9V9zy', 'user'),
(4, 'daygrenn52@gmail.com', 'Валентин', '$2y$10$Xra4R.IkpiptO424a2U.GuQq8ji/UKSFimr7PGNTX7eJBIiYWic8q', 'user');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Індекси таблиці `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблиці `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT для таблиці `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
