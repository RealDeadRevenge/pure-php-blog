<?php

namespace App\Controllers;

use App\Core\View;
use App\Repositories\CategoryRepository;
use Smarty\Exception;

class HomeController
{
    /** @var CategoryRepository */
    private CategoryRepository $categoryRepository;

    /** @var View */
    private View $view;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->view = new View();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function index(): void
    {
        $categories = $this->categoryRepository
            ->getCategoriesWithLatestArticles();

        $this->view
            ->assign(
                'title',
                'Home'
            );

        $this->view
            ->assign(
                'categories',
                $categories
            );

        $this->view
            ->render('home.tpl');
    }
}