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
                // console.log(wp);
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
            $(document).on('click', '#listing_add_gallery_image', function(e) {
                // console.log("listing_add_gallery_image");
                open_media_uploader_image_plus();
            });
            $(document).on('click', '.gallery_wrapper .gallery_area .button.remove', function(e) {
                console.log("remove_img");
                remove_img($this);
            });
            $(document).on('click', '.gallery_wrapper .gallery_img_img', function(e) {
                console.log("open_media_uploader_image_this");
                open_media_uploader_image_this($this);
            });
            

            

            // Availability Calendar
            availability_calendar();
        });
        
        // Availability Calendar Metabox
        function availability_calendar(){
            const currentDate = document.querySelector(".current-date");
            daysTag = document.querySelector(".days");

            // getting new date, current year and month
            let date = new Date(),
            currentYear = date.getFullYear(),
            currentMonth = date.getMonth();

            console.log(date, currentYear, currentMonth);
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            const renderCalendar = () => {
                let lastDateofMonth = new Date(currentYear, currentMonth + 1, 0).getDate(); //getting last date of month
                let liTag = "";
                for(let i = 1; i <= lastDateofMonth; i++){
                    liTag += `<li>${i}</li>`;
                }
                currentDate.innerText = `${months[currentMonth]} ${currentYear}`;
                daysTag.innerHTML = liTag; 
            }
            renderCalendar();
        }
    });
    // Availability Calendar Metabox End

    // Listing Gallery Field
    function remove_img(value) {
        var parent=jQuery(value).parent().parent();
        parent.remove();
    }
    var media_uploader = null;
    function open_media_uploader_image(obj){
        media_uploader = wp.media({
            frame:    "post", 
            state:    "insert", 
            multiple: false
        });
        media_uploader.on("insert", function(){
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
            console.log(image_url);
            jQuery(obj).append(html);
            jQuery(obj).find('.meta_image_url').val(image_url);
        });
        media_uploader.open();
    }
    function open_media_uploader_image_this(obj){
        media_uploader = wp.media({
            frame:    "post", 
            state:    "insert", 
            multiple: false
        });
        media_uploader.on("insert", function(){
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            console.log(image_url);
            jQuery(obj).attr('src',image_url);
            jQuery(obj).siblings('.meta_image_url').val(image_url);
        });
        media_uploader.open();
    }

    function open_media_uploader_image_plus(){
        media_uploader = wp.media({
            frame:    "post", 
            state:    "insert", 
            multiple: true 
        });
        media_uploader.on("insert", function(){

            var length = media_uploader.state().get("selection").length;
            var images = media_uploader.state().get("selection").models

            for(var i = 0; i < length; i++){
                var image_url = images[i].changed.url;
                var box = jQuery('#master_box').html();
                jQuery(box).appendTo('#img_box_container');
                var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
                var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55"/>';
                element.append(html);
                element.find('.meta_image_url').val(image_url);
                console.log(image_url);		
            }
        });
        media_uploader.open();
    }
    // Listing Gallery Field End
}(jQuery, this, document);