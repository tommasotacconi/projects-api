@extends('layouts.app')

@section('content')
<div class="container-md">
	<h1 class="ms-1">Create</h1>
	<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="col-md-8 mx-auto row gy-3"> <!-- enctype allows to send files to form -->
		@csrf
		@include('admin.projects.form', ['project' => $project ?? null])

		<div class="col-12">
			<button type="submit" class="btn btn-primary">Crea</button>
			<button type="reset" class="btn btn-warning">Cancella campi</button>
		</div>
	</form>
</div>
@endsection
