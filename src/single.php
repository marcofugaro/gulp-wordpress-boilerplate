<?php get_header(); ?>
    
   


    <?php 
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
    
    <article class="page">
        <h2><?php the_title(); ?></h2> 
        
        <p class="post-info">
            <?php
                the_time('d/m/y'); //day/month/year in numbers, otherwise j for the number of day, F mor the name of the month, Y for the year, G for the hours, i for the minutes

                the_author(); //name of the author
                echo get_author_posts_url(get_the_author_meta('ID')); //link to the author posts page

                list_categories(', '); //custom function
            ?>
        </p>
        
        
        <p><?php the_content(); ?></p>
    </article>
    
    <?php 
        endwhile; 
    else : 
        echo 'No content found';
    endif;
    ?>
    
<?php get_footer(); ?>