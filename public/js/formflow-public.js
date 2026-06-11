(function( $ ) {
	'use strict';

	$(function() {
        $('.formflow-form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var responseDiv = form.find('.formflow-response');
            var submitButton = form.find('button[type="submit"]');

            responseDiv.hide().removeClass('success error');
            submitButton.prop('disabled', true);

            var formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: formflowPublic.ajax_url,
                data: formData,
                success: function(response) {
                    submitButton.prop('disabled', false);
                    if (response.success) {
                        responseDiv.addClass('success').html(response.data.message).fadeIn();
                        form[0].reset();
                    } else {
                        responseDiv.addClass('error').html(response.data.message || 'An error occurred.').fadeIn();
                    }
                },
                error: function() {
                    submitButton.prop('disabled', false);
                    responseDiv.addClass('error').html('A server error occurred. Please try again.').fadeIn();
                }
            });
        });
	});

})( jQuery );
