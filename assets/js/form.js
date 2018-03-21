$(document).ready(function() {

    //Select date of birth
	$('#birthday-picker').datepicker({

		format: "yyyy-mm-dd",
		todayHighlight: true,
		title: "Please select your birthday.",
		endDate: new Date().getFullYear() - 6 + "-12-31",
        autoclose: true //Auto-hide date after selected
	});


    //Adding age from birthday selector dynamically
	$("#birthday-picker").on('change', function() {
        var today = new Date();
        var dob = new Date($("#birthday-picker").val());
        var age = new Date(today - dob).getFullYear() - 1970;

        $("#age").val(age + ' years old');

        // console.log('today: ' + today);
        // console.log('dob: ' + dob);
        // console.log('age: ' + age);
        
    });


    // To Disable Submit Button By Default
    $('#button-submit').attr('disabled','disabled');

        // When User Fills Out Form Completely
        $("form").keyup(function() {

            $('#button-submit').removeAttr('disabled');
        });


    //Adding friends in another input
    $('#form-input-list').on('click', '.add-friend', function (e) {
        e.preventDefault();
        var friendInputContainer = $('#form-input-list');
        var friendInput = [
            '<div class="col-md-12 multiplied-friend-input form-group">',
                '<label>Friend</label>',
                '<div class="row">',
                    '<div class="col-md-10">',
                        '<div class="control-group">',
                            '<input type="text" class="form-control" maxlength="50" name="friends[]" placeholder="Enter your friends name...">',
                        '</div>',
                    '</div>',
                    '<div class="col-md-1 plus-button-container">',
                        '<button class="btn btn-xs btn-success add-friend">',
                            '<span class="glyphicon glyphicon-plus"></span>',
                        '</button>',
                    '</div>',
                    '<div class="col-md-1 pull-right">',
                        '<button class="btn btn-xs btn-danger remove-friend">',
                            '<span class="glyphicon glyphicon-minus"></span>',
                        '</button>',
                    '</div>',
                '</div>',
                '<!-- /.row -->',
            '</div>'
        ];
        friendInput = friendInput.join('');

        var plus_button = [
            '<div class="col-md-1">',
                '<button class="btn btn-xs btn-success add-friend">',
                    '<span class="glyphicon glyphicon-plus"></span>',
                '</button>',
            '</div>'
        ];
        plus_button = plus_button.join('');

        $(friendInputContainer).append(friendInput);
        $(this).parent().remove();
        // console.log($(this).parent().attr('class'));
    });


    //Removeing friends from form container
    $('#form-input-list').on('click', '.remove-friend', function (e) {
        e.preventDefault();
        $(this).parents().eq(2).remove();

        // console.log($(this).parents().eq(2));
    });


    //fill the selectable dynamically with all the country names coming from a json object
    $.getJSON('http://localhost/farki-3rd-project-advanced-form/assets/js/countries.json', function(country_data) {

        //get the selectable element from the DOM
        var country_select = $('#country-selector');
        var selected_country = $('#country-selector').attr('value');
        var this_is_selected = '';

        //parse the json object's elements one by one and use the actual data
        $(country_data).each(function(index, single_country_data) {

            if (single_country_data.name == selected_country) {
                this_is_selected = 'selected';
            } else {
                this_is_selected = '';
            }
            // console.log('ez a country codeja: ' + single_country_data.code + ' - Ennek az orszagnak: ' + single_country_data.name);

            //append the object's current element to the country_select dom element as an option value and name
            //the option's value must be the country code and the option's displayed name should be the country's actual name
            
            $(country_select).append('<option value="'+ single_country_data.name +'" '+ this_is_selected + '>'+ single_country_data.name +'</option>');

        });

    });


    //create the json object from the form data
     $('#my-submission-form').submit(function (e) {

        e.preventDefault();

        var form_data = $(this).serializeForm();
        delete form_data.submit;
        var form_data_json = JSON.stringify(form_data);

        // console.log(typeof(form_data));
        // console.log(JSON.stringify(form_data));


        //send the data to the server using ajax + modal 
        $.ajax({
            
            method: "POST",
            url: "classes/post.php",
            data: {
                'farki-form': form_data_json
            }

        }).done(function(ajax_response) {
            var response = JSON.parse(ajax_response);
            console.log(response);

            if (response.status == "success") {
                //set the modal title to "submission succes"
                $('#myModalLabel').empty().text('Success!').addClass('submission-success');

                //set the modal content to "Thank you for submitting. Your data has been successfully saved"
                $('#submit-reponse-modal-content').empty().text(response.message);

                //show the modal with the new content
                $('#submit-response-modal').modal('show');

                console.log(JSON.parse(response.form_data))

            } else if (response.status == "error") {
                //set the modal title to "submission error"
                $('#myModalLabel').empty().text(response.message).addClass('submission-error');

                //set the modal content to "There was an error receiveing your data. Please try resubmitting the form again !"
                $('#submit-reponse-modal-content').empty().text(response.message);

                //show the modal with the new content
                $('#submit-response-modal').modal('show');

                console.log("Error detected")
            }
        });
    });


    //Picture Slideshow
    var slideDuration = parseFloat($('.slide-duration input[type=radio]:checked').val()) * 1000; //get the value from the selected radio button multiply by 1000
    // console.log('Default slide duration: ' + slideDuration);
    
    $('.slider-images img:gt(0)').hide();

    function slideChanger_fade() {
        $('.slider-images :first-child').fadeOut(1000).next('img').fadeIn(1000).end().appendTo('.slider-images');
        // console.log(slideDuration);
    }

    var timer = setInterval(slideChanger_fade, slideDuration);

    $('#panel').on('click', '.slide-duration input', function() {
        slideDuration = parseFloat($(this).val()) * 1000; //get the value from the selected radio button multiply by 1000
        // console.log(slideDuration);
        // console.log(typeof(slideDuration));

        clearInterval(timer);
        timer = setInterval(slideChanger_fade, slideDuration);
    });


    //Previous and Next chevron 
    $('#nav-arrow-right').click(function () { 
        $('.slider-images img:first').fadeOut(500).next().fadeIn(500).end().appendTo('.slider-images');
    });
    $('#nav-arrow-left').click(function() {
        $('.slider-images img:first').fadeOut(500);
        $('.slider-images img:last').prependTo('.slider-images');
        $('.slider-images img:first').fadeIn(500);
    });


    //Get the value from the slide change button type selector
    $('#panel').on('change', '#slide-change-button-type-selector', function () {
        var button_type = $(this, 'option:selected').val();
        // console.log(button_type);
        
        switch (button_type) {
            case "chevron":
                //replace the current slide changing glyph icons with chevron icons
                $('#nav-arrow-left').empty().append('<span class="glyphicon glyphicon-chevron-left"></span>');
                $('#nav-arrow-right').empty().append('<span class="glyphicon glyphicon-chevron-right"></span>');
                break;

            case "arrow":
                //replace the current slide changing glyph icons with arrow icons
                $('#nav-arrow-left').empty().append('<span class="glyphicon glyphicon-arrow-left"></span>');
                $('#nav-arrow-right').empty().append('<span class="glyphicon glyphicon-arrow-right"></span>');
                break;

            case "triangle":
                //replace the current slide changing glyph icons with arrow icons
                $('#nav-arrow-left').empty().append('<span class="glyphicon glyphicon-triangle-left"></span>');
                $('#nav-arrow-right').empty().append('<span class="glyphicon glyphicon-triangle-right"></span>');
                break;
        }
    });


    //Drop-down menu
    $("#flip").click(function () {
        $("#panel").slideToggle();
    }); 


    //Show slide changing buttons
    $(".show-type").click(function () {
        $(".nav-buttons").toggle();
    });


    //Deleting table-row from database
    $('table#edittable').on('click', '.btn-delete', function (e) {
        //delete action here
        e.preventDefault();
        var id_to_delete = $(this).data('id');
        var row_to_delete = $(this).parent().parent();

        //show modal on delete
        $('#delete-form-data-modal').modal('show');

        //deleting table row on modal confirmation
        $('#delete-form-modal-delete-button').on('click', function (){
            $.ajax({
                method: "POST",
                url: "classes/post.php",
                data: {
                    'farki-table': {
                        action: 'delete',
                        id: id_to_delete
                    }
                }
            }).done(function(ajax_response) {
                //this if deletes the entire table-row from the database
                if(ajax_response == 'deleted') {
                    $(row_to_delete).remove();
                    //hide modal on delete
                    $('#delete-form-data-modal').modal('hide');
                }
            });   
        });

        //Hiding the modal when cancel button is clicked
        $('#delete-modal-cancel-button').on('click', function () {
            //hide modal on cancel
            $('#delete-form-data-modal').modal('hide');
        });
    });

    //create the json object from the form data when submiting the edit-table.php
    $('#my-edit-form').submit(function (e) {

        // e.stopPropagation();
        e.preventDefault();


        var form_data = $(this).serializeForm();
        delete form_data.update;
        form_data.id = $('#button-update').data('form-id');
        var form_data_json = JSON.stringify(form_data);

        // console.log(typeof(form_data));
        // console.log(JSON.stringify(form_data));

        // console.log(form_data_json);

        // console.log("edit form submitted");
        // console.log(form_data_json);

        //send the data to the server using ajax + modal 
        $.ajax({
            method: "POST",
            url: "classes/post.php",
            data: {
                'edit-farki-form': form_data_json
            }
        }).done(function(ajax_response) {
            var response = JSON.parse(ajax_response);
            console.log(response);

            if (response.status == 'success') {
                //trigger success alert notification
                $('#edit-form-submission-notification').addClass('alert-success').text(response.message);
                $('#edit-form-submission-notification').alert();
            } else {
                //trigger error alert notification
                $('#edit-form-submission-notification').addClass('alert-danger').text(response.message);
                $('#edit-form-submission-notification').alert();
            }
        });
    });
});