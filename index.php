<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<?php the_content(); ?>
		</div>

	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link( __( '&laquo; Older Entries', 'vivid-framework' ) ) ?></div>
		<div class="alignright"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'vivid-framework' ) ) ?></div>
	</div>

<?php else : ?>

	<h2><?php _e('No post found', 'vivid-framework'); ?></h2>

<?php endif; ?>

<?php get_footer(); ?>