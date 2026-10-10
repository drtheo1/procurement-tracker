<?php

declare(strict_types=1);

use App\Models\User;

it('lets an admin change a role', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($admin)
        ->patch("/admin/users/{$employee->id}", ['role' => 'manager'])
        ->assertRedirect();

    expect($employee->fresh()->role)->toBe('manager');
});

it('stops a manager reaching user management', function () {
    $manager = User::factory()->create(['role' => 'manager']);

    $this->actingAs($manager)
        ->get('/admin/users')
        ->assertForbidden();
});

it('stops an admin changing their own role', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->patch("/admin/users/{$admin->id}", ['role' => 'employee'])
        ->assertForbidden();

    expect($admin->fresh()->role)->toBe('admin');
});
