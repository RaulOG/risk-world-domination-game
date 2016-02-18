<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use App\Turn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;

class GamesController extends AppController
{
    const VIEW_SHOW_GAME = 'games.show';
    const ROUTE_SHOW_GAME = 'games.show';

    const MESSAGE_CREATED_GAME = '%s, you have successfully created the game!';
    const MESSAGE_JOINED_GAME = '%s, you have successfully joined the game!';
    const MESSAGE_STARTED_GAME = 'Game started! BAM!';
    const MESSAGE_ACTION_ATTACK = 'Attack successful';
    const MESSAGE_ACTION_EOT = 'End of turn';

    const ERROR_NO_GAMES_FOUND = 'No games found, try again later.';
    const ERROR_NOT_IN_GAME = 'You are not in this game';
    const ERROR_NOT_ENOUGH_PLAYERS = 'This game does not have enough players to start!';
    const ERROR_UNKNOWN_ACTION = 'Unknown action';

    const ACTION_ATTACK = 'action.attack';
    const ACTION_END_OF_TURN = 'action.eot';

    /**
     * Stores a new game
     *
     * @return RedirectResponse
     */
    public function store()
    {
        $game = new Game();
        $game->save();

        $player = new Player();
        $player->game_id = $game->id;
        $player->user_id = Auth::id();
        $player->is_host = true;
        $player->troops = 5;
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

        $turn = Turn
            ::where('game_id', $game->id)
            ->where('is_current', true)
            ->first();

        return view(self::VIEW_SHOW_GAME, [
            'game' => $game,
            'current_player' => $currentPlayer,
            'turn' => $turn,
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
        $player->troops = 5;
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

        $players = $game->players->toArray();
        $firstPlayer = $players[rand(0, count($game->players) - 1)];

        // Changing game state
        $game->state = Game::STATE_IN_PROGRESS;
        $game->save();

        // Creating a new turn
        $turn = new Turn();
        $turn->game_id = $game->id;
        $turn->player_id = $firstPlayer['id'];
        $turn->is_current = true;
        $turn->save();

        session()->flash('success', sprintf(self::MESSAGE_STARTED_GAME));

        return redirect()->route(self::ROUTE_SHOW_GAME, $game->id);
    }

    /**
     * Executes an action to given game
     */
    public function action($gameId)
    {
        $game = Game::find($gameId);

        if (is_null($game)) {
            session()->flash('error', sprintf(self::ERROR_NO_GAMES_FOUND, Auth::user()->name));

            return redirect()->route('welcome');
        }

        $action = Input::get('action');

        switch ($action) {
            case self::ACTION_ATTACK:
                return $this->actionAttack($game);
                break;
            case self::ACTION_END_OF_TURN:
                return $this->actionEOT($game);
                break;
            default:
                session()->flash('warning', sprintf(self::ERROR_UNKNOWN_ACTION));

                return redirect()->route(self::ROUTE_SHOW_GAME, $game->id);
        }
    }

    /**
     * Handles an attack
     *
     * @param Game $game
     *
     * @return RedirectResponse
     */
    private function actionAttack(Game $game)
    {
        // Get game's players
        $players = $game->players;

        // Assign an attacker and a defender from the game's players
        foreach ($players as $player) {
            if($player->user_id === Auth::id())
            {
                $attacker = $player;
            } else {
                $defender = $player;
            }
        }

        // Decide randomly who wins and who loses
        $loser = (rand(0,1) === 0)? $defender : $attacker;

        // Reduce by one the troops of the losing player
        $loser->troops = $loser->troops - 1;
        $loser->save();

        // If losing player now has 0 troops, Game ends:
        if($loser->troops === 0)
        {
            $game->state = Game::STATE_CLOSED;
            // @todo Game->winner_id = $winner->id;
            $game->save();
        }

        session()->flash('success', sprintf(self::MESSAGE_ACTION_ATTACK));

        return redirect()->route(self::ROUTE_SHOW_GAME, $game->id);
    }

    /**
     * Handles an eot
     *
     * @param Game $game
     *
     * @return RedirectResponse
     */
    private function actionEOT(Game $game)
    {
        // Current turn is not current anymore
        $turn = Turn
            ::where('game_id', $game->id)
            ->where('is_current', true)
            ->first();

        $turn->is_current = false;
        $turn->save();

        // Create new turn, which will be the new current
        $turn = new Turn();
        $turn->is_current = true;
        $turn->game_id = $game->id;

        // Get players from game and cycle them: get the player who is not the current player
        $players = $game->players;

        foreach($players as $player)
        {
            if($player->user_id !== Auth::id())
            {
                $nextPlayer = $player;
                break;
            }
        }

        // Set the turn's player to be the player found previously
        $turn->player_id = $nextPlayer->id;

        // Save the turn
        $turn->save();

        // Assign new troops to the new turn's player
        $nextPlayer->troops++;
        $nextPlayer->save();

        session()->flash('success', sprintf(self::MESSAGE_ACTION_EOT));

        return redirect()->route(self::ROUTE_SHOW_GAME, $game->id);
    }
}
