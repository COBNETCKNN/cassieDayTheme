<?php get_header(); ?>

<?php
  if( have_rows('flexible_blocks_home') ):
      while ( have_rows('flexible_blocks_home') ) : the_row();
            include 'blocks/homepage/' . get_row_layout() . '.php';
      endwhile;
  endif; 
?>

<!-- Popup Modal Structure -->
<div id="form-popup" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-10 rounded-xl w-full max-w-md">
        <div class="relative w-fit h-fit">
            <button id="close-popup" class="absolute -top-8 -right-8 text-black bg-gray-300 px-4 py-2 rounded-full shadow-md font-bold text-lg text-white">X</button>
            <div id="form-content">
                <!-- AJAX-loaded form content with iframe will be inserted here -->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>