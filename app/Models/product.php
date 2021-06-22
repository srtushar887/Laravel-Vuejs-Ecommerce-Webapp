<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function main_cat(){
        return $this->hasOne(main_category::class,'id','main_cat_id');
    }

    public function sub_cat(){
        return $this->hasOne(sub_category::class,'id','sub_cat_id');
    }

}
