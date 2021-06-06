<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'product_variants';

    /**
     * @var array
     */
    protected $fillable = ['value', 'product_id', 'product_attribute_id', 'quantity', 'price'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
