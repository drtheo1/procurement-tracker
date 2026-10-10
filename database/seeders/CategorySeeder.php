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
            ['name' => 'Furniture', 'description' => 'Desks, chairs, storage, and fittings'],
            ['name' => 'Software Licences', 'description' => 'Subscriptions, licences, and renewals'],
            ['name' => 'Professional Services', 'description' => 'Consulting, legal, audit, and contracted expertise'],
            ['name' => 'Travel and Accommodation', 'description' => 'Flights, rail, hotels, and ground transport'],
            ['name' => 'Training and Development', 'description' => 'Courses, certifications, conferences, and workshops'],
            ['name' => 'Marketing and Communications', 'description' => 'Advertising, print, events, and branded materials'],
            ['name' => 'Facilities and Maintenance', 'description' => 'Repairs, cleaning, utilities, and building services'],
            ['name' => 'Telecommunications', 'description' => 'Mobile plans, internet, and conferencing services'],
            ['name' => 'Vehicles and Fleet', 'description' => 'Vehicle purchase, leasing, fuel, and servicing'],
            ['name' => 'Security Services', 'description' => 'Physical security, surveillance, and access control'],
            ['name' => 'Logistics and Freight', 'description' => 'Shipping, courier, customs clearance, and warehousing'],
            ['name' => 'Health and Safety', 'description' => 'Protective equipment, first aid, and safety compliance'],
            ['name' => 'Catering and Hospitality', 'description' => 'Refreshments, catered meetings, and staff events'],
        ];

        foreach ($categories as $category) {
            Category::factory()->create($category);
        }
    }
}
