<?php
/**
 * Template Name: Archives
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dream Big and Make Things Theme 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="posts-list-head">
					<?php the_archive_title( '<p class="page-title">', '</p>' ); ?>
				</div>
			</header><!-- .page-header -->
			<section class="archive-wrapper entry-content">
				<div class="archive-body">
				<?php
					//setup the necessary variables.
					$categories = get_the_category();
					$category_id = $categories[0]->cat_ID;
					$blogtime = date('Y');
					$prev_limit_year = $blogtime - 1;
					$prev_month = '';
					$prev_year = '';
					$first_time_round = true;
					$args = array(
						'cat' => $category_id,
						'posts_per_page' => -1,
						'ignore_sticky_posts' => 1
					);

					$posts_by_month = new WP_Query($args);

					while($posts_by_month->have_posts()) {
					    $posts_by_month->the_post();

					    //end the previous month's list, print the title of this month, and start this month's list.
					    if(get_the_time('F') != $prev_month || get_the_time('Y') != $prev_year && get_the_time('Y') == $prev_limit_year) {
					    	//if this is the first list, don't close a <ul> tag.
					    	if( !$first_time_round )
					    		echo '</ul>';
					    	else
					    		$first_time_round = false;

				            echo "<h4>".get_the_time('F, Y')."</h4>\n\n";
				       		echo '<ul>';
				        }
					    ?>
					    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					    <?php

					    //set the current posts month
					    $prev_month = get_the_time('F');
					    $prev_year = get_the_time('Y');
					}
		        ?>
	        	</div>
	        </section>
	    <?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php dbamt_mailchimp_signup(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>