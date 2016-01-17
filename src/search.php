<?php get_header(); ?>
    
    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title"><?php printf( 'Search Results for: %s', 'theme-name', '<span>' . get_search_query() . '</span>' ); ?></h1>
        </header>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', 'search' ); ?>
        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>

    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

<?php get_footer(); ?>