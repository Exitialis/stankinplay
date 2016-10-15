
@php
    $name = array_last(explode('.', $model));
    $label = is_array($label) ? $label : [$label];
@endphp

<div class="form-group" :class="{ 'has-error': errors.{{ $name }} }">
    <div class="checkbox">
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