<?php

if ( class_exists( 'RoslynElatedWidget' ) ) {
	class RoslynElatedSideAreaOpener extends RoslynElatedWidget
	{
		public function __construct()
		{
			parent::__construct(
				'eltdf_side_area_opener',
				esc_html__('Roslyn Side Area Opener', 'roslyn'),
				array('description' => esc_html__('Display a "hamburger" icon that opens the side area', 'roslyn'))
			);

			$this->setParams();
		}

		protected function setParams()
		{
			$this->params = array(
				array(
					'type' => 'colorpicker',
					'name' => 'icon_color',
					'title' => esc_html__('Side Area Opener Color', 'roslyn'),
					'description' => esc_html__('Define color for side area opener', 'roslyn')
				),
				array(
					'type' => 'colorpicker',
					'name' => 'icon_hover_color',
					'title' => esc_html__('Side Area Opener Hover Color', 'roslyn'),
					'description' => esc_html__('Define hover color for side area opener', 'roslyn')
				),
				array(
					'type' => 'textfield',
					'name' => 'widget_margin',
					'title' => esc_html__('Side Area Opener Margin', 'roslyn'),
					'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'roslyn')
				),
				array(
					'type' => 'textfield',
					'name' => 'widget_title',
					'title' => esc_html__('Side Area Opener Title', 'roslyn')
				)
			);
		}

		public function widget($args, $instance)
		{

			$side_area_icon_source = roslyn_elated_options()->getOptionValue('side_area_icon_source');
			$side_area_icon_pack = roslyn_elated_options()->getOptionValue('side_area_icon_pack');
			$side_area_icon_svg_path = roslyn_elated_options()->getOptionValue('side_area_icon_svg_path');

			$side_area_icon_class_array = array(
				'eltdf-side-menu-button-opener',
				'eltdf-icon-has-hover'
			);

			$side_area_icon_class_array[] = $side_area_icon_source == 'icon_pack' ? 'eltdf-side-menu-button-opener-icon-pack' : 'eltdf-side-menu-button-opener-svg-path';

			$holder_styles = array();

			if (!empty($instance['icon_color'])) {
				$holder_styles[] = 'color: ' . $instance['icon_color'] . ';';
			}
			if (!empty($instance['widget_margin'])) {
				$holder_styles[] = 'margin: ' . $instance['widget_margin'];
			}

			?>

			<a <?php roslyn_elated_class_attribute($side_area_icon_class_array); ?> <?php echo roslyn_elated_get_inline_attr($instance['icon_hover_color'], 'data-hover-color'); ?>
					href="javascript:void(0)" <?php roslyn_elated_inline_style($holder_styles); ?>>
				<?php if (!empty($instance['widget_title'])) { ?>
					<h5 class="eltdf-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h5>
				<?php } ?>
				<span class="eltdf-side-menu-icon">
				<?php if (($side_area_icon_source == 'icon_pack') && isset($side_area_icon_pack)) {
					echo roslyn_elated_icon_collections()->getMenuIcon($side_area_icon_pack);
				} else if (isset($side_area_icon_svg_path)) {
					echo roslyn_elated_get_module_part($side_area_icon_svg_path);
				} ?>
            </span>
			</a>
		<?php }
	}
}