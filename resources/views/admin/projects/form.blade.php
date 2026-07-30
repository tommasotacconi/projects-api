@php
	function adaptBracketSyn(string $name, string $replacement) {

		return preg_replace(['/\[/', '/\]/'], [$replacement, ''], $name);
		$lang = preg_split('/translations\[|\]\[|\]/', $name)[1] ?? NULL;
	}

	$project?->setRelation('translations', $project->translations->keyBy('locale'));
	$fields = [
		['component' => 'adaptable-field', 'name' => 'name', 'label' => "Nome del progetto", 'col' => 'col-9 col-sm-8'],
		['component' => 'select', 'name' => 'type_id', 'label' => "Tipo", 'col' => 'col-3 col-sm-4', 'options' => $types],
		['component' => 'adaptable-field', 'name' => 'authors', 'label' => 'Autori'],
		['component' => 'adaptable-field', 'name' => 'start_date', 'label' => "Data d'inizio", 'type' => 'date', 'col' => 'col-6 col-sm-4 col-md-4'],
		['component' => 'adaptable-field', 'name' => 'end_date', 'label' => 'Data di fine', 'type' => 'date', 'col' => 'col-6 col-sm-4 col-md-4'],
		['component' => 'checkbox-input', 'name' => 'technologies', 'label' => 'Tecnologie', 'boxes' => $technologies],
		['component' => 'adaptable-field', 'name' => 'url', 'label' => 'URL progetto', 'type' => 'url'],
		['component' => 'adaptable-field', 'name' => 'img', 'label' => 'Immagine di presentazione', 'type' => 'file'],
	];
	$panels = [
		['component' => 'adaptable-field', 'element' => 'textarea', 'name' => 'translations[][purpose]', 'rows' =>  2, 'label' => 'Scopo'],
		['component' => 'adaptable-field', 'element' => 'textarea', 'name' => 'translations[][description]', 'label' => 'Descrizione'],
	];

	$locales = array_keys(old('translations', $project?->translations->all()) ?? ['IT' => null]);
	$toAddLocales = array_diff($availableLocales, $locales);
	$localePanels = [];
	foreach ($locales as $locale) {
		foreach ($panels as $panel) {
			['name' => &$name] = $panel;
			$name = str_replace('[]', "[$locale]", $name);
			$panel = array_merge($panel, ['id' => adaptBracketSyn($name, '-'), 'oldKey' => adaptBracketSyn($name, '.'), 'locale' => $locale]);
			$localePanels[] = $panel;
		}
	}
	array_splice($fields, 5, 0, $localePanels);

	foreach ($fields as &$field) {
		$lookupKey = $field['oldKey'] ?? $field['name'];
		$field['value'] = old($lookupKey) ?? data_get($project, $lookupKey);
		$field['error'] = $errors->first($lookupKey);
	}
	unset($field);
@endphp

<div class="col-12 d-flex">
	<ul class="nav nav-tabs flex-grow-1" id="language-tabs">
		@foreach ($locales as $locale)
			<li class="nav-item" data-locale="{{ $locale }}">
				<button type="button" class="nav-link tab-btn" aria-current="page">{{ strtoupper($locale) }}</button>
			</li>
		@endforeach
		<li id="add-tab-item" @class(['nav-item', 'd-none' => !$toAddLocales])>
			<button id="add-tab-btn" type="button" class="nav-link">+</button>
		</li>
	</ul>
</div>

@foreach ($fields as $field)
	@if (isset($field['locale']) && $loop->index == 5)
		<div class="col-12 d-contents" id="tab-panels">
	@endif
			<div @class([$field['col'] ?? 'col-12', 'tab-panel' => isset($field['locale'])])
				@if (isset($field['locale'])) data-locale="{{ $field['locale'] }}" @endif>
				<x-dynamic-component :component="'forms.' . $field['component']" :field="Arr::except($field, 'component')" :project="$project" />
			</div>
	@if (isset($field['locale']) && $loop->index == (5 + 2 * count($locales) - 1))
		</div>
	@endif
@endforeach

<template id="locale-select-template">
	<select style="border: none;
    height: 100%;" class="form-select form-select-sm d-inline-block w-auto" id="lang-select">
		@foreach($toAddLocales as $locale)
			<option value="{{ $locale }}">{{ strtoupper($locale) }}</option>
		@endforeach
	</select>
	<button type="button" class="btn btn-sm btn-success ms-1 mb-0" id="confirm-add-btn">✓</button>
</template>
<template id="panels-template">
@foreach ($panels as $panel)
	<div class="col-12 tab-panel">
		<x-forms.adaptable-field :field="Arr::except($panel, 'component')" />
	</div>
@endforeach
</template>
{{-- @endsection --}}

@push('scripts')
    @vite('resources/js/project-form.js')
@endpush
