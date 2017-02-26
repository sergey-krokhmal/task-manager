<?php
namespace Krokhmal\Soft\Tasker;

class Task
{
    private $name;
    private $uuid;
    private $priority = 1;
    private $tags = array();
    private $status = 1;
    
    public function __construct($uuid, $name, $priority, $status, $tags)
    {
        $this->uuid = $uuid;
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
            $assoc['priority'],
            $assoc['status'],
            $assoc['tags']
        );
        return $task;
    }
    
    public function toAssoc()
    {
        $assoc = array();
        $assoc['uuid'] = $this->uuid;
        $assoc['name'] = $this->name;
        $assoc['priority'] = $this->priority;
        $assoc['status'] = $this->status;
        $assoc['tags'] = $this->tags;
        return $assoc;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
       $this->name = $name;
    }
    
    public function getUuid()
    {
        return $this->uuid;
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
