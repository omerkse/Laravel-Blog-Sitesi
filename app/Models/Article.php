<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'articles';
    function getCategory()
    {
            return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
