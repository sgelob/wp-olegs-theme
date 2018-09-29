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

<script>
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
