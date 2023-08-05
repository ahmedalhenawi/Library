<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name_en','name_ar' , 'is_active' , 'img' , 'category_id'];

    public function books(){
        return $this->hasMany(Book::class);
    }
    public function getIsActiveAttribute($value): string
    {
        if (LaravelLocalization::setLocale() == 'ar') {
            if ($value){
                return "<span class = 'badge badge-success'>نشط</span>";
            }else{
                return  "<span class = 'badge bg-danger'>غير نشط</span>";
            }
        }else{
            if ($value){
                return "<span class = 'badge badge-success'>Active</span>";
            }else{
                return  "<span class = 'badge bg-danger'>NON-Active</span>";
            }
        }

    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
