<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $news = News::with('categories')->paginate(6);


        return response($news, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            News::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'created_at' => now()
            ]);

            return response([
                'message' => 'Notícia cadastrada com sucesso!'
            ], 201);
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function filter(Request $request)
    {
        $titleOrCategory = News::query()
            ->where('title', 'LIKE', '%' . $request->query('search') . '%')
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->orWhere('name', 'LIKE', '%' . $request->query('search') . '%')
            ->select('categories.*', 'news.*')->get();

        return response($titleOrCategory, 200);
    }
}
