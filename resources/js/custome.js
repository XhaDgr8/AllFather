$(document).ready(function (){

    $('.hovered').hover(function (){
        $(this).toggleClass('pl-4');
    })

    $('.hovered').click(function (){
        $('.hovered').removeClass('btn-outline-primary shadow-sm-primary');
        $(this).addClass('btn-outline-primary shadow-sm-primary');
    })

    function toggleSideBar() {
        if ( $('#toggle-sidebar').hasClass('open') ) {
            sidebar(1);
            $('#toggle-sidebar').removeClass('open');
            $('#toggle-sidebar').addClass('closed');
        } else if ( $('#toggle-sidebar').hasClass('closed') ) {
            sidebar(0);
            $('#toggle-sidebar').removeClass('closed');
            $('#toggle-sidebar').addClass('open');
        }
    }

    // Toggle Side bar
    $('#toggle-sidebar').click(()=>{
        toggleSideBar()
    })

    // Toggle Side bar on
    $(window).resize(()=>{
        if ($(window).width() <= '786') {
            sidebar(1);
            $('#toggle-sidebar').removeClass('open');
            $('#toggle-sidebar').addClass('closed');
        } else {
            sidebar(0);
            $('#toggle-sidebar').removeClass('closed');
            $('#toggle-sidebar').addClass('open');
        }
    });

    if ($(window).width() <= '786') {
        sidebar(1);
        $('#toggle-sidebar').removeClass('open');
        $('#toggle-sidebar').addClass('closed');
    } else {
        sidebar(0);
        $('#toggle-sidebar').removeClass('closed');
        $('#toggle-sidebar').addClass('open');
    }

    $("#sidebar").mouseover(()=>{
        if ( $('#toggle-sidebar').hasClass('closed') ) {
            sidebar(0);
        }
    })

    $("#sidebar").mouseleave(()=>{
        if ( $('#toggle-sidebar').hasClass('closed') ) {
            sidebar(1);
            $('.collapse').removeClass('show');
        }
    })


    function sidebar(status) {
        let sidebar = 1;
        if (sidebar == status) {
            $(".logo-text").removeClass('d-md-block');
            $("#sidebar").css('width', '4.5rem');
            $('#content').css('min-width', 'calc(100% - 4.5rem)');
            $('.sp-lg').css('display','none');
        } else {
            $(".logo-text").addClass('d-md-block');
            $("#sidebar").css('width', '15rem');
            $('#content').css('min-width', 'calc(100% - 15rem)');
            $('.sp-lg').css('display','inline');
        }
    }

    // Add slideDown animation to Bootstrap dropdown when expanding.
    $('.dropdown').on('show.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    });

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $('.dropdown').on('hide.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    });

    $('.hover-delete').hover(function (){
        $(this).toggleClass("my-1 btn-primary shadow-sm bg-danger my-2 shadow-md");
    });

    $('.hover-up').hover(function (){
        $(this).toggleClass("my-2 shadow-md my-4 shadow-lg");
    });

})
