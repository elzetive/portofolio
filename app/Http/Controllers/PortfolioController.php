<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = [
            'name' => 'Dimas Riyan Wirayuda',
            'short_name' => 'Dimas',
            'role' => 'Web developer',
            'subtitle' => 'full stack developer • D3 Informatics',
            'github_username' => 'elzetive',
            'location' => 'Purwokerto, Banyumas',
        ];

        $projects = Project::where('is_featured', true)->latest()->get();
        $repos = $this->getGithubRepos($profile['github_username']);

        return view('portfolio', compact('profile', 'projects', 'repos'));
    }

    public function fetchRepos(Request $request)
    {
        $username = $request->query('username', 'dimasriyan');
        $repos = $this->getGithubRepos($username);

        return response()->json([
            'status' => !empty($repos),
            'data' => $repos,
        ]);
    }

    private function getGithubRepos(string $username): array
    {
        $cleanUsername = preg_replace('/[^a-zA-Z0-9-]/', '', $username);

        return Cache::remember("github_repos_{$cleanUsername}", now()->addMinutes(30), function () use ($cleanUsername) {
            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github.v3+json',
                'User-Agent' => 'Laravel-Portofolio-Dimas',
            ])->get("https://api.github.com/users/{$cleanUsername}/repos", [
                'sort' => 'updated',
                'per_page' => 6,
            ]);

            if ($response->successful()) {
                return collect($response->json())
                    ->reject(fn ($repo) => $repo['fork'] ?? false)
                    ->take(6)
                    ->values()
                    ->all();
            }

            return [];
        });
    }
}
