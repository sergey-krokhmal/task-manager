<?php
namespace Krokhmal\Soft\Tasker;

class Task
{
    private $name;
    private $id;
    private $priority;
    private $tags;
    private $status;
    
    public function __construct($id, $name, $priority, $status, $tags)
    {
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
        $this->tags = $tags;
        $this->status = $status;
    }
    
    public static function createFromAssoc($assoc)
    {
        $task = new Task(
            $assoc['uuid'],
            $assoc['name'],
            $assoc['id_priority'],
            $assoc['id_status'],
            explode('|',$assoc['tags'])
        );
        return $task;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getPriority()
    {
        return $this->priority;
    }
    
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
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
