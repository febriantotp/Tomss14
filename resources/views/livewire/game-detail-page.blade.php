@php
use App\Helpers\PlatformHelper;
@endphp

<div>
    {{-- Main Content --}}
    <div class="w-100 flex flex-row mt-6 mb-2" style="z-index: 1;">
        {{-- Left Content --}}
        <div class="left-content bg-transparent border-0">
            {{-- Game Name - Uploader - Thumbnail - Desc --}}
            <div class="game-detail-card border border-1 rounded-lg shadow p-4 mb-4">
                {{-- Game Name, Uploader & Breadcrumb --}}
                <div class="bg-transparent border-0 flex flex-row justify-between items-stretch">
                    <div class="game-detail-name text-secondary mb-5">
                        <h3 class="text-blue text-2xl font-semibold">{{ $game->name }}</h3>
                        <small class="text-medium">Posted by Admin - {{ $game->created_at }}</small>
                    </div>
                    <div class="game-detail-breadcrumb text-secondary text-sm">
                        <small><a href="/">Home</a> / <a href="/games">Games</a> / {{ $game->name }}</small>
                    </div>
                </div>
                {{-- Thumbnail & Desc --}}
                <div class="game-detail-thumb-desc mb-4">
                    <img src="{{ asset('storage/' . $game->thumbnail) }}" class="game-detail-thumb me-4 shadow rounded-lg" alt="{{ $game->name }}" style="min-height: 100%; max-height: 100%;">
                    <p class="game-detail-desc">{{ $game->description }}</p>
                </div>
                {{-- Developer - Genre - Size --}}
                <div class="game-specifications">
                    <p class="font-medium text-blue">Developer / Publisher: <span class="font-normal text-secondary">{{ $game->developer }}</span></p>
                    <p class="font-medium text-blue">Genres: <span class="font-normal text-secondary">{{ $this->genre_names }}</span></p>
                    <p class="font-medium text-blue">Game Size: <span class="font-normal text-secondary">{{ $game->game_size }}</span></p>
                </div>
            </div>

            {{-- Game Screenshots --}}
            <div class="game-detail-card border border-1 rounded-lg shadow p-4 mb-4">
                {{-- Game Screenshots --}}
                <div class="game-detail-screenshots text-secondary mb-5">
                    <h3 class="text-blue text-lg font-semibold mb-5">Game Screenshots:</h3>
                    <div class="screenshots-grid grid grid-cols-3 gap-4">
                        @foreach($game->screenshots as $screenshot)
                            <img src="{{ asset('storage/' . str_replace('\\', '/', $screenshot)) }}" 
                            class="game-detail-screenshots-img me-4 shadow rounded-lg" alt="Game Screenshots">
                        @endforeach
                    </div>
                    
                </div>
            </div>

            {{-- Game Minimum Requirements --}}
            <div class="game-detail-card border border-1 rounded-lg shadow p-4 mb-4">
                {{-- Game Minimum Requirements --}}
                <div class="game-detail-minimumreq-card text-secondary mb-5">
                    <h3 class="text-blue text-lg font-semibold mb-5">Game System Minimum Requirements:</h3>
                    <p class="game-detail-minimumreq">{{ $game->requirement }}</p>
                </div>
            </div>

            {{-- Game Howtoinstall --}}
            <div class="game-detail-card border border-1 rounded-lg shadow p-4 mb-4">
                {{-- Game How to install--}}
                <div class="game-detail-tutor-card text-secondary mb-5">
                    <h3 class="text-blue text-lg font-semibold mb-5">How to Install:</h3>
                    <p class="game-detail-tutor">{{ $game->howtoinstall }}</p>
                </div>
            </div>

            {{-- Game Links --}}
            <div class="game-detail-card border border-1 rounded-lg shadow p-4 mb-8">
                {{-- Game Links --}}
                <h3 class="text-blue text-lg font-semibold mb-5">Game Links:</h3>
                <div class="dropdown relative inline-block text-left text-blue mb-3">
                    <button onclick="toggleDropdown()" class="linkBtn font-medium border border-1 rounded-lg shadow p-2 mb-2 hover:bg-gray-100">Download Game<i class="ms-2 bi bi-cloud-download"></i></button>
                    <div class="dropdown-link-content text-blue border border-1 rounded-lg shadow hidden underline">
                        <a target="blank" class="hover:bg-gray-300" href="{{ $game->link1 }}">Primary Link</a>
                        <a target="blank" class="hover:bg-gray-300" href="{{ $game->link2 }}">Mirror Link</a>
                    </div>
                </div>
                <small class="text-secondary text-sm">*Click to show download links</small>
                <small class="text-secondary text-sm">*Click again to close download links</small>
            </div>

            {{-- Disqus Thread --}}
            <div class="game-detail-card-disqus border border-1 rounded-lg shadow p-4 mb-4">
                <h3 class="text-blue text-2xl font-semibold mb-4">Comments:</h3>
                <div id="disqus_thread"></div>
            </div>

            @push('scripts')
            <script>
                function toggleDropdown() {
                    // Cari elemen dropdown-link-content dan toggle class 'hidden'
                    const dropdownContent = document.querySelector('.dropdown-link-content');
                    dropdownContent.classList.toggle('hidden'); // Menampilkan atau menyembunyikan dropdown
                }

                var disqus_config = function () {
                    this.page.url = "{{ url()->current() }}";  // URL halaman saat ini
                    this.page.identifier = "{{ $game->id }}"; // ID unik untuk halaman ini
                    this.callbacks.onReady = [function() {
                         // Ganti warna teks pada bagian "What Do You Think?"
                        var commentBox = document.querySelector('.disqus-comment-count');
                        if (commentBox) {
                            commentBox.style.color = '#2c5ce0b0';  // Misalnya ganti warna teks menjadi merah
                        }
                        
                        // Ganti warna teks pada komentar
                        var commentText = document.querySelectorAll('.disqus-comment .disqus-comment-text');
                        commentText.forEach(function(el) {
                            el.style.color = '#2c5ce0b0';  // Ganti warna teks komentar menjadi putih
                        });
                    }];
                };

                (function() { // Skrip Disqus
                    var d = document, s = d.createElement('script');
                    s.src = 'https://tomss14.disqus.com/embed.js'; // Ganti 'tomss14' dengan shortname Disqus kamu
                    s.setAttribute('data-timestamp', +new Date());
                    if (!document.getElementById('disqus-script')) { // Pastikan tidak dimuat dua kali
                        s.id = 'disqus-script';
                        (d.head || d.body).appendChild(s);
                    }
                })();

                // Fungsi untuk menyesuaikan ukuran font berdasarkan lebar layar
                function adjustDisqusFontSize() {
                    var iframe = document.querySelector('iframe[id^="dsq-app"]'); // Target iframe Disqus

                    if (iframe) {
                        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document; // Akses dokumen iframe

                        if (iframeDoc) {
                            // Ambil elemen komentar di dalam iframe
                            var comments = iframeDoc.querySelectorAll('.post-message'); // Sesuaikan dengan class Disqus

                            comments.forEach(function (comment) {
                                if (window.innerWidth <= 768) {
                                    comment.style.fontSize = '14px'; // Font size untuk layar kecil
                                } else if (window.innerWidth <= 1024) {
                                    comment.style.fontSize = '16px'; // Font size untuk layar sedang
                                } else {
                                    comment.style.fontSize = '18px'; // Font size untuk layar besar
                                }
                            });
                        }
                    }
                }

                // Jalankan fungsi saat iframe Disqus selesai dimuat
                var disqusObserver = new MutationObserver(function () {
                    var iframe = document.querySelector('iframe[id^="dsq-app"]');
                    if (iframe) {
                        adjustDisqusFontSize(); // Panggil fungsi untuk menyesuaikan font-size
                        disqusObserver.disconnect(); // Hentikan pengamatan setelah iframe dimuat
                    }
                });

                disqusObserver.observe(document.body, { childList: true, subtree: true });

                // Tambahkan listener untuk menangani perubahan ukuran layar
                window.addEventListener('resize', adjustDisqusFontSize);
            </script>
            @endpush



        </div>

        {{-- Right Content --}}
        <div class="right-content card bg-transparent border-0 w-100 ms-6">
            {{-- Related Games --}}
            <div class="related-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.6); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Related Games</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($relatedGames->isNotEmpty())
                            @foreach($relatedGames as $relatedGame)
                                <a class="popular-card bg-transparent border-0 no-underline" href="/games/{{ $relatedGame->game_slug }}">
                                    <div class="game-card-popular border border-light border-1 rounded-lg shadow">
                                        <h4 class="text-blue font-bold m-2 flex items-center justify-between">{{ $relatedGame->game_name }}<p class="font-semibold text-blue text-md" style="max-width: fit-content; display: flex; align-items: start;">{!! PlatformHelper::getPlatformIcon($game->platform_id) !!}</p></h4>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h5 class="text-secondary text-lg">No related games available.</h5>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Popular Windows Games --}}
            <div class="popular-windows-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.6); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular Games on Windows</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($popularWindows->isNotEmpty())
                            @foreach($popularWindows as $game)
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

            {{-- Popular PlayStation 1 Games --}}
            <div class="popular-ps1-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.6); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular Games on PlayStation 1</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($popularPS1->isNotEmpty())
                            @foreach($popularPS1 as $game)
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

            {{-- Popular PlayStation 2 Games --}}
            <div class="popular-ps2-games border border-1 rounded-lg shadow p-4 mb-4" style="background: rgba(230, 230, 230, 0.6); backdrop-filter: blur(10px); max-width: 100%;">
                <div class="font-semibold border-0 bg-transparent">
                    <h5 class="text-secondary text-xl">Popular Games on PlayStation 2</h5>
                </div>
                <div class="card-body d-flex py-3" style="align-items: flex-start;">
                    <!-- Game Card Container -->
                    <div class="flex flex-col align-items-start w-100 h-auto">
                        @if($popularPS2->isNotEmpty())
                            @foreach($popularPS2 as $game)
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
