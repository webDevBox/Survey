<?php

use Illuminate\Database\Seeder;
use App\models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Tag::class, 50)->create();
    }
}
