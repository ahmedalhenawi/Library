<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model
{
    use HasFactory;
//    protected $guarded = [];
        protected $fillable = ['name_en' , 'name_ar' ,'img' , 'is_active'];

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

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function subCategories(){
        return $this->hasMany(subCategory::class);
    }

}
