<?php
$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="eltdf-top-part-post-image">
		<?php the_post_thumbnail( 'full' ); ?>
	</div>
<?php } ?>