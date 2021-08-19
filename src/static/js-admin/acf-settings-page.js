jQuery( document ).ready(function($) {

	  $( "#acf-field_import_list" ).on( "click", function() {

        $( "#spinner_acf-field_import_list" ).addClass( "is-active" );
        $( "#acf-field_import_list" ).addClass( "disabled" ).val("Processing...").off( "click" );

		$.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=" + ajax_var.action + "&nonce=" + ajax_var.nonce,
            success: function(result){
                $( "#acf-field_import_list" ).val("Ready!");
                location.reload();
            }
        });
	  });

});