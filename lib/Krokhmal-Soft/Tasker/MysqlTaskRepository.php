<?php
namespace Krokhmal\Soft\Tasker;

use Krokhmal\Soft\Data\TaskRepository;

class MysqlTaskRepository implements TaskRepository
{
    
    public function getAll()
    {
        $task1 = new Task('c8791555-b462-433b-925a-f8946bd608cd', 'task1', TaskPriority::LOW, array('test_tag'));
        $task2 = new Task('040e0517-0dde-4434-bc75-dba09d7688aa', 'test the task', TaskPriority::HIGH, array('cool tag', 'listen Slade'));
        return array($task1, $task2);
    }
    
    public function findById($taskId)
    {
        
    }
    
    public function save(Task $task)
    {
        
    }
    
    public function remove(Task $task)
    {
        
    }
}