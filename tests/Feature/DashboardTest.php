<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('non admin users cannot access dashboard and redirected to home', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertRedirect('/');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create(['is_admin' => true, 'email_verified_at' => now()]);
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});
