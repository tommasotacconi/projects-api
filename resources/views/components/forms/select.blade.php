@props(['field'])
@php
	['name' => $name, 'options' => $options, 'label' => $label] = $field;
@endphp

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<select class="form-select" id="{{ $name }}" name="{{ $name }}">
	@foreach ($options as $option)
		<option value="{{ $option->id }}">{{ $option->name }}</option>
	@endforeach
</select>
