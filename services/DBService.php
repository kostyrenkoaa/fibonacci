<?php
namespace App\services;

use \Redis;

class DBService
{
    protected ?Redis $connection;

    public function __construct(
        protected array $config
    )
    {
    }

    /**
     * Получение данных с редиса по ключу
     *
     * @param $key
     * @return false|mixed|string
     */
    public function get($key)
    {
        return $this->getConnection()->get($key);
    }

    /**
     * Установка данных в редис по ключу
     *
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value)
    {
        $this->getConnection()->set($key, $value);
    }

    /**
     * Создание соединение с редисом
     *
     * @return Redis|null
     */
    protected function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new \Redis();
            $this->connection->connect($this->config['host'], $this->config['port']
            );
        }
        return $this->connection;
    }
}