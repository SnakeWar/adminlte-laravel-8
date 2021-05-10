<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CategoriesProduct extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    protected $table = 'categories_products';
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
