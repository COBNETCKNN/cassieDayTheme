<?php get_header(); ?>

<?php
  if( have_rows('flexible_blocks_home') ):
      while ( have_rows('flexible_blocks_home') ) : the_row();
            include 'blocks/homepage/' . get_row_layout() . '.php';
      endwhile;
  endif; 
?>

<!-- Popup Modal Structure -->
<?php get_template_part('partials/pop', 'up-form'); ?>

<?php get_footer(); ?>