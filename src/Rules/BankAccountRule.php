<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Rules;

use App\Bank;
use Illuminate\Contracts\Validation\Rule;

class BankAccountRule implements Rule
{

    private $msg = 'Conta bancária invalida.';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!isset($value['bank_number'])) {
            $this->msg = 'Informe o número do banco';

            return false;
        }

        if (empty($value['bank_number']) || !is_numeric($value['bank_number'])) {
            $this->msg = 'Número do banco é inválido.';

            return false;
        }

        $bankRule = new BankRule();
        $passesBank = $bankRule->passes('number', $value['bank_number']);

        if (!$passesBank) {
            $this->msg = $bankRule->message();

            return false;
        }

        if (!isset($value['tax_document_type']) || empty($value['tax_document_type'])) {
            $this->msg = 'Informe o tipo do documento.';

            return false;
        }

        if (!isset($value['tax_document']) || empty($value['tax_document'])) {
            $this->msg = 'Informe o número do documento.';

            return false;
        }

        $taxDocumentRule = new TaxDocumentRule();
        $passesTaxDocument = $taxDocumentRule->passes('number', [
            'tax_document_type' => $value['tax_document_type'],
            'tax_document_number' => $value['tax_document'],
        ]);

        if (!$passesTaxDocument) {
            $this->msg = $taxDocumentRule->message();

            return false;
        }

        if (!isset($value['holder_name']) || empty($value['holder_name']) || is_numeric($value['holder_name'])) {
            $this->msg = 'Informe o nome do titular da conta.';

            return false;
        }

        if (
            (!isset($value['agency_number']) || empty($value['agency_number']) || !is_numeric($value['agency_number'])) &&
            (!isset($value['agency_check_number']) || empty($value['agency_check_number']) || !is_numeric($value['agency_check_number'])) &&
            (!isset($value['account_number']) || empty($value['account_number']) || !is_numeric($value['account_number'])) &&
            (!isset($value['account_check_number']) || empty($value['account_check_number']) || !is_numeric($value['account_check_number']))
        ) {
            $this->msg = 'Conta bancária inválida.';

            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}