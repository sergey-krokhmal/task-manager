<?php
use Krokhmal\Soft\Helpers\UUID;
use Krokhmal\Soft\Tasker\Test;
use Krokhmal\Soft\Tasker\MysqlTaskRepository;
use Krokhmal\Soft\Data\Database\DbDriverPdo;
use Krokhmal\Soft\Tasker\DbConfig;

// Добавить автозагрузчик
$loader = require (__DIR__ . '/vendor/autoload.php');
// Установка соответсвия префикса пространства имен с его базовым каталогом
$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');

$db_driver = new DbDriverPdo(DbConfig::DB_CONFIG_PARAMS);
$tr = new MysqlTaskRepository($db_driver);
$task = $tr->findById('c8791555-b462-433b-925a-f8946bd608cd');
$task->setPriority(2);
$tr->save($task);
//echo UUID::generateV4();