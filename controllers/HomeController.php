<?php

namespace App\controllers;

use App\services\Service;
use App\services\TwigRenderService;

class HomeController extends Controller
{
    /**
     * Возвращает форму
     *
     * @param TwigRenderService $renderService
     * @return string
     */
    public function indexAction(
        TwigRenderService $renderService,
    ): string
    {
        return $renderService->render(
            'home',
                [
                    'url' => Service::URL
                ]
        );
    }
}
