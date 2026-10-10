<?php

declare(strict_types=1);

use App\Models\User;

it('blocks employees from the admin area', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($employee)
        ->get('/admin/dashboard')
        ->assertForbidden();
});

it('allows managers into the admin area', function () {
    $manager = User::factory()->create(['role' => 'manager']);

    $this->actingAs($manager)
        ->get('/admin/dashboard')
        ->assertOk();
});

it('redirects guests to login', function () {
    $this->get('/admin/dashboard')->assertRedirect('/login');
});
