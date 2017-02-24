<?php
use Krokhmal\Soft\Helpers\UUID;
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
//$task->setPriority(2);
//$tr->save($task);
//echo UUID::generateV4();

$http_method = $_SERVER['REQUEST_METHOD'];
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$api_spec = '~^/([a-zA-Z0-9_\-]+)(/([a-zA-Z0-9_\-]+))?.*$~';
preg_match($api_spec, $url_path, $matches);
echo "<pre>";
var_dump($matches);
echo "</pre>";

$api_spec = '~(?<=^params=)(\{.*\})$~';
preg_match($api_spec, $url_query, $matches);
echo "<pre>";
var_dump(json_decode(urldecode($matches[0]), true));
echo "</pre>";

/*if (count($_REQUEST)>0){
    foreach ($_REQUEST as $controllerFunction => $apiFunctionParams) {
        $APIEngine=new APIEngine($apiFunctionName,$apiFunctionParams);
        echo $APIEngine->callApiFunction(); 
        break;
    }
}else{
    $jsonError->error='No function called';
    echo json_encode($jsonError);
}*/

abstract class ApiEngine
{
    protected $http_method;
    protected $url_path;
    protected $url_params;
    
    public function __construct($http_method, $url_path, $url_params)
    {
        $this->http_method = $http_method;
        $this->url_path = $url_path;
        $this->url_params = $url_params;
    }
    
    abstract public function getController()
    {
        $api_spec = '~^/([a-zA-Z0-9_\-]+)(/([a-zA-Z0-9_\-]+))?.*$~';
        preg_match($api_spec, $url_path, $matches);
        echo "<pre>";
        var_dump($matches);
        echo "</pre>";

        $api_spec = '~(?<=^params=)(\{.*\})$~';
        preg_match($api_spec, $url_query, $matches);
        echo "<pre>";
        var_dump(json_decode(urldecode($matches[0]), true));
        echo "</pre>";
    }
}

class TaskerApiEngine
{
    protected $http_method;
    protected $url_path;
    protected $url_params;
    
    public function __construct($http_method, $url_path, $url_params)
    {
        $this->http_method = $http_method;
        $this->url_path = $url_path;
        $this->url_params = $url_params;
    }
    
}


interface ApiController
{
    
}