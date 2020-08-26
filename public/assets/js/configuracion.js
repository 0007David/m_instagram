
$(document).ready((evt) => {

    $('#select_thema').change((evt) => {
        let target = $(evt.target);
        let thema = target.val();
        console.log('Thema: ', thema);
        switch (thema) {
            case 'light':
                $("body").removeClass();
                $("body").addClass('container bg-light');
                //navbar navbar-expand-lg navbar-light fixed-top bg-light nav-border
                $("nav").removeClass();
                $("nav").addClass('navbar navbar-expand-lg fixed-top nav-border navbar-light bg-light');
                //navbar fixed-bottom nav-border bg-light
                $("footer").removeClass();
                $("footer").addClass('navbar navbar-expand-lg fixed-bottom nav-border navbar-light bg-light');
                break;
            case 'white':
                $("body").removeClass();
                $("body").addClass('container bg-white text-dark');
                //navbar navbar-expand-lg navbar-white fixed-top bg-white nav-border
                $("nav").removeClass();
                $("nav").addClass('navbar navbar-expand-lg fixed-top nav-border navbar-white bg-white text-dark');
                //navbar fixed-bottom nav-border bg-white
                $("footer").removeClass();
                $("footer").addClass('navbar navbar-expand-lg fixed-bottom nav-border navbar-white bg-white text-dark');
                break;
            case 'dark':
                $("body").removeClass();
                $("body").addClass('container bg-dark text-white');
                //navbar navbar-expand-lg navbar-dark fixed-top bg-dark nav-border
                $("nav").removeClass();
                $("nav").addClass('navbar navbar-expand-lg fixed-top nav-border navbar-dark bg-dark text-white');
                //navbar fixed-bottom nav-border bg-dark
                $("footer").removeClass();
                $("footer").addClass('navbar navbar-expand-lg fixed-bottom nav-border navbar-dark bg-dark text-white');
                break;
            default:
                //gray
                $("body").removeClass();
                $("body").addClass('container bg-secondary');
                //navbar navbar-expand-lg navbar-secondary fixed-top bg-secondary nav-border
                $("nav").removeClass();
                $("nav").addClass('navbar navbar-expand-lg fixed-top nav-border navbar-secondary bg-secondary');
                //navbar fixed-bottom nav-border bg-secondary
                $("footer").removeClass();
                $("footer").addClass('navbar navbar-expand-lg fixed-bottom nav-border navbar-secondary bg-secondary');
                break;
        }
    });
});