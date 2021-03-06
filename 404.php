<?php get_header(); ?>

<header class="jumbotron jumbotron-fluid bg-danger full-height text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<h1 class="display-3"><?php _e('Oops! Error 404.', 'bootplate'); ?></h1>
				<p class="lead margin-bottom"><?php _e('Oops.  Looks like the page you&rsquo;re looking for doesn&rsquo;t exist or can&rsquo;t be found.  You might try searching.', 'bootplate'); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</header>
<section class="no-results not-found">
	<div class="container">
		<h2>Error Details</h2>
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p><?php printf( 'Ready to publish your first post? <a href="%1$s">Let&rsquo;s do this</a>!', esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
		<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bootplate'); ?></p>
		<?php else : ?>
		<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching would help.', 'bootplate'); ?></p>
		<?php endif; ?>
	</div><!-- .container -->
</section><!-- .no-results -->

<?php get_footer(); ?>
