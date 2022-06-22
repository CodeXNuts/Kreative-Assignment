<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Rules\CategorySelect;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'parent' => ['nullable', new CategorySelect]
        ]);

        $categories = [];

        if (!empty($request->parent)) {
            $categories = Category::where('parent_id', $request->parent)->get(['id', 'name', 'parent_id']);
        } else {
            $categories = Category::whereNull('parent_id')->orderBy('created_at', 'DESC')->get(['id', 'name', 'parent_id']);
        }

        return view('category.index')->withCategories($categories);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'slug' => ['required', 'unique:categories,slug'],
            'parent' => ['nullable', new CategorySelect]
        ]);

        $key = 'success';
        $msg = 'Category has been created.';

        try {

            Category::create([
                'name' => $request->name,
                'slug' => Str::lower($request->slug),
                'parent_id' => $request->parent ?? null
            ]);
        } catch (Exception $e) {

            $key = 'fail';
            $msg = 'Category could not be created. Try again.';
        }

        return redirect()->route('category.home')->with($key, $msg);
    }
}
