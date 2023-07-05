<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [ 'name',
                            'author_name',
                            'description',
                            'category_id',
                            'categories',
                            'publication_at'];


    function category(){
        $this->belongsTo(Category::class);
    }


}
