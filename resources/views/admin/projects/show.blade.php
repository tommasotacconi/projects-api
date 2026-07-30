@extends('layouts.app')

@section('content')
<div class="container-lg">
	<h1 class="text-center p-3">{{ $project->name }}</h1>
	<div class="project-property">
		<img src="{{ asset('/storage/' . $project->img_url) }}" alt="project image" class="img-fluid">
	</div>

	<div class="btn-group" role="group" aria-label="Basic example">
		@foreach ($project->translations as $t9n)
			<button type="button" @class(['btn btn-secondary', 'active' => $t9n->locale == 'IT']) data-locale="{{ $t9n->locale }}">{{ $t9n->locale }}</button>
		@endforeach
	</div>

	<div class="project-property">
		<b>Autori</b>: {{ $project->authors }}
	</div>
	<div class="project-property">
		{{-- Type added by means of relation functions in controller  --}}
		<b>Tipo</b>:
		@if (isset($project->type))
			{{ $project->type->name }}
		@else
		  Nessun tipo di progetto selezionato.
		@endif
	</div>
	@foreach ($project->translations as $t9n)
	<div @class(['locale-container', 'd-none' => $t9n->locale !== 'IT']) data-locale="{{ $t9n->locale }}">
		<div id="scope" class="project-property">
			<b>Scopo</b>:
			<p>{{ $t9n->purpose }}</p>
		</div>
		<div id="descr" class="project-property">
			<b>Descrizione</b>:
			<p>{{ $t9n->description }}</p>
		</div>
	</div>
	@endforeach
	<div class="project-property">
		<b>Data d'inizio</b>: {{ $project->start_date }} <b class="ms-3">Data di fine</b>: {{ $project->end_date }}
	</div>
	@if ($project->url)
		<div class="project-property">
			<b>URL</b>: <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">{{ $project->url }}</a>
		</div>
	@endif
	<div class="project-property">
		{{-- Type added by means of relation functions in controller  --}}
		<b>Technologies</b>:
		@if (!isset($project->technologies[0]))
			no related technologies
		@endif
		<ul>
			@foreach ($project->technologies as $technology)
				<li>{{ $technology->name }}</li>
			@endforeach
		</ul>
	</div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/show-locale.js')
@endpush

