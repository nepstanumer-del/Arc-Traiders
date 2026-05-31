-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 18 2026 г., 18:38
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shariki`
--

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`status_id`, `status`) VALUES
(1, 'Выполнен'),
(2, 'Открыт'),
(3, 'Отменен'),
(4, 'На рассмотрении');

-- --------------------------------------------------------

--
-- Структура таблицы `trades`
--

CREATE TABLE `trades` (
  `trade_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `client` int DEFAULT NULL,
  `trade_status` int NOT NULL,
  `amount_price` int NOT NULL,
  `img_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `embark_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `trades`
--

INSERT INTO `trades` (`trade_id`, `name`, `img`, `user_id`, `price`, `amount`, `client`, `trade_status`, `amount_price`, `img_price`, `embark_id`) VALUES
(28, 'Чертеж Бурлетта', 'images3.jpg', 14, 'Чертеж Охотник', 1, NULL, 2, 1, 'images4.jpg', 'embark#3435'),
(29, 'Чертеж Наковальня', '4.webp', 14, 'Чертеж Угловая рукоятка 2', 1, NULL, 2, 1, '5.webp', 'embark#3431'),
(30, 'Чертеж охотник', 'images4.jpg', 14, 'Чертеж Бурлетта', 1, NULL, 2, 2, 'images3.jpg', 'embark#3435'),
(31, 'Чертеж Бурлетта', 'images3.jpg', 14, 'Чертеж Охотник', 1, NULL, 2, 1, 'images4.jpg', 'embark#3435'),
(32, 'Чертеж Бурлетта', '5.webp', 15, 'Чертеж Угловая рукоятка 2', 1, NULL, 2, 2, '5.webp', 'embark#3432'),
(33, 'Чертеж Вулкан', 'Без имени.jpg', 17, 'Чертеж Эль-торо', 1, NULL, 2, 2, 'images.jpg', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role_id`) VALUES
(9, '0', '0', '0', 1),
(10, '0', '0', '0', 1),
(11, '2', '3', '2@m', 1),
(12, '5', '5', '5@m', 1),
(13, '1', '1', 'admin@gmail.com', 1),
(14, 'admin', 'admin', 'admin@gmail.com', 2),
(15, 'admin1', 'admin1', 'admin1@gmail.com', 1),
(16, 'login', '$2y$10$dz.oZDidy0pf4oYxexoQXuQ/zAZLd6vuWNpKz51ZH3X04iA9Vujxm', 'rrr@gmail.ru', 1),
(17, 'login1', '$2y$10$uxYlIru.lPRUXd8aMZgxUubQHRF10sLUkySycQWvMr1M22avYw47y', '22@m', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`trade_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trade_status` (`trade_status`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `trades`
--
ALTER TABLE `trades`
  MODIFY `trade_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `trades`
--
ALTER TABLE `trades`
  ADD CONSTRAINT `trades_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trades_ibfk_2` FOREIGN KEY (`trade_status`) REFERENCES `statuses` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
