<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Admin::class;
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "last_name" => $this->faker->lastName(),
            "email" => $this->faker->unique()->safeEmail(),
            "password" => Hash::make("Make_My_Password_Harder_Than_It_IS@!#$%^&*()"),
        ];
    }
}
