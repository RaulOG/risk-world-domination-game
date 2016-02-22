<div class="container">
    <h2>Game closed</h2>
    @if ((int)$game->user_winner == Auth::id())
        <h3>You have won !!</h3>
    @else
        <h3>You have been defeated !!</h3>
    @endif
</div>
