<?php
namespace Krokhmal\Soft\Tasker;

use Krokhmal\Soft\Web\Api\ApiEngine;

// Api движок "Задачника"
class TaskerApiEngine extends ApiEngine
{
    
    // Выполнить запрос по параметрам
    public function executeRequest($http_method, $request_uri, $assoc_params)
    {
        $url_path = parse_url($request_uri, PHP_URL_PATH);
        
        $api_spec = '~^/([a-zA-Z0-9_\-]+)(/([a-zA-Z0-9_\-]+))?.*$~';
        preg_match($api_spec, $url_path, $matches);

        $controller_name = "Krokhmal\\Soft\\Tasker\\".$matches[1].$this->controller_postfix;
        $method_name = $matches[3];
        $controller_method_name = strtolower($http_method).ucwords($method_name);
        
        $json_response = '{}';
        if ($http_method == 'OPTIONS') {
            $json_response = '{"status":"work!"}';
        } elseif (class_exists($controller_name)) {
            if ($method_name == '' || $method_name == 'index') {
                $controller = new $controller_name();
                $json_response = json_encode($controller->getIndex());
            } elseif (method_exists($controller_name, $controller_method_name)) {
                $controller = new $controller_name();
                $json_response = json_encode($controller->$controller_method_name($assoc_params));
            } else {
                $json_response = '{"error":"Api method not found!"}';
            }
        } else {
            $json_response = '{"error":"Api controller not found!"}';
        }
        
        echo $json_response;
    }
}
