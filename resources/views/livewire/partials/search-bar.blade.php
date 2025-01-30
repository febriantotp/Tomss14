<div id="search-bar" class="relative">
    <form class="d-flex pt-3 md:pt-0" role="search">
        <input wire:model.live="search" id="search-input" class="form-control py-2 px-3 inline-flex items-center gap-x-2 font-mediums rounded-lg border border-transparent text-blue" type="search" placeholder="Search games..." aria-label="Search">
    </form>
    @if (sizeof($games) > 0)
        <div class="dropdown-search border font-bold rounded-lg mt-5">
            @foreach($games as $game)
                <div class="px-2 py-2 border-bottom">
                    <a class="search-results mx-1" href="/games/{{ $game->slug }}">
                        <span class="text-blue">{{ $game->name }}</span>
                        <small style="color: #2c5ce0b0;">
                            {{ $game->platform ? $game->platform->name : 'Unknown Platform' }}
                        </small>
                    </a>
                </div>
            @endforeach
        </div> 
    @endif
    
</div>