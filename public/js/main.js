/**
 * Created by User on 25/09/2016.
 */

//TEST JQUERY
/*window.onload = function() {
    if (window.jQuery) {
        // jQuery is loaded
        alert("Yeah!");
    }
};*/

$(function () {
 
    dynamicActiveClass();
    googleAnalyrics();
    serviceFadeIn();
    flashMessageClose();
    
    // DYNAMICALLY ADD ACTIVE CLASS TO MENU ITEM
    function dynamicActiveClass() {
        var pathNameOfCurrentPage = window.location.pathname;
        $('a[href="' + pathNameOfCurrentPage + '"]').parent().addClass('active');
    }

    //GOOGLE ANALYTICS
    function googleAnalyrics() {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        
        ga('create', 'UA-84805393-1', 'auto');
        ga('send', 'pageview');
    }
	
	//SERVICE PAGE FADES IN THE SERVICES
	function serviceFadeIn() {
		$(window).on('scroll',function () {
			var wScroll = $(window).scrollTop();;
			//console.log(wScroll);
			var divOffset = $('div #serviceOffset').offset().top;
			if (wScroll > divOffset - ($(window).height() / 1.2)){
				var increment = 3000
				$('#serviceOffset #service').each(function (i) {
					setTimeout(function () {
						$('#serviceOffset #service').eq(i).removeClass(".hideService");
						$('#serviceOffset #service').eq(i).fadeIn(increment);
						increment = increment + 1500;
					})
				})
			}
		});
	}
	
	//FUNCTION TO CLOSE THE FLASH MESSAGE BOX
	function flashMessageClose() {
		$('#flashClose').on('click', function () {
			$('#flashClose').parent().fadeOut( "slow" );
		})
	}

});

