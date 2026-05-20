<?php

namespace Database\Seeders;

use App\Core\Database;
use PDO;
use Random\RandomException;

class ArticleSeeder
{
    /** @var PDO */
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    /**
     * @return void
     * @throws RandomException
     */
    public function run(): void
    {
        $articles = [
            [
                'image' => 'https://picsum.photos/800/400?random=1',
                'title' => 'Introduction to PHP 8.3',
                'description' => 'Learn about new PHP 8.3 features.',
                'content' => 'PHP 8.3 introduces new improvements and performance optimizations.',
                'views' => random_int(100, 5000),
                'categories' => [1],
            ],
            [
                'image' => 'https://picsum.photos/800/400?random=2',
                'title' => 'Getting Started with Docker',
                'description' => 'Basic Docker concepts for beginners.',
                'content' => 'Docker helps developers create isolated environments.',
                'views' => random_int(100, 5000),
                'categories' => [1, 2],
            ],
            [
                'image' => 'https://picsum.photos/800/400?random=3',
                'title' => 'Why MySQL Is Still Popular',
                'description' => 'Understanding MySQL popularity.',
                'content' => 'MySQL remains one of the most popular relational databases.',
                'views' => random_int(100, 5000),
                'categories' => [2],
            ],
            [
                'image' => 'https://picsum.photos/800/400?random=4',
                'title' => 'Understanding MVC Architecture',
                'description' => 'Learn how MVC works.',
                'content' => 'MVC separates business logic, views, and controllers.',
                'views' => random_int(100, 5000),
                'categories' => [1, 3],
            ],
            [
                'image' => 'https://picsum.photos/800/400?random=5',
                'title' => 'Top Backend Development Tips',
                'description' => 'Improve your backend skills.',
                'content' => 'Writing clean and maintainable code is essential.',
                'views' => random_int(100, 5000),
                'categories' => [3],
            ],
        ];

        foreach ($articles as $article) {
            $statement = $this->pdo->prepare('
                INSERT INTO articles (image, title, description, content, views)
                VALUES (:image, :title, :description, :content, :views)
            ');

            $statement->execute([
                'image' => $article['image'],
                'title' => $article['title'],
                'description' => $article['description'],
                'content' => $article['content'],
                'views' => $article['views'],
            ]);

            $articleId = (int) $this->pdo->lastInsertId();

            foreach ($article['categories'] as $categoryId) {
                $statement = $this->pdo->prepare('
                    INSERT INTO article_category (article_id, category_id)
                    VALUES (:article_id, :category_id)
                ');

                $statement->execute([
                    'article_id' => $articleId,
                    'category_id' => $categoryId,
                ]);
            }
        }
    }
}