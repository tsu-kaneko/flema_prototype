<?php

namespace App\Resource;

class Status
{
    const STATUS_1 = '新品、未使用';
    const STATUS_2 = '未使用に近い';
    const STATUS_3 = '目立った傷や汚れなし';
    const STATUS_4 = 'やや傷や汚れあり';
    const STATUS_5 = '傷や汚れあり';
    const STATUS_6 = '全体的に状態が悪い';

    public function __construct()
    {

    }

    public static function getName(int $statusId): string
    {
        switch ($statusId){
            case 1:
                return self::STATUS_1;
            case 2:
                return self::STATUS_2;
            case 3:
                return self::STATUS_3;
            case 4:
                return self::STATUS_4;
            case 5:
                return self::STATUS_5;
            case 6:
                return self::STATUS_6;
            default:
                return '';
        }
    }
}
