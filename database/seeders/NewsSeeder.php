<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all categories
        $categories = Category::all();
        
        // Create 5 news items for each category
        foreach ($categories as $category) {
            News::factory()
                ->count(5)
                ->state(['category_id' => $category->id])
                ->create();
        }
        
        $this->command->info('Created 5 news items for each category.');
    }
}
