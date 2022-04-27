<?php

namespace App\controllers;

use App\forms\FibonacciForm;
use App\services\FibonacciService;
use App\services\ResponseService;

class FibonacciController extends Controller
{
    /**
     * Метод апи для проверки результатов
     *
     * @param FibonacciForm $fibonacciForm
     * @param FibonacciService $fibonacciService
     * @param ResponseService $responseService
     * @return false|string
     */
    public function indexAction(
        FibonacciForm $fibonacciForm,
        FibonacciService $fibonacciService,
        ResponseService $responseService
    )
    {
        $errors = $fibonacciForm->getErrorsForm();

        if (!empty($errors)) {
            return $responseService->send(['error' => $errors]);
        }

        return $responseService->send(
            [
                'rate' => $fibonacciService->getRate($fibonacciForm->getDataForm())
            ]
        );
    }
}
