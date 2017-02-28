<?php
use Krokhmal\Soft\Data\IOStream;
use Krokhmal\Soft\Tasker\TaskerApiEngine;

// Добавить автозагрузчик
$loader = require (__DIR__ . '/vendor/autoload.php');
// Установка соответсвия префикса пространства имен с его базовым каталогом
$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');

// Получить JSON потока input в массив
$assoc_params = IOStream::getAssocJsonInput();

// Настроить заголовки на получение HTTP запросов и отправку JSON
header("Content-Type: application/json;");
$header_access_allow_header = "Access-Control-Allow-Headers, Origin, Accept,";
$header_access_allow_header .= "X-Requested-With, Content-Type, Access-Control-Request-Method,";
$header_access_allow_header .= "Access-Control-Request-Headers";
header("Access-Control-Allow-Headers: ".$header_access_allow_header);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Создать экземпляр API движка "Задачника", передав окончание контроллеров
$apiEngine = new TaskerApiEngine('ApiController');

// Выполнить запрос, передав HTTP метод, запрашиваемый URI и параметры
$apiEngine->executeRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $assoc_params);
