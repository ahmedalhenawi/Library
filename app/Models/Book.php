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
                            'sub_category_id',
                            'publication_at'];


    public function subCategory(){
        return $this->belongsTo(subCategory::class);
    }

}
