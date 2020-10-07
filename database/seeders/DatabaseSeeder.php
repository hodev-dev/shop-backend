<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PemissionSeeder;
use Database\Seeders\PermissionRoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PemissionSeeder::class,
            PermissionRoleSeeder::class,
            GameSeed::class,
            CurrencySeeder::class,
            PriceSeed::class
        ]);
    }
}
