<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//style-3
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

        if ($this->current_currency !== $key) {
            $flags_data[$key] = "background-image: url(" . $flag . "); background-size: 40px 25px; background-repeat: no-repeat; background-position: 98% 10px;";
        } else {
            $flags_data[$key] = "background-image: url(" . $flag . "); background-repeat: no-repeat; background-position: 0 0;";
        }
    }
}

//+++

$options = [];
foreach ($all_currencies as $key => $currency) {

    if (isset($currency['hide_on_front']) AND $currency['hide_on_front']) {
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

    $options[$key] = $option_txt;
}
?>


<div class="wpcs-style-3-du-dialog" style="display: none;">
    <div class="wpcs-style-3-dlg-wrapper" tabindex="0">

        <?php if (isset($head_title)): ?>
            <?php
            if (!empty($head_title)) {
                $head_title .= ':';
            }
            ?>
            <div class="wpcs-style-3-dlg-header"><?php echo $head_title ?>
            <?php else: ?>
                <div class="wpcs-style-3-dlg-header"><?php echo __('Select Currency', 'currency-switcher') ?>:
                <?php endif; ?>
                <span class="wpcs-style-3-close">X</span></div>



            <div class="wpcs-style-3-dlg-content">

                <?php foreach ($options as $key => $value) : ?>                
                    <?php if ($key === $this->current_currency AND!$this->shop_is_cached) continue; ?>
                    <?php
                    if (strtolower($key) === strtolower($this->current_currency)) {
                        continue;
                    }
                    ?>
                    <?php $id = uniqid(); ?>
                    <div class="wpcs-style-3-dlg-select-item  <?php if ($key === $this->current_currency): ?>wpcs-btn-switcher<?php endif; ?>" data-currency="<?php echo $key ?>" data-flag="<?php echo (isset($all_currencies[$key]['flag']) ? $all_currencies[$key]['flag'] : '') ?>" style="<?php
                    if (isset($flags_data[$key])) {
                        echo $flags_data[$key];
                    }
                    ?>;">

                        <input class="wpcs-style-3-dlg-select-radio" id="<?= $id ?>" <?php checked($key === $this->current_currency) ?> name="wpcs-selection" type="radio" value="<?= $key ?>">

                        <label class="wpcs-style-3-dlg-select-lbl" for="<?= $id ?>"><?= $value ?></label>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <button class="wpcs-style-3-du-dialog-starter <?php if (isset($flags_data[$this->current_currency])): ?>wpcs-btn-switcher2<?php endif; ?>" style="width: <?= $width ?>; <?php
    if (isset($flags_data[$this->current_currency])): echo $flags_data[$this->current_currency] . '';
    endif;
    ?>"><?= $options[$this->current_currency] ?></button>


    <div class="wpcs_display_none">WPCS v.<?php echo WPCS_VERSION ?></div>


