<?php

namespace Database\Seeders\Develop;

use Database\Seeders\AgentSeeder;
use Database\Seeders\PermissionRoleSeeder;
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
