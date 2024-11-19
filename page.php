<?php get_header(); ?>

<?php
  if( have_rows('site_builder_pages') ):
      while ( have_rows('site_builder_pages') ) : the_row();
            include 'blocks/pages/' . get_row_layout() . '.php';
      endwhile;
  endif; 
?>

<!-- Popup Modal Structure -->
<?php get_template_part('partials/pop', 'up-form'); ?>

<?php get_footer(); ?>