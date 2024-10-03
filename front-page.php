<?php get_header(); ?>

<?php
  if( have_rows('flexible_blocks_home') ):
      while ( have_rows('flexible_blocks_home') ) : the_row();
            include 'blocks/homepage/' . get_row_layout() . '.php';
      endwhile;
  endif; 
?>

<?php get_footer(); ?>