<?php
/**
 * Created by rodrigobrun
 *   with PhpStorm
 */

namespace Newestapps\Validators\Enum;

use MyCLabs\Enum\Enum;

class Period extends Enum
{

    const SECONDS = 'SECONDS';
    const MINUTES = 'MINUTES';
    const HOURS = 'HOURS';
    const DAYS = 'DAYS';
    const MONTHS = 'MONTHS';
    const WEEKS = 'WEEKS';
    const YEARS = 'YEARS';

    /**
     * @param $status
     * @return string
     */
    public static function getLabel($status)
    {
        switch ($status) {
            case self::SECONDS:
                return 'Segundos';
            case self::MINUTES:
                return 'Minutos';
            case self::HOURS:
                return 'Horas';
            case self::DAYS:
                return 'Dias';
            case self::WEEKS:
                return 'Semanas';
            case self::MONTHS:
                return 'Meses';
            case self::YEARS:
                return 'Anos';
        }
    }

    public static function shortPeriods()
    {
        return [self::SECONDS, self::MINUTES, self::HOURS];
    }

    public static function longPeriods()
    {
        return [self::DAYS, self::WEEKS, self::MONTHS, self::YEARS];
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