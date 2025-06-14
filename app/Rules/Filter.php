<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected array $blackList;
    public function __construct($blackList)
    {
        $this->blackList =  $blackList;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array(strtolower($value), array_map('strtolower', $this->blackList))) {
            $fail("The {$attribute} contains a forbidden word.");
        }
    }
}
