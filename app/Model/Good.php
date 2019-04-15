<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //
    const STATE_ON=1;//上架
    const STATE_OFF=2;//下架

    const STATE_MAP=[
        self::STATE_ON=>'上架',
        self::STATE_OFF=>'下架',
    ];

    const STATE_SWITCH=[
        'on'  => ['value' => self::STATE_ON, 'text' => self::STATE_MAP[self::STATE_ON], 'color' => 'primary'],
        'off' => ['value' => self::STATE_OFF, 'text' => self::STATE_MAP[self::STATE_OFF], 'color' => 'default'],
    ];

    /**
     * 设置多图
     *
     * @param  string  $value
     * @return string
     */
    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        }
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * 关联分类
     * @return mixed
     */
    public function goodtype()
    {
        return $this->hasOne(GoodType::class,'id','type');
    }
}
