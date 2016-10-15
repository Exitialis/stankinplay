
@php
	$sub = in_array('sub', $options);
@endphp

<div class="page-header{{ $sub ? ' page-header-sub' : '' }}">
	@if($sub)
		<h3>{{ $name }}</h3>
	@else
		<h2>{{ $name }}</h2>
	@endif

	@if(isset($options['desc']))
		<small class="page-header-desc">
			{{ $options['desc'] }}
		</small>
	@endif
</div>