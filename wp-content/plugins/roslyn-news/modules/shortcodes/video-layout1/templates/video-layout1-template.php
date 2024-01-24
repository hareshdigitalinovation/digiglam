<div class="eltdf-news-item eltdf-video-layout1-item eltdf-item-space">
    <div class="eltdf-ni-inner">
        <div class="eltdf-ni-image-holder">
            <?php echo roslyn_news_get_shortcode_inner_template_part( 'image', 'video', $params ); ?>
        </div>
        <div class="eltdf-ni-content">
            <?php echo roslyn_news_get_shortcode_inner_template_part( 'title', '', $params ); ?>
            <?php echo roslyn_news_get_shortcode_inner_template_part( 'excerpt', '', $params ); ?>
            <div class="eltdf-ni-info eltdf-ni-info-bottom">
                <?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/date', '', $params ); ?>
                <?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/category', '', $params ); ?>
            </div>
        </div>
    </div>
</div>