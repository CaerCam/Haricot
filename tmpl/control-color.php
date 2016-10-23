<label>
	<# if ( data.label ) { #>
		<span class="haricot-label">{{ data.label }}</span>
	<# } #>

	<# if ( data.description ) { #>
		<span class="haricot-description">{{{ data.description }}}</span>
	<# } #>

	<input {{{ data.attr }}} value="<# if ( data.value ) { #>#{{ data.value }}<# } #>" />
</label>
