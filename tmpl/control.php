<label>
	<# if ( data.label ) { #>
		<span class="haricot-label">{{ data.label }}</span>
	<# } #>

	<# if ( data.description ) { #>
		<span class="haricot-description">{{{ data.description }}}</span>
	<# } #>

	<input type="{{ data.type }}" value="{{ data.value }}" {{{ data.attr }}} />
</label>
