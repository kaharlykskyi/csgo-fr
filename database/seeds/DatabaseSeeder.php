<?php

use Illuminate\Database\Seeder;

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
            CountrysTableSeeder::class,
            DefaultAdminUserTableSeeder::class,
            SettingsTableSeeder::class,
            Settings2TableSeeder::class,
            Settings3TableSeeder::class,
        ]);
    }
}
