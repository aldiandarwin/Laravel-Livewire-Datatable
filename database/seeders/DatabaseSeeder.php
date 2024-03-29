<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        collect(range(1, 100))->each(function ($_) {
            \App\Models\User::factory()->hasPosts(rand(0, 16))->create();
        });
    }
}
