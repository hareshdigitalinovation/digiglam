<div class="eltdf-news-filter" data-filter-by="<?php echo esc_attr( $filter_by ); ?>">
	<?php
	foreach ( $filter_array as $filter ) { ?>
		<a href="" itemprop="url" class="eltdf-news-filter-item" data-filter="<?php echo esc_attr( $filter['slug'] ); ?>"><?php echo esc_html( $filter['name'] ); ?></a>
	<?php }
	?>
</div>
<div class="eltdf-spinner eltdf-rotate-line eltdf-hide-spinner"></div>