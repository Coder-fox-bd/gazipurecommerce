<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'carousels';

    /**
     * @var array
     */
    protected $fillable = ['images', 'mobile_image', 'offer_url', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collections()
    {
        return $this->belongsTo(Collection::class);
    }
}
