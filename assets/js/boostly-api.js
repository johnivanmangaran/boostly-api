! function($, window, document, _undefined) {
    $(function() {
        $(document).ready(function() {

            $(document).on('click', '#boostly_api_sync_listings', function(e) {
                $(this).text('Listings Syncing..');
                console.log(ajaxurl);
                $.ajax({
                    url: ajaxurl,
                    dataType: "json",
                    method: "POST",
                    data: {
                        action: 'boostly_api_sync_listings_ajax'
                    },
                    success: function(response) {
                        $(this).text('Listings Sync');
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

        });

        
    });
}(jQuery, this, document);