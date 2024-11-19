<?php 

//Heading decorative underlines that are added through wysiwyg editor.

add_filter('mce_buttons_2', 'mce_editor_buttons');
function mce_editor_buttons($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

function mce_mod( $init ) {
  //$init['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4';

  $style_formats = array (
  array(  
          'title' => 'Underline Primary Decoration',  
          'inline' => 'span',  
          'classes' => 'underlinePrimaryDecoration',
          'wrapper' => true,
      ),
  array(  
          'title' => 'Underline Secondary Decoration',  
          'inline' => 'span',  
          'classes' => 'underlineSecondaryDecoration',
          'wrapper' => true,
      ),
    array(  
          'title' => 'Underline Tertiary Decoration',  
          'inline' => 'span',  
          'classes' => 'underlineTertiaryDecoration',
          'wrapper' => true,
    ),
  );

  $init['style_formats'] = json_encode( $style_formats );

  $init['style_formats_merge'] = false;
  return $init;
}
add_filter('tiny_mce_before_init', 'mce_mod');