<?php
namespace Krokhmal\Soft\Data;

// Ксласс доступа к потокам ввода/вывода
class IOStream
{
    // Функция получения JSON из потока input в массив
    public static function getAssocJsonInput()
    {
        $params = array();
        $row_json = file_get_contents('php://input');
        if ($row_json !== false){
            $json_obj = json_decode($row_json, true);
            if ($json_obj !== null){
                $params = $json_obj;
            }
        }
        return $params;
    }
}
