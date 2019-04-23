<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodType extends Model
{
    //
    public $timestamps = false;

    /**
     * 关联分类
     * @return mixed
     */
    public function uptype()
    {
        return $this->hasOne(HomeType::class,'id','up');
    }
}
