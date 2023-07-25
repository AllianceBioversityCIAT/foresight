/**
 * Validate Email Format
 * @param  {String} string  example@host.com
 * @return {Boolead}        true/false
 */
window.validEmail = function(string){
  let str = string.trim();
  if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(str)) {
    return true;
  }
  return false;
};

/**
 * Validate an input is not empty
 * @param  {String} string input value
 * @return {Boolean}        true/false
 */
window.validInput = function(string, number) {
  let str = string.replace( /\s+/g, '' );

  return ((str).trim().length >= number);
};

window.validPhone = function(string) {
  let str = string.replace( /\s+/g, '' );

  if ( str !== '' ) {
    return (/[0-9\-\(\)\s]+/.test(str) && (str).trim().length >= 10);
  } else {
    return true;
  }
};

window.isNullOrBlank = function(string) {
  let str = string.replace( /\s+/g, '' );

  if ( str !== '' ) {
    return ( (str).trim().length >= 10  );
  } else {
    return true;
  }

};
