<?php
/** Footer template.
 * 
 * @package Archimedes
 */
?>
			
			</div><!-- #content -->
			
			<footer id="contentinfo" role="contentinfo">
				<?php
					printf( __( '<a href="#document">%1$s</a> &bull; Powered by %2$s with %3$s', 'archimedes' ),
						ArchimedesTag::archimedes_copyright(),
						'<a href="//wordpress.org/" target="_blank">WordPress</a>',
						'<a href="//github.com/mgsisk/archimedes" target="_blank">Archimedes</a>'
					);
				?>
			</footer><!-- #contentinfo -->
			
		</div><!-- #document -->
		
		<?php wp_footer(); ?>
		
	</body>
	
</html>