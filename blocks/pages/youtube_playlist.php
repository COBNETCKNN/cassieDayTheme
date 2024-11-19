<?php 
/**
 * Flexible content template for Team Cards.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesVideosPlaylist';
$default_id = 'pagesVideosPlaylist';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_videos_playlist($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_videos_playlist($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_videos_playlist($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_videos_playlist($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-white relative font-plus">
    <div class="container mx-auto w-full h-full">
        <?php
            $editorContent = get_sub_field('content_editor');
            $alignment = get_sub_field('align_content');
        ?>
        <!-- Text Content -->
        <?php 
            // Determine the alignment value for inline CSS
            $alignment_style = '';
            if ($alignment == 'left') {
                $alignment_style = 'left';
            } elseif ($alignment == 'center') {
                $alignment_style = 'center';
            } elseif ($alignment == 'right') {
                $alignment_style = 'right';
            }
        ?>
        <div class="pagesPricingCards my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
            <div class="pagesEditor pagesPricingCards_wrapper relative mb-14 lg:mb-24">
                <!-- Content -->
                <?php echo $editorContent; ?>
            </div>
        </div>
        <!-- Videos Playlist -->
        <div class="videosPlaylist_wrapper">
            <div class="lg:grid lg:grid-cols-5 gap-14">
                <!-- Main Video -->
                <div class="col-span-3">
                    <!-- Main Video Embedded -->
                    <div class="mainVideo_wrapper">
                        <?php if( have_rows('main_video') ): ?>
                            <?php while( have_rows('main_video') ): the_row(); 
                                $mainVideoTitle = get_sub_field('video_title');
                                $mainVideoDescription = get_sub_field('video_description');
                                $mainVideoEmbeddedCode = get_sub_field('youtube_embed_code');
                            ?>
                                <div class="main-video" id="main-video">
                                    <?php echo $mainVideoEmbeddedCode; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Main Video Content -->
                    <div class="mainVideoContent_wrapper pt-14 md:pt-24 lg:pt-32 pl-5 md:pl-14 pr-5 md:pr-14 pb-5 md:pb-14 w-full">
                        <h3 class="mainVideoContent_title mb-2" id="main-video-title"><?php echo $mainVideoTitle; ?></h3>
                        <p class="mainVideoContent_description" id="main-video-description"><?php echo $mainVideoDescription; ?></p>
                    </div>
                </div>
                
                <!-- Videos Playlist -->
                <div class="col-span-2">
                    <div class="videoPlaylistGrid md:grid grid-cols-2 lg:grid-cols-3 gap-4 my-auto overflow-y-auto mt-5 lg:mt-0">
                        <?php if( have_rows('videos_playlist') ): ?>
                            <?php while( have_rows('videos_playlist') ): the_row(); 
                                $videosPlaylistTitle = get_sub_field('video_title_repeater');
                                $videosPlaylistDescription = get_sub_field('video_description_repeater');
                                $videosPlaylistEmbeddedCode = get_sub_field('youtube_embed_code_repeater');
                            ?>
                                <!-- Playlist Item -->
                                <div class="lg:col-span-3 flex items-center relative my-5 lg:my-0 video-item"> <!-- Added video-item class -->
                                    <!-- Thumbnail -->
                                    <div class="videoPlaylist_video__wrapper col-span-1">
                                        <?php echo $videosPlaylistEmbeddedCode; ?>
                                    </div>
                                    <!-- Title -->
                                    <div class="videoPlaylistTitle col-span-2">
                                        <h5 class="text-lg font-bold ml-5"><?php echo esc_html($videosPlaylistTitle); ?></h5>
                                    </div>
                                    <!-- Video Link -->
                                    <div class="videoLink playlist-item w-full h-full absolute top-0 right-0 z-20" 
                                        data-video-embed="<?php echo htmlspecialchars($videosPlaylistEmbeddedCode); ?>" 
                                        data-video-title="<?php echo esc_attr($videosPlaylistTitle); ?>" 
                                        data-video-description="<?php echo esc_attr($videosPlaylistDescription); ?>">
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<style>
    #<?php echo $default_id; ?> {
        padding: <?php echo $desktopSpacing; ?>;
    }

    @media (max-width: 1024px) {
        #<?php echo $default_id; ?> {
            padding: <?php echo $tabletSpacing; ?>;
        }
    }

    @media (max-width: 768px) {
        #<?php echo $default_id; ?> {
            padding: <?php echo $mobileSpacing; ?>;
        }
    }
</style>