<?php
namespace Krokhmal\Soft\Tasker;

use Krokhmal\Soft\Data\TaskRepository;
use Krokhmal\Soft\Data\Database\DbDriver;
use Krokhmal\Soft\Data\Database\DbDriverPdo;

// Mysql репозиторий для работы с задачами
class MysqlTaskRepository implements TaskRepository
{
    protected $db;  // Драйвер БД
    
    public function __construct(DbDriver $db)
    {
        $this->db = $db;    // Инъекция драйвера БД
    }
    
    // Получить все задачи из БД
    public function getAll()
    {
        $task_arr = array();
        $task_rows = $this->db->selectArray("SELECT * FROM `task` ORDER BY id_priority");
        foreach($task_rows as $task_row) {
            $task_row['tags'] = $task_row['tags'] == '' ? array() : explode('|', $task_row['tags']);
            $task_row['status'] = $task_row['id_status'];
            $task_row['priority'] = $task_row['id_priority'];
            $task_arr[] = Task::createFromAssoc($task_row);
        }
        return $task_arr;
    }
    
    // Получить задачу по uuid
    public function findById($uuid)
    {
        if (is_string($uuid)) {
            $task_row = $this->db->selectFirst("SELECT * FROM `task` WHERE uuid = '$uuid'");
            if ($task_row === false) {
                return false;
            } else {
                $task_row['tags'] = explode('|', $task_row['tags']);
                $task_row['status'] = $task_row['id_status'];
                $task_row['priority'] = $task_row['id_priority'];
                $task = Task::createFromAssoc($task_row);
                return $task;
            }
        } else {
            return false;
        }
    }
    
    // Сохранить задачу
    public function save(Task $task)
    {
        if (!isset($task)) {
            return false;
        } else {
            $uuid = $task->getUuid();
            $task_row = $this->db->selectFirst("SELECT * FROM `task` WHERE uuid = '$uuid'");
            $set_string = "
                name = '".$task->getName()."',
                id_priority = '".$task->getPriority()."',
                id_status = '".$task->getStatus()."',
                tags = '".implode('|',$task->getTags())."'
            ";
            if ($task_row === false) {
                $insert_sql = "
                    INSERT INTO `task` SET
                    uuid = '".$uuid."', ".
                    $set_string;
                $this->db->run($insert_sql);
            } else {
                $update_sql = "
                    UPDATE `task` SET ".
                    $set_string.
                    " WHERE uuid = '".$uuid."'";
                $this->db->run($update_sql);
            }
            return true;
        }
    }
    
    // Удалить задачу
    public function remove(Task $task)
    {
        if (!isset($task)) {
            return false;
        } else {
            $uuid = $task->getUuid();
            $task = $this->findById($uuid);
            if ($task === false) {
                return false;
            } else {
                $this->db->run("DELETE FROM `task` WHERE uuid = '".$uuid."'");
                return true;
            }
        }
    }
}
