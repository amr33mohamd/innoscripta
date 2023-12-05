<?php


namespace App\Services;

use App\Jobs\SendEmailQueueJob;
use App\Models\Article;
use App\Repositories\ArticleRepository;


class ArticleService
{
    /**
     * @var $articleRepository
     */
    protected $articleRepository;

    /**
     * PostService constructor.
     *
     * @param articleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    public function getAllArticles()
    {
        return $this->articleRepository->getAllArticles();
    }
    public function insertArticles($articles)
    {
        return $this->articleRepository->insertArticles($articles);
    }
    public function getUserArticles($user)
    {
        return $this->articleRepository->getUserArticles($user);
    }

    public function getArticleById($id)
    {
         return $this->articleRepository->getArticleById($id);
    }

    public function deleteArticle($id)
    {
        return $this->articleRepository->deleteArticle($id);

    }

    public function createArticle(array $articleDetails)
    {
        return $this->articleRepository->createArticle($articleDetails);
    }

    public function updateArticle($id, array $newDetails)
    {
       return $this->articleRepository->updateArticle($id,$newDetails);

    }
}
