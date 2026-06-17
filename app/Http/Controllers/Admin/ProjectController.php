<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
	public function index() {
		$projects = Project::all();
		return view('admin.projects.index', compact('projects'));
	}

	public function show(string $id) {
		$project = Project::findOrFail($id);
		return view('admin.projects.show', compact('project'));
	}

	public function create() {
		$types = Type::all();
		$technologies = $this->getOrderedTechnologies();
		return view('admin.projects.create', compact('types', 'technologies'));
	}

	public function store(ProjectRequest $request) {
		$new_project_data = $request->validated();

		if (isset($new_project_data['img_url'])) {
			$file_path = Storage::disk('public')->put("images/projects", $request->img_url);
			$new_project_data['img_url'] = $file_path;
		}
		$new_project = Project::create($new_project_data);
		$new_project->technologies()->sync($request['technologies']);
		return redirect()->route('admin.projects.show', ['id' => $new_project->id]);
	}

	public function edit(string $id) {
		$editing_project = Project::findOrFail($id);
		$types = Type::all();
		$technologies = $this->getOrderedTechnologies();
		return view('admin.projects.edit', compact('editing_project', 'types', 'technologies'));
	}

	public function update(ProjectRequest $request, string $id) {
		$edited_project_data = $request->validated();

		$editing_project = Project::findOrFail($id);
		if (isset($edited_project_data['img_url'])) {
			if ($editing_project->img_url) Storage::disk('public')->delete($editing_project->img_url);
			$file_path = Storage::disk('public')->put("images/projects/", $request->img_url);
			$edited_project_data['img_url'] = $file_path;
		}
		$editing_project->technologies()->sync($request['technologies']);
		$editing_project->update($edited_project_data);
		return redirect()->route('admin.projects.show', ['id' => $editing_project->id]);
	}

	public function destroy(string $id) {
		$deleting_project = Project::findOrFail($id);
		$deleting_project->delete();
		return redirect()->route('admin.projects.index');
	}

	private function getOrderedTechnologies()
	{
		return Technology::ordered()->get();
	}
}
