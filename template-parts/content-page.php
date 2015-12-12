<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Masters-Ribakoff
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php 	
			//display list of subpages with featured images as thumb
			//get the list of child pages
			$args = array('post_parent' => $post->ID, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => 'page', 'post_status' => 'publish');
			$child_pages = new WP_Query($args);
		?>
		<?php if ($child_pages->have_posts()): ?>

		<?php while($child_pages->have_posts()): $child_pages->the_post(); ?>
				<?php $counter = 0; ?>
				<h2><?php echo get_the_title(); ?></h2>
				<p><a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class' => 'alignleft' ) ); ?></a> 		
				<?php echo get_the_excerpt(); ?></p>
				<?php if (is_page('professional-biographies') && ($counter == 0)) {
					echo '<div class="separator"></div>';
					$counter++;
				}

				?>
		<?php wp_reset_postdata(); ?>
		<?php 		endwhile;	?>
		<?php		else: ?>
		<?php the_content(); ?>
		<?php		endif;		?>
		

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'masters-ribakoff' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'masters-ribakoff' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
