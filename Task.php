<?php

require_once "TaskStatus.php";

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
        $status = TaskStatus::Active;
    }
    
    public function getName()
    {
        return $this->name;
    }
}