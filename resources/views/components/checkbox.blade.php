
@php
    $name = array_last(explode('.', $model));
    $label = is_array($label) ? $label : [$label];
    $class = 'checkbox';
    if (isset($options['horizontal'])) {
        $class .= ' col-sm-10 col-sm-offset-2';
    }
@endphp



<div class="form-group" :class="{ 'has-error': errors.{{ $name }} }">

    <div class="{{ $class }}">
        <label>
            <input type="checkbox" v-model="{{ $model }}">
            @foreach ($label as $key => $value)
                @if(is_numeric($key))
                    {{ $value }}
                @else
                    @if($key === 'html')
                        {!! value($value) !!}
                    @endif
                @endif
            @endforeach
        </label>
    </div>

    <div class="help-block" v-if="errors.{{ $name }}" v-text="errors.{{ $name }}[0]"></div>
</div>