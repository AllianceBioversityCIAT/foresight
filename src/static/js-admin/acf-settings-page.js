jQuery( document ).ready(function($) {

    /**
     * Import control lists from Clarisa  
    **/    
	  $( "#acf-field_import_list" ).on( "click", function() {

        $( "#spinner_acf-field_import_list" ).addClass( "is-active" );
        $( "#acf-field_import_list" ).addClass( "disabled" ).val("Processing...").off( "click" );

		$.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=" + ajax_var.action_import_clarisa + "&nonce=" + ajax_var.nonce,
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


     /**
      * Import items from Zotero
     **/
      $( "#acf-field_import_zotero" ).on( "click", function() {

        $( "#spinner_acf-field_import_zotero" ).addClass( "is-active" );
        $( "#acf-field_import_zotero" ).addClass( "disabled" ).val("Processing...").off( "click" );

		$.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=" + ajax_var.action_import_zotero + "&nonce=" + ajax_var.nonce,
            success: function(result){
                $( "#acf-field_import_zotero" ).val("Ready!");
                location.reload();
            },
            error: function (xhr) {
                var json_error = JSON.parse(xhr.responseText);
                if(json_error.success == false){
                    $( "#acf-field_import_zotero" ).val("Import failed!");
                    $( "#spinner_acf-field_import_zotero" ).removeClass( "is-active" );
                    alert(json_error.data[0].code + ": " + json_error.data[0].message);
                }
              }
        });
	  }); 

});