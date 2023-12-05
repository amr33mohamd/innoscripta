<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    protected $article;
    

    /**
     * ArticleRepository constructor.
     *
     * @param Article $article
     */
     
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    public function getAllArticles()
    {
        return $this->article->paginate();
    }

    public function getArticleById($id)
    {
        return Article::findOrFail($id);
    }

    public function deleteArticle($id){
        return Article::destroy($id);
    }

    public function createArticle(array $articleDetails)
    {
        return Article::create($articleDetails);
    }
    public function insertArticles(array $articles)
    {
        return Article::insert($articles);
    }
    public function getUserArticles($user)
    {
        $category = $user->category;
        $source_id = $user->source__id;
        $keywords = $user->keywords;
        $articles = Article::where([
            ['category', 'like','%'.$category.'%'],
        ])->when($source_id, function($query) use ($source_id) {
            return $query->where('source_id', '=', $source_id);
          })->when($keywords, function($query) use ($keywords) {
            return $query->where('body', 'like', '%'.$keywords.'%');
          })->paginate();
          return $articles;
    }

    public function updateArticle($id, array $newDetails)
    {
           $article =  Article::where('id',$id)->first();
           $article->update($newDetails);
           return $article;
    }
}
