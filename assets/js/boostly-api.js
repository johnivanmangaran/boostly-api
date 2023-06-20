! function($, window, document, _undefined) {
    $(function() {
        // Sync Rentals United properties
        $(document).ready(function() {

            $(document).on('click', '#boostly_api_sync_listings', function(e) {
                var $button = $(e.target).prop('disabled', true);
                var $spin = $button.next('.spinner').addClass('is-active');
                $spin.show();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    dataType: 'json',
                    data: {
                        action: 'boostly_api_sync_listings'
                    },
                    success: function(response) {
                        console.log(response);
                        $button.prop('disabled', false);
                        $spin.removeClass('is-active');
                        $spin.hide();
                    },
                    error: function() {
                        $button.prop('disabled', false);
                        $spin.removeClass('is-active');
                        $spin.hide();
                    }
                });
            });

        });

        
    });
}(jQuery, this, document);