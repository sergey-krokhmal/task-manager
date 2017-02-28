SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) unsigned NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `id_priority` int(10) unsigned NOT NULL DEFAULT '1',
  `id_status` int(10) unsigned NOT NULL DEFAULT '1',
  `tags` varchar(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `task` (`id`, `uuid`, `name`, `id_priority`, `id_status`, `tags`) VALUES
(1, '69cd086c-8ff8-4436-afdf-024756ed7bc7', 'Тестовая задача', 2, 1, 'tag1|tag2|tag5'),
(2, 'd299355b-ade7-48eb-97e7-d4d461b88fe0', 'test', 2, 2, 'Протестировать|Познать дзен'),
(3, '69ef1300-1692-4392-b959-7020ef13d8ca', 'Вава', 1, 1, 'Вава|Бубу|Кукууу|test'),
(5, 'd2a3a510-0c9b-4605-b51a-d0097bd5a7c9', 'ааа', 2, 2, 'tag1|tag2|tag3|Протестировать|Познать дзен|Вава|Бубу|Кукууу'),
(8, '3ccc87bf-c02d-460f-9a98-4631f10ab587', 'ккк', 1, 1, 'test'),
(15, 'eac48ac2-d215-484b-9005-ad987df2c7d7', 'y', 1, 1, '');

CREATE TABLE IF NOT EXISTS `task_priority` (
  `id` int(10) unsigned NOT NULL,
  `value` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `task_priority` (`id`, `value`, `name`) VALUES
(1, 'low', 'Низкий'),
(2, 'middle', 'Средний'),
(3, 'high', 'Высокий');

CREATE TABLE IF NOT EXISTS `task_status` (
  `id` int(10) unsigned NOT NULL,
  `value` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `task_status` (`id`, `value`, `name`) VALUES
(1, 'active', 'В работе'),
(2, 'done', 'Завершена');


ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `task_priority`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `task`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
ALTER TABLE `task_priority`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `task_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
