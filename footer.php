<?php
/**
 * @package WordPress
 * @subpackage Megumi
**/
?></div><!-- #main -->
	<footer id="site-footer" role="contentinfo">
		<?php get_template_part( 'widgets', 'footer' ); ?>
		<?php megumi_footer(); ?>
	</footer><!-- #site-footer -->
</div><!-- #wrapper -->
<?php wp_footer(); ?>
<pre>
<?php var_dump(megumi_widget_id()); ?>
</pre>
</body>
</html>
