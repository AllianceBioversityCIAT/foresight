jQuery( document ).ready(function($) {

	  $( "#acf-field_import_list" ).on( "click", function() {
        
		$.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=" + ajax_var.action + "&nonce=" + ajax_var.nonce,
            success: function(result){
                alert('Import completed!');
                location.reload();
            }
        });
	  });

});