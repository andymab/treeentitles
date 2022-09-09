--
-- Структура таблицы `users__`
--

CREATE TABLE `users__` (
  `id` int(11) NOT NULL,
  `sid` varchar(64) NOT NULL,
  `login` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `psswd` varchar(80) NOT NULL,
  `restime` int(11) NOT NULL,
  `regtime` int(11) NOT NULL,
  `descr` text NOT NULL,
  `roles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы таблицы `users__`
--
ALTER TABLE `users__`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sid` (`sid`),
  ADD UNIQUE KEY `login` (`login`,`email`);

--
-- AUTO_INCREMENT для таблицы `users__`
--
ALTER TABLE `users__`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;