<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $logoPath = $this->faker->image('storage/app/public', 100, 100, null, false);
        $logoUrl = Storage::url($logoPath);

        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'logo' => $logoUrl,
        ];
    }
}
