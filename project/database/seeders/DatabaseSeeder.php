<?php

namespace Database\Seeders;

use Random\RandomException;

class DatabaseSeeder
{
    /**
     * @return void
     * @throws RandomException
     */
    public function run(): void
    {
        (new CategorySeeder())->run();
        (new ArticleSeeder())->run();
    }
}