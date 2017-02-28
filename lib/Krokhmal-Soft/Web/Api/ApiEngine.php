<?php
namespace Krokhmal\Soft\Web\Api;

// ����������� ����� ������ API
abstract class ApiEngine
{
    // ��������� ����� �����������
    protected $controller_postfix;
    
    public function __construct($controller_postfix)
    {
        $this->controller_postfix = $controller_postfix;
    }
    
    // ������� ���������� �������
    abstract public function executeRequest($http_method, $url_path, $assoc_params);
}
