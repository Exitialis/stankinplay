
@php
	$name = array_last(explode('.', $model));
@endphp

<div class="form-group" :class="{ 'has-error': errors.{{ $name }} }">
	
	@php
		$options = array_merge(compact('type', 'name'), $options);
		$attrs = attrs($options, ['v-model' => $model, 'class' => 'form-control']);
	@endphp	

	{!! "<select {$attrs}>" !!}
		@if(is_string($prop))
			<option v-for="item in {{ $prop }}" :value="item.select_id || item.id">
				@{{ item.select_name || item.name }}
			</option>
		@else
			@foreach($prop as $item)
				<option value="{{ $item['select_id'] ?? $item['id'] }}">
					{{ $item['select_name'] ?? $item['name'] }}
				</option>
			@endforeach
		@endif
	{!! '</select>' !!}
    
    <div class="help-block" v-if="errors.{{ $name }}" v-text="errors.{{ $name }}[0]"></div>
</div>