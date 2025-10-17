<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Sasa',
            'email' => 'sasa.bacic12@gmail.com',
            'password' => bcrypt('Putstanova4!'),
            'email_verified_at' => time()
        ]);

        Project::factory()->count(30)->hasTasks(30)->create();
    }
}
