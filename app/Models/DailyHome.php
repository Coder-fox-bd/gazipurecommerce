<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyHome extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'daily_homes';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'daily_home_pivot', 'daily_home_id', 'product_id');
    }
}
