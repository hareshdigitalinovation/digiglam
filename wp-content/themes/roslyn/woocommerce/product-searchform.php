<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'roslyn' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_attr_e('Search Products...', 'roslyn'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e('Search for:', 'roslyn'); ?>"/>
		<button type="submit" class="eltdf-woo-search-widget-button"><?php echo roslyn_elated_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
		<input type="hidden" name="post_type" value="product"/>
	</div>
</form>