var linkPrintCss = $("<link rel='stylesheet' href='printContacts.css' type='text/css' media='print' />");

function setCookie(name, value, days) { 
	if (days) { 
	var date = new Date(); 
	date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
	var expires = "; expires=" + date.toGMTString(); 
	} 
	else var expires = ""; 
	document.cookie = name + "=" + value + expires + "; path=/"; 
	document.location.href = document.location.href;
} 
function eraseCookie(name) { 
	setCookie(name, "", -1); 
	document.location.href = document.location.href;
}; 

$(document).ready(function(){

    $('#mainMenu ul li:last-child a.parentLink').addClass('contactLink');

    $('a.moreList').click( function(e) {
	e.preventDefault();
	var $mpgd = $('#morepgd').val();	
	e.preventDefault();	
        $.ajax({
                url: "/wp-admin/admin-ajax.php",
		type:'POST',
		data: "action=more_post&pgd="+$mpgd,
		success: function(data){
			$('#postList .item:last-child').after(data);
			$('#morepgd').val(String(Number($mpgd)+1)); 
		}
        });
    });
    
    $('#order_post select.customSelect').change(function () {	
		setCookie("posts_per_page",$("#order_post select.customSelect option:selected").val(),10);
		$('#order_post').submit();
    }) 

    $('#order_year select.customSelect').change(function () {	
		setCookie("order_year",$("#order_year select.customSelect option:selected").val(),10);
		$('#order_year').submit();
    })    

    $('#order_month select.customSelect').change(function () {	
		setCookie("order_month",$("#order_month select.customSelect option:selected").val(),10);
		$('#order_month').submit();
    })
    
    $('#order_cat select.customSelect').change(function () {	
		setCookie("order_cat",$("#order_cat select.customSelect option:selected").val(),10);
		$('#order_cat').submit();
    })    
    
    $('.bookList tr').click(function(){
		$(this).toggleClass('selected');
        return false;
    })	
    $('#wpcf7-f164-o1 .btn').click(function(){
		var el = $('.bookList tr');
		var sum = 0;
		var zakaz = "";
		var kol =""; 
		el.each(function() {		
			kol=$( this ).find('input').val();
		
			if(Math.floor(kol) == kol && $.isNumeric(kol)) {
				zakaz=zakaz+ kol+"*"+$( this ).find('b').html()+ " "+$( this ).find('.cena').html()+ ", ";			
				sum=sum+parseFloat(($( this ).find('.cena').html()).replace(",", ".").replace(" ", "").replace(".-", "").replace("&euro;", "").slice(1))*kol;			
			}
		});
		$('#wpcf7-f164-o1 input[name=data1]').val(sum);
		$('#wpcf7-f164-o1  input[name=data2]').val(zakaz);			
    })	
/*
    $('#wpcf7-f887-p91-o1 .btn').click(function(){
		var el = $('.additionalInfo .RowDonat');
		var sum = 0;
		var zakaz = "";
		var kol =""; 
		el.each(function() {				
			 if($( this ).find("input[type=checkbox]").prop("checked")){				
				zakaz=zakaz+$( this ).find('span.wpcf7-list-item-label').html()+ " "+$( this ).find('.price').html()+ ", ";			
				
				sum=sum+parseFloat(($( this ).find('.price').html()).replace(" ", "").replace(",-", "").replace("&euro;", "").slice(1));
				
			}
		});
		$('#wpcf7-f887-p91-o1 input[name=data1]').val(sum);
		$('#wpcf7-f887-p91-o1  input[name=data2]').val(zakaz);
    })	    
 */   
    

    $('#mainMenu .hasChild .parentLink').click(function(){
        $(this).toggleClass('active').siblings().toggleClass('vis');
       /* return false; */
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
    $('.customSelect input, .customCheckbox input').styler();

    //popup window
    $(".contactLink").fancybox({
        padding : 30,
        autoCenter:true,
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
        autoCenter:true
    })

})

//print page "Contacts" from popup
function printContact() {
    $("head").append(linkPrintCss);
    window.print();
    return false;
}
