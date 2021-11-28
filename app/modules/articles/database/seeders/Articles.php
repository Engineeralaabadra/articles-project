<?php

namespace Database\Seeders;

use Articles\Models\Article;
use Illuminate\Database\Seeder;

class Articles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'title'=>'article1',
            'body'=>'body article1'
        ]);
    }
}
