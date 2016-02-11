<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    const USER_HECTOR_NAME = 'Héctor';
    const USER_HECTOR_EMAIL = 'hector@animalworld.com';
    const USER_RAUL_NAME = 'Raúl';
    const USER_RAUL_EMAIL = 'raul@animalworld.com';
    const USER_ZUZANNA_NAME = 'Zuzanna';
    const USER_ZUZANNA_EMAIL = 'zuzanna@animalworld.com';
    const USER_DEFAULT_PASSWORD = '12345';

    const MESSAGE_OURS_CREATED = 'Created users for Héctor, Raúl and Zuzanna';
    const MESSAGE_ALL_CREATED = 'Created %d users.';

    const USERS_TO_SEED = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate();
        $this->createOurUsers();
        $this->createRandomUsers();
    }

    /**
     * Truncates the users table so the ids are reset
     */
    private function truncate()
    {
        DB::table('users')->truncate();

    }

    /**
     * Creates our awesome users
     */
    private function createOurUsers()
    {
        factory(User::class)->create([
            'name' => self::USER_HECTOR_NAME,
            'email' => self::USER_HECTOR_EMAIL,
            'password' => bcrypt(self::USER_DEFAULT_PASSWORD),
        ]);
        factory(User::class)->create([
            'name' => self::USER_RAUL_NAME,
            'email' => self::USER_RAUL_EMAIL,
            'password' => bcrypt(self::USER_DEFAULT_PASSWORD),
        ]);
        factory(User::class)->create([
            'name' => self::USER_ZUZANNA_NAME,
            'email' => self::USER_ZUZANNA_EMAIL,
            'password' => bcrypt(self::USER_DEFAULT_PASSWORD),
        ]);

        $this->command->info(self::MESSAGE_OURS_CREATED);

    }

    /**
     * Creates some random users to have our table crowded
     */
    private function createRandomUsers()
    {
        factory(User::class, self::USERS_TO_SEED)->create();

        $this->command->info(sprintf(self::MESSAGE_ALL_CREATED, self::USERS_TO_SEED));
    }
}
