<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Carousel as Slider;

class CarouselController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carouselPc = Slider::where('mobile_image', 0)->get();
        return view('admin.carousel', compact('carouselPc'));
    }

    public function uploadImage(Request $request)
    {
        if ($request->has('image')) {

            $image = $request->image->store('carousel', 'public');

            Slider::create([
                'images'      =>  $image,
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $carousel = Slider::findOrFail($id);
        Storage::delete('public/'.$carousel->images);
        $carousel->delete(); 
        return back();
    }
}
