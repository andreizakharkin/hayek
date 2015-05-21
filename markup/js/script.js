var linkPrintCss = $("<link rel='stylesheet' href='printContacts.css' type='text/css' media='print' />");

$(document).ready(function(){

    $('#mainMenu .hasChild .parentLink').click(function(){
        $(this).toggleClass('active').siblings().toggleClass('vis');
        return false;
    })

    // button show/hide Main menu (tablet + desktop)
    $('#mainMenuTrigger').click(function(){
        $(this).toggleClass('trig');
        $('#mainMenu, .mainMenuPointer').toggleClass('visible');
        $('#searchForm').removeClass('visSearch');
        clearVisibility();
    })

    $(document).click(function(e) {
        if ($(e.target).parents().filter('.child.vis').length != 1) {
            clearVisibility();
        }
    });


    //button show/hide Search Form (mobile)
    $('.icon_search').click(function(){
        $('#searchForm').toggleClass('visSearch');
        $('#mainMenuTrigger').removeClass('trig');
        $('#mainMenu, .mainMenuPointer').removeClass('visible');
        clearVisibility();
    })

    function clearVisibility() {
        $('.child, .childMenuPointer').removeClass('vis');
        $('.parentLink').removeClass('active');
    }

    //placeholder for Input and Textarea
    var el = $('input[type=text], input[type=email], textarea');
    el.focus(function(e) {
        if (e.target.value == e.target.defaultValue)
            e.target.value = '';
    });
    el.blur(function(e) {
        if (e.target.value == '')
            e.target.value = e.target.defaultValue;
    });

    //slider on Index Page
    $('.bxslider').bxSlider({
        mode: 'fade',
        pager: false
    });

    //stylized <select></select>
    $('.customSelect, .customCheckbox').styler();

    //popup window
    $(".contactLink").fancybox({
        padding : 30,
        autoCenter:true,
        margin: 0,
        afterLoad : function(){
            $('.contactLink').addClass('current');
            $('#mainMenu, .mainMenuPointer').removeClass('visible');
            $('#mainMenuTrigger').removeClass('trig');
        },
        afterClose : function(){
            $('.contactLink').removeClass('current');
            linkPrintCss.remove();
        }
    });

    $('.downloadFiles').fancybox({
        padding : 30,
        autoCenter:true,
        margin:0
    })

})

//print page "Contacts" from popup
function printContact() {
    $("head").append(linkPrintCss);
    window.print();
    return false;
}
