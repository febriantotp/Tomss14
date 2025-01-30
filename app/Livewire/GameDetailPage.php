<?php

namespace App\Livewire;

use App\Helpers\PlatformHelper;
use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class GameDetailPage extends Component
{
    public $game;
    public $popularWindows;
    public $popularPS1;
    public $popularPS2;

    public function mount($slug)
    {
         // Ambil data game berdasarkan slug
        $this->game = Game::with(['genres', 'platform'])->where('slug', $slug)->firstOrFail();

        // Tingkatkan jumlah views setiap kali halaman detail game diakses
        $this->game->increment('total_views');

        // Ambil popular games berdasarkan platform
        $this->popularWindows = $this->fetchGamesByPlatform(1); // Platform ID: Windows
        $this->popularPS1 = $this->fetchGamesByPlatform(2); // Platform ID: PlayStation 1
        $this->popularPS2 = $this->fetchGamesByPlatform(3); // Platform ID: PlayStation 2

        // Ambil related games berdasarkan platform dan genres
        $this->relatedGames = $this->fetchRelatedGames();

    }

    /**
     * Ambil game berdasarkan platform_id.
     *
     * @param int|null $platformId Platform ID untuk filter.
     * @param int $limit Batas jumlah game.
     * @return \Illuminate\Support\Collection
     */

    private function fetchGamesByPlatform(int $platformId, int $limit = 10)
    {
        return DB::table('games as g')
            ->select(
                'g.id AS id',
                'g.thumbnail AS game_thumbnail',
                'g.name AS game_name',
                'g.summary AS game_summary',
                'g.slug AS game_slug',
                DB::raw('GROUP_CONCAT(gn.name SEPARATOR ", ") AS genre_names')
            )
            ->leftJoin('game_genre as gg', 'g.id', '=', 'gg.game_id')
            ->leftJoin('genres as gn', 'gg.genre_id', '=', 'gn.id')
            ->where('g.platform_id', $platformId) // Filter berdasarkan platform_id
            ->where('g.slug', '!=', $this->game->slug) // Hindari game yang sedang dibuka
            ->groupBy('g.id', 'g.thumbnail', 'g.name', 'g.summary', 'g.slug')
            ->orderBy('g.created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->limit($limit) // Batas jumlah game
            ->get();
    }

    /**
     * Ambil related games berdasarkan platform dan genres.
     *
     * @return \Illuminate\Support\Collection
     */

    private function fetchRelatedGames(int $limit = 10)
    {
        $genreIds = $this->game->genres->pluck('id'); // Ambil genre ID dari game saat ini

        return DB::table('games as g')
            ->select(
                'g.id AS id',
                'g.thumbnail AS game_thumbnail',
                'g.name AS game_name',
                'g.summary AS game_summary',
                'g.slug AS game_slug',
                'g.platform_id',
                DB::raw('GROUP_CONCAT(gn.name SEPARATOR ", ") AS genre_names')
            )
            ->leftJoin('game_genre as gg', 'g.id', '=', 'gg.game_id')
            ->leftJoin('genres as gn', 'gg.genre_id', '=', 'gn.id')
            ->where('g.platform_id', $this->game->platform_id)
            ->whereIn('gn.id', $genreIds)
            ->where('g.slug', '!=', $this->game->slug)
            ->groupBy('g.id', 'g.thumbnail', 'g.name', 'g.summary', 'g.slug', 'g.platform_id')
            ->orderBy('g.created_at', 'desc')
            ->limit($limit)
            ->get();
    }




    public function getGenreNamesProperty()
    {
        return $this->game->genres->pluck('name')->join(', ');
    }

    public function render()
    {
        return view('livewire.game-detail-page', [
            'game' => $this->game,
            'resultWindows' => $this->popularWindows,
            'resultPS1' => $this->popularPS1,
            'resultPS2' => $this->popularPS2,
            'relatedGames' => $this->relatedGames,
            ])
            ->layout('components.layouts.app', [
                'title' => $this->game->meta_title ?? $this->game->name,
                'meta_description' => $this->game->meta_description,
                'meta_keyword' => $this->game->meta_keyword,
            ]);
    }
}
