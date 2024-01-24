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

            // Handle OTP request
            $('#custom-get-otp-btn').on('click', function() {
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
	                        	$('#custom-token').val(response.token);
	                        	$('#otp-section').hide();
                				$('#enter-otp-section').show();								
	                        }else{
	                        	$('.Mail_err').html('something went wrong while sending otp!');
	                        }
	                        
	                    }
	                });
	            }else{
	            	$('.Mail_err').html('Enter valid email address!');
	            }
            });
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
    	<a href="javascript:;"><i class="eltdf-icon-font-awesome fa fa-user"></i></a>
    	<ul>
    		<li><a href="">My Account</a></li>
    		<li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
    	</ul>
	<?php }else{?>
		<a id="model_button" class="btn btn-info btn-lg model_button_outline" data-toggle="modal" data-target="#custom-login-modal">Login</a>
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
                        <label for="custom-email">Email:</label>
                        <input type="email" id="custom-email" name="custom-email" required>
						<span class="Mail_err" style="color: red;"></span>
                        <button type="button" class="btn btn-primary" id="custom-get-otp-btn">Get OTP</button>
                    </form>

                    <?php  echo do_shortcode("[xs_social_login provider='google' class='custom-class' btn-text='Button Text for Google']"); ?>
                </div>
                <div class="modal-body" id="enter-otp-section" style="display: none;">
                    <!-- OTP input form -->
                    <form>
                        <label for="custom-otp">Enter OTP:</label>
                        <input type="text" id="custom-otp" name="custom-otp" required>
                        <input type="hidden" id="custom-token" name="token" required>
						<span class="Otp_err" style="color: red;"></span>
                        <button type="button" class="btn btn-success" id="custom-submit-otp-btn">Submit OTP</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
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
    echo json_encode(array('token' => base64_encode($otp),'status'=>$send));

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
    $password='';
    $username='';
    if(!$user){
		$new_user_id = wp_create_user($username, $password, $email);
		$user = get_user_by( 'id', $new_user_id );
    }
    remove_filter('authenticate', 'wp_authenticate_username_password', 20);
	add_filter('authenticate',function($user, $email){
		return $user;
	}, 20, 3);

    // Return the OTP
    echo json_encode(array('user' => $user,'status'=>true));

    wp_die();
}
add_action('wp_ajax_custom_login_register', 'custom_login_register');
add_action('wp_ajax_nopriv_custom_login_register', 'custom_login_register');