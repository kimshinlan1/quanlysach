<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call([
            BrandSeeder::class
        ]);
        

        // Create list of users and categories from factory
        $users = User::factory()->count(3)->create();
        $categories = Category::factory()->count(4)->create();

        // Create list of posts based on its user and its category
        foreach ($users as $user) {
            # code...
            Post::factory()
                ->count(3)
                ->for($user)
                ->create();
        }

        foreach ($categories as $category) {
            # code...
            Post::factory()
                ->count(3)
                ->for($category)
                ->create();
        }
    }
}
