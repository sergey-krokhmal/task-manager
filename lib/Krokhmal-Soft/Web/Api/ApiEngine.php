<?php
namespace Krokhmal\Soft\Web\Api;

// Абстрактный класс движка API
abstract class ApiEngine
{
    // Окончание имени контроллера
    protected $controller_postfix;
    
    public function __construct($controller_postfix)
    {
        $this->controller_postfix = $controller_postfix;
    }
    
    // Функция выполнения запроса
    abstract public function executeRequest($http_method, $url_path, $assoc_params);
}
