<?php
namespace App\services;

use App\dto\FibonacciDTO;

class FibonacciService
{
    const FIBONACCI_KEY = 'fibonacci';

    public function __construct(
        protected DBService $DBService
    )
    {
    }

    /**
     * Возвращает последовательность
     *
     * @param FibonacciDTO $fibonacciDTO
     * @return mixed|string
     */
    public function getRate(FibonacciDTO $fibonacciDTO)
    {
        $this->prepareData($fibonacciDTO);
        $keyStorage = $this->getKeyFromStorage($fibonacciDTO);

        $rate = $this->DBService->get($keyStorage);

        if (!empty($rate)) {
            return $rate;
        }

        $rate = $this->calcRate($fibonacciDTO);

        $this->DBService->set($keyStorage, $rate);

        return $rate;
    }

    /**
     * Вычисляет последовательность
     *
     * @param FibonacciDTO $fibonacciDTO
     * @return string
     */
    protected function calcRate(FibonacciDTO $fibonacciDTO)
    {
        $result = [];
        for ($number = $fibonacciDTO->from; $number <= $fibonacciDTO->to; $number++) {
            $result[] = $this->getElementByNumber($number);
        }

        return implode(' ', $result);
    }

    /**
     * Возвращает элемент последовательности по эго номеру
     *
     * @param $number
     * @return float
     */
    protected function getElementByNumber($number)
    {
        return round(pow((sqrt(5)+1)/2, $number) / sqrt(5));
    }

    /**
     * Обработка полученных данных
     *
     * @param FibonacciDTO $fibonacciDTO
     * @return void
     */
    protected function prepareData(FibonacciDTO $fibonacciDTO)
    {
        $fibonacciDTO->from = (int) $fibonacciDTO->from;
        $fibonacciDTO->to = (int) $fibonacciDTO->to;
    }

    /**
     * Ключ для поиска
     *
     * @param FibonacciDTO $fibonacciDTO
     * @return string
     */
    protected function getKeyFromStorage(FibonacciDTO $fibonacciDTO): string
    {
        return self::FIBONACCI_KEY . '|' . $fibonacciDTO->from . '|' . $fibonacciDTO->to;
    }
}