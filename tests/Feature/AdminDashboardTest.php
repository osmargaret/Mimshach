<?php

use App\Models\ConsultationRequest;
use App\Models\Event;
use App\Models\NewsletterSubscription;
use App\Models\User;

test('guest is redirected when visiting admin dashboard', function () {
    $response = $this->get(route('admin.dashboard'));

    $response->assertRedirect(route('admin.login'));
});

test('authenticated admin can view dashboard with empty states', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertOk();
    $response->assertViewIs('admin.dashboard');
    $response->assertSee('Admin Dashboard');
    $response->assertSee('Recent Consultation Requests');
    $response->assertSee('Recent Newsletter Subscriptions');
    $response->assertSee('Upcoming Events');
    $response->assertSee('No consultations yet');
    $response->assertSee('No subscribers yet');
    $response->assertSee('No upcoming events');
});

test('authenticated admin can view dashboard with populated data', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    ConsultationRequest::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'level_of_education' => 'Bachelor',
        'programme_of_interest' => ['Computer Science'],
        'preferred_countries' => ['Canada'],
        'tuition_budget' => 20000,
    ]);

    NewsletterSubscription::create([
        'email' => 'subscriber@example.com',
        'subscribed_at' => now(),
    ]);

    Event::factory()->create([
        'title' => 'Global Education Expo',
        'location' => 'Main Hall',
        'date' => now()->addDays(5)->toDateString(),
        'start_time' => now()->addDays(5)->format('H:i:s'),
        'end_time' => now()->addDays(5)->addHours(2)->format('H:i:s'),
    ]);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertOk();
    $response->assertViewIs('admin.dashboard');
    $response->assertSee('John Doe');
    $response->assertSee('john@example.com');
    $response->assertSee('subscriber@example.com');
    $response->assertSee('Global Education Expo');
});
