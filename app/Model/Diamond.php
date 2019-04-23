<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Diamond extends Model
{

    const TYPE_BARE=1;//裸钻
    const TYPE_COLOR=2;//彩砖

    //
    const STATE_ON=1;//上架
    const STATE_OFF=2;//下架

    const STATE_MAP=[
        self::STATE_ON=>'上架',
        self::STATE_OFF=>'下架',
    ];
    const TYPE_MAP=[
        self::TYPE_BARE=>'裸钻',
        self::TYPE_COLOR=>'彩砖',
    ];

    const STATE_SWITCH=[
        'on'  => ['value' => self::STATE_ON, 'text' => self::STATE_MAP[self::STATE_ON], 'color' => 'primary'],
        'off' => ['value' => self::STATE_OFF, 'text' => self::STATE_MAP[self::STATE_OFF], 'color' => 'default'],
    ];

 
}
