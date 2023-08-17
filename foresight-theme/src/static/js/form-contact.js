jQuery( 'body' ).ready( function ( $ ) {

  if ( $( '#foresight-form-contact' ).length === 1 ) {
    var form = document.getElementById( 'foresight-form-contact' );

    if ( form ) {
      window.addEventListener( 'load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName( 'needs-validation' );

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call( forms, function ( form ) {
          var fullNameField    = $( 'input[name="full_name"]' );
          var emailField       = $( 'input[name="email"]' );
          var cellPhoneField   = $( 'input[name="cell_phone"]' );
          var descriptionField = $( 'textarea[name="description"]' );

          form.addEventListener( 'submit', function ( event ) {
            var validateDescription = isNullOrBlank( descriptionField.val() );
            var validateFullName    = validInput( fullNameField.val(), 3 );
            var validateEmail       = validEmail( emailField.val() );
            var validateCellPhone   = validPhone( cellPhoneField.val() );

            if ( form.checkValidity() === false || validateFullName === false || validateEmail === false ||
              validateDescription === false || validateCellPhone === false ) {

              if ( validateFullName === false ) {
                $( '#alert-error-full-name' ).show();

              } else {
                $( '#alert-error-full-name' ).hide();
              }

              if ( validateEmail === false ) {
                $( '#alert-error-email' ).show();

              } else {
                $( '#alert-error-email' ).hide();
              }

              if ( validateDescription === false ) {
                $( '#alert-error-description' ).show();

              } else {
                $( '#alert-error-description' ).hide();
              }

              if ( validateCellPhone === false ) {
                $( '#alert-error-phone' ).show();

              } else {
                $( '#alert-error-phone' ).hide();
              }

              event.preventDefault();
              event.stopPropagation();

            } else {
              var idForm = $( '#foresight-form-contact' );
              form.classList.add( 'was-validated' );
              $( '#alert-error-description' ).hide();
              $( '#alert-error-full-name' ).hide();
              $( '#alert-error-email' ).hide();
              $( '#alert-error-phone' ).hide();

              event.preventDefault();
              event.stopPropagation();
              $( '#contact_form_load' ).show();

              setTimeout( function () {
                grecaptcha.ready( function () {
                  var btnSend = $( '#contact_btn_submit' );
                  grecaptcha.execute( googleRecaptcha.siteKey, { action: 'foresight_contact_submit' } ).then( function ( token ) {
                    idForm.append( '<input type="hidden" name="token" value="' + token + '">' );
                    idForm.append( '<input type="hidden" name="action" value="foresight_contact_submit">' );
                    btnSend.html('<i class="fa-solid fa-circle-notch fa-spin"></i> Sending...').prop('disabled',true);
                    idForm.submit();
                  } );
                } );
              }, 300 );
            }
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
