<?php
namespace Krokhmal\Soft\Data;

use Krokhmal\Soft\Tasker\Task;

// Интерфейс репозитория задач
interface TaskRepository
{
    // Выборка всех задач
    public function getAll();
    // Выбрать по id
    public function findById($taskId);
    // Сохранить задачу
    public function save(Task $task);
    // Удалить задачу
    public function remove(Task $task);
}