<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberType;
use libphonenumber\PhoneNumberUtil;

class DDDPhoneRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!isset($value) || !is_numeric($value) || empty(trim($value))) {
            return false;
        }

        $validOnes = require __DIR__.'/assert/valid_ddd_list.php';

        return in_array($value, $validOnes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Código de area (DDD) do telefone não é válido.';
    }
}