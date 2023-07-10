<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'is_active' , 'img'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
