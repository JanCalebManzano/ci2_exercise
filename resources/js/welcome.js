$(document).ready( () => {
    
    $(`a#toggle-login`).on( `click`, (e) => {
        e.preventDefault();
        $(`div#wrapper-signup`).hide();
        $(`div#wrapper-login`).show(`medium`);

        $(`form#frmLogin input[name=email]`).focus();
    } );

    $(`a#toggle-signup`).on( `click`, (e) => {
        e.preventDefault();
        $(`div#wrapper-login`).hide();
        $(`div#wrapper-signup`).show(`medium`);

        $(`form#frmSignup input[name=email]`).focus();
    } );

} );