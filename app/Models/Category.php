<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Category extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    use SoftDeletes;
    public $translatedAttributes = ['title', 'content'];
    protected $fillable = [
        'id', 'image', 'parent_id', 'created_at', 'updated_at', 'deleted_at',
    ]; 

    public function parent() {

        return $this->belongsTo(Category::class,'parent_id', 'id');
    }

    public function children() {

        return $this->hasMany(Category::class, 'parent_id', 'id'); 
    }

    public function posts()
    {
        return $this->hasMany(Post::class); 
    }

}
