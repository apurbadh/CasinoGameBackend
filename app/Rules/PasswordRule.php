<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $email;


    public function __construct($email)
    {
        $this->email = $email;
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

        return Auth::attempt([
            "email" => $this->email,
            "password" => $value
        ]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The password doesn't match with our records.";
    }
}
