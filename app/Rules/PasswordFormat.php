<?php namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordFormat implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Password must be at least 8 characters, start with a capital letter, and include at least one special character
        return preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.,-])[A-Za-z\d@$!%*?&.,-]{8,}/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be at least 8 characters long, start with a capital letter, and include at least one special character.';
    }
}
