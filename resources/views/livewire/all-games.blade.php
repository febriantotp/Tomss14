@php
use App\Helpers\PlatformHelper;
@endphp

{{-- All Games --}}
<div class="all-games border border-1 rounded-lg shadow mt-6 p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
    <div class="font-semibold flex flex-row justify-between items-stretch border-0 bg-transparent mb-4">
        <h5 class="text-secondary text-xl">All Games</h5>
        <div class="game-detail-breadcrumb text-secondary text-sm">
            <small><a href="/">Home</a> / <a href="/games">All Games</a></small>
        </div>
    </div>
    <div class="all-games-con flex flex-row" style="width: 100%">
        <div class="filters-container me-6" style="min-width: 25%; max-width: 25%;">
            {{-- Filters --}}
            <div class="filters mb-4 d-flex justify-between">
                {{-- Filter Sort By --}}
                <div class="filter-card form-control border border-light border-1 rounded-lg shadow me-2 py-1 px-2 mb-2">
                    <label class="font-bold mb-2">Sort by:</label>

                    {{-- Sort by Alphabet A-Z --}}
                    <label for="alphabet-asc" class="flex items-center">
                        <input type="radio" wire:model.live="sortBy" value="alphabet_asc" id="alphabet-asc" class="w-4 h-4 mr-2">
                        <span>A-Z</span>
                    </label>

                    {{-- Sort by Alphabet Z-A --}}
                    <label for="alphabet-desc" class="flex items-center">
                        <input type="radio" wire:model.live="sortBy" value="alphabet_desc" id="alphabet-desc" class="w-4 h-4 mr-2">
                        <span>Z-A</span>
                    </label>

                    {{-- Sort by Recent --}}
                    <label for="sort-recent" class="flex items-center">
                        <input type="radio" wire:model.live="sortBy" value="recent" id="sort-recent" class="mr-2">
                        <span>Sort by Recent</span>
                    </label>

                    {{-- Sort by Popularity --}}
                    <label for="sort-popular" class="flex items-center">
                        <input type="radio" wire:model.live="sortBy" value="popular" id="sort-popular" class="mr-2">
                        <span>Sort by Popularity</span>
                    </label>
                </div>

                {{-- Platform Filters --}}
                <div class="filter-card form-control border border-light border-1 rounded-lg shadow me-2 py-1 px-2 mb-2">
                    <label class="font-bold mb-2">Filter by Platform:</label>

                    @foreach (\App\Models\Platform::all() as $platform)
                        <label for="{{ $platform->slug }}" class="flex items-center">
                            <input type="checkbox" wire:model.live="selectedPlatforms" id="{{ $platform->slug }}" value="{{ $platform->id }}" class="w-4 h-4 mr-2">
                            <span>{{ $platform->name }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Genre Filters --}}
                <div class="filter-card form-control border border-light border-1 rounded-lg shadow me-2 py-1 px-2 mb-2">
                    <label class="font-bold mb-2">Filter by Genre:</label>

                    @foreach (\App\Models\Genre::all() as $genre)
                        <label for="{{ $genre->slug }}" class="flex items-center">
                            <input type="checkbox" wire:model.live="selectedGenres" id="{{ $genre->slug }}" value="{{ $genre->id }}" class="w-4 h-4 mr-2">
                            <span>{{ $genre->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="game-grid-containter" style="width: 100%">
            {{-- Game Card Grid --}}
            <div class="all-games-card-con grid">
                @if($games->isNotEmpty())
                        @foreach($games as $game)
                            <div class="all-games-card border border-light border-1 rounded-lg mb-3 p-2 shadow">
                                <a class="bg-transparent border-0 no-underline" href="{{ route('game.detail', ['slug' => $game->slug]) }}">
                                    <img src="{{ asset('storage/' . $game->thumbnail) }}" class="card-img-top shadow rounded-lg" alt="{{ $game->name }}">
                                    <h4 class="text-blue font-bold mt-2 mb-2">{{ $game->name }}</h4>
                                    <p class="card-text text-md mb-2">{{ \Illuminate\Support\Str::limit($game->summary, 50, '...') }}</p>
                                    <p class="card-text text-sm mb-1">{{ $game->genre_names }}</p>
                                    <div class="card-footer">
                                        <p class="card-text text-md" style="max-width: fit-content; display: flex; align-items: start;">{!! PlatformHelper::getPlatformIcon($game->platform_id) !!}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h5 class="text-secondary text-lg">Comming Soon...</h5>
                    @endif
            </div>
        </div>
    </div>
    

    {{-- Pagination --}}
    <div class="pagination mt-4">
        {{ $games->links() }}
    </div>
</div>
