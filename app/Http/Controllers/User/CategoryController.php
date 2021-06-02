<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function findBySlug($slug)
    {
        return Category::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }

    public function show($slug)
    {
        $category = $this->findBySlug($slug);

        return view('user.pages.listing-grid', compact('category'));
    }
}
