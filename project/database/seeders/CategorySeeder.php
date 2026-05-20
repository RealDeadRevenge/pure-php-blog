<?php

namespace Database\Seeders;

use App\Core\Database;
use PDO;

class CategorySeeder
{
    /** @var PDO */
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Technology',
                'description' => 'Technology news and tutorials.',
            ],
            [
                'title' => 'Databases',
                'description' => 'Articles about SQL and databases.',
            ],
            [
                'title' => 'Backend',
                'description' => 'Backend development guides and tips.',
            ],
            [
                'title' => 'DevOps',
                'description' => 'Docker, CI/CD and infrastructure topics.',
            ],
            [
                'title' => 'Programming',
                'description' => 'General programming articles.',
            ],
        ];

        foreach ($categories as $category) {
            $statement = $this->pdo->prepare('
                INSERT INTO categories (title, description)
                VALUES (:title, :description)
            ');

            $statement->execute([
                'title' => $category['title'],
                'description' => $category['description'],
            ]);
        }
    }
}