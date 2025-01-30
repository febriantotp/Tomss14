<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Untuk pagination
use App\Models\Game;

class PS2Games extends Component
{
    use WithPagination;


    public $selectedGenres = [];
    public $sortBy = 'alphabet_asc'; // Default adalah A-Z

    public $search = '';
    public $perPage = 18;

    protected $queryString = [
        'selectedGenres' => ['except' => null],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'alphabet_asc'],  // Menambahkan sortBy ke queryString
    ];

    protected $listeners = ['$refresh'];

    public function updating($field)
    {
        // Reset pagination jika ada perubahan filter
        $this->resetPage();
    }

    public function getFilteredGamesProperty()
    {
        return Game::with('genres')
            ->where('platform_id', 3)
            ->when(count($this->selectedGenres), function ($query) {
                $query->whereHas('genres', function ($q) {
                    $q->whereIn('genres.id', $this->selectedGenres);
                });
            })
            // Pengurutan berdasarkan A-Z atau Z-A
            ->when($this->sortBy === 'alphabet_asc', function ($query) {
                $query->orderBy('name', 'asc'); // A-Z
            })
            ->when($this->sortBy === 'alphabet_desc', function ($query) {
                $query->orderBy('name', 'desc'); // Z-A
            })
            // Pengurutan berdasarkan Recent
            ->when($this->sortBy === 'recent', function ($query) {
                $query->orderByDesc('created_at'); // Urutkan berdasarkan tanggal terbaru
            })
            // Pengurutan berdasarkan Popularity
            ->when($this->sortBy === 'popular', function ($query) {
                $query->orderByDesc('total_views'); // Urutkan berdasarkan popularitas (total views)
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);
            
    }


    public function render()
    {
        return view('livewire.ps2-games', [
            'games' => $this->filteredGames,
        ])
        ->layout('components.layouts.app', [
            'title' => 'All PlayStation 2 Games - Tomss14 - Free Games for You!',
            'meta_description' => 'Free Games for You!',
            'meta_keyword' => 'free games, ps1, ps2, windows games, popular games',
        ]);
    }
}
