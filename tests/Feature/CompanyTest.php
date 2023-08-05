<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewCompanyNotification;
use Illuminate\Support\Str;

use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testNewCompanyEmailNotification()
    {
        // Fake
        Notification::fake();

        // Create user
        $user = User::create([
            'name' => 'Maulana Yusup Abdullah',
            'email' => 'maulanayusupp@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        // Company data
        $companyData = [
            'name' => 'New Company',
            'email' => 'adeneling@gmail.com',
            // Add any other data required to create a company
        ];

        // Send the request to create a new company
        $response = $this->post(route('companies.store'), $companyData);

        // Make sure the company was created successfully
        $response->assertStatus(302);

        // Assert that the company is in the database
        $this->assertDatabaseHas('companies', $companyData);

        // Assert that the notification
        Notification::assertNotSentTo(User::latest()->first(), NewCompanyNotification::class);
    }
}
