<?php get_header(); ?>

<?php
  if( have_rows('site_builder_pages') ):
      while ( have_rows('site_builder_pages') ) : the_row();
            include 'blocks/pages/' . get_row_layout() . '.php';
      endwhile;
  endif; 
?>

<!-- Popup Modal Structure -->
<div id="form-popup" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white py-7 lg:py-10 px-5 lg:px-10 rounded-xl max-w-[22.5rem] lg:max-w-[35.625rem]">
        <div class="relative w-fit h-fit">
            <button id="close-popup" class="absolute -top-4 lg:-top-5 -right-3 lg:-right-5">
            <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.5 0C8.5745 0 0.5 8.0745 0.5 18C0.5 27.9255 8.5745 36 18.5 36C28.4255 36 36.5 27.9255 36.5 18C36.5 8.0745 28.4255 0 18.5 0ZM24.0605 21.4395C24.647 22.026 24.647 22.974 24.0605 23.5605C23.768 23.853 23.384 24 23 24C22.616 24 22.232 23.853 21.9395 23.5605L18.5 20.121L15.0605 23.5605C14.768 23.853 14.384 24 14 24C13.616 24 13.232 23.853 12.9395 23.5605C12.353 22.974 12.353 22.026 12.9395 21.4395L16.379 18L12.9395 14.5605C12.353 13.974 12.353 13.026 12.9395 12.4395C13.526 11.853 14.474 11.853 15.0605 12.4395L18.5 15.879L21.9395 12.4395C22.526 11.853 23.474 11.853 24.0605 12.4395C24.647 13.026 24.647 13.974 24.0605 14.5605L20.621 18L24.0605 21.4395Z" fill="#D5DFE2"/>
            </svg>
            </button>
            <div id="form-content">
                <!-- AJAX-loaded form content with iframe will be inserted here -->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>