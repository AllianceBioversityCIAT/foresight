jQuery( 'body' ).ready( function ( $ ) {

  if ( $( '#foresight-form-contact' ).length === 1 ) {
    var form = document.getElementById( 'foresight-form-contact' );

    if ( form ) {
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            } /*else {
              var idForm = $( '#driven-form-contact' );
              event.preventDefault();
              event.stopPropagation();
              $( '#contact_form_load' ).show();

              setTimeout( function () {
                grecaptcha.ready( function () {
                  grecaptcha.execute( googleRecaptcha.siteKey, { action: 'driven_contact_submit' } ).then( function ( token ) {
                    idForm.append( '<input type="hidden" name="token" value="' + token + '">' );
                    idForm.append( '<input type="hidden" name="action" value="driven_contact_submit">' );
                    idForm.submit();
                  } );
                } );
              }, 300 );
            }*/
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    }

    setTimeout(function() {
      $('#alert-success').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
  }

} ); // End jQuery
