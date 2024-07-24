<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Category;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::with('categories', 'votes')->get();
        return response()->json($websites);
    }
    public function show($id)
    {
        $website = Website::with('categories', 'votes')->findOrFail($id);
        return response()->json($website);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
            'description' => 'required',
            'categories' => 'required|array'
        ]);

        $website = Website::create($request->only('name', 'url', 'description'));

        $website->categories()->attach($request->categories);

        return response()->json($website, 201);
    }


}
