<?php

namespace App\Rules;

use App\Enums\JobTypes;
use Illuminate\Contracts\Validation\InvokableRule;

class ValidJobType implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {

        if (!($value instanceof JobTypes)) $fail("The :attribute is not valid");
    }
}
