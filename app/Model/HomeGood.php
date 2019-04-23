<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomeGood extends Model
{
//

    const WIDTH_ONR=1;//一格
    const WIDTH_TWO=2;//二格

    const STATE_ON=1;//上架
    const STATE_OFF=2;//下架

    const STATE_MAP=[
        self::STATE_ON=>'上架',
        self::STATE_OFF=>'下架',
    ];

    const WIDTH_MAP=[
        self::WIDTH_ONR=>'1格',
        self::WIDTH_TWO=>'2格',
    ];

    const STATE_SWITCH=[
        'on'  => ['value' => self::STATE_ON, 'text' => self::STATE_MAP[self::STATE_ON], 'color' => 'primary'],
        'off' => ['value' => self::STATE_OFF, 'text' => self::STATE_MAP[self::STATE_OFF], 'color' => 'default'],
    ];
 

    /**
     * 关联分类
     * @return mixed
     */
    public function type()
    {
        return $this->hasOne(HomeType::class,'id','type_id');
    }
}
