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
            

        
            // Date Picker
            daterange_picker();
        });
        
    });
    // Function for Daterange Picker
    function daterange_picker(){
        if($('#arrive_date_picker, #depart_date_picker').length){
            // check if element is available to bind ITS ONLY ON HOMEPAGE
            var currentDate = moment().format("DD-MM-YYYY");
        
            $('#arrive_date_picker, #depart_date_picker').daterangepicker({
                locale: {
                      format: 'DD-MM-YYYY',
                      daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri','Sat'],
                      firstDay: 1,
                      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                      firstDay: 7
                },
                firstDayOfWeek: 1,
                "alwaysShowCalendars": true,
                "minDate": currentDate,
                autoApply: true,
                autoUpdateInput: false,
            //    ranges: {
            //        'Today': [moment(), moment()],
            //        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            //        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            //        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            //        'This Month': [moment().startOf('month'), moment().endOf('month')],
            //        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            //     }
              
            }, function(start, end, label) {
              // console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
              // Lets update the fields manually this event fires on selection of range
              var selectedStartDate = start.format('DD-MM-YYYY'); // selected start
              var selectedEndDate = end.format('DD-MM-YYYY'); // selected end
              
              $checkinInput = $('#arrive_date_picker');
              $checkoutInput = $('#depart_date_picker');
        
              // Updating Fields with selected dates
              $checkinInput.val(selectedStartDate);
              $checkoutInput.val(selectedEndDate);
        
              // Setting the Selection of dates on calender on CHECKOUT FIELD (To get this it must be binded by Ids not Calss)
              var checkOutPicker = $checkoutInput.data('daterangepicker');
              checkOutPicker.setStartDate(selectedStartDate);
              checkOutPicker.setEndDate(selectedEndDate);

              // Setting the Selection of dates on calender on CHECKIN FIELD (To get this it must be binded by Ids not Calss)
              var checkInPicker = $checkinInput.data('daterangepicker');
              checkInPicker.setStartDate(selectedStartDate);
              checkInPicker.setEndDate(selectedEndDate);

              
              

                var not_available_dates = $('#listing-availability #not_available_dates').val();
                var merge_dates_array = getRangeOfDates(selectedStartDate, selectedEndDate); 
                // console.log(merge_dates_array);
                if(not_available_dates){
                    not_available_dates = not_available_dates.split(', ');
                    var merge_dates_array = $.merge( not_available_dates, merge_dates_array );
                }
                //remove empty value
                merge_dates_array = merge_dates_array.filter(function(v){return v!==''}); 
                merge_dates_array = removeDuplicates(merge_dates_array);
                merge_dates_array = merge_dates_array.sort();

                merge_dates_array = merge_dates_array.join(', ');

                $('#listing-availability #not_available_dates').val(merge_dates_array);
            });
        
        } // End Daterange Picker

        // Get Remove Duplicates Array
        function removeDuplicates(data){
            return	data.filter((value, index) => data.indexOf(value) === index);
        }
        // Get Remove Duplicates Array End 

        // Get Range Of Dates Array
        function getRangeOfDates(startDate, endDate) {
            // console.log(startDate+" - "+endDate);
            const getDatesDiff = (start_date, end_date, date_format = "DD-MM-YYYY") => {
                const getDateAsArray = date => {
                    return moment(date.split(/\D+/), date_format);
                };
                const diff = getDateAsArray(end_date).diff(getDateAsArray(start_date).add(1, 'day'), "days") + 1;
                // const diff = getDateAsArray(end_date).diff(getDateAsArray(start_date), "days") + 1;
                const dates = [];
                dates.push(start_date);
                dates.push(end_date);
                for (let i = 1; i < diff; i++) {
                    const nextDate = getDateAsArray(start_date).add(i, "day");
                    const isWeekEndDay = nextDate.isoWeekday() > 7;

                    if (!isWeekEndDay)
                    dates.push(nextDate.format(date_format))
                }
                return dates;
            };

            const dates_array = getDatesDiff(startDate, endDate);
            return dates_array;
            
        }
        // Get Range Of Dates Array End
    }

}(jQuery, this, document);