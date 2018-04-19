<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Enum;

use MyCLabs\Enum\Enum;

class CivilStatus extends Enum
{

    const SINGLE = 'SINGLE';
    const MARRIED = 'MARRIED';
    const DIVORCED = 'DIVORCED';
    const WIDOWED = 'WIDOWED';
    const SEPARATED = 'SEPARATED';

    /**
     * @param $status
     * @return string
     */
    public static function getLabel($status)
    {
        switch ($status) {
            case self::SINGLE:
                return 'Solteiro(a)';
            case self::MARRIED:
                return 'Casado(a)';
            case self::DIVORCED:
                return 'Divorciado(a)';
            case self::WIDOWED:
                return 'Viúvo(a)';
            case self::SEPARATED:
                return 'Separado(a)';
        }
    }

    /**
     * @param $status
     * @return array
     */
    public static function transformed($status)
    {
        return [
            'name' => $status,
            'label' => self::getLabel($status),
        ];
    }
}