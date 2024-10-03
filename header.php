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
                    $headerAddCTAButton = get_sub_field('header_add_cta_button', 'option');
                    $headerAddCustomLink = get_sub_field('header_add_custom_link', 'option');
                    ?>

                    <?php
                    if($headerAddButton) {
                        if ($headerAddCTAButton) {
                            if( have_rows('header_popup_form', 'option') ):
                                while( have_rows('header_popup_form', 'option') ): the_row(); 

                                $ctaButtonName = get_sub_field('button_name', 'option');
                                $ctaButtonLink = get_sub_field('select_form', 'option'); ?>

                                <a href="#" class="font-giga text-sm font-bold uppercase tracking-tighter px-5 py-3 bg-primary-light text-tertiary rounded-lg"><?php echo $ctaButtonName; ?></a>

                                <?php 

                            endwhile;
                        endif;
                        } 
                        if ($headerAddCustomLink) {
                            if( have_rows('header_custom_link_group', 'option') ):
                                while( have_rows('header_custom_link_group', 'option') ): the_row(); 

                                $customLinkButtonName = get_sub_field('custom_link_button_name', 'option');
                                $customLinkButtonLink = get_sub_field('custom_button_link', 'option'); ?>

                                <a href="<?php echo esc_url($customLinkButtonLink); ?>" class="font-giga text-sm font-bold uppercase tracking-tighter px-5 py-3 bg-primary-light text-tertiary rounded-lg"><?php echo $customLinkButtonName; ?></a>

                                <?php 

                            endwhile;
                        endif;
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