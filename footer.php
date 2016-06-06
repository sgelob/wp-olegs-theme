<footer class="footer-foo" role="contentinfo">
	<ul class="footer-copyright">
		<li><?php echo olegs_copyright(); ?> <?php echo get_option('footercontent1'); ?></li>
		<li><?php echo get_option('footercontent2'); ?></li>
	</ul>
	<?php wp_nav_menu( array( 
		'theme_location' => 'footer-social',
		'container' => false,
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<ul class="footer-social">%3$s</ul>',
		'echo' => true,
		) );
	?>
</footer>
<?php wp_footer(); ?>
<script>
	window.onload = function() {    
        // Google Fonts
		WebFontConfig = {
        	google: {
            	families: ['Lato:400,400italic,300,700:latin']
        	}
    	};
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
	};
	
	/* Fix iOS 7 bug for -unit support */
	var iOS = navigator.userAgent.match(/(iPod|iPhone|iPad)/);
	if(iOS) {
		function iosVhHeightBug() {
			var height = $(window).height();
			$(".gallery-cover").css('height', height);
		}
		
		iosVhHeightBug();
		$(window).bind('resize', iosVhHeightBug);
	}
	
	<?php if ( is_single() ) { ?>
	// FitVids.js
	$(document).ready(function(){
    	$("article").fitVids();
    }
    <?php } ?>

    // Google Analytics
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-3011787-7', 'auto');
    ga('send', 'pageview');
</script>
</body> 
</html>