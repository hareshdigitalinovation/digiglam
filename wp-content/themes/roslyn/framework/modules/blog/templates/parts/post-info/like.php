<?php if(roslyn_elated_core_plugin_installed()) { ?>
    <div class="eltdf-blog-like">
        <?php if( function_exists('roslyn_elated_get_like') ) roslyn_elated_get_like(); ?>
    </div>
<?php } ?>