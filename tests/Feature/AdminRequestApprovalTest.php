<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Request;
use App\Models\User;

it('lets a manager approve a pending request', function () {
    $manager = User::factory()->create(['role' => 'manager']);
    $employee = User::factory()->create(['role' => 'employee']);
    $category = Category::create(['name' => 'Test', 'description' => 'Test']);

    $request = Request::create([
        'title' => 'Test item', 'description' => 'Test', 'quantity' => 1,
        'estimated_cost' => 100.00, 'status' => 'pending', 'request_date' => now(),
        'user_id' => $employee->id, 'category_id' => $category->id,
    ]);

    $this->actingAs($manager)
        ->patch("/admin/requests/{$request->id}/approve")
        ->assertRedirect();

    expect($request->fresh()->status)->toBe('approved')
        ->and($request->fresh()->approved_by)->toBe($manager->id)
        ->and($request->fresh()->decided_at)->not->toBeNull()
        ->and($request->fresh()->approver->name)->toBe($manager->name);
});

it('stops an employee approving anything', function () {
    $employee = User::factory()->create(['role' => 'employee']);
    $category = Category::create(['name' => 'Test', 'description' => 'Test']);

    $request = Request::create([
        'title' => 'Test item', 'description' => 'Test', 'quantity' => 1,
        'estimated_cost' => 100.00, 'status' => 'pending', 'request_date' => now(),
        'user_id' => $employee->id, 'category_id' => $category->id,
    ]);

    $this->actingAs($employee)
        ->patch("/admin/requests/{$request->id}/approve")
        ->assertForbidden();

    expect($request->fresh()->status)->toBe('pending');
});
