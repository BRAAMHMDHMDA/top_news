<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titleEn = $this->faker->sentence(6);
        $titleAr = 'عنوان الخبر بالعربية: ' . $this->faker->sentence(3);

        $contentEn = '<p>' . implode('</p><p>', $this->faker->paragraphs(5)) . '</p>';
        $contentAr = '<p>هذا محتوى الخبر باللغة العربية. ' .
            implode('</p><p>', array_map(fn() => $this->faker->realText(200), range(1, 5))) .
            '</p>';

        // Ensure we have at least one user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Ensure we have at least one category
        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => ['en' => 'General', 'ar' => 'عام'],
                'show_at_nav' => true,
                'status' => true,
            ]);
        }

        // Create the news directory if it doesn't exist
//        if (!is_dir(public_path('storage/news'))) {
//            mkdir(public_path('storage/news'), 0777, true);
//        }

        return [
            'category_id' => $category->id,
            'author_id' => $user->id,
            'image_path' => null,
            'title' => ['en' => $titleEn, 'ar' => $titleAr],
            'slug' => Str::slug($titleEn),
            'content' => ['en' => $contentEn, 'ar' => $contentAr],
            'meta_title' => $this->faker->sentence(5),
            'meta_description' => $this->faker->paragraph(2),
            'is_breaking_news' => $this->faker->boolean(20), // 20% chance of being breaking news
            'show_at_slider' => $this->faker->boolean(30), // 30% chance of showing in slider
            'show_at_popular' => $this->faker->boolean(40), // 40% chance of showing in popular
            'status' => true,
            'is_approved' => true,
            'views' => $this->faker->numberBetween(0, 1000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
