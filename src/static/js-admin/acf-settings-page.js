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
            },
            error: function (xhr) {
                var json_error = JSON.parse(xhr.responseText);
                if(json_error.success == false){
                    alert(json_error.data[0].code + ": " + json_error.data[0].message);
                    $( "#acf-field_import_list" ).val("Import failed!");
                    $( "#spinner_acf-field_import_list" ).removeClass( "is-active" );
                }
              }
        });
	  });

});