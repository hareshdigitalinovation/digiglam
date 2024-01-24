<form role="search" method="get" class="searchform" id="searchform-<?php echo esc_attr(rand(0, 1000)); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'roslyn' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search*', 'roslyn' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'roslyn' ); ?>"/>
		<button type="submit" class="eltdf-search-submit"><?php echo roslyn_elated_icon_collections()->renderIcon( 'fa fa-search', 'font_awesome' ); ?></button>
	</div>
</form>