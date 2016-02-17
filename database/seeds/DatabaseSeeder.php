<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const FOREIGN_KEYS_CHECK = 'SET FOREIGN_KEY_CHECKS=%d;';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->beforeSeeding();

         $this->call(UsersSeeder::class);
         $this->call(GamesSeeder::class);

        $this->afterSeeding();
    }

    /**
     * Disabling protections for seeding
     */
    private function beforeSeeding()
    {
        Model::unguard();
        DB::statement(sprintf(self::FOREIGN_KEYS_CHECK, false));
    }

    /**
     * Re-enabling protections after seeding
     */
    private function afterSeeding()
    {
        Model::reguard();
        DB::statement(sprintf(self::FOREIGN_KEYS_CHECK, true));
    }
}
