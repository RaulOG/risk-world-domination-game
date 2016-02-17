<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    const GAMES_TO_SEED = 10;
    const MESSAGE_GAMES_CREATED = 'Created games';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate();

        // Creating games
        $games = factory(App\Game::class, self::GAMES_TO_SEED)->create(['state' => App\Game::STATE_CLOSED]);

        // For each game, creating two players
        foreach ($games as $game) {
            $hostUser = factory(User::class)->create();
            $guestUser = factory(User::class)->create();

            // Host
            factory(App\Player::class)->create([
                'game_id' => $game->id,
                'user_id' => $hostUser->id,
            ]);

            // Guest
            factory(App\Player::class)->create([
                'game_id' => $game->id,
                'user_id' => $guestUser->id,
            ]);
        }

        $this->command->info(self::MESSAGE_GAMES_CREATED);
    }

    /**
     * Truncates the games and players tables
     */
    private function truncate()
    {
        DB::table('players')->truncate();
        DB::table('games')->truncate();

    }
}