@extends('layouts.app')

@section('content')
	<h1 class="text-center p-3">
		Projects
    </h1>
    <div class="container-lg">
    <table class="table table-striped table-hover">
			<thead>
				<tr>
					<th scope="col">Nome</th>
					<th scope="col">Autori</th>
					<th scope="col">Scopo</th>
					<th scope="col">Data d'inizio</th>
					<th scope="col">Data di fine</th>
				</tr>
			</head>
			<tbody>
			@forelse ($projects as $id => $project)
				<tr>
					<td>{{ $project->name }}</td>
					<td>{{ $project->authors }}</td>
					<td>{{ $project->translations[0]->purpose ?? null}}</td>
					<td>{{ $project->start_date }}</td>
					<td>{{ $project->end_date }}</td>
					{{-- buttons table data --}}
					<td class="buttons-col">
						<a href="{{ route('admin.projects.show', $project) }}" class="btn btn-primary btn-sm">Mostra</a>
						<a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-success btn-sm">Modifica</a>
						<form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" custom-data-name="{{ $project->name }}" class="d-inline">
							@csrf
							@method('DELETE')

							<button type="submit" class="btn btn-danger btn-sm">Cancella</button>
						</form>
					</td>
					{{-- Project nullable fields --}}
				</tr>
			@empty
				<tr>
					<td colspan="5">No projects found</td>
				<tr>
			@endforelse
			</tbody>
    </table>
    </div>
@endsection

<!-- final commit -->
