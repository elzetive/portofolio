<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} — Full Stack Web Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #111418;
            color: #f3f4f6;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-mono-code {
            font-family: 'Fira Code', monospace;
        }
        .glow-emerald {
            box-shadow: 0 0 32px rgba(16, 185, 129, 0.22);
        }
        .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.025) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
            background-size: 36px 36px;
        }
        .asymmetric-photo {
            border-radius: 1.5rem 4rem 1.5rem 1.5rem;
        }
    </style>
</head>
<body class="antialiased bg-grid-pattern selection:bg-emerald-500 selection:text-gray-950">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-[#111418]/90 backdrop-blur border-b border-gray-800/80">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('portfolio.index') }}" class="font-mono-code text-sm font-semibold text-gray-200 flex items-center gap-2">
                <span class="text-emerald-400">&lt;/&gt;</span> {{ $profile['name'] }}
            </a>
            <div class="flex items-center gap-6 font-mono-code text-xs text-gray-400">
                <a href="#home" class="text-emerald-400 hidden sm:inline">&lt;Home&gt;</a>
                <a href="#portfolio" class="hover:text-emerald-400 transition hidden sm:inline">Portfolio</a>
                <a href="#github" class="hover:text-emerald-400 transition hidden sm:inline">GitHub</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-1.5 rounded-lg bg-emerald-500 text-gray-950 font-semibold hover:bg-emerald-400 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-1.5 rounded-lg border border-gray-700 hover:border-emerald-500/50 text-gray-300 transition">Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative overflow-hidden py-16 lg:py-24">
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-12 gap-12 lg:gap-8 items-center relative z-10">
            <!-- Sisi Kiri (Teks & Deskripsi) -->
            <div class="lg:col-span-6 space-y-6">
                <div class="font-mono-code text-xs text-gray-600 space-y-1 select-none">
                    <div>&lt;html&gt;</div>
                    <div class="pl-4">&lt;body&gt;</div>
                    <div class="pl-8">&lt;h1&gt;</div>
                </div>

                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-none pl-4">
                    Hello,<br>
                    Im <span class="text-emerald-400 relative inline-block">
                        {{ $profile['short_name'] }},
                        <span class="absolute bottom-1 left-0 w-full h-2 bg-emerald-500/20 -z-10"></span>
                    </span><br>
                    <span class="text-white">{{ $profile['role'] }}</span>
                </h1>

                <div class="font-mono-code text-xs text-gray-600 pl-8 select-none">&lt;/h1&gt;</div>

                <p class="font-mono-code text-sm text-gray-400 pl-4 leading-relaxed">
                    <span class="text-gray-600">&lt;p&gt;</span>
                    {{ $profile['subtitle'] }}
                    <span class="text-gray-600">&lt;/p&gt;</span>
                </p>

                <div class="pt-4 pl-4 flex flex-wrap items-center gap-4">
                    <a href="#portfolio" class="px-7 py-3.5 rounded-lg bg-emerald-500 text-gray-950 font-bold font-mono-code text-xs sm:text-sm hover:bg-emerald-400 transition transform hover:-translate-y-0.5 glow-emerald">
                        Explore Projects
                    </a>
                    <a href="#github" class="px-6 py-3.5 rounded-lg border border-gray-800 bg-[#15191f]/80 text-gray-300 hover:text-emerald-400 font-mono-code text-xs sm:text-sm hover:border-emerald-500/40 transition">
                        GitHub Repositories &rarr;
                    </a>
                </div>

                <div class="font-mono-code text-xs text-gray-700 pl-4 pt-4 space-y-1 select-none hidden sm:block">
                    <div>&lt;/body&gt;</div>
                    <div>&lt;/html&gt;</div>
                </div>
            </div>

            <!-- Sisi Kanan (Visual Frame Foto Ekstra Besar & Asimetris) -->
            <div class="lg:col-span-6 flex justify-center lg:justify-end relative">
                <div class="absolute -top-3 -left-3 w-12 h-12 border-t-2 border-l-2 border-emerald-500/50 rounded-tl-xl pointer-events-none"></div>
                <div class="absolute -bottom-3 -right-3 w-12 h-12 border-b-2 border-r-2 border-emerald-500/50 rounded-br-xl pointer-events-none"></div>

                <div class="hidden sm:flex flex-col gap-1.5 absolute -left-6 top-1/3 pointer-events-none">
                    <span class="w-6 h-1 bg-emerald-400/70"></span>
                    <span class="w-3 h-1 bg-teal-400/50 ml-3"></span>
                    <span class="w-8 h-1 bg-emerald-500/40"></span>
                </div>

                <div class="relative w-full max-w-[430px] rounded-3xl bg-[#181c22]/95 border border-emerald-500/30 p-6 flex flex-col justify-between gap-5 glow-emerald overflow-hidden group">
                    <div class="flex items-center justify-between z-10">
                        <span class="px-3.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono-code text-[11px] flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            Available for Hire
                        </span>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-gray-700"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/60"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        </div>
                    </div>

                    <div class="relative w-full aspect-square asymmetric-photo bg-gradient-to-tr from-emerald-500/40 via-teal-400/20 to-emerald-500/40 p-[2px] overflow-hidden">
                        <div class="absolute bottom-3 left-3 px-2.5 py-1 rounded-md bg-[#111418]/85 backdrop-blur border border-gray-800 font-mono-code text-[10px] text-emerald-400 z-10 select-none">
                            &lt;dev /&gt;
                        </div>
                        <img src="{{ asset('dimas.jpeg') }}"
                             alt="{{ $profile['name'] }}"
                             class="w-full h-full asymmetric-photo object-cover object-top group-hover:scale-[1.03] transition-transform duration-500">
                    </div>

                    <div class="space-y-4 z-10">
                        <div class="text-center">
                            <h2 class="font-extrabold text-2xl text-white tracking-tight">{{ $profile['name'] }}</h2>
                            <p class="font-mono-code text-xs text-gray-400 mt-1 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $profile['location'] }}
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-2 pt-3 border-t border-gray-800/90 font-mono-code text-[11px] text-center text-gray-300">
                            <div class="bg-[#111418] border border-gray-800 py-2 rounded-lg hover:border-emerald-500/40 hover:text-emerald-400 transition">Laravel</div>
                            <div class="bg-[#111418] border border-gray-800 py-2 rounded-lg hover:border-emerald-500/40 hover:text-emerald-400 transition">AJAX / JS</div>
                            <div class="bg-[#111418] border border-gray-800 py-2 rounded-lg hover:border-emerald-500/40 hover:text-emerald-400 transition">MySQL</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section id="portfolio" class="py-20 bg-[#15191f]/90 border-y border-gray-800/80">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-12">
                <p class="font-mono-code text-xs text-emerald-400 mb-2">// FEATURED WORK</p>
                <h2 class="text-3xl font-bold text-white">Selected Systems &amp; Applications</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <article class="bg-[#181c22] border border-gray-800 hover:border-emerald-500/50 rounded-xl overflow-hidden flex flex-col justify-between transition group">
                        <div>
                            @if ($project->thumbnail)
                                <div class="overflow-hidden border-b border-gray-800">
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-6">
                                <span class="font-mono-code text-xs text-emerald-400">{{ $project->category }}</span>
                                <h3 class="text-xl font-bold text-white mt-2 mb-3">{{ $project->title }}</h3>
                                <p class="text-sm text-gray-400 leading-relaxed">{{ $project->description }}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6">
                            <div class="flex flex-wrap gap-2 mb-5">
                                @foreach ($project->tech_stack as $tag)
                                    <span class="px-2.5 py-1 rounded bg-[#111418] text-gray-300 font-mono-code text-[11px] border border-gray-800">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex items-center gap-4 font-mono-code text-xs">
                                @if ($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="text-emerald-400 hover:underline">Source Code &rarr;</a>
                                @endif
                                @if ($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" class="text-gray-300 hover:text-emerald-400">Live Demo &nearr;</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Live GitHub Repositories -->
    <section id="github" class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <p class="font-mono-code text-xs text-emerald-400 mb-2">// GITHUB REST API</p>
                    <h2 class="text-3xl font-bold text-white">Public Repositories</h2>
                </div>
                <form id="githubForm" class="flex gap-2">
                    <input type="text" id="usernameInput" value="{{ $profile['github_username'] }}"
                        placeholder="GitHub username..."
                        class="bg-[#181c22] border border-gray-700 rounded-lg px-4 py-2 font-mono-code text-xs text-white focus:outline-none focus:border-emerald-500">
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-400 text-gray-950 font-semibold px-4 py-2 rounded-lg font-mono-code text-xs transition">
                        Load Repos
                    </button>
                </form>
            </div>

            <div id="repoGrid" class="grid md:grid-cols-3 gap-6">
                @forelse ($repos as $repo)
                    <a href="{{ $repo['html_url'] }}" target="_blank" class="block bg-[#181c22] border border-gray-800 hover:border-emerald-500/50 rounded-xl p-5 transition">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-mono-code text-sm font-semibold text-emerald-400 truncate">{{ $repo['name'] }}</h3>
                            <span class="font-mono-code text-xs text-gray-500">★ {{ $repo['stargazers_count'] }}</span>
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-2 mb-4 h-8">{{ $repo['description'] ?? 'No description provided.' }}</p>
                        <div class="flex items-center justify-between font-mono-code text-[11px] text-gray-500">
                            <span>{{ $repo['language'] ?? 'PHP / Blade' }}</span>
                            <span>{{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}</span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-10 bg-[#181c22] rounded-xl border border-gray-800 font-mono-code text-xs text-gray-400">
                        Repository tidak ditemukan. Masukkan username GitHub valid di atas.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 border-t border-gray-800 text-center font-mono-code text-xs text-gray-500">
        &lt;/&gt; Built with Laravel &amp; Tailwind CSS by {{ $profile['name'] }}
    </footer>

    <script>
        document.getElementById('githubForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const username = document.getElementById('usernameInput').value.trim();
            const grid = document.getElementById('repoGrid');
            if (!username) return;

            grid.innerHTML = `<div class="col-span-3 text-center py-8 font-mono-code text-xs text-emerald-400">Memuat repository dari GitHub API...</div>`;

            const res = await fetch(`{{ route('portfolio.repos') }}?username=${encodeURIComponent(username)}`);
            const json = await res.json();

            if (!json.status || json.data.length === 0) {
                grid.innerHTML = `<div class="col-span-3 text-center py-8 font-mono-code text-xs text-red-400">Repository publik tidak ditemukan untuk user tersebut.</div>`;
                return;
            }

            grid.innerHTML = json.data.map(repo => `
                <a href="${repo.html_url}" target="_blank" class="block bg-[#181c22] border border-gray-800 hover:border-emerald-500/50 rounded-xl p-5 transition">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-mono-code text-sm font-semibold text-emerald-400 truncate">${repo.name}</h3>
                        <span class="font-mono-code text-xs text-gray-500">★ ${repo.stargazers_count}</span>
                    </div>
                    <p class="text-xs text-gray-400 line-clamp-2 mb-4 h-8">${repo.description || 'No description provided.'}</p>
                    <div class="flex items-center justify-between font-mono-code text-[11px] text-gray-500">
                        <span>${repo.language || 'Code'}</span>
                        <span>Forks: ${repo.forks_count}</span>
                    </div>
                </a>
            `).join('');
        });
    </script>
</body>
</html>
