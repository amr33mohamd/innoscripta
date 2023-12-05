<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use Inertia\Inertia;

class DashboardController extends Controller
{

    protected $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    public function index()
    {
        $user = auth()->user();
        $articles = $this->articleService->getUserArticles($user);
        return Inertia::render('Dashboard',['articles'=>$articles]);
    }
}
