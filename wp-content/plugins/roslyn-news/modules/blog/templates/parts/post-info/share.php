<?php
$share_type    = isset( $share_type ) ? $share_type : 'dropdown';
$display_share = isset( $display_share ) && $display_share !== '' ? $display_share : 'yes';
?>
<?php if ( $display_share == 'yes' && roslyn_elated_options()->getOptionValue( 'enable_social_share' ) === 'yes' && roslyn_elated_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="eltdf-blog-share">
		<?php echo roslyn_elated_get_social_share_html( array( 'type' => $share_type ) ); ?>
	</div>
<?php } ?>