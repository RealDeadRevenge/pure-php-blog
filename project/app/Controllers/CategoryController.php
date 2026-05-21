<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Smarty\Exception;

class CategoryController
{
    /** @var CategoryRepository */
    private CategoryRepository $categoryRepository;

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
        $this->categoryRepository = new CategoryRepository();
        $this->articleRepository = new ArticleRepository();
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function show(): void
    {
        $categoryId = (int) $this->request
            ->input('id');

        if ($categoryId <= 0) {
            $this->response
                ->abort();
        }

        $category = $this->categoryRepository
            ->findById($categoryId);

        if ($category === false) {
            $this->response
                ->abort();
        }

        $sort = $this->request
            ->input(
                'sort',
                'date'
            );

        $page = max(
            1,
            (int) $this->request
                ->input(
                    'page',
                    1
                )
        );

        $limit = 6;

        $offset = ($page - 1) * $limit;

        $articles = $this->articleRepository
            ->getByCategory(
                $categoryId,
                $sort,
                $limit,
                $offset
            );

        $this->view
            ->assign(
                'title',
                $category['title']
            );

        $this->view
            ->assign(
                'category',
                $category
            );

        $this->view
            ->assign(
                'articles',
                $articles
            );

        $this->view
            ->assign(
                'sort',
                $sort
            );

        $this->view
            ->assign(
                'page',
                $page
            );

        $this->view
            ->render('category.tpl');
    }
}