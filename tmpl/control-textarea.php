<label>
	<# if ( data.label ) { #>
		<span class="haricot-label">{{ data.label }}</span>
	<# } #>

	<textarea {{{ data.attr }}}>{{{ data.value }}}</textarea>

	<# if ( data.description ) { #>
		<span class="haricot-description">{{{ data.description }}}</span>
	<# } #>
</label>