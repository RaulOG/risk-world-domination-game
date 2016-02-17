<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GamesController extends AppController
{
    const SHOW_GAME = 'games.show';
    const CREATED_GAME_MESSAGE = '%s, you have successfully created the game!';
    const JOINED_GAME_MESSAGE = '%s, you have successfully joined the game!';
    const ERROR_NO_GAMES_FOUND = 'No games found, try again later.';

    public function store()
    {
        $game = new Game();
        $game->save();

        $player = new Player();
        $player->game_id = $game->id;
        $player->user_id = Auth::id();
        $player->is_host = true;
        $player->save();

        session()->flash('success', sprintf(self::CREATED_GAME_MESSAGE, Auth::user()->name));

        return redirect()->route(self::SHOW_GAME, [$game->id]);
    }

    /**
     * Shows a game
     *
     * @param int $gameId
     * @return View
     */
    public function show($gameId)
    {
        $game = Game::find($gameId);

        return view(self::SHOW_GAME, compact('game'));
    }

    /**
     * Joins the game of another person
     *
     * @params
     */
    public function join()
    {
        $players = Player::where('user_id', Auth::id())->get();
        $gameIds = $players->lists('game_id')->toArray();

        $game = Game::whereNotIn('id', $gameIds)->where(['state' => Game::STATE_OPEN])->first();

        if (is_null($game)) {
            session()->flash('error', sprintf(self::ERROR_NO_GAMES_FOUND, Auth::user()->name));

            return redirect()->route('welcome');
        }

        $player = new Player();
        $player->game_id = $game->id;
        $player->user_id = Auth::id();
        $player->save();

        session()->flash('success', sprintf(self::JOINED_GAME_MESSAGE, Auth::user()->name));

        return redirect()->route(self::SHOW_GAME, [$game->id]);
    }

}
