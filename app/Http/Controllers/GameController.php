<?php

namespace App\Http\Controllers;

use App\Helpers\PlatformHelper;
use App\Models\Game; // Pastikan Anda mengimpor model Game
use App\Models\GameRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller // Pastikan ini mewarisi dari Controller Laravel
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            // Validasi lainnya...
            'genre_id' => 'required|array', // Pastikan ini adalah array
            'genre_id.*' => 'exists:genres,id', // Validasi setiap ID genre
        ]);
    
        // Simpan game
        $game = Game::create($validatedData);
    
        // Sync genre ke tabel pivot
        $game->genres()->sync($validatedData['genre_id']);
    
        return redirect()->route('games.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
            'platform_id' => 'required|exists:platforms,id',
        ]);

        // Simpan data ke database
        GameRequest::create($validated);

        // Kembalikan respon JSON
        return response()->json(['message' => 'Request game applied'], 200);
    }

    public function index()
    {
        // Daftar platform yang ingin diambil
        $platformIds = [1, 2, 3]; // Platform: Windows (1), PS1 (2), PS2 (3)
        $gamesByPlatform = [];
        
        // Ambil 3 game terbaru untuk semua platform (Recent Uploaded Games)
        $recentUploadedGames = DB::table('games as g')
        ->select(
            'g.id AS game_id',
            'g.thumbnail AS game_thumbnail',
            'g.name AS game_name',
            'g.summary AS game_summary',
            'g.slug AS game_slug',
            'g.created_at',
            'g.platform_id',
            DB::raw('GROUP_CONCAT(gn.name ORDER BY gn.name ASC SEPARATOR ", ") AS genre_names')
        )
        ->leftJoin('game_genre as gg', 'g.id', '=', 'gg.game_id')
        ->leftJoin('genres as gn', 'gg.genre_id', '=', 'gn.id')
        ->groupBy('g.id', 'g.thumbnail', 'g.name', 'g.summary', 'g.slug', 'g.created_at', 'g.platform_id')
        ->limit(3) // Membatasi hanya 3 game secara umum
        ->orderBy('g.created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
        ->get();

        // Ambil 3 game terbaru untuk setiap platform (Windows, PS1, PS2)
        foreach ($platformIds as $platformId) {
            $gamesByPlatform[$platformId] = DB::table('games as g')
                ->select(
                    'g.id AS game_id',
                    'g.thumbnail AS game_thumbnail',
                    'g.name AS game_name',
                    'g.summary AS game_summary',
                    'g.slug AS game_slug',
                    'g.created_at',
                    'g.platform_id',
                    DB::raw('GROUP_CONCAT(gn.name ORDER BY gn.name ASC SEPARATOR ", ") AS genre_names')
                )
                ->leftJoin('game_genre as gg', 'g.id', '=', 'gg.game_id')
                ->leftJoin('genres as gn', 'gg.genre_id', '=', 'gn.id')
                ->where('g.platform_id', $platformId) // Filter berdasarkan platform
                ->groupBy('g.id', 'g.thumbnail', 'g.name', 'g.summary', 'g.slug', 'g.created_at', 'g.platform_id')
                ->limit(3) // Membatasi hanya 3 game per platform
                ->orderBy('g.created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
                ->get();
        }

        // Mengirim data ke view
        return view('home-page', [
            'title' => 'Game List',
            'games' => $recentUploadedGames, // Semua platform (Recent Uploaded Games)
            'resultWindows' => $gamesByPlatform[1] ?? collect(), // Windows Games
            'resultPS1' => $gamesByPlatform[2] ?? collect(), // PS1 Games
            'resultPS2' => $gamesByPlatform[3] ?? collect(), // PS2 Games
        ]);
    }

    
}