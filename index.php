<?php
use Krokhmal\Soft\Helpers\UUID;
use Krokhmal\Soft\Tasker\Test;
use Krokhmal\Soft\Tasker\MysqlTaskRepository;
use Krokhmal\Soft\Data\Database\DbConfig;

// Добавить автозагрузчик
$loader = require (__DIR__ . '/vendor/autoload.php');
// Установка соответсвия префикса пространства имен с его базовым каталогом
$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');

var_dump(DbConfig::DB_CONFIG_PARAMS);
//echo UUID::generateV4();