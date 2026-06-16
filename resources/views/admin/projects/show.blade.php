@extends('layouts.app')

@section('content')
<div class="container-lg">
	<h1 class="text-center p-3">{{ $project->name }}</h1>
	<div class="project-property">
		<img src="{{ asset('/storage/' . $project->img_url) }}" alt="project image" class="img-fluid">
	</div>
	<div class="project-property">
		<b>Authors</b>: {{ $project->authors }}
	</div>
	<div class="project-property">
		{{-- Type added by means of relation functions in controller  --}}
		<b>Type</b>:
		@if (isset($project->type))
			{{ $project->type->name }}
		@else
		  no type selected
		@endif
	</div>
	<div class="project-property">
		<b>Arguments</b>
		<p>{{ $project->arguments }}</p>
	</div>
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
