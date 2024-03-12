<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Roles;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
 class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
             'name' => fake()->name(),
             'email' => fake()->unique()->safeEmail(),
             'email_verified_at' => now(),
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
             'remember_token' => Str::random(10),
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


}
// $factory->define(Admin::class, function(Faker $faker){
//     return [
//         'admin_name' => $faker->name,
//         'admin_email' => $faker->unique()->safeEmail,
//         'admin_phone' => '0889227802',
//         'admin_password' => '827ccb0eea8a706c4c34a16891f84e7b',
//     ];
//     });
// $factory->afterCreating(Admin::class, function($admin,$faker){
//     $roles = Roles::where('name','user')->get();
//     $admin->roles()->sync($roles->pluck('id_roles')->toArray());
// });
