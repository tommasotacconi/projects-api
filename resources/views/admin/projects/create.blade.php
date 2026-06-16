@extends('layouts.app')

@section('content')
<div class="container-md">
	<h1 class="ms-1">Create</h1>
	<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="col-md-8 mx-auto row gy-3"> <!-- enctype allows to send files to form -->
		@csrf

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
			<input type="text" class="form-control" id="name-input" name="name">
		</div>
		<div class="col-3 col-sm-4">
			<label for="type-input" class="form-label">Tipo</label>
			<select class="form-select" id="type-input" name="type_id">
				@foreach ($types as $id => $type)
					<option value="{{ $type->id }}">{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-12">
			<label for="authors-input" class="form-label">Autori</label>
			<input type="text" class="form-control" id="authors-input" name="authors">
		</div>
		<div class="col-12">
			<label for="purpose-input" class="form-label">Scopo</label>
			<textarea type="text" class="form-control" id="purpose-input" name="purpose" rows="4"></textarea>
		</div>
		<div class="col-6 col-sm-4 col-md-4">
			<label for="start-date-input" class="form-label">Data d'inizio</label>
			<input type="date" class="form-control" id="start-date-input" name="start_date">
		</div>
		<div class="col-6 col-sm-4 col-md-4">
			<label for="end-date-input" class="form-label">Data di fine</label>
			<input type="date" class="form-control" id="end-date-input" placeholder="" name="end_date">
		</div>
		<div class="col-12">
			<label for="url-input" class="form-label">URL progetto</label>
			<input type="url" class="form-control" id="url-input" name="url" value="{{ old('url') }}">
		</div>
		<div class="col-12">
			Technologies:
			@foreach ($technologies as $technology)
				<div class="form-check col-6">
					<input class="technologies-input" type="checkbox" id="technologies-{{ $technology->name }}-input" name="technologies[]" value="{{ $technology->id }}">
					<label class="technologies-label" for="technologies-{{ $technology->name }}-input">{{ $technology->name }}</label>
				</div>
			@endforeach
		</div>
		<div class="col-12">
			<input type="file" name="img_url" id="image_url" class="form-control">
		</div>
		<div class="col-12">
			<button type="submit" class="btn btn-primary">Crea</button>
			<button type="reset" class="btn btn-warning">Cancella campi</button>
		</div>
	</form>
</div>

@endsection
