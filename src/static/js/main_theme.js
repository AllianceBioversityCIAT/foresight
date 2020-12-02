( function ( $ ) {
  console.log( 'theme' );

  if ( $( 'div#wpadminbar' ).length === 1 ) {
    $( '#theme-main-menu' ).css( 'top', '32px' );
  }

  $( '#theme-masthead' ).ready( function () {
    var nav = $( '.fixed-top' );
    var homeSection = $( '.theme-header-scroll' );

    if ( homeSection.length ) {
      $( document ).scroll( function () {
        nav.toggleClass( 'scrolled', $( this ).scrollTop() > homeSection.height() );
      } );
    }
  } );
} )( jQuery );
