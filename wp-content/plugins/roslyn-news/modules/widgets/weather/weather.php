<?php

class RoslynNewsClassWeather extends RoslynNewsPhpClassWidget {
	
	public function __construct() {
		parent::__construct(
			'eltdf_weather_widget', // Base ID
			esc_html__( 'Roslyn Weather Widget', 'roslyn-news' ), // Name
			array( 'description' => esc_html__( 'Displays Weather Forecast', 'roslyn-news' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$app_link     = 'http://openweathermap.org/appid#get';
		$app_location = 'http://openweathermap.org/find';
		
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'roslyn-news' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'layout',
				'title'   => esc_html__( 'Layout', 'roslyn-news' ),
				'options' => array(
					'simple' => esc_html__( 'Simple', 'roslyn-news' ),
					'more'   => esc_html__( 'More Info', 'roslyn-news' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'skin',
				'title'   => esc_html__( 'Skin', 'roslyn-news' ),
				'options' => array(
					''      => esc_html__( 'Default', 'roslyn-news' ),
					'dark'  => esc_html__( 'Dark', 'roslyn-news' ),
					'light' => esc_html__( 'Light', 'roslyn-news' )
				)
			
			),
			array(
				'type'        => 'textfield_html',
				'name'        => 'api_key',
				'title'       => esc_html__( 'API Key', 'roslyn-news' ),
				'description' => '<a href="' . esc_url( $app_link ) . '" target="_blank">' . esc_html__( 'How to get API key', 'roslyn-news' ) . '</a>'
			),
			array(
				'type'        => 'textfield_html',
				'name'        => 'location',
				'title'       => esc_html__( 'Location', 'roslyn-news' ),
				'description' => '<a href="' . esc_url( $app_location ) . '" target="_blank">' . esc_html__( 'Find Your Location (i.e: London,UK or New York City,NY)', 'roslyn-news' ) . '</a>'
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'units',
				'title'   => esc_html__( 'Temperature Unit', 'roslyn-news' ),
				'options' => array(
					'metric'   => esc_html__( 'Metric', 'roslyn-news' ),
					'imperial' => esc_html__( 'Imperial', 'roslyn-news' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'time_zone',
				'title'   => esc_html__( 'Time Zone', 'roslyn-news' ),
				'options' => array(
					'0' => esc_html__( 'UTC', 'roslyn-news' ),
					'1' => esc_html__( 'GMT', 'roslyn-news' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'days_to_show',
				'title'   => esc_html__( 'Days to Show', 'roslyn-news' ),
				'options' => array(
					'1' => esc_html__( 'Current Day', 'roslyn-news' ),
					'5' => esc_html__( '5 Days', 'roslyn-news' ),
				)
			)
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		$classes_array   = array();
		$classes_array[] = 'widget';
		$classes_array[] = 'eltdf-news-weather-widget';
		
		$api_key = '';
		if ( ! empty( $instance['api_key'] ) && $instance['api_key'] !== '' ) {
			$api_key = $instance['api_key'];
		}
		
		$layout = '';
		if ( ! empty( $instance['layout'] ) && $instance['layout'] !== '' ) {
			$layout          = $instance['layout'];
			$classes_array[] = 'eltdf-news-weather-' . $layout;
		}
		
		if ( ! empty( $instance['skin'] ) && $instance['skin'] !== '' ) {
			$skin            = $instance['skin'];
			$classes_array[] = 'eltdf-news-weather-skin-' . $skin;
		}
		
		$location = '';
		if ( ! empty( $instance['location'] ) && $instance['location'] !== '' ) {
			$location = $instance['location'];
		}
		
		$units = '';
		if ( ! empty( $instance['units'] ) && $instance['units'] !== '' ) {
			$units = $instance['units'];
		}
		
		$time_zone = '';
		if ( ! empty( $instance['time_zone'] ) && $instance['time_zone'] !== '' ) {
			$time_zone = $instance['time_zone'];
		}
		
		$days_to_show = '';
		if ( ! empty( $instance['days_to_show'] ) && $instance['days_to_show'] !== '' ) {
			$days_to_show    = $instance['days_to_show'];
			$classes_array[] = 'eltdf-news-weather-days-' . $days_to_show;
		}
		
		if ( ! empty( $instance['widget_title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		}
		
		echo '<div ' . roslyn_elated_get_class_attribute( $classes_array ) . '>';
		
		echo roslyn_news_weather_widget_logic(
			array(
				'api_key'      => $api_key,
				'layout'       => $layout,
				'location'     => $location,
				'units'        => $units,
				'time_zone'    => $time_zone,
				'days_to_show' => $days_to_show,
			)
		);
		
		echo '</div>';
	}
}

// the logic
function roslyn_news_weather_widget_logic( $atts ) {
	$html         = '';
	$weather_data = array();
	$api_key      = $atts['api_key'] !== '' ? $atts['api_key'] : false;
	$layout       = $atts['layout'] !== '' ? $atts['layout'] : 'simple';
	$location     = $atts['location'] !== '' ? $atts['location'] : false;
	$units        = $atts['units'] !== '' ? $atts['units'] : false;
	$time_zone    = $atts['time_zone'] !== '' ? $atts['time_zone'] : false;
	$days_to_show = $atts['days_to_show'] !== '' ? $atts['days_to_show'] : 1;
	$locale       = 'en';
	
	$sytem_locale      = get_locale();
	$available_locales = array(
		'en',
		'es',
		'sp',
		'fr',
		'it',
		'de',
		'pt',
		'ro',
		'pl',
		'ru',
		'uk',
		'ua',
		'fi',
		'nl',
		'bg',
		'sv',
		'se',
		'ca',
		'tr',
		'hr',
		'zh',
		'zh_tw',
		'zh_cn',
		'hu'
	);
	
	// check for locale
	if ( in_array( $sytem_locale, $available_locales ) ) {
		$locale = $sytem_locale;
	}
	
	// check for locale by first two digits, used as language in returned data
	if ( in_array( substr( $sytem_locale, 0, 2 ), $available_locales ) ) {
		$locale = substr( $sytem_locale, 0, 2 );
	}
	
	// if location is empty abort
	if ( ! $location ) {
		return roslyn_news_weather_widget_error();
	}
	
	// find and cache city id
	if ( is_numeric( $location ) ) {
		$city_name_slug = sanitize_title( $location );;
		$api_query = "id=" . $location;
	} else {
		$city_name_slug = sanitize_title( $location );
		$api_query      = "q=" . $location;
	}
	
	// set transient name
	$weather_transient_name = 'roslyn_news_' . $city_name_slug . "_" . $days_to_show . "_" . $units . '_' . $locale;
	
	// get weather data
	if ( get_transient( $weather_transient_name ) ) {
		$weather_data = get_transient( $weather_transient_name );
	} else {
		$weather_data['now']      = array();
		$weather_data['forecast'] = array();
		
		// ping weather now api
		$now_ping     = "http://api.openweathermap.org/data/2.5/weather?" . $api_query . "&lang=" . $locale . "&units=" . $units . "&APPID=" . $api_key;
		$now_ping     = str_replace( " ", "", $now_ping );
		$now_ping_get = wp_remote_get( $now_ping );
		
		// ping url error
		if ( is_wp_error( $now_ping_get ) ) {
			return roslyn_news_weather_widget_error( $now_ping_get->get_error_message() );
		}
		
		// get body of request
		$city_data = json_decode( $now_ping_get['body'] );
		
		if ( isset( $city_data->cod ) AND $city_data->cod == 404 ) {
			return roslyn_news_weather_widget_error( $city_data->message );
		} else {
			$weather_data['now'] = $city_data;
		}
		
		if ( $days_to_show == 5 ) {
			
			// ping weather forecast api
			$forecast_ping = "http://api.openweathermap.org/data/2.5/forecast/daily?" . $api_query . "&lang=" . $locale . "&units=" . $units . "&cnt=7&APPID=" . $api_key;
			
			$forecast_ping     = str_replace( " ", "", $forecast_ping );
			$forecast_ping_get = wp_remote_get( $forecast_ping );
			
			if ( is_wp_error( $forecast_ping_get ) ) {
				return roslyn_news_weather_widget_error( $forecast_ping_get->get_error_message() );
			}
			
			$forecast_data = json_decode( $forecast_ping_get['body'] );
			
			if ( isset( $forecast_data->cod ) AND $forecast_data->cod == 404 ) {
				return roslyn_news_weather_widget_error( $forecast_data->message );
			} else {
				$weather_data['forecast'] = $forecast_data;
			}
		}
		
		if ( $weather_data['now'] || $weather_data['forecast'] ) {
			// set the transient, cache for three hours
			set_transient( $weather_transient_name, $weather_data, apply_filters( 'roslyn_elated_weather_cache', 1800 ) );
		}
	}
	
	// no weather
	if ( ! $weather_data || ! isset( $weather_data['now'] ) ) {
		return roslyn_news_weather_widget_error();
	}
	
	$today_params = array();
	
	if ( $units == 'metric' ) {
		$today_params['temp_unit'] = esc_html__( 'C', 'roslyn-news' );
		$today_params['wind_unit'] = esc_html__( 'm/s', 'roslyn-news' );
	} else {
		$today_params['temp_unit'] = esc_html__( 'F', 'roslyn-news' );
		$today_params['wind_unit'] = esc_html__( 'fps', 'roslyn-news' );
	}
	
	$today_params['dt_today'] = date( 'd M, l', current_time( 'timestamp', $time_zone ) );
	
	// todays temps
	$today = $weather_data['now'];
	
	$today_params['today_temp']              = round( $today->main->temp );
	$today_params['today_high']              = round( $today->main->temp_max );
	$today_params['today_low']               = round( $today->main->temp_min );
	$today_params['today_description']       = $today->weather[0]->description;
	$today_params['today_description_class'] = sanitize_title( $today->weather[0]->description );
	$today_params['today_humidity']          = $today->main->humidity;
	$today_params['today_wind_speed']        = $today->wind->speed;
	$today_params['city']                    = $today->name;
	$today_params['day_number']              = 1;
	
	
	if ( $layout == 'simple' ) {
		$html .= '<div class="eltdf-weather-city">' . $today_params['city'] . '</div>';
	}
	
	$html .= roslyn_news_get_template_part( 'weather/templates/weather-' . $layout, 'widgets', '', $today_params );
	
	if ( $days_to_show == 5 ) {
		$c        = 1;
		$forecast = $weather_data['forecast'];
		
		foreach ( (array) $forecast->list as $forecast ) {
			if ( $c == 1 ) {
				$c ++;
				continue;
			}
			
			$days_of_week = array(
				esc_html__( 'Sun', 'roslyn-news' ),
				esc_html__( 'Mon', 'roslyn-news' ),
				esc_html__( 'Tue', 'roslyn-news' ),
				esc_html__( 'Wed', 'roslyn-news' ),
				esc_html__( 'Thu', 'roslyn-news' ),
				esc_html__( 'Fri', 'roslyn-news' ),
				esc_html__( 'Sat', 'roslyn-news' )
			);
			
			$today_params['today_temp']  = round( $forecast->temp->day );
			$today_params['day_of_week'] = $days_of_week[ date( 'w', $forecast->dt ) ];
			
			//add surrounding div for days after today
			if ( $c == 2 ) {
				$html .= '<div class="eltdf-news-weather-other-days">';
			}
			
			$html .= roslyn_news_get_template_part( 'weather/templates/weather-simple', 'widgets', '', $today_params );
			
			if ( $c == $days_to_show ) {
				$html .= '</div>';
				break;
			}
			
			$c ++;
		}
	}

    return $html;
}

// handle error
function roslyn_news_weather_widget_error( $msg = false ) {
	
	if ( ! $msg ) {
		$msg = esc_html__( 'No weather information available', 'roslyn-news' );
	}
	
	return $msg;
}