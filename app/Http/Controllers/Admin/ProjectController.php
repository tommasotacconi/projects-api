<?php

namespace App\Http\Controllers\Admin;

use App\Actions\StoreProjImg;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct(protected StoreProjImg $storer)
    {
    }

    public function index()
    {
        $projects = Project::with('translations')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function show(string $id)
    {
        $project = Project::with('translations')->findOrFail($id);

        return view('admin.projects.show', compact('project'));
    }

    public function create()
    {
        $availableLocales = ['IT', 'EN', 'ES'];
        $types = Type::all();
        $technologies = $this->getOrderedTechnologies();

        return view('admin.projects.create', compact('availableLocales', 'types', 'technologies'));
    }

    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        if (isset($validated['img'])) {
            $validated['img_url'] = $this->storer->handle($validated['img']);
        }

        $newProj = Project::create($validated);
        foreach ($validated['translations'] as $locale => $tran) {
            $newProj->translations()->create([
                'locale' => $locale,
                ...$tran
            ]);
        }
        if (isset($validated['technologies'])) {
            $newProj->technologies()->sync($validated['technologies']);
        }

        return redirect()->route('admin.projects.show', ['id' => $newProj->id]);
    }

    public function edit(string $id)
    {
        $project = Project::with(['translations', 'technologies', 'type'])->findOrFail($id);
        $availableLocales = ['IT', 'EN', 'ES'];
        $types = Type::all();
        $technologies = $this->getOrderedTechnologies();

        return view('admin.projects.edit', compact('project', 'availableLocales', 'types', 'technologies'));
    }

    public function update(ProjectRequest $request, string $id)
    {
        $toEditProj = Project::findOrFail($id);

        $validated = $request->validated();
        if (isset($validated['img'])) {
            if ($toEditProj->img_url) {
                Storage::disk('public')->delete($toEditProj->img_url);
            }
            $validated['img_url'] = $this->storer->handle($validated['img']);
        }

        $toEditProj->update($validated);
        foreach ($validated['translations'] as $locale => $tran) {
            $toEditT9n = $toEditProj->translations()->firstOrCreate(
                ['locale' => $locale],
                [...$tran]
            );
            $toEditT9n->update([...$tran]);
        }
        $toEditProj->technologies()->sync($validated['technologies'] ?? null);

        return redirect()->route('admin.projects.show', ['id' => $toEditProj->id]);
    }

    public function destroy(string $id)
    {
        $toDeleteProj = Project::findOrFail($id);
        $toDeleteProj->delete();

        return redirect()->route('admin.projects.index');
    }

    private function getOrderedTechnologies()
    {
        return Technology::ordered()->get();
    }
}
