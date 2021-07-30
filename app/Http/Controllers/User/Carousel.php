<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Carousel as Slider;
use Illuminate\Http\Request;

class Carousel extends Controller
{
    public function carouselPc()
    {
        $images = Slider::where('mobile_image', 0)->get();
        $carousel = $images->where('status', 1);
        return response()->json($carousel);
    }

    public function carouselMobile()
    {
        $images = Slider::where('mobile_image', 1)->get();
        $carousel = $images->where('status', 1);
        return response()->json($carousel, 200);
    }
}
