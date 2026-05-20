<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class ArticleRepository
{
    /** @var PDO */
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    /**
     * @param int $categoryId
     * @param string $sort
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function getByCategory(
        int $categoryId,
        string $sort = 'date',
        int $limit = 6,
        int $offset = 0,
    ): array {
        $orderBy = match ($sort) {
            'views' => 'a.views DESC',
            default => 'a.created_at DESC',
        };

        $statement = $this->pdo->prepare("
            SELECT a.id, a.image, a.title, a.description, a.views, a.created_at
            FROM articles a
            INNER JOIN article_category ac ON ac.article_id = a.id
            WHERE ac.category_id = :category_id
            ORDER BY {$orderBy}
            LIMIT :limit OFFSET :offset
        ");

        $statement->bindValue(
            ':category_id',
            $categoryId,
            PDO::PARAM_INT
        );

        $statement->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $statement->bindValue(
            ':offset',
            $offset,
            PDO::PARAM_INT
        );

        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @param int $id
     *
     * @return array|false
     */
    public function find(int $id): array|false
    {
        $statement = $this->pdo->prepare('
            SELECT id, image, title, description, content, views, created_at
            FROM articles
            WHERE id = :id
            LIMIT 1
        ');

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch();
    }

    /**
     * @param int $articleId
     * @param int $limit
     *
     * @return array
     */
    public function getRelatedArticles(
        int $articleId,
        int $limit = 3
    ): array
    {
        $statement = $this->pdo->prepare('
            SELECT DISTINCT a.id, a.image, a.title, a.description, a.views
            FROM articles a
            INNER JOIN article_category ac ON ac.article_id = a.id
            WHERE ac.category_id IN (
                SELECT category_id
                FROM article_category
                WHERE article_id = :article_id
            )
            AND a.id != :article_id
            LIMIT :limit
        ');

        $statement->bindValue(
            ':article_id',
            $articleId,
            PDO::PARAM_INT
        );

        $statement->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @param int $articleId
     *
     * @return void
     */
    public function incrementViews(int $articleId): void
    {
        $statement = $this->pdo->prepare('
            UPDATE articles
            SET views = views + 1
            WHERE id = :id
        ');

        $statement->execute([
            'id' => $articleId,
        ]);
    }
}