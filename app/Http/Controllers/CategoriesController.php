<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
     public function index(Request $request, Category $category)
    {
        return CategoryResource::collection($category->all());
    }
}
