
@php($name = array_last(explode('.', $model)))

<div class="form-group" :class="{ 'has-error': errors.{{ $name }} }">
	
	@php($options = array_merge(compact('type', 'name'), $options))
	@php($attrs = attrs($options, ['v-model' => $model, 'class' => 'form-control']))
	
	{!! "<input {$attrs}>" !!}
    
    <div class="help-block" v-if="errors.{{ $name }}" v-text="errors.{{ $name }}[0]"></div>
</div>