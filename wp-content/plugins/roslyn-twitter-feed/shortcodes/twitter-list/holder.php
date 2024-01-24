<div class="eltdf-twitter-list-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-tl-wrapper eltdf-outer-space">
        <?php if ( isset($response) && $response->status ) { ?>
            <?php if ( is_array( $response->data ) && count( $response->data ) ) { ?>
                <ul class="eltdf-twitter-list">
                    <?php foreach ( $response->data as $tweet ) { ?>
                        <?php
                            $params['tweet'] = $tweet;
                            echo roslyn_twitter_get_shortcode_module_template_part('templates/item', 'twitter-list', '', $params);
                        ?>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <div class="eltdf-twitter-message">
                    <?php echo esc_html( $response->message ); ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="eltdf-twitter-not-connected">
                <?php esc_html_e( 'It seams that you haven\'t connected with your Twitter account', 'roslyn-twitter-feed' ); ?>
            </div>
        <?php } ?>
    </div>
</div>