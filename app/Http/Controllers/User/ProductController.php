<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $attributes = Attribute::orderBy('id', 'DESC')->get();
        return view('user.pages.product-detail', compact('product', 'attributes'));

    }
}