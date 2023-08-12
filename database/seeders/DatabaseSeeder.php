<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Maulana Yusup A',
            'email' => 'maulanayusupp@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$0v0Qo7XZigpG8IqJDKxxC.mLHbl7bu09cEJYXEs7ZVWgAhk4xeXqm', // password
            'remember_token' => Str::random(10),
        ]);

        $this->call([
            // Other seeders if you have any
            CompanySeeder::class,
        ]);
    }
}
