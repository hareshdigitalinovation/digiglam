<?php

if ( ! function_exists( 'roslyn_elated_like' ) ) {
	/**
	 * Returns RoslynElatedLike instance
	 *
	 * @return RoslynElatedLike
	 */
	function roslyn_elated_like() {
		return RoslynElatedLike::get_instance();
	}
}

function roslyn_elated_get_like() {
	
	echo wp_kses( roslyn_elated_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}