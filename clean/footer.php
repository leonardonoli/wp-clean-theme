<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package clean
 */
global $clicky_id, $quantcast_id, $quantcast_include, $clicky_include;
?>
	</div><!-- #content -->
	<footer class="site-footer" role="contentinfo">
		<div class="site-info">
			Copyright © <?= date("Y"); ?> <?= $_SERVER['SERVER_NAME']; ?>. All rights reserved.
			<div class="footer-menu">
				<?php wp_nav_menu( array('menu' => 'disclaimers' ) ); ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php 
if ($clicky_include==true)
{
?>
<!-- Clicky tracking not shown because you're an administrator and you've configured Clicky to ignore administrators. -->
<script type="text/javascript">
var clicky_site_ids = clicky_site_ids || [];
clicky_site_ids.push(<?= $clicky_id; ?>);
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/<?= $clicky_id; ?>ns.gif" /></p></noscript>
<?php
}
?>
<?php 
if ($quantcast_include==true)
{
?>
<!-- Quantcast Tag -->
<script type="text/javascript">
	var _qevents = _qevents || [];
	(function() {
		var elem = document.createElement('script');
		elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
		elem.async = true;
		elem.type = "text/javascript";
		var scpt = document.getElementsByTagName('script')[0];
		scpt.parentNode.insertBefore(elem, scpt);
	})();
	_qevents.push({
		qacct:"p-<?= $quantcast_id; ?>"
	});
</script>

<noscript>
	<div style="display:none;">
	<img src="//pixel.quantserve.com/pixel/p-<?= $quantcast_id; ?>.gif" border="0" height="1" width="1" alt="Quantcast"/>
	</div>
</noscript>
<!-- End Quantcast tag -->
<?php
}
?>
<?php wp_footer(); ?>
<?php
// Function declared in widgets/init
?>
<script type="text/javascript">
    jQuery(".menu-toggle").on('click',function(){
       jQuery('#primary-menu').toggle();
    });
</script>
<script>document.write(load_widget('mobile-before-closing-body','desktop-before-closing-body'));</script>
</body>
</html>
