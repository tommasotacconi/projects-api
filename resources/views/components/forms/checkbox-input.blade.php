@props(['field'])
@php
	['name' => $name, 'value' => $checked, 'boxes' => $boxes, 'label' => $label] = $field;
@endphp

Technologies:
<div class="row">
	@foreach ($boxes as $box)
		<div class="form-check col-4">
			<input class="technologies" type="checkbox" id="{{ $box->name }}" name="{{$name . '[]'}}" value="{{ $box->id }}" @checked($checked && in_array($box->id, $checked->pluck('id')->all()))>
			<label class="label" for="{{ $box->name }}">{{ $box->name }}</label>
		</div>
	@endforeach
</div>
@error($name)
	<div class="text-danger small">{{ $message }}</div>
@enderror

