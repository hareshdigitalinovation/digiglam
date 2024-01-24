<?php

$display_button = isset( $display_button ) && $display_button !== '' ? $display_button : 'yes';

if($display_button == 'yes') { ?>
    <?php
        echo roslyn_elated_get_button_html(
            apply_filters(
                'roslyn_elated_blog_template_read_more_button',
                array(
                    'link' =>  get_the_permalink(),
                    'size' => 'normal',
                    'text' => esc_html__( 'READ MORE', 'roslyn-news' ),
                    'type' => esc_attr( $button_type ),
                    'custom_class' => 'eltdf-blog-list-button'
                )
            )
        );
    ?>
<?php }?>