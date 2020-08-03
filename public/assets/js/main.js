
$(document).ready((evt) => {
    console.log('main');
    // MediaQuery
    $(window).resize(function () {
        if ($(window).width() < 992) {
            console.log('main: $(window).width()', $(window).width());
            $('#nav-div').removeClass('container');
        }
    });

    
});