<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', Article::POSTED)->get();
        return ['success' => true, 'data' => $articles];
    }

    public function show($id)
    {
        $article = Article::find($id);
        if (empty($article) || $article->status == Article::DRAFT) {
            return ['success' => false, 'message' => "Article not found"];
        }
        return ['success' => true, 'data' => $article];
    }
}
