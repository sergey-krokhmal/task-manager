<?php
namespace Krokhmal\Soft\Web\Api;

// Интерфейс API контроллера
interface ApiController
{
    // GET ControllerName/index
    public function getIndex();
    
    // POST ControllerName/filter
    public function postFilter($params);
    
    // GET ControllerName/findBy
    public function getFindById($params);
    
    // POST ControllerName/add
    public function postAdd($params);
    
    // PUT ControllerName/update
    public function putUpdate($params);
    
    // DELETE ControllerName/remove
    public function deleteRemove($params);
}
