<?php

namespace App\forms;

use App\dto\FibonacciDTO;

/**
 * @method FibonacciDTO getDataForm()
 */
class FibonacciForm extends Form
{
    protected array $validateRules = [
        'from' => [
            'stringNotEmpty' => 'Значение старта последовательности не должен быть пустым',
            'numeric' => 'Значение старта должно быть числом',
        ],
        'to' => [
            'stringNotEmpty' => 'Значение конца последовательности не должен быть пустым',
            'numeric' => 'Значение конца последовательности должно быть числом',
        ]
    ];

    public function getErrorsForm()
    {
        if (!is_null($this->errors)) {
            return $this->errors;
        }

        $this->errors = parent::getErrorsForm();
        $formData = $this->getDataForm();
        if (is_numeric($formData->from) && is_numeric($formData->to) && ($formData->from > $formData->to)) {
            $this->errors['to'][] = 'Значение конца последовательности должно быть больше начала';
        }

        return $this->errors;
    }

    public function getDTOClass(): string
    {
        return FibonacciDTO::class;
    }
}