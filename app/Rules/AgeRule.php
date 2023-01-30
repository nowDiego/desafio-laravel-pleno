<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AgeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       return $this->verifyAge($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Você precisa ter mais de 18 anos para se cadastrar';
    }

    private function verifyAge($age){

     return $age>18?true:false;

    }


}
