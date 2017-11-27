<footer class="footer-foo" role="contentinfo">
	<ul class="footer-copyright">
		<li class="footer-item"><?php echo olegs_copyright(); ?> <?php echo get_option('footercontent1'); ?></li>
		<li class="footer-item"><?php echo get_option('footercontent2'); ?></li>
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

<script src="https://olegs.be/webperf/boomerang.custom.min.js" type="text/javascript"></script>

<script>
	performance.mark('start')
</script>

<script>
	window.onload = function() {    
        // Google Fonts
		WebFontConfig = {
        	google: {families: ['Lato:400,400italic,300,700:latin']},
        	timeout: 10000,
        	active: function() {
	        	performance.mark('fonts:active');
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
    
    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>
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
	<?php endif; ?>
	
	// Boomerang
    BOOMR.init({
	    beacon_url: "https://olegs.be/webperf/beacon.gif"
	});
	
	//Register a service worker
	if ('serviceWorker' in navigator) {
		window.addEventListener('load', function() {
			navigator.serviceWorker.register('<?php bloginfo('template_directory'); ?>/build/sw.js').then(function(registration) {
				// Registration was successful
				console.log('ServiceWorker registration successful with scope: ', registration.scope);
				}, function(err) {
					// registration failed :(
					console.log('ServiceWorker registration failed: ', err);
				});
			});
		}
</script>

<script>
	performance.mark('end')
</script>

</body> 
</html>