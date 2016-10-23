<label>
	<input type="checkbox" value="true" {{{ data.attr }}} <# if ( data.value ) { #> checked="checked" <# } #> />

	<# if ( data.label ) { #>
		<span class="haricot-label">{{ data.label }}</span>
	<# } #>

	<# if ( data.description ) { #>
		<span class="haricot-description">{{{ data.description }}}</span>
	<# } #>
</label>
