<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    public function run(): void
    {
        $employees = User::where('role', 'employee')->get();
        $categories = Category::all();

        if ($employees->isEmpty() || $categories->isEmpty()) {
            return;
        }

        $requests = [
            ['title' => 'Replacement laptop', 'description' => 'Current unit is four years old and no longer holds charge.', 'quantity' => 1, 'estimated_cost' => 1450.00, 'status' => 'pending'],
            ['title' => 'Ergonomic office chairs', 'description' => 'Three chairs for the new members of the operations team.', 'quantity' => 3, 'estimated_cost' => 960.00, 'status' => 'approved'],
            ['title' => 'Project management software', 'description' => 'Annual licence renewal for ten seats.', 'quantity' => 10, 'estimated_cost' => 2400.00, 'status' => 'approved'],
            ['title' => 'Conference travel to Munich', 'description' => 'Return rail fare and two nights accommodation.', 'quantity' => 1, 'estimated_cost' => 680.00, 'status' => 'pending'],
            ['title' => 'Standing desk', 'description' => 'Height adjustable desk recommended after workplace assessment.', 'quantity' => 1, 'estimated_cost' => 520.00, 'status' => 'rejected'],
            ['title' => 'Printer toner cartridges', 'description' => 'Quarterly restock for the third floor.', 'quantity' => 8, 'estimated_cost' => 240.00, 'status' => 'approved'],
            ['title' => 'External monitors', 'description' => 'Second screens for the two new analysts.', 'quantity' => 2, 'estimated_cost' => 580.00, 'status' => 'pending'],
            ['title' => 'Supplier audit consultancy', 'description' => 'Two day engagement to review supplier compliance.', 'quantity' => 1, 'estimated_cost' => 3200.00, 'status' => 'pending'],
        ];

        foreach ($requests as $index => $request) {
            Request::factory()->create([
                ...$request,
                'request_date' => now()->subDays(30 - ($index * 3)),
                'user_id' => $employees->random()->id,
                'category_id' => $categories->random()->id,
            ]);
        }

        Request::factory()
            ->count(20)
            ->recycle($employees)
            ->recycle($categories)
            ->create();

        $admin = User::where('email', 'admin@admin.com')->first();

        if ($admin !== null) {
            Request::factory()
                ->count(4)
                ->recycle($categories)
                ->create(['user_id' => $admin->id]);
        }

        $approver = User::whereIn('role', ['manager', 'admin'])->first();

        if ($approver !== null) {
            Request::whereIn('status', ['approved', 'rejected'])->update([
                'approved_by' => $approver->id,
                'decided_at' => now()->subDays(2),
            ]);
        }
    }
}
