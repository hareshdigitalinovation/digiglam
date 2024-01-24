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
            $('#custom-get-otp-btn').on('click', function() {
                var email = $('#custom-email').val();

                // AJAX request to send OTP (Replace "your_otp_endpoint" with the actual endpoint)
                $.ajax({
                    // url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'custom_get_otp',
                        email: email
                    },
                    success: function(response) {
                        // Handle the response (e.g., display a message)
                        console.log(response);
                    }
                });
            });
        });