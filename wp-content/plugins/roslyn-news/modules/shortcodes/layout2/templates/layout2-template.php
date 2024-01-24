<?php  
$bgrnd_img_style = '';
global $post;

if ( has_post_thumbnail( $post->ID ) ) {
	$bgrnd_img_style .= "background-image: url(" . wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) . ");";
} 
?>

<div class="eltdf-news-item eltdf-layout2-item eltdf-item-space <?php echo esc_attr(isset( $holder_classes ) ? $holder_classes : ''); ?>">
	<div class="eltdf-ni-inner">
		<div class="eltdf-ni-image-holder" <?php echo roslyn_elated_inline_style($bgrnd_img_style); ?>>
			<?php if( isset( $parallax ) && $parallax === "yes" ) { ?>
				<div class="eltdf-ni-image-parallax-holder">
					<div class="eltdf-ni-image-parallax-image" <?php echo roslyn_elated_inline_style($bgrnd_img_style); echo roslyn_elated_get_inline_attrs($holder_data); ?>>
					</div>
				</div>
			<?php }  ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'image', '', $params ); ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/hot-trending', '', array_merge( $params, array( 'display_hot_trending_text' => true ) ) ); ?>
		</div>
		<div class="eltdf-ni-content <?php echo esc_attr(isset( $bg_styles ) ? $bg_styles : '');?>" <?php echo isset( $content_styles ) ? roslyn_elated_inline_style( $content_styles ) : ''; ?>>
			<div class="eltdf-ni-info eltdf-ni-info-top">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/date', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/category', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/comments', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/like', '', $params ); ?>
			</div>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'title', '', $params ); ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'excerpt', '', $params ); ?>
			<div class="eltdf-ni-info eltdf-ni-info-bottom">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/read-more', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/author', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/share', '', $params ); ?>
			</div>
		</div>
	</div>
</div>