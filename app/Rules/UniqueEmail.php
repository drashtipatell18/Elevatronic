<?php namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmail implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Check if the email exists in the users table
        return !DB::table('users')->where('email', $value)->exists();
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
