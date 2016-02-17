<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GamesController extends AppController
{
    const VIEW_SHOW_GAME = 'games.show';
    const ROUTE_SHOW_GAME = 'games.show';

    const MESSAGE_CREATED_GAME = '%s, you have successfully created the game!';
    const MESSAGE_JOINED_GAME = '%s, you have successfully joined the game!';
    const MESSAGE_STARTED_GAME = 'Game started! BAM!';

    const ERROR_NO_GAMES_FOUND = 'No games found, try again later.';
    const ERROR_NOT_IN_GAME = 'You are not in this game';
    const ERROR_NOT_ENOUGH_PLAYERS = 'This game does not have enough players to start!';

    public function store()
    {
        $game = new Game();
        $game->save();

        $player = new Player();
        $player->game_id = $game->id;
        $player->user_id = Auth::id();
        $player->is_host = true;
        $player->save();

        session()->flash('success', sprintf(self::MESSAGE_CREATED_GAME, Auth::user()->name));

        return redirect()->route(self::ROUTE_SHOW_GAME, [$game->id]);
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

        $currentPlayer = Player::where(
            [
                'game_id' => $game->id,
                'user_id' => Auth::id(),
            ]
        )->first();

        if (is_null($currentPlayer)) {
            session()->flash('error', sprintf(self::ERROR_NOT_IN_GAME, Auth::user()->name));

            return redirect()->route('welcome');
        }

        return view(self::VIEW_SHOW_GAME, [
            'game' => $game,
            'current_player' => $currentPlayer,
        ]);
    }

    /**
     * Joins the game of another person
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

        session()->flash('success', sprintf(self::MESSAGE_JOINED_GAME, Auth::user()->name));

        return redirect()->route(self::ROUTE_SHOW_GAME, [$game->id]);
    }

    /**
     * Starts a game
     *
     * @param int $gameId
     *
     * @return RedirectResponse
     */
    public function start($gameId)
    {
        $game = Game::find($gameId);

        if (is_null($game)) {
            session()->flash('error', sprintf(self::ERROR_NO_GAMES_FOUND, Auth::user()->name));

            return redirect()->route('welcome');
        }

        if (count($game->players) < 2) {
            session()->flash('error', sprintf(self::ERROR_NOT_ENOUGH_PLAYERS));

            return redirect()->route('games.show', $game->id);
        }

        $game->state = Game::STATE_IN_PROGRESS;
        $game->save();

        session()->flash('success', sprintf(self::MESSAGE_STARTED_GAME));
        return redirect()->route(self::ROUTE_SHOW_GAME, $game->id);
    }
}
