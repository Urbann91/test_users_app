<?php

namespace App\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseDataValidator implements DataValidatorInterface
{
    /**
     * @param array $data
     * @return array|mixed
     * @throws ValidationException
     */
    public function isPassed(array $data)
    {
        return Validator::make($data, $this->rules())->validate();
    }
}
