<# if ( data.label ) { #>
	<span class="haricot-label">{{ data.label }}</span>
<# } #>

<# if ( data.description ) { #>
	<span class="haricot-description">{{{ data.description }}}</span>
<# } #>

<# _.each( data.choices, function( palette, choice ) { #>
	<label aria-selected="{{ palette.selected }}">
		<input type="radio" value="{{ choice }}" name="{{ data.field_name }}" <# if ( palette.selected ) { #> checked="checked" <# } #> />

		<span class="haricot-palette-label">{{ palette.label }}</span>

		<div class="haricot-palette-block">

			<# _.each( palette.colors, function( color ) { #>
				<span class="haricot-palette-color" style="background-color: {{ color }}">&nbsp;</span>
			<# } ) #>

		</div>
	</label>
<# } ) #>
