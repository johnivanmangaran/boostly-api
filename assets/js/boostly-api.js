! function($, window, document, _undefined) {
    $(function() {
        $(document).ready(function() {

            // Instantiates the variable that holds the media library frame.
            var meta_image_frame;

            // Runs when the image button is clicked. You need to insert ID of your button
            $('#listing_add_image_gallery').click(function(e){

                // Prevents the default action from occuring.
                e.preventDefault();

                // If the frame already exists, re-open it.
                if ( meta_image_frame ) {
                    meta_image_frame.open();
                    return;
                }

                // Sets up the media library frame
                meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                    title: 'Choose image(s)',
                    multiple: 'add',
                    button: { text:  'Choose image(s)' },
                    library: { type: 'image' }
                });

                // Runs when an image is selected. You need to insert ID of input field
                meta_image_frame.on('select', function(){
                    var selection = meta_image_frame.state().get('selection');
                    var size = 'thumbnail'
                    selection.map(function(attachment) {
                        attachment = attachment.toJSON();
                        // console.log(attachment);
                        // console.log(attachment.sizes[size]);
                        var img_ids = $("#listing_gallery").val().split(', ');
                        var img_exist = false;
                        $.each( img_ids, function( key, value ) {
                            if(value == attachment.id){
                                img_exist = true;
                                // console.log(attachment.id +" = "+value);
                            }
                        });
                        // var img_exist = $("#listing_media_lists li img").find('[data-id='+attachment.id+']');
                        // console.log(img_exist);
                        if(!img_exist){
                            $("#listing_media_lists").html($("#listing_media_lists").html() +"<li><a href=" +attachment.url+ " target=_blank><img data-id="+attachment.id+" src=" +attachment.url+ " /></a></li>");
                            if($("#listing_gallery").val()){
                                $("#listing_gallery").val( $("#listing_gallery").val()+", "+attachment.id);
                            }else{
                                $("#listing_gallery").val(attachment.id);
                            }
                        }
                        
                    });
                    
                });

                // Opens the media library frame.
                meta_image_frame.open();
            });

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
                        // console.log(response);
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