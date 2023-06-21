! function($, window, document, _undefined) {
    $(function() {
        $(document).ready(function() {

            $(document).on('click', '#boostly_api_sync_listings', function(e) {
                
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    method: "POST",
                    data: {
                        action: 'boostly_api_sync_listings_ajax'
                    },
                    beforeSend: function() {
                        $("#boostly_api_sync_listings").html('Listings Syncing..');

                    },
                    success: function(response) {
                        $("#boostly_api_sync_listings").html('Listings Sync Successfully');
                        console.log(response);
                        // alert('Successfully');
                        setTimeout(function() {
                            $("#boostly_api_sync_listings").html('Listings Sync');
                        }, 3000);
                    },
                    error: function(error) {
                        $("#boostly_api_sync_listings").text('Listings Sync Error...');
                        console.log(JSON.parse(error));
                    }
                });

            });

            $(document).on('click', '#boostly_api_delete_listings', function(e) {
                
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    method: "POST",
                    data: {
                        action: 'boostly_api_delete_listings_ajax'
                    },
                    beforeSend: function() {
                        $("#boostly_api_delete_listings").html('Deleting..');

                    },
                    success: function(response) {
                        $("#boostly_api_delete_listings").html('Delete Listings Successfully');
                        console.log(response);
                        // alert('Successfully');
                        setTimeout(function() {
                            $("#boostly_api_delete_listings").html('Delete Listings');
                        }, 3000);
                    },
                    error: function(error) {
                        $("#boostly_api_delete_listings").text('Delete Listings Error...');
                        console.log(JSON.parse(error));
                    }
                });

            });

        });

        
    });
}(jQuery, this, document);