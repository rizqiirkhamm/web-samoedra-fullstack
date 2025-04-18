<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->latest()
            ->paginate(6);

        return view('artikel', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedArticles = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('detail-artikel', compact('article', 'relatedArticles'));
    }
}
