<?php
use Krokhmal\Soft\Helpers\UUID;
use Krokhmal\Soft\Tasker\MysqlTaskRepository;
use Krokhmal\Soft\Data\Database\DbDriverPdo;
use Krokhmal\Soft\Tasker\DbConfig;
use Krokhmal\Soft\Tasker\Task;
use Krokhmal\Soft\Tasker\TaskStatus;

// Добавить автозагрузчик
$loader = require (__DIR__ . '/vendor/autoload.php');
// Установка соответсвия префикса пространства имен с его базовым каталогом
$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');

$http_method = $_SERVER['REQUEST_METHOD'];
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$api_spec = '~^/([a-zA-Z0-9_\-]+)(/([a-zA-Z0-9_\-]+))?.*$~';
preg_match($api_spec, $url_path, $matches);

$api_spec = '~(?<=^params=)(\{.*\})$~';
preg_match($api_spec, $url_query, $matches_params);

$controller_name = $matches[1].'ApiController';
$method_name = $matches[3];
$params = json_decode(urldecode($matches_params[0]),true);

header('Content-type: application/json; charset=UTF-8');

if (class_exists($controller_name)) {
    if ($method_name == '' || $method_name == 'index') {
        $controller = new $controller_name();
        echo json_encode($controller->index());
    } elseif (method_exists($controller_name, $method_name)) {
        $controller = new $controller_name();
        echo json_encode($controller->$method_name($params));
    }
}

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
    
    public function getController()
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

class TasksApiController
{
    private $db;
    private $repository;
    
    public function __construct()
    {
        $this->db = new DbDriverPdo(DbConfig::DB_CONFIG_PARAMS);
        $this->repository = new MysqlTaskRepository($this->db);
    }
    
    // GET Tasks
    public function index()
    {
        $tasks = $this->repository->getAll();
        $tasks_assoc = array();
        foreach($tasks as $task) {
            $tasks_assoc[] = $task->toAssoc();
        }
        return $tasks_assoc;
    }
    
    public function getAll()
    {
        $this->index();
    }
    
    // GET Tasks/getById?params={"uuid": "..."}
    public function findById($params)
    {
        $task = $this->repository->findById($params['uuid']);
        return $task->toAssoc();
    }
    
    // POST Tasks/add?params={"name": "task_name", "priority": 1, ...}
    public function add($params)
    {
        $uuid = UUID::generateV4();
        $params['uuid'] = $uuid;
        $params['status'] = TaskStatus::ACTIVE;
        $task = Task::createFromAssoc($params);
        $result = $this->repository->save($task);
        return $result;
    }
    
    // PUT Tasks/update?params={"uuid": "...", "name": "task_name", ...}
    public function update($params)
    {
        $task = Task::createFromAssoc($params);
        $result = $this->repository->save($task);
        return $result;
    }
    
    // DELETE Tasks/remove?params={"uuid": "..."}
    public function remove($params)
    {
        $task = Task::createFromAssoc($params);
        $result = $this->repository->remove($task);
        return $result;
    }
    
    function __destruct() {
        if (isset($this->db)){             //Если было установленно соединение с базой,
            $this->db->closeConnection();  //то закрываем его когда наш объект больше не нужен
        }
    }
}