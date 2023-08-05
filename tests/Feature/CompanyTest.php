<?php

namespace Tests\Feature;

use App\Models\{Company, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewCompanyNotification;

use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testNewCompanyEmailNotification()
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'admin@example.com']);

        $companyData = [
            'name' => 'New Company',
            'email' => 'new@example.com',
        ];

        $response = $this->post(route('companies.store'), $companyData);

        $company = Company::first();

        Notification::assertSentTo(
            [$user],
            NewCompanyNotification::class,
            function ($notification, $channels) use ($company) {
                return $notification->company->id === $company->id;
            }
        );
    }
}
