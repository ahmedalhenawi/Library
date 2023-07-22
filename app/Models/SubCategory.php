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
        if ($value){
           return "<span class = 'badge badge-success'>نشط</span>";
        }else{
          return  "<span class = 'badge bg-danger'>غير نشط</span>";

        }
//        return $value?"Active":'non-active';
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
