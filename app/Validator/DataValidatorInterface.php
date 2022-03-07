<?php

namespace App\Validator;

interface DataValidatorInterface
{
    /**
     * @return array
     */
    public function rules(): array;

    /**
     * @param array $data
     * @return mixed
     */
    public function isPassed(array $data);
}
