<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-text">
            <div class="eltdf-post-mark">
                <span class="eltdf-quote-mark">’’</span>
            </div>
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-info-top">
                    <?php roslyn_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php roslyn_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php roslyn_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php roslyn_elated_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                    <?php if(roslyn_elated_options()->getOptionValue('show_tags_area_blog') === 'yes') {
	                    roslyn_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params);
                    } ?>
                </div>
                <div class="eltdf-post-text-main">
                    <?php roslyn_elated_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>