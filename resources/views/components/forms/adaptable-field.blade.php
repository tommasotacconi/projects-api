@props(['field'])
@php
	$default = ['type' => 'text', 'value' => NULL, 'element' => NULL, 'rows' => 4, 'locale' => null, 'error' => null];
	['name' => $name, 'value' => $value, 'element' => $el, 'type' => $type, 'label' => $label, 'rows' => $rows, 'locale' => $lang, 'error' => $err] = $field + $default;
	$id = $field['id'] ?? $name;

@endphp

<label for="{{ $id }}" class="form-label">
	{{ $label }} @if (str_contains($name, 'translations'))
		(<span class="locale">{{ $lang }}</span>)
	@endif</label>
@if($el === 'textarea')
	<textarea class="form-control" id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}">{{ $value }}</textarea>
@else
	<input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}">
@endif
@if($err)
	<div class="text-danger small">{{ $err }}</div>
@endif
