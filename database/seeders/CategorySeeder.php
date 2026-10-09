<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'IT Equipment', 'description' => 'Laptops, monitors, peripherals, and accessories'],
            ['name' => 'Office Supplies', 'description' => 'Stationery, paper, and consumables'],
            ['name' => 'Furniture', 'description' => 'Desks, chairs, and storage'],
            ['name' => 'Software Licences', 'description' => 'Subscriptions and licence renewals'],
            ['name' => 'Professional Services', 'description' => 'Consulting, training, and contracted work'],
            ['name' => 'Travel', 'description' => 'Flights, accommodation, and ground transport'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
