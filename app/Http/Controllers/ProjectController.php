<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function datatable()
    {
        $query = Project::query()->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('tech_stack', function ($row) {
                return collect($row->tech_stack)
                    ->map(fn ($t) => "<span class='px-2 py-0.5 text-xs rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mr-1'>{$t}</span>")
                    ->implode('');
            })
            ->addColumn('action', function ($row) {
                $json = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                return "
                    <button onclick='editProject({$json})' class='px-2.5 py-1 text-xs bg-amber-500/20 text-amber-300 border border-amber-500/40 rounded mr-1'>Edit</button>
                    <button onclick='deleteProject({$row->id})' class='px-2.5 py-1 text-xs bg-red-500/20 text-red-300 border border-red-500/40 rounded'>Hapus</button>
                ";
            })
            ->rawColumns(['tech_stack', 'action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $techArray = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));
        $path = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('thumbnails', 'public')
            : null;

        Project::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'tech_stack' => $techArray,
            'github_url' => $validated['github_url'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'thumbnail' => $path,
            'is_featured' => true,
        ]);

        return response()->json(['message' => 'Proyek berhasil ditambahkan']);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $techArray = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $project->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $project->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'tech_stack' => $techArray,
            'github_url' => $validated['github_url'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
        ]);

        return response()->json(['message' => 'Proyek berhasil diperbarui']);
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        $project->delete();

        return response()->json(['message' => 'Proyek berhasil dihapus']);
    }
}
