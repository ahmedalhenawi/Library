<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
//    protected $guarded = [];
        protected $fillable = ['name','img' , 'is_active'];

    public function getIsActiveAttribute($value){
        if($value == 1 ){
            return 'active';
        }else{
            return 'non-avtive';
        }
    }


}
