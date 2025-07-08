<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => ['en' => 'Politics', 'ar' => 'سياسة'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Sports', 'ar' => 'رياضة'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Technology', 'ar' => 'تكنولوجيا'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Entertainment', 'ar' => 'ترفيه'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Health', 'ar' => 'صحة'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Business', 'ar' => 'أعمال'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Science', 'ar' => 'علوم'], 'show_at_nav' => true, 'status' => true],
            ['name' => ['en' => 'Education', 'ar' => 'تعليم'], 'show_at_nav' => true, 'status' => true],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name->en' => $category['name']['en']],
                $category
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
