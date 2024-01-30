<?php

/*** Child Theme Function  ***/
if ( ! function_exists( 'roslyn_elated_child_theme_enqueue_scripts' ) ) {
	function roslyn_elated_child_theme_enqueue_scripts()
	{

		$parent_style = 'roslyn_elated_default_style';

		wp_enqueue_style('roslyn_elated_child_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
	}

	add_action('wp_enqueue_scripts', 'roslyn_elated_child_theme_enqueue_scripts');
}


// Enqueue parent theme styles
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles() {
    wp_enqueue_style('roslyn_elated_default_style', get_template_directory_uri() . '/style.css');
}

// Enqueue custom child theme styles
add_action('wp_enqueue_scripts', 'enqueue_child_styles');
function enqueue_child_styles() {
    wp_enqueue_style('roslyn_elated_child_style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}



// Login Pop-up

// Enqueue jQuery
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Add the necessary scripts for the pop-up
function custom_login_popup_scripts() {
	// Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');

    // Enqueue Bootstrap JavaScript
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js', array('jquery'), '', true);

    ?>
    <script>
        jQuery(document).ready(function($) {
            // Check if the cookie is not set
            if (document.cookie.indexOf('custom_login_popup_displayed') === -1) {
                // Open the login pop-up
                $('#custom-login-popup').fadeIn();

                // Set the cookie to indicate that the pop-up has been displayed
                document.cookie = 'custom_login_popup_displayed=true; expires=' + new Date(new Date().getTime() + 5 * 1000).toUTCString(); // Expires in 5 seconds

                // Automatically close the pop-up after 5 seconds (adjust the duration as needed)
                setTimeout(function() {
                    $('#custom-login-popup').fadeOut();
                }, 100);
            }

            // Hide the "Login" button when the pop-up is open
            $('#custom-login-link').on('click', function(e) {
                e.preventDefault();
                $('#custom-login-popup').fadeIn();
                $(this).hide();
            });

            // Show the "Login" button when closing the pop-up
            $('#custom-close-popup').on('click', function() {
                $('#custom-login-popup').fadeOut();
                $('#custom-login-link').show();
            });
            $('.BacktoChange').on('click', function() {
                $('#enter-otp-section').hide();
                $('#otp-section').show();
            });

            
            // Handle OTP request
            $(document).on("click","#custom-get-otp-btn,.Resend_code",function() {
                var email = $('#custom-email').val();

                if(email!=''){
                	$('.Mail_err').html('');
	                // AJAX request to send OTP (Replace "your_otp_endpoint" with the actual endpoint)
	                $.ajax({
	                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
	                    type: 'POST',
	                    data: {
	                        action: 'custom_get_otp',
	                        email: email
	                    },
	                    success: function(response) {
	                        var response = $.parseJSON(response);
	                        if(response.status){
                                $('.emailTxt').text(email);
	                        	$('#custom-token').val(response.token);
	                        	$('#otp-section').hide();
                				$('#enter-otp-section').show();
                                timer(60);							
	                        }else{
	                        	$('.Mail_err').html('something went wrong while sending otp!');
	                        }
	                        
	                    }
	                });
	            }else{
	            	$('.Mail_err').html('Enter valid email address!');
	            }
            });

            let timerOn = true;

            function timer(remaining) {
              var m = Math.floor(remaining / 60);
              var s = remaining % 60;
              
              m = m < 10 ? '0' + m : m;
              s = s < 10 ? '0' + s : s;
              document.getElementById('timer').innerHTML = m + ':' + s;
              remaining -= 1;
              
              if(remaining >= 0 && timerOn) {
                setTimeout(function() {
                    timer(remaining);
                }, 1000);
                return;
              }

              if(!timerOn) {
                // Do validate stuff here
                return;
              }
              
              // Do timeout stuff here
              $('#timer').addClass("Resend_code");
              $('#timer').html('Resend code');
            }

            
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_login_popup_scripts');

// Add the login pop-up HTML
function custom_login_popup_html() {
    ob_start(); ?>
    <!-- Button to trigger the modal -->
    <?php if(is_user_logged_in()){ ?>
    	<!-- <a href="javascript:;"><i class="eltdf-icon-font-awesome fa fa-user"></i></a>
    	<ul>
    		<li><a href="">My Account</a></li>
    		<li><a href="<?php echo wp_logout_url( home_url() ); ?>">Log out</a></li>
    	</ul> -->
        <div class="dropdown login_account">
            <a href="javascript:;" class="dropdown-toggle" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="eltdf-icon-font-awesome fa fa-user"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                <li>
                    <span class="item_outer">
                        <a href="<?php echo site_url()."/membership-account/"; ?>">My Account</a>
                    </span>
                </li>
                <li>
                    <span class="item_outer">
                        <a href="<?php echo wp_logout_url(home_url()); ?>">Log out</a>
                    </span>
                </li>
            </ul>
        </div>
	<?php }else{?>
		<a id="model_button" class="btn btn-info btn-lg model_button_outline" data-toggle="modal" data-target="#custom-login-modal">Log in</a>
	<?php } ?>

    <!-- Modal -->
    <div id="custom-login-modal" class="modal fade custom-popup-modal" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body" id="otp-section">
                    <!-- Your initial form can go here -->
                    <form>
                        <!-- <label for="custom-email">Email:</label> -->
                        <input type="email" id="custom-email" name="custom-email" placeholder="e-mail*" required>
                        <!-- <input size="40" id="custom-email" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="e-mail*" value="" type="email" name="custom-email"> -->
						<span class="Mail_err" style="color: red !important;"></span>
                        <button type="button" class="btn btn-primary" id="custom-get-otp-btn">Get OTP</button>
                    </form>

                    <div id="loginSignUpSeparator">
                        <span class="textInSeparator">or</span>
                    </div>

                    <?php  echo do_shortcode("[xs_social_login provider='google' class='custom-class' btn-text='Button Text for Google']"); ?>
                </div>
                <div class="modal-body" id="enter-otp-section" style="display: none;">
                    <!-- OTP input form -->
                    <div class="backtochangeTxt">
                        Please enter the OTP sent to<br>
                        <span class="emailTxt"></span><a class="BacktoChange" href="javascript:;">Change</a>
                    </div>
                    <form>
                        <!-- <label for="custom-otp">Enter OTP:</label> -->
                        <input type="text" id="custom-otp" name="custom-otp" placeholder="Enter OTP*" required>
                        <input type="hidden" id="custom-token" name="token" required>
						<span class="Otp_err" style="color: red !important;"></span>
                        <button type="button" class="btn btn-success" id="custom-submit-otp-btn">Verify</button>

                        <div class="resendText">Not received your code? <a href="javascript:;" id="timer" class="resendCode">Resend code</a></div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            // Disable scrolling when the modal is open
            $('#custom-login-modal').on('show.bs.modal', function () {
                $('body').addClass('custom-modal-open');
            });

            // Enable scrolling when the modal is closed
            $('#custom-login-modal').on('hidden.bs.modal', function () {
                $('body').removeClass('custom-modal-open');
            });

            // Handle OTP request
            // $('#custom-get-otp-btn').on('click', function() {
            //     // Hide the initial form
            //     $('#otp-section').hide();
                
            //     // Show the "Enter OTP" section
            //     $('#enter-otp-section').show();
            // });

            // Handle OTP submission
            $('#custom-submit-otp-btn').on('click', function() {
                var enteredOTP = $('#custom-otp').val();
                var token = $('#custom-token').val();
                var email = $('#custom-email').val();

                if(enteredOTP!=''){
                	if(enteredOTP==atob(token)){
                		$('.Otp_err').html('');
                		$.ajax({
		                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
		                    type: 'POST',
		                    data: {
		                        action: 'custom_login_register',
		                        email: email,
		                        token: token
		                    },
		                    success: function(response) {
		                        var response = $.parseJSON(response);
		                        if(response.status){
		                        	$('#custom-token').val(response.token);
		                        	$('#otp-section').hide();
	                				$('#enter-otp-section').hide();	
	                				location.reload();							
		                        }else{
		                        	$('.Mail_err').html('something went wrong while sending otp!');
		                        }
		                        
		                    }
		                });
                	}else{
                		$('.Otp_err').html('invalid otp!');
                	}
                }else{
					$('.Otp_err').html('Enter otp!');
                }
                console.log('Entered OTP:', enteredOTP);
                console.log('Token:', token);
                console.log('OTP:', atob(token));
            });
        });
    </script>
    <?php
    return ob_get_clean();
}



// Register the shortcode
function Digi_login_shortcode() {
    return custom_login_popup_html();
}
add_shortcode('DigiGlamLogin', 'Digi_login_shortcode');

// AJAX handler for OTP request
function custom_get_otp() {
    $email = sanitize_email($_POST['email']);
    $otp = random_int(100000, 999999);

    //$user = get_user_by( 'email', $email );
    

    $html ='';
	$html .='<p>Hi, </p>';
	
	//$html .='<p>Name : <strong> '.$results[0]->booking_user_fname.' '.$results[0]->booking_user_lname.'</strong></p>';
	$html .='<p>Your Login OTP is : <strong> '.$otp.'</strong></p>';
	$body = $html;
	$siteName=get_bloginfo( 'name' )?get_bloginfo( 'name' ):"DiGi-Glam";
	$subj="Login Otp - ".$siteName;
	// send mail
	
	$toEmail=$email;
	//$send=true;
	$send=customEmailsendWithTemplate($toEmail, $subj, $body);

    // Return the OTP
    echo json_encode(array('token' => base64_encode($otp),'status'=>$send)); //,'otp' => $otp

    wp_die();
}
add_action('wp_ajax_custom_get_otp', 'custom_get_otp');
add_action('wp_ajax_nopriv_custom_get_otp', 'custom_get_otp');


function customEmailsendWithTemplate($to, $subject, $body){

	$id = roslyn_elated_get_page_id();
	$logo_image = roslyn_elated_get_meta_field_intersect( 'logo_image', $id );
	
	$vars['email_url'] =  get_stylesheet_directory_uri() . "/mailtemplate/";
	$vars['content'] = $body;
	$vars['Emaillogo']=$logo_image;
	$vars['siteurl'] = site_url();
	$vars['heading'] = get_bloginfo( 'name' )?get_bloginfo( 'name' ):"DiGi-Glam";
	$vars['copyrightYear'] = date('Y');
	$template_content = file_get_contents( get_stylesheet_directory_uri() . "/mailtemplate/otp.html");
	foreach($vars as $var=>$val) {
		$template_content = str_replace('{'.$var.'}', $val, $template_content);
	}

	$Bodycontent=$template_content;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	return wp_mail( $to, strip_tags($subject), $Bodycontent, $headers );
}

// login / registration process after otp
function custom_login_register() {
    $email = sanitize_email($_POST['email']);
    $user = get_user_by( 'email', $email );
    $password= random_int(10000000, 99999999);
    $username=$email;
    if(!$user){
		$new_user_id = wp_create_user($username, $password, $email);
		$user = get_user_by( 'id', $new_user_id );
    }
    remove_filter('authenticate', 'wp_authenticate_username_password', 20);
	add_filter('authenticate',function($user, $email){
		return $user;
	}, 20, 3);

    wp_set_auth_cookie( $user->ID, 0, 0);
    wp_set_current_user($user->ID);
    // The next line *really* seemed to help!
    do_action('set_current_user');

    // Return the OTP
    echo json_encode(array('user' => $user,'status'=>true));

    wp_die();
}
add_action('wp_ajax_custom_login_register', 'custom_login_register');
add_action('wp_ajax_nopriv_custom_login_register', 'custom_login_register');



/*---------------- Currency switcher ---------------------*/ 

// function custom_currency_switcher_pmpro_level_cost($level_cost, $level)
// {
//     // Get user's location using the currency switcher plugin or another method
//     $user_location = get_user_location(); // Implement your method here

//     // Determine the currency based on the user's location
//     $currency = get_currency_based_on_location($user_location); // Implement your method here

//     // Convert the level cost to the selected currency
//     $converted_cost = convert_currency($level_cost, $currency); // Implement your method here

//     return $converted_cost;
// }

add_filter('pmpro_level_cost', 'custom_currency_switcher_pmpro_level_cost', 10, 2);

function get_user_location() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $api_url = "http://www.geoplugin.net/json.gp?ip=$ip";

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    return $data->geoplugin_countryCode; // Return the country code
}

function get_currency_based_on_location($country_code) {
    // Define a mapping of country codes to currency codes
    $country_currency_map = array(
        'US' => 'USD', // United States
        'GB' => 'GBP', // United Kingdom
        'CA' => 'CAD', // Canada
        'AU' => 'AUD', // Australia
        'FR' => 'EUR', // France
        // Add more mappings as needed
    );

    global $country_currency_map;
    error_log('Country Code: ' . $country_code);
    error_log('Mapped Currency: ' . $country_currency_map[$country_code]);
    return isset($country_currency_map[$country_code]) ? $country_currency_map[$country_code] : 'USD';

    // // Check if the country code exists in the mapping
    // if (isset($country_currency_map[$country_code])) {
    //     return $country_currency_map[$country_code];
    // } else {
    //     // Default to a fallback currency if the country code is not found
    //     return 'USD'; // Default to United States Dollar
    // }
}




// function convert_currency($amount, $to_currency) {
//     // Replace 'YOUR_API_KEY' with your actual API key
//     $api_key = '62760006460d2a141b290044';

//     // API endpoint for exchange rates (replace with the actual API endpoint)
//     $api_url = "https://v6.exchangerate-api.com/v6/62760006460d2a141b290044/latest/USD";

//     // Make a request to the API to get the latest exchange rates
//     $response = wp_remote_get($api_url);

//     if (is_wp_error($response)) {
//         // Handle error
//         return false;
//     }

//     $body = wp_remote_retrieve_body($response);
//     $exchange_rates = json_decode($body, true);

//     // Check if the target currency exists in the exchange rates data
//     if (isset($exchange_rates[$to_currency])) {
//         // Perform the currency conversion
//         $conversion_rate = $exchange_rates[$to_currency];
//         $converted_amount = $amount * $conversion_rate;

//         return $converted_amount;
//     } else {
//         // Handle the case where the target currency is not found in the exchange rates data
//         return false;
//     }
// }


function convert_currency($amount, $to_currency) {
    // Replace 'YOUR_API_KEY' with your actual ExchangeRate-API key
    $api_key = '62760006460d2a141b290044';
    $api_url = "https://v6.exchangerate-api.com/v6/62760006460d2a141b290044/latest/USD?apikey=$api_key";

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        // Handle error
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['rates'][$to_currency])) {
        $conversion_rate = $data['rates'][$to_currency];
        $converted_amount = $amount * $conversion_rate;

        return $converted_amount;
    } else {
        // Handle invalid currency code
        return false;
    }
}

