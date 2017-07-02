@php($options['class'] = 'control-label' . ($required ? ' required' : ''))
{!! Form::label(null, $name, $options) !!}