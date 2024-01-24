<div class="eltdf-news-weather-single eltdf-ws-more">
	<div class="eltdf-news-ws-left">
		<span class="eltdf-news-weather-icon eltdf-news-ws-<?php echo esc_attr( $today_description_class ); ?>"></span>
		<div class="eltdf-weather-temperature">
			<?php echo esc_html( $today_temp ); ?><sup>°</sup>
			<?php echo esc_html( $temp_unit ); ?>
		</div>
	</div>
	<div class="eltdf-news-ws-right">
		<div class="eltdf-weather-top-part">
			<?php if ( isset( $city ) ) { ?>
				<h4 class="eltdf-weather-city"><?php echo esc_html( $city ); ?></h4>
			<?php } ?>
			<div class="eltdf-weather-description">
				<?php echo esc_html( $today_description ) ?>
			</div>
		</div>
		<div class="eltdf-weather-humidity">
			<?php esc_html_e( 'Humidity:', 'roslyn-news' ); echo esc_html( $today_humidity ); echo esc_html__( '%', 'roslyn-news' ); ?>
		</div>
		<div class="eltdf-weather-wind">
			<?php esc_html_e( 'Wind:', 'roslyn-news' ); echo esc_html( $today_wind_speed ); echo esc_html( $wind_unit ); ?>
		</div>
		<div class="eltdf-weather-temperature eltdf-wt-high-low">
			<span class="eltdf-wt-low">
				<?php esc_html_e( 'L ', 'roslyn-news' ); echo esc_html( $today_low ); ?><sup>°</sup><?php echo esc_html( $temp_unit ); ?>
			</span>
			-
			<span class="eltdf-wt-high">
				<?php esc_html_e( 'H ', 'roslyn-news' ); echo esc_html( $today_high ); ?><sup>°</sup><?php echo esc_html( $temp_unit ); ?>
			</span>
		</div>
	</div>
</div>