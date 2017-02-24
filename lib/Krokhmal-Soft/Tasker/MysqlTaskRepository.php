<?php
namespace Krokhmal\Soft\Tasker;

use Krokhmal\Soft\Data\TaskRepository;
use Krokhmal\Soft\Data\Database\DbDriver;
use Krokhmal\Soft\Data\Database\DbDriverPdo;

class MysqlTaskRepository implements TaskRepository
{
    protected $db;
    
    public function __construct(DbDriver $db)
    {
        $this->db = $db;
    }
    
    public function getAll()
    {
        $task_arr = array();
        $task_rows = $this->db->selectArray("SELECT * FROM `task` ORDER BY id_priority");
        foreach($task_rows as $task_row) {
            $task_arr[] = Task::createFromAssoc($task_row);
        }
        return $task_arr;
    }
    
    public function findById($task_id)
    {
        if (is_string($task_id)) {
            $task_row = $this->db->selectFirst("SELECT * FROM `task` WHERE uuid = '$task_id'");
            if ($task_row === false) {
                return false;
            } else {
                $task = Task::createFromAssoc($task_row);
                return $task;
            }
        } else {
            return false;
        }
    }
    
    public function save(Task $task)
    {
        if (!isset($task)) {
            return false;
        } else {
            $task_id = $task->getId();
            $task_row = $this->db->selectFirst("SELECT * FROM `task` WHERE uuid = '$task_id'");
            $set_string = "
                name = '".$task->getName()."',
                id_priority = '".$task->getPriority()."',
                id_status = '".$task->getStatus()."',
                tags = '".implode('|',$task->getTags())."'
            ";
            if ($task_row === false) {
                $insert_sql = "
                    INSERT INTO `task` SET
                    uuid = '".$task->getId()."', ".
                    $set_string;
                $this->db->run($insert_sql);
            } else {
                $update_sql = "
                    UPDATE `task` SET ".
                    $set_string.
                    " WHERE uuid = '".$task->getId()."'";
                $this->db->run($update_sql);
            }
            return true;
        }
    }
    
    public function remove(Task $task)
    {
        if (!isset($task)) {
            return false;
        } else {
            $task_id = $task->getId();
            $this->db->run("DELETE FROM `task` WHERE uuid = '".$task->getId()."'");
        }
    }
}