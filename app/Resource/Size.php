<?php

namespace App\Resource;

class Size
{
    const NONE = 'なし';
    const S = 'S';
    const M = 'M';
    const L = 'L';

    public function __construct()
    {

    }

    public static function getName(int $sizeId): string
    {
        switch ($sizeId){
            case 1:
                return self::S;
            case 2:
                return self::M;
            case 3:
                return self::L;
            default:
                return '';
        }
    }
}
