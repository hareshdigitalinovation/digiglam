<li class="eltdf-bl-item eltdf-item-space clearfix">
	<div class="eltdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			roslyn_elated_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="eltdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="eltdf-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                roslyn_elated_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                roslyn_elated_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                roslyn_elated_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                roslyn_elated_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php roslyn_elated_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>

            <div class="eltdf-post-info-bottom clearfix">
                <div class="eltdf-post-info-bottom-left">
			        <?php if ( $post_info_author == 'yes' ) {
				        roslyn_elated_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
			        } ?>
                </div>
                <div class="eltdf-post-info-bottom-right">
                    <?php if ( $post_info_share == 'yes' ) {
                        roslyn_elated_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
                    } ?>
                </div>
            </div>
        </div>
	</div>
</li>