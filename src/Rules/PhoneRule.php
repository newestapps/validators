<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberType;
use libphonenumber\PhoneNumberUtil;

class PhoneRule implements Rule
{

    /**
     * @var int
     */
    protected $mustBeOfType;

    public function __construct($mustBeOfType = PhoneNumberType::MOBILE)
    {
        $this->mustBeOfType = $mustBeOfType;
    }

    private function isDDDValid($ddd)
    {
        $validOnes = require __DIR__.'./assert/valid_ddd_list.php';

        return in_array($ddd, $validOnes);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!isset($value['phone_country_code']) || !isset($value['phone_area_code']) || !isset($value['phone_number'])) {
            return false;
        }

        if (!$this->isDDDValid($value['phone_area_code'])) {
            return false;
        }

        $fullNumber = "+{$value['phone_country_code']}{$value['phone_area_code']}{$value['phone_number']}";
        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        $phoneNumber = $phoneNumberUtil->parse($fullNumber);
        $valid = $phoneNumberUtil->isValidNumberForRegion($phoneNumber, 'BR');

        if (!$valid) {
            return false;
        }

        return $phoneNumberUtil->getNumberType($phoneNumber) === $this->mustBeOfType;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Número telefone celular inválido.';
    }
}