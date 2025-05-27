<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomeSettings extends Settings
{
    public ?int $category_section_one;
    public ?int $category_section_two;
    public ?int $category_section_three;
    public ?int $category_section_four;

    public static function group(): string
    {
        return 'home';
    }
}
