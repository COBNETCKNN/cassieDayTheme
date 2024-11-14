<?php 
/**
 * Estimated Reading Time on single post page
 */
function prefix_estimated_reading_time() {
    $my_postid = get_queried_object_id();
    // get the content
    $the_content = get_post_field('post_content', $my_postid);
    // count the number of words
    $words = str_word_count(strip_tags($the_content));
    // rounding off and dividing per 200 words per minute
    $minute = floor($words / 200);
    $second = floor($words % 200 / (200 / 60));

    // Display "1 min" for a single minute, otherwise "x mins"
    $estimate = $minute . ' min';

    // Create output
    $output = '<p>' . $estimate . '</p>';
    
    // return the estimate
    return $output;
}

add_shortcode('kilo_estimated_reading_time', 'prefix_estimated_reading_time');
