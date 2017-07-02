
@php($name = array_last(explode('.', $model)))

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

	@php($options = array_merge(compact('type', 'name'), $options))
    @php($attrs = attrs($options, ['v-model' => $model, 'class' => 'form-control']))

	<div class="{{ $class }}">
        {!! "<input {$attrs}>" !!}

        <div class="help-block" v-if="errors.{{ $name }}" v-text="errors.{{ $name }}[0]"></div>
    </div>
    

</div>