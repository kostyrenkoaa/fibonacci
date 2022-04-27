<?php
namespace App\services;

class ResponseService
{
    /**
     * Оправка данных по API
     *
     * @param $data
     * @return false|string
     */
    public function send($data = [])
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
