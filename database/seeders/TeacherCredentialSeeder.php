<?php

namespace Database\Seeders;

use App\Models\TeacherCredential;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->has(
            TeacherCredential::factory()
                                ->count(10)
                                ->state(function (array $attributes, User $user) {
                                    return ['email' => $user->email];
                                })
                            );
    }
}
