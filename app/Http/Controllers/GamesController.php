<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GamesController extends AppController
{
    const SHOW_GAME = 'games.show';

    public function store()
    {
        $game = new Game();
        $game->save();

        $player = new Player();
        $player->game_id = $game->id;
        $player->user_id = Auth::id();
        $player->save();

        session()->flash('success', sprintf('%s, you have successfully created the game!', Auth::user()->name));

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

        return view(self::SHOW_GAME, compact($game));
    }
}
