
@php
	$name = array_last(explode('.', $model));
@endphp

<div class="form-group" :class="{ 'has-error': errors.{{ $name }} }">

    @php($labelOptions['class'] = ' control-label' . ($required ? ' required' : ''))

    @php
        $class = '';

        if (isset($options['horizontal'])) {
            $class = 'col-sm-10';
            $labelOptions['class'] .= ' col-sm-2';
            unset($options['horizontal']);
        }
    @endphp

    {!! Form::label($name, $label, $labelOptions) !!}

	@php
		$options = array_merge(compact('type', 'name'), $options);
		$attrs = attrs($options, ['v-model' => $model, 'class' => 'form-control']);
	@endphp

    <div class="{{ $class }}">
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
    </div>

    
    <div class="help-block" v-if="errors.{{ $name }}" v-text="errors.{{ $name }}[0]"></div>
</div>