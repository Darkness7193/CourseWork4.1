<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Storage>
 */
class StorageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(100),
            'address' => $this->faker->text(100),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->text(100),
            'comment' => $this->faker->text(1000)
        ];
    }
}
