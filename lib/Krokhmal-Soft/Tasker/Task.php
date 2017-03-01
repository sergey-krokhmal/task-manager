<?php
namespace Krokhmal\Soft\Tasker;

use Krokhmal\Soft\Data\Value;
use Krokhmal\Soft\Data\UUID;

// Задача
class Task
{
    private $name;
    private $uuid;
    private $priority;
    private $tags = array();
    private $status;
    
    public function __construct(Value $uuid, Value $name, Value $priority, Value $status, $tags)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->priority = $priority;
        $this->tags = $tags;
        $this->status = $status;
    }
    
    // Создать задачу из ассоциативного масссива
    public static function createFromAssoc($assoc)
    {
        $task = new Task(
            new UUID($assoc['uuid']),
            new TaskName($assoc['name']),
            new TaskPriority($assoc['priority']),
            new TaskStatus($assoc['status']),
            $assoc['tags']
        );
        return $task;
    }
    
    // Преобразовать задачу в ассоциативный массив
    public function toAssoc()
    {
        $assoc = array();
        $assoc['uuid'] = $this->uuid->get();
        $assoc['name'] = $this->name->get();
        $assoc['priority'] = $this->priority->get();
        $assoc['status'] = $this->status->get();
        $assoc['tags'] = $this->tags;
        return $assoc;
    }
    
    // Геттеры и сеттеры параметров задачи
    public function getName()
    {
        return $this->name->get();
    }
    
    public function setName($name)
    {
       $this->name->set($name);
    }
    
    public function getUuid()
    {
        return $this->uuid->get();
    }
    
    public function getPriority()
    {
        return $this->priority->get();
    }
    
    public function setPriority($priority)
    {
        $this->priority->set($priority);
    }
    
    public function getStatus()
    {
        return $this->status->get();
    }
    
    public function setStatus($status)
    {
        $this->status->set($status);
    }
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
}
