<article class="home-post">
    <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
    <p><?php 
        //the_excerpt(); //prints the shortened post, not the whole post, you can also write the excerpt in the new article page, and adds some ellipsis
        //the_content('Read more'); //prints the content with the read more text where you put the more tag in the editor
        echo get_the_excerpt();        
    ?>
        <a href="<?php the_permalink() ?>">Read More >></a> <!--custom ellipsis-->
    </p>
</article>
