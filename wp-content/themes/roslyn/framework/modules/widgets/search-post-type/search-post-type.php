<?php

class RoslynElatedSearchPostType extends RoslynElatedWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_search_post_type',
			esc_html__( 'Roslyn Search Post Type', 'roslyn' ),
			array( 'description' => esc_html__( 'Select post type that you want to be searched for', 'roslyn' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$post_types = apply_filters( 'roslyn_elated_search_post_type_widget_params_post_type', array( 'post' => esc_html__( 'Post', 'roslyn' ) ) );
		
		$this->params = array(
			array(
				'type'        => 'dropdown',
				'name'        => 'post_type',
				'title'       => esc_html__( 'Post Type', 'roslyn' ),
				'description' => esc_html__( 'Choose post type that you want to be searched for', 'roslyn' ),
				'options'     => $post_types
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$search_type_class = 'eltdf-search-post-type';
		$post_type         = $instance['post_type'];
		?>
		
		<div class="widget eltdf-search-post-type-widget">
			<div data-post-type="<?php echo esc_attr( $post_type ); ?>" <?php roslyn_elated_class_attribute( $search_type_class ); ?>>
				<input class="eltdf-post-type-search-field" value="" placeholder="<?php esc_attr_e( 'Search here', 'roslyn' ) ?>">
				<i class="eltdf-search-icon fa fa-search" aria-hidden="true"></i>
				<i class="eltdf-search-loading fa fa-spinner fa-spin eltdf-hidden" aria-hidden="true"></i>
			</div>
			<div class="eltdf-post-type-search-results"></div>
		</div>
	<?php }
}