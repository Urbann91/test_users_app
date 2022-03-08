<?php

namespace App\Validator;

class UserDataValidator extends BaseDataValidator implements UserDataValidatorInterface
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'regex:/^[a-z0-9\s]+$/|min:8|max:64|unique:users,name|not_in:' . $this->nameBlackList(),
            'email' => 'email:rfc,dns,filter|unique:users,email|max:256|not_in:' . $this->emailBlackList(),
        ];
    }

    /**
     * @return string
     */
    protected function nameBlackList(): string
    {
        return config('rules.black_list.name');
    }

    /**
     * @return string
     */
    protected function emailBlackList(): string
    {
        return config('rules.black_list.email');
    }
}
