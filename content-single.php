<?php
/**
 * @package Dream Big and Make Things Theme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php dbamt_posted_on(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php the_post_thumbnail( 'large' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			// wp_link_pages( array(
			// 	'before' => '<div class="page-links">' . __( 'Pages:', 'dbamt' ),
			// 	'after'  => '</div>',
			// ) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php dbamt_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
