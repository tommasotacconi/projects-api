@extends('layouts.app')

@section('content')

<div class="container-md">
		<h1 class="ms-1">Modifica {{ $editing_project->name }}</h1>
    <form action="{{ route('admin.projects.update', $editing_project->id ) }}" method="POST" enctype="multipart/form-data" class="col-md-8 mx-auto row gy-3">
      @csrf
      @method('PUT')

			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
      <div class="col-9 col-sm-8">
        <label for="name-input" class="form-label">Nome del progetto</label>
        <input type="text" class="form-control" id="name-input" name="name" value="{{ $editing_project->name }}">
      </div>
      <div class="col-3 col-sm-4">
        <label for="type-input" class="form-label">Tipo</label>
        <select type="text" class="form-select" id="type-input" name="type_id">
					@foreach ($types as $id => $type)
						<option value="{{ $id + 1 }}"
						@if ($type->name === $editing_project->type->name) selected @endif>
						{{ $type->name }}
						</option>
					@endforeach
        </select>
      </div>
      <div class="col-12">
        <label for="authors-input" class="form-label">Autori</label>
        <input type="text" class="form-control" id="authors-input" name="authors" value="{{ $editing_project->authors }}">
      </div>
      <div class="col-12">
        <label for="arguments-input" class="form-label">Argomenti</label>
        <textarea type="text" class="form-control" id="arguments-input" name="arguments" rows="4">{{ $editing_project->arguments }}</textarea>
      </div>
      <div class="col-6 col-sm-4 col-md-4">
        <label for="start-date-input" class="form-label">Data d'inizio</label>
        <input type="date" class="form-control" id="start-date-input" name="start_date" value="{{ $editing_project->start_date }}">
      </div>
      <div class="col-6 col-sm-4 col-md-4">
        <label for="end-date-input" class="form-label">Data di fine</label>
        <input type="date" class="form-control" id="end-date-input" placeholder="" name="end_date" value="{{ $editing_project->end_date }}">
      </div>
      <div class="col-12">
        <label for="url-input" class="form-label">URL progetto</label>
        <input type="url" class="form-control" id="url-input" name="url" value="{{ old('url', $editing_project->url) }}">
      </div>
			<div class="col-12">
				Technologies:
				{{-- @dd($editing_project->technologies) --}}
				@foreach ($technologies as $technology)
					<div class="form-check">
						<input class="technologies-input" type="checkbox" id="technology-{{ $technology->name }}-input" name="technologies[]" value="{{ $technology->id }}" @if ($editing_project->technologies->contains($technology->id)) checked @endif>
						<label class="technologies-label" for="technology-{{ $technology->name }}-input">{{ $technology->name }}</label>
					</div>
				@endforeach
			</div>
			<div class="col-12">
				<input type="file" name="img_url" id="image_url" class="form-control">
			</div>
				<div class="col-12">
        <button type="submit" class="btn btn-success">Modifica</button>
        <button type="reset" class="btn btn-warning">Cancella campi</button>
      </div>
    </form>
  </div>

	{{-- <h1 class="text-center p-3">
		{{ $project->name }}
		</h1>
		<div class="container-lg">
				<div class="project-property">
						<b>Authors</b>: {{ $project->authors }}
				</div>
				<div class="project-property">
						<b>Arguments</b>
						<p>{{ $project->arguments }}</p>
				</div>
				<div class="project-property">
						<b>Linguaggi di programmazione</b>: {{ $project->programming_languages }}
				</div>
				<div class="project-property">
						<b>Data d'inizio</b>: {{ $project->start_date }}, <b>data di fine</b>: {{ $project->end_date }}
				</div>
		</div> --}}
@endsection
