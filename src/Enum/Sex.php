<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Enum;

use MyCLabs\Enum\Enum;

class Sex extends Enum
{

    const MALE = 'MALE';
    const FEMALE = 'FEMALE';
    const OTHER = 'OTHER';

    /**
     * @param $status
     * @return string
     */
    public static function getLabel($status)
    {
        switch ($status) {
            case self::MALE:
                return 'Masculino';
            case self::FEMALE:
                return 'Feminino';
            case self::OTHER:
                return 'Outro';
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