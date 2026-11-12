<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} — Full Stack Web Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #111418; color: #f3f4f6; font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-code { font-family: 'Fira Code', monospace; }
        .glow-emerald { box-shadow: 0 0 28px rgba(16, 185, 129, 0.18); }
    </style>
</head>
<body class="antialiased selection:bg-emerald-500 selection:text-gray-950">

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
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded bg-emerald-500/15 text-emerald-400 border border-emerald-500/40">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-1.5 rounded border border-gray-700 hover:border-emerald-500/50 text-gray-300">Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="py-20 lg:py-28">
        <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-5">
                <div class="font-mono-code text-xs text-gray-600 space-y-1 select-none">
                    <div>&lt;html&gt;</div>
                    <div class="pl-4">&lt;body&gt;</div>
                    <div class="pl-8">&lt;h1&gt;</div>
                </div>

                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-tight pl-4">
                    Hello<br>
                    Im <span class="text-emerald-400">{{ $profile['short_name'] }},</span><br>
                    {{ $profile['role'] }}
                </h1>

                <div class="font-mono-code text-xs text-gray-600 pl-8 select-none">&lt;/h1&gt;</div>

                <p class="font-mono-code text-sm text-gray-400 pl-4">
                    <span class="text-gray-600">&lt;p&gt;</span> {{ $profile['subtitle'] }} <span class="text-gray-600">&lt;/p&gt;</span>
                </p>

                <div class="pt-4 pl-4 flex flex-wrap items-center gap-4">
                    <a href="#portfolio" class="px-6 py-3 rounded border border-emerald-500/60 bg-emerald-500/10 text-emerald-400 font-mono-code text-sm hover:bg-emerald-500 hover:text-gray-950 transition">
                        Explore Projects
                    </a>
                    <a href="#github" class="px-6 py-3 rounded text-gray-300 hover:text-emerald-400 font-mono-code text-sm transition">
                        GitHub Repositories &rarr;
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 flex justify-center">
                <div class="w-80 rounded-2xl bg-[#181c22] border border-gray-800 p-6 flex flex-col justify-between gap-6 glow-emerald">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono-code text-xs">
                            Available for Hire
                        </span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    </div>

                    <div class="text-center space-y-3 py-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-tr from-emerald-500 to-teal-300 p-0.5">
                            <div class="w-full h-full rounded-full bg-[#111418] flex items-center justify-center font-mono-code text-2xl font-bold text-emerald-400">
                                DR
                            </div>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg text-white">{{ $profile['name'] }}</h2>
                            <p class="font-mono-code text-xs text-gray-400">{{ $profile['location'] }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 pt-4 border-t border-gray-800 font-mono-code text-[11px] text-center text-gray-300">
                        <div class="bg-[#111418] py-2 rounded">Laravel</div>
                        <div class="bg-[#111418] py-2 rounded">AJAX / JS</div>
                        <div class="bg-[#111418] py-2 rounded">MySQL</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section (From Database) -->
    <section id="portfolio" class="py-20 bg-[#15191f] border-y border-gray-800/80">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-12">
                <p class="font-mono-code text-xs text-emerald-400 mb-2">// FEATURED WORK (DYNAMIC DATABASE)</p>
                <h2 class="text-3xl font-bold text-white">Selected Systems &amp; Applications</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <article class="bg-[#181c22] border border-gray-800 hover:border-emerald-500/50 rounded-xl overflow-hidden flex flex-col justify-between transition">
                        <div>
                            @if ($project->thumbnail)
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-44 object-cover border-b border-gray-800">
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
                        class="bg-[#181c22] border border-gray-700 rounded px-4 py-2 font-mono-code text-xs text-white focus:outline-none focus:border-emerald-500">
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-400 text-gray-950 font-semibold px-4 py-2 rounded font-mono-code text-xs transition">
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
