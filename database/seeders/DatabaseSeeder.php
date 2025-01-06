<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $seeder = [
            PermissionRoleSeeder::class,
            AdminSeeder::class,
            AgentSeeder::class,
        ];

        $this->call($seeder);
    }
}
