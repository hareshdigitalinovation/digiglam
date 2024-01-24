<div class="eltdf-news-weather-single">
	<?php if ( ! isset( $day_of_week ) ) { ?>
		<div class="eltdf-weather-date">
			<?php echo esc_html( $dt_today ); ?>
		</div>
	<?php } ?>
	<div class="eltdf-weather-temperature">
		<?php echo esc_html( $today_temp ); ?><sup>°</sup>
		<?php echo esc_html( $temp_unit ); ?>
	</div>
	<?php if ( isset( $day_of_week ) ) { ?>
		<div class="eltdf-weather-day">
			<?php echo esc_html( $day_of_week ); ?>
		</div>
	<?php } ?>
</div>