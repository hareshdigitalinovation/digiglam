<?php

if ( class_exists( 'RoslynElatedWidget' ) ) {
	class RoslynElatedYithWishlist extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct(
				'eltdf_woocommerce_yith_wishlist',
				esc_html__('Roslyn WooCommerce Wishlist', 'roslyn'),
				array('description' => esc_html__('Display a wishlist icon with number of products that are in the wishlist', 'roslyn'),)
			);
		}

		/**
		 * @param array $new_instance
		 * @param array $old_instance
		 *
		 * @return array
		 */
		public function update($new_instance, $old_instance)
		{
			$instance = array();
			foreach ($this->params as $param) {
				$param_name = $param['name'];

				$instance[$param_name] = sanitize_text_field($new_instance[$param_name]);
			}

			return $instance;
		}

		public function widget($args, $instance)
		{
			extract($args);

			global $yith_wcwl;

			?>
			<div class="eltdf-wishlist-widget-holder">
				<a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="eltdf-wishlist-widget-link">
					<span class="eltdf-wishlist-widget-icon"><i class="icon_heart_alt"></i></span>
					<span class="eltdf-wishlist-items-number">(<span><?php echo yith_wcwl_count_products(); ?></span>)</span>
				</a>
			</div>
			<?php
		}
	}
}

?>