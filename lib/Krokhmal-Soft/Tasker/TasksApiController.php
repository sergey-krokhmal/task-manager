<?php
namespace Krokhmal\Soft\Tasker;

use Krokhmal\Soft\Web\Api\ApiController;
use Krokhmal\Soft\Data\Database\DbDriverPdo;
use Krokhmal\Soft\Data\UUID;

// Контроллер API задач
class TasksApiController implements ApiController
{
    private $db;            // Драйвер БД
    private $repository;    // Репозиторий для работы с задачами
    
    public function __construct()
    {
        // Новый экземпляр драйвера
        $this->db = new DbDriverPdo(DbConfig::DB_CONFIG_PARAMS);
        // Новый экземпляр репозитория с переданным ему драйвером
        $this->repository = new MysqlTaskRepository($this->db);
    }
    
    // GET Tasks/
    public function getIndex()
    {
        $tasks = $this->repository->getAll();
        $tasks_assoc = array();
        foreach($tasks as $task) {
            $tasks_assoc[] = $task->toAssoc();
        }
        return $tasks_assoc;
    }
    
    // POST Tasks/filter
    public function postFilter($params)
    {
        $tasks = $this->repository->getAll();
        $tasks_assoc = array();
        $status = $params['status'];
        $priority = $params['priority'];
        foreach($tasks as $task) {
            $tasks_assoc[] = $task->toAssoc();
        }
        if ($status != '' && $status > 0){
            $result_tasks = array();
            foreach($tasks_assoc as $task) {
                if ($task['status'] == $status) {
                    $result_tasks[] = $task;
                }
            }
            $tasks_assoc = $result_tasks;
        }
        if ($priority != '' && $priority > 0){
            $result_tasks = array();
            foreach($tasks_assoc as $task) {
                if ($task['priority'] == $priority) {
                    $result_tasks[] = $task;
                }
            }
            $tasks_assoc = $result_tasks;
        }
        return $tasks_assoc;
    }
    
    // GET Tasks/getById
    public function getFindById($params)
    {
        $task = $this->repository->findById($params['uuid']);
        return $task->toAssoc();
    }
    
    // POST Tasks/add
    public function postAdd($params)
    {
        $uuid = UUID::createWithNewHash();
        $params['uuid'] = $uuid->get();
        $params['status'] = TaskStatus::ACTIVE;
        $task = Task::createFromAssoc($params);
        if($this->repository->save($task)) {
            $result = $task->toAssoc();
        } else {
            $result = false;
        }
        return $result;
    }
    
    // PUT Tasks/update
    public function putUpdate($params)
    {
        $task = Task::createFromAssoc($params);
        $result = $this->repository->save($task);
        return $result;
    }
    
    // DELETE Tasks/remove
    public function deleteRemove($params)
    {
        $task = Task::createFromAssoc($params);
        $result = $this->repository->remove($task);
        return $result;
    }
    
    function __destruct()
    {
        // Закрыть соединение с базой данных
        if (isset($this->db)) {
            $this->db->closeConnection();
        }
    }
}
