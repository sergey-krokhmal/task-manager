<?php
/*
    Base TaskRepository Interface
*/
namespace Krokhmal\Soft\Data;

use Krokhmal\Soft\Tasker\Task;

interface TaskRepository
{
    public function getAll();
    public function findById($taskId);
    public function save(Task $task);
    public function remove(Task $task);
}