<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Rules;

use Illuminate\Contracts\Validation\Rule;
use Newestapps\Validators\Enum\TaxDocument;

class TaxDocumentRule implements Rule
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

        switch (strtoupper($value['type'])) {
            case TaxDocument::CPF:
                return (new CPFRule())->passes('type', $value['number']);
            case TaxDocument::CNPJ:
                return (new CNPJRule())->passes('type', $value['number']);
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Documento inválido.';
    }
}