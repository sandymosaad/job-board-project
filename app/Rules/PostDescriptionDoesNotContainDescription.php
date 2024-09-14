<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostDescriptionDoesNotContainDescription implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (stripos($value, 'description') !== false) {
            $fail('The :attribute should not contain the word "description".');
            }
        }

        public function __construct()
        {
        }

        public function message()
        {
            return 'The :attribute should not contain the word "description".';
        }
}
