<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $categories = Category::all();

        return response($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            Category::create([
                'name' => $request->name,
                'created_at' => now()
            ]);

            return response([
                'message' => 'Categoria cadastrada com sucesso!'
            ], 201);
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
