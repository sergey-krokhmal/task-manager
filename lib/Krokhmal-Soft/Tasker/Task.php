<?php
namespace Krokhmal\Soft\Tasker;

use TaskStatus;
use TaskPriority;

class Task
{
    
    private $name;
    public $priority;
    public $tags;
    public $status;
    
    public function __construct($name, $priority, $tags)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->tags = $tags;
        $status = TaskStatus::ACTIVE;
    }
    
    public function getName()
    {
        return $this->name;
    }
}