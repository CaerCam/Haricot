<# if ( data.label ) { #>
	<span class="haricot-label">{{ data.label }}</span>
<# } #>

<# if ( data.description ) { #>
	<span class="haricot-description">{{{ data.description }}}</span>
<# } #>

<input type="hidden" class="haricot-attachment-id" name="{{ data.field_name }}" value="{{ data.value }}" />

<# if ( data.src ) { #>
	<img class="haricot-img" src="{{ data.src }}" alt="{{ data.alt }}" />
<# } else { #>
	<div class="haricot-placeholder">{{ data.l10n.placeholder }}</div>
<# } #>

<p>
	<# if ( data.src ) { #>
		<button type="button" class="button button-secondary haricot-change-media">{{ data.l10n.change }}</button>
		<button type="button" class="button button-secondary haricot-remove-media">{{ data.l10n.remove }}</button>
	<# } else { #>
		<button type="button" class="button button-secondary haricot-add-media">{{ data.l10n.upload }}</button>
	<# } #>
</p>
