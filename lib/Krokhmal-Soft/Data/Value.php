<?php
namespace Krokhmal\Soft\Data;

// Объект-значение
class Value
{
    private $value;
    
    public function __construct($value)
    {
        $this->set($value);
    }
    
    // Геттер и сеттер
    public function set($value)
    {
        $this->value = $value;
    }
    
    public function get()
    {
        return $this->value;
    }
}
