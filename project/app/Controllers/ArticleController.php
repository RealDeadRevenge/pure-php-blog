<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Repositories\ArticleRepository;

class ArticleController
{
    /** @var ArticleRepository */
    private ArticleRepository $articleRepository;

    /** @var Request */
    private Request $request;

    /** @var Response */
    private Response $response;

    /** @var View */
    private View $view;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
    }

    /**
     * @return void
     * @throws \Smarty\Exception
     */
    public function show(): void
    {
        $articleId = (int) $this->request
            ->input('id');

        if ($articleId <= 0) {
            $this->response
                ->abort();
        }

        $article = $this->articleRepository
            ->find($articleId);

        if ($article === false) {
            $this->response
                ->abort();
        }

        $this->articleRepository
            ->incrementViews($articleId);

        $relatedArticles = $this->articleRepository
            ->getRelatedArticles($articleId);

        $this->view
            ->assign(
                'title',
                $article['title']
            );

        $this->view
            ->assign(
                'article',
                $article
            );

        $this->view
            ->assign(
                'relatedArticles',
                $relatedArticles
            );

        $this->view
            ->render('article.tpl');
    }
}