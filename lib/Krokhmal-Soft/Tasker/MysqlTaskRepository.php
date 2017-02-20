<?php
namespace Krokhmal\Soft\Tasker;

use Task;
use TaskPriority;

class MysqlTaskRepository implements TaskRepository
{
    public function getAll()
    {
        $task1 = new Task('task1', TaskPriority::LOW, array('test_tag'));
        $task2 = new Task('test the task', TaskPriority::HIGH, array('cool tag', 'listen Slade'));
        return array($task1, $task2);
    }
    public function findById(TaskId $taskId);
    public function save(Task $task);
    public function remove(Task $task);
}