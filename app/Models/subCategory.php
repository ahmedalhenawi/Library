<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'is_active' , 'img' , 'category_id'];

    public function books(){
        return $this->hasMany(Book::class);
    }
    public function getIsActiveAttribute($value){
        return $value?"Active":'non-active';
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
