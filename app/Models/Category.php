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

        return $value ? 'Active':'non-active';

    }

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function subCategories(){
        return $this->hasMany(subCategory::class);
    }

}
