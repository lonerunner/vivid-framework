jQuery(document).ready(function($) {

    // Tabs
    $( '#tabs' ).tabs();

    // Tooltip
    $( '.tooltip' ).tooltip();

    // Select 2 plugin for select boxes
    $( '.select2' ).select2();

    // Formstone dropdown for multiselect boxes, using class selecter because formerly dropdown was called selecter
    $( '.selecter' ).dropdown();

    // Turn checkbox in toggle buttons
    $( '.togglebox' ).checkbox({
        toggle: true
    });

    // WordPress built in color picker
    $( '.color-picker' ).wpColorPicker();

    // WordPress built in jquery date picker
    $( '.date-picker' ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });

    // Repeatable fields
    $('.vf-repeatable-fields').each(function() {
        $(this).repeatable_fields();
    });

    // Upload button add
    $( '.vf-add-media' ).click(function(e) {

        e.preventDefault();

        var sel = $(this).parent(); // .vf-upload

        var uploader = wp.media({
            title: 'Add an image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

          uploader.on('select', function(){

            var attachment = uploader.state().get('selection').first().toJSON();

              $('input', sel).val(attachment.url);

              $(sel).find('.vf-img-holder').append( '<img src="'+attachment.url+'" alt="" style="width:100%"/>' );

              $(sel).find('.vf-add-media').addClass( 'hidden' );

              $(sel).find('.vf-del-media').removeClass( 'hidden' );
        });

           uploader.open();

    });
    // Upload button remove
    $( '.vf-del-media' ).click(function(e) {

        e.preventDefault();

        var sel = $(this).parent(); // .vf-upload


        $('input', sel).val('');

        $(sel).find('.vf-img-holder').html('');

        $(sel).find('.vf-add-media').removeClass( 'hidden' );

        $(sel).find('.vf-del-media').addClass( 'hidden' );

    });


});