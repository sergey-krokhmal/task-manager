<?php
/*
    Base TaskRepository Interface
*/

namespace Krokhmal\Soft\Data;

interface TaskRepository
{
    public function getAll();
    public function findById(TaskId $taskId);
    public function save(Task $task);
    public function remove(Task $task);
}