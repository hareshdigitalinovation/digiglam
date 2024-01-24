<?php

if ( class_exists( 'RoslynElatedWidget' ) ) {
	class RoslynElatedSearchOpener extends RoslynElatedWidget
	{
		public function __construct()
		{
			parent::__construct(
				'eltdf_search_opener',
				esc_html__('Roslyn Search Opener', 'roslyn'),
				array('description' => esc_html__('Display a "search" icon that opens the search form', 'roslyn'))
			);

			$this->setParams();
		}

		protected function setParams()
		{

			$search_icon_params = array(
				array(
					'type' => 'colorpicker',
					'name' => 'search_icon_color',
					'title' => esc_html__('Icon Color', 'roslyn'),
					'description' => esc_html__('Define color for search icon', 'roslyn')
				),
				array(
					'type' => 'colorpicker',
					'name' => 'search_icon_hover_color',
					'title' => esc_html__('Icon Hover Color', 'roslyn'),
					'description' => esc_html__('Define hover color for search icon', 'roslyn')
				),
				array(
					'type' => 'textfield',
					'name' => 'search_icon_margin',
					'title' => esc_html__('Icon Margin', 'roslyn'),
					'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'roslyn')
				),
				array(
					'type' => 'dropdown',
					'name' => 'show_label',
					'title' => esc_html__('Enable Search Icon Text', 'roslyn'),
					'description' => esc_html__('Enable this option to show search text next to search icon in header', 'roslyn'),
					'options' => roslyn_elated_get_yes_no_select_array()
				)
			);

			$search_icon_pack_params = array(
				array(
					'type' => 'textfield',
					'name' => 'search_icon_size',
					'title' => esc_html__('Icon Size (px)', 'roslyn'),
					'description' => esc_html__('Define size for search icon', 'roslyn')
				)
			);

			if (roslyn_elated_options()->getOptionValue('search_icon_pack') == 'icon_pack') {
				$this->params = array_merge($search_icon_pack_params, $search_icon_params);
			} else {
				$this->params = $search_icon_params;
			}

		}

		public function widget($args, $instance)
		{
			$search_icon_source = roslyn_elated_options()->getOptionValue('search_icon_source');
			$search_icon_pack = roslyn_elated_options()->getOptionValue('search_icon_pack');
			$search_icon_svg_path = roslyn_elated_options()->getOptionValue('search_icon_svg_path');
			$enable_search_icon_text = roslyn_elated_options()->getOptionValue('enable_search_icon_text');

			$search_icon_class_array = array(
				'eltdf-search-opener',
				'eltdf-icon-has-hover'
			);

			$search_icon_class_array[] = $search_icon_source == 'icon_pack' ? 'eltdf-search-opener-icon-pack' : 'eltdf-search-opener-svg-path';

			$styles = array();
			$show_search_text = $instance['show_label'] == 'yes' || $enable_search_icon_text == 'yes' ? true : false;

			if (!empty($instance['search_icon_size'])) {
				$styles[] = 'font-size: ' . intval($instance['search_icon_size']) . 'px';
			}

			if (!empty($instance['search_icon_color'])) {
				$styles[] = 'color: ' . $instance['search_icon_color'] . ';';
			}

			if (!empty($instance['search_icon_margin'])) {
				$styles[] = 'margin: ' . $instance['search_icon_margin'] . ';';
			}
			?>

			<a <?php roslyn_elated_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?> <?php roslyn_elated_inline_style($styles); ?> <?php roslyn_elated_class_attribute($search_icon_class_array); ?>
					href="javascript:void(0)">
            <span class="eltdf-search-opener-wrapper">
                <?php if (($search_icon_source == 'icon_pack') && isset($search_icon_pack)) {
					roslyn_elated_icon_collections()->getSearchIcon($search_icon_pack, false);
				} else if (($search_icon_source == 'svg_path') && isset($search_icon_svg_path)) {
					echo roslyn_elated_get_module_part($search_icon_svg_path);
				} ?>
				<?php if ($show_search_text) { ?>
					<span class="eltdf-search-icon-text"><?php esc_html_e('Search', 'roslyn'); ?></span>
				<?php } ?>
            </span>
			</a>
		<?php }
	}
}