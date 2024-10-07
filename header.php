<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-cursor">
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); 

global $headerWidthDesktop, $headerWidthMobile;

$header_settings = get_field('header_settings', 'option');
$header_fixed = $header_settings && $header_settings['header_fixed_header'] ? 'header-fixed' : '';
$header_class = 'py-5 ' . $header_fixed;
?>

<header class="<?php echo esc_attr($header_class); ?>">
    <div class="container mx-auto h-auto">
        <div class="flex justify-between">
            <!-- Logo of the site -->
            <?php if( have_rows('header_logo', 'option') ): ?>
                <?php while( have_rows('header_logo', 'option') ): the_row(); ?>
                    <div class="">
                        <a href="<?php echo site_url(); ?>">
                            <?php 
                                $headerLogo = get_sub_field('header_logo_image', 'option'); ?>
                            <?php


                                if( $headerLogo ) {
                                    echo wp_get_attachment_image( $headerLogo, 'full', false, array( 'class' => 'headerLogo' ) );
                                }else {

                                }
                            ?>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <!-- Nav items -->
            <div class="header_navItems__wrapper my-auto">
                <?php 
                    wp_nav_menu(
                        array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'header-menu font-medium font-plus font-semibold text-primary',
                        'walker' => new Custom_Walker_Nav_Menu(),
                        )
                    );
                ?>
            </div>
            <!-- Button -->
             <div class="headerButton_wrapper my-auto">
                <?php if( have_rows('header_button', 'option') ): ?>
                    <?php while( have_rows('header_button', 'option') ): the_row(); 
                    $headerAddButton = get_sub_field('add_header_button', 'option');
                    ?>

                    <?php
                        if($headerAddButton) {
                        // Get the true/false values
                        $add_cta_button = get_sub_field('header_add_cta_button', 'option');
                        $add_custom_link = get_sub_field('header_add_custom_link', 'option');

                        // Get the Popup Form content and Custom Link
                        $popup_form_content = get_sub_field('header_popup_form', 'option');
                        $custom_link = get_sub_field('header_custom_link_group', 'option');
                        $form_id = $popup_form_content['select_form']->ID;

                        if ($add_cta_button || $add_custom_link) {
                            if ($add_cta_button && $popup_form_content) {
                                ?>
                                <button class="cta-button font-giga text-sm font-bold uppercase tracking-tighter px-5 py-3 bg-primary-light text-tertiary rounded-lg"
                                    data-form-id="<?php echo esc_attr($form_id); ?>" class="cta-button-header">
                                    <?php echo esc_html($popup_form_content['button_name']); ?>
                                </button>
                                <?php
                            }
                            if ($add_custom_link && $custom_link) {
                                ?>
                                <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                    <a href="<?php echo esc_url($custom_link['custom_button_link']) ?>">
                                        <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                    </a>
                                </button>
                                <?php
                            }

                        }
                    }
                    ?>
                    <?php endwhile; ?>
                <?php endif; ?>
             </div>
        </div>
    </div>
</header>

<style>
    @media only screen and (max-width: <?php echo BREAKPOINT_MD; ?>) {
        .headerLogo {
            width: <?php echo $headerWidthMobile; ?>;
        }
    }

    @media only screen and (min-width: <?php echo BREAKPOINT_MD; ?>) {
        .headerLogo {
            width: <?php echo $headerWidthDesktop; ?>;
        }
    }
</style>