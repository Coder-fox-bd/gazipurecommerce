<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'featured', 'menu', 'image'];

    protected $casts = [
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'category_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
    }
}
