@php
use App\Helpers\PlatformHelper;
@endphp

<div>
    <div class="main-content flex flex-row mt-6 mb-2" style="z-index: 1;">
        {{-- Left Content --}}
        <div class="left-content card bg-transparent border-0">
            {{-- Popular Games --}}
            <div class="recent-uploaded-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold flex flex-row justify-between items-stretch border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular Games</h5>
                    <div class="game-detail-breadcrumb text-secondary text-sm">
                        <small><a href="/">Home</a> / <a href="/games">Games</a> / Popular Games</small>
                    </div>
                </div>
                <div class="card-body d-flex py-5" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="game-card-con align-items-start w-100 h-auto pb-2">
                        @if($popularGames->isNotEmpty())
                            @foreach($popularGames as $game)
                                <div class="game-card border border-light border-1 rounded-lg me-4 p-2 shadow">
                                    <a class="bg-transparent border-0 no-underline" href="{{ route('game.detail', ['slug' => $game->game_slug]) }}">
                                        <img src="{{ asset('storage/' . $game->game_thumbnail) }}" class="card-img-top shadow rounded-lg" alt="{{ $game->game_name }}">
                                        <h4 class="text-blue font-bold mt-2 mb-2">{{ $game->game_name }}</h5>
                                        <p class="card-text text-md mb-2">{{ \Illuminate\Support\Str::limit($game->game_summary, 50, '...') }}</p>
                                        <p class="card-text text-sm">{{ $game->genre_names }}</p>
                                        <p class="card-text text-md" style="max-width: fit-content; display: flex; align-items: start;">{!! PlatformHelper::getPlatformIcon($game->platform_id) !!}</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Popular Windows Games --}}
            <div class="recent-uploaded-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular Windows Games</h5>
                </div>
                <div class="card-body d-flex py-5" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="game-card-con align-items-start w-100 h-auto pb-2">
                        @if($popularWindowsGames->isNotEmpty())
                            @foreach($popularWindowsGames as $game)
                                <div class="game-card border border-light border-1 rounded-lg me-4 p-2 shadow">
                                    <a class="bg-transparent border-0 no-underline" href="{{ route('game.detail', ['slug' => $game->game_slug]) }}">
                                        <img src="{{ asset('storage/' . $game->game_thumbnail) }}" class="card-img-top shadow rounded-lg" alt="{{ $game->game_name }}">
                                        <h4 class="text-blue font-bold mt-2 mb-2">{{ $game->game_name }}</h5>
                                        <p class="card-text text-md mb-2">{{ \Illuminate\Support\Str::limit($game->game_summary, 50, '...') }}</p>
                                        <p class="card-text text-sm">{{ $game->genre_names }}</p>
                                        <p class="card-text text-md" style="max-width: fit-content; display: flex; align-items: start;">{!! PlatformHelper::getPlatformIcon($game->platform_id) !!}</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Popular PlayStation 1 Games --}}
            <div class="recent-uploaded-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular PlayStation 1 Games</h5>
                </div>
                <div class="card-body d-flex py-5" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="game-card-con align-items-start w-100 h-auto pb-2">
                        @if($popularPS1Games->isNotEmpty())
                            @foreach($popularPS1Games as $game)
                                <div class="game-card border border-light border-1 rounded-lg me-4 p-2 shadow">
                                    <a class="bg-transparent border-0 no-underline" href="{{ route('game.detail', ['slug' => $game->game_slug]) }}">
                                        <img src="{{ asset('storage/' . $game->game_thumbnail) }}" class="card-img-top shadow rounded-lg" alt="{{ $game->game_name }}">
                                        <h4 class="text-blue font-bold mt-2 mb-2">{{ $game->game_name }}</h5>
                                        <p class="card-text text-md mb-2">{{ \Illuminate\Support\Str::limit($game->game_summary, 50, '...') }}</p>
                                        <p class="card-text text-sm">{{ $game->genre_names }}</p>
                                        <p class="card-text text-md" style="max-width: fit-content; display: flex; align-items: start;">{!! PlatformHelper::getPlatformIcon($game->platform_id) !!}</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Popular PlayStation 2 Games --}}
            <div class="recent-uploaded-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular PlayStation 2 Games</h5>
                </div>
                <div class="card-body d-flex py-5" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="game-card-con align-items-start w-100 h-auto pb-2">
                        @if($popularPS2Games->isNotEmpty())
                            @foreach($popularPS2Games as $game)
                                <div class="game-card border border-light border-1 rounded-lg me-4 p-2 shadow">
                                    <a class="bg-transparent border-0 no-underline" href="{{ route('game.detail', ['slug' => $game->game_slug]) }}">
                                        <img src="{{ asset('storage/' . $game->game_thumbnail) }}" class="card-img-top shadow rounded-lg" alt="{{ $game->game_name }}">
                                        <h4 class="text-blue font-bold mt-2 mb-2">{{ $game->game_name }}</h5>
                                        <p class="card-text text-md mb-2">{{ \Illuminate\Support\Str::limit($game->game_summary, 50, '...') }}</p>
                                        <p class="card-text text-sm">{{ $game->genre_names }}</p>
                                        <p class="card-text text-md" style="max-width: fit-content; display: flex; align-items: start;">{!! PlatformHelper::getPlatformIcon($game->platform_id) !!}</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Content --}}
        <div class="right-content card bg-transparent border-0 w-100 ms-6">
            {{-- Recent Uploaded Games --}}
            <div class="popular-windows-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Recent Uploaded Games</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($recentUploadedGames->isNotEmpty())
                            @foreach($recentUploadedGames as $game)
                                <a class="popular-card bg-transparent border-0 no-underline" href="/games/{{ $game->game_slug }}">
                                    <div class="game-card-popular border border-light border-1 rounded-lg shadow">
                                        <h4 class="text-blue font-bold m-2">{{ $game->game_name }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Uploaded Windows Games --}}
            <div class="popular-ps1-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Recent Uploaded Windows Games</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($recentUploadedWindowsGames->isNotEmpty())
                            @foreach($recentUploadedWindowsGames as $game)
                                <a class="popular-card bg-transparent border-0 no-underline" href="/games/{{ $game->game_slug }}">
                                    <div class="game-card-popular border border-light border-1 rounded-lg shadow">
                                        <h4 class="text-blue font-bold m-2">{{ $game->game_name }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Uploaded PlayStation 1 Games --}}
            <div class="popular-ps1-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Recent Uploaded PlayStation 1 Games</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($recentUploadedPS1Games->isNotEmpty())
                            @foreach($recentUploadedPS1Games as $game)
                                <a class="popular-card bg-transparent border-0 no-underline" href="/games/{{ $game->game_slug }}">
                                    <div class="game-card-popular border border-light border-1 rounded-lg shadow">
                                        <h4 class="text-blue font-bold m-2">{{ $game->game_name }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Uploaded PlayStation 2 Games --}}
            <div class="popular-ps2-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Recent Uploaded PlayStation 2 Games</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($recentUploadedPS2Games->isNotEmpty())
                            @foreach($recentUploadedPS2Games as $game)
                                <a class="popular-card bg-transparent border-0 no-underline" href="/games/{{ $game->game_slug }}">
                                    <div class="game-card-popular border border-light border-1 rounded-lg shadow">
                                        <h4 class="text-blue font-bold m-2">{{ $game->game_name }}</h5>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">Comming Soon...</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>