<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;

    public function main_cat()
    {
        return $this->hasOne(main_category::class,'id','main_category_id');
    }
}
