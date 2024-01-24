<?php

roslyn_elated_get_single_post_format_html( $blog_single_type );

do_action( 'roslyn_elated_after_article_content' );

roslyn_elated_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

roslyn_elated_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

roslyn_elated_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

roslyn_elated_get_module_template_part( 'templates/parts/single/comments', 'blog' );