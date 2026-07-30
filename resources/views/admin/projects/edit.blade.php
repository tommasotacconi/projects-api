@extends('layouts.app')

@section('content')
<div class="container-md">
	<h1 class="ms-1">Modifica {{ $project->name }}</h1>
	<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="col-md-8 mx-auto row gy-3"> <!-- enctype allows to send files to form -->
		@csrf
		@method('PUT')
		@include('admin.projects.form')

		<div class="col-12">
			<button type="submit" class="btn btn-primary">Modifica</button>
			<button type="reset" class="btn btn-warning">Ripristina precedente</button>
		</div>
	</form>
</div>
@endsection
