<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//style-1
$all_currencies = apply_filters('wpcs_currency_manipulation_before_show', $this->get_currencies());

//+++

$empty_flag = WPCS_LINK . 'img/no_flag.png';
$show_money_signs = get_option('wpcs_show_money_signs', 1);

//***

if (!isset($show_flags)) {
    $show_flags = $this->get_option('wpcs_show_flags', 1);
}

if (!isset($width)) {
    $width = '100%';
}

if (!isset($flag_position)) {
    $flag_position = 'right';
}

//***

$flags_data = [];

if ($show_flags) {
    foreach ($all_currencies as $key => $currency) {

        $flag = (!empty($currency['flag']) ? $currency['flag'] : $empty_flag);
        $flags_data[$currency['name']] = "background-image: url(" . $flag . "); background-size: 30px 20px; background-repeat: no-repeat; background-position: 99% 10px;";
    }
}
?>


<div class="wpcs-style-1-dropdown" style="width: <?php echo $width ?>;">

    <?php
    $options = [];
    foreach ($all_currencies as $key => $currency) {
        
        if(isset($currency['hide_on_front']) AND $currency['hide_on_front']){
            continue;
        }
        
        $option_txt = apply_filters('wpcs_currname_in_option', $currency['name']);

        if ($show_money_signs) {
            if (!empty($option_txt)) {
                $option_txt .= ', ' . $currency['symbol'];
            } else {
                $option_txt = $currency['symbol'];
            }
        }
        //***
        if (isset($txt_type)) {
            if ($txt_type == 'desc') {
                if (!empty($currency['description'])) {
                    $option_txt = $currency['description'];
                }
            }
        }

        $options[$currency['name']] = $option_txt;
    }
    ?>

    <div class="wpcs-style-1-select">
        <span><?= $options[$this->current_currency] ?></span>
        <i class="fa2 fa-chevron-left2"><img src="<?php echo WPCS_LINK ?>img/arrow-right.png" width="16" alt="" /></i>
    </div>
    <ul class="wpcs-style-1-dropdown-menu">
        <?php foreach ($options as $key => $value) : ?>
            <?php if ($key === $this->current_currency AND ! $this->shop_is_cached) continue; ?>
            <li data-currency="<?php echo $key ?>" data-flag="<?php echo (isset($all_currencies[$key]['flag']) ? $all_currencies[$key]['flag'] : '') ?>" style="<?php
            if (isset($flags_data[$key])) {
                echo $flags_data[$key];
            }
            ?>"><?= $value ?></li>
            <?php endforeach; ?>
    </ul>

    <div class="wpcs_display_none">WPCS v.<?php echo WPCS_VERSION ?></div>
</div>
