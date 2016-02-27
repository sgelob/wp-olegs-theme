<?php if (comments_open()) : ?>
<div id="disqus_thread"></div>
<script>
var disqus_config = function () {
    this.page.url = '<?php the_permalink() ?>';
    this.page.identifier = '<?php $id = get_the_ID(); echo $id; ?>';
};
(function() {  // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://sgelob.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php endif; // comments_open ?>