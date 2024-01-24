<?php
$share_type = isset($share_type) ? $share_type : 'dropdown';
?>
<?php if( roslyn_elated_core_plugin_installed() && roslyn_elated_options()->getOptionValue('enable_social_share') === 'yes' && roslyn_elated_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="eltdf-blog-share">
        <?php echo roslyn_elated_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>