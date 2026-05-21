<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class CategoryRepository
{
    /** @var PDO */
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    /**
     * @return array
     */
    public function getCategoriesWithLatestArticles(): array
    {
        $statement = $this->pdo->query('
            SELECT DISTINCT c.id, c.title, c.description
            FROM categories c
            INNER JOIN article_category ac ON ac.category_id = c.id
            ORDER BY c.title
        ');

        $categories = $statement->fetchAll();

        foreach ($categories as &$category) {
            $statement = $this->pdo->prepare('
                SELECT a.id, a.image, a.title, a.description, a.views, a.created_at
                FROM articles a
                INNER JOIN article_category ac ON ac.article_id = a.id
                WHERE ac.category_id = :category_id
                ORDER BY a.created_at DESC 
                LIMIT 3
            ');

            $statement->execute([
                'category_id' => $category['id'],
            ]);

            $category['articles'] = $statement->fetchAll();
        }

        return $categories;
    }

    /**
     * @param int $id
     *
     * @return array|false
     */
    public function findById(int $id): array|false
    {
        $statement = $this->pdo->prepare('
            SELECT id, title, description
            FROM categories
            WHERE id = :id
            LIMIT 1
        ');

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch();
    }
}