<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        // Ưu tiên dùng giá trị nếu đã được truyền từ create([...])
        if (isset($this->attributes['name'])) {
            $name = $this->attributes['name'];
        }

        $nickname = $this->generateUniqueNickname($name);

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'avatar' => 'default-avatar.png',
            'nickname' => $nickname,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    private function generateUniqueNickname(string $name): string
    {
        $baseNickname = $this->toCamelCase($name);
        $nickname = $baseNickname;
        $i = 1;
        while (\App\Models\User::where('nickname', $nickname)->exists()) {
            $nickname = $baseNickname . rand(1, 9999);
        }

        return $nickname;
    }

    private function toCamelCase(string $string): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

}
