<?php

namespace App\Livewire\Partials;

use App\Models\Game;
use Livewire\Component;

class SearchBar extends Component
{
    public $search = "";
    public function render()
    {

        $results = [];

        if(strlen($this->search) >= 1) {
            $results = Game::with('platform')
            ->where('name', 'like', '%'.$this->search.'%')
            ->limit(5)
            ->get();
        }

        return view('livewire.partials.search-bar',[
            'games' => $results
        ]);
    }
}
