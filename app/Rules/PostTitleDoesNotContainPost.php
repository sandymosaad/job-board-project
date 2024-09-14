<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostTitleDoesNotContainPost implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (stripos($value, 'post') !== false) {
        $fail('The :attribute should not contain the word "post".');
        }
    }

    public function __construct()
    {
    }

    public function message()
    {
        return 'The :attribute should not contain the word "post".';
    }
}
