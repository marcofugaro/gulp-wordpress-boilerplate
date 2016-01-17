<!--Default HTML5 search form-->
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <span class="screen-reader-text">Cerca:</span>
    <input type="search" class="search-field" placeholder="Cerca…" value="<?php the_search_query(); ?>" name="s" title="Cerca:" />
  </label>
  <input type="submit" class="search-submit" value="Cerca" />
</form>