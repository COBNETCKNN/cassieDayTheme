<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-cursor">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php wp_head(); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open();

global $headerWidthDesktop, $headerWidthMobile;

$header_settings = get_field('header_settings', 'option');
$header_fixed = $header_settings && $header_settings['header_fixed_header'] ? 'header-fixed' : '';
$header_class = '' . $header_fixed;

// Get the top banner settings
$show_top_banner = $header_settings['header_show_top_banner'];
$banner_background_color = $header_settings['banner_background_color'];
$banner_text_color = $header_settings['banner_text_color'];
$banner_content = $header_settings['banner_content'];

if (!is_page('free-intro-social')){ ?>

<!-- Header Section -->
<header class="<?php echo esc_attr($header_class); ?> header relative">
    <!-- Display the top banner if enabled -->
    <?php if ($show_top_banner): ?>
    <div class="top-banner" style="background-color: <?php echo esc_attr($banner_background_color); ?>; color: <?php echo esc_attr($banner_text_color); ?>;">
        <div class="top-banner-content">
            <?php echo wp_kses_post($banner_content); ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="container mx-auto h-auto py-5 lg:py-0 lg:py-5">
        <div class="flex justify-between items-center mx-0 md:mx-7 lg:mx-0">
            <!-- Logo -->
            <?php if (have_rows('header_logo', 'option')): ?>
                <?php while (have_rows('header_logo', 'option')): the_row(); ?>
                    <div class="">
                        <a href="<?php echo site_url(); ?>">
                            <?php 
                            $headerLogo = get_sub_field('header_logo_image', 'option');
                            // Image variables.
                            $url = $headerLogo['url'];
                            $alt = $headerLogo['alt'];
                            $size = 'large';
                            $thumb = $headerLogo['sizes'][ $size ]; ?>

                            <img class="headerLogo" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <!-- Hamburger Menu Icon -->
            <div id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Nav items -->
            <div class="header_navItems__wrapper my-auto hidden lg:block">
                <?php 
                    wp_nav_menu(
                        array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'header-menu font-medium font-plus font-semibold text-primary flex',
                        'walker' => new Custom_Walker_Nav_Menu(),
                        )
                    );
                ?>
            </div>

            <!-- Navigation Overlay -->
            <div id="mobileMenu" class="mobile-menu hidden bg-white fixed inset-0 z-50">
                <div class="mobileMenuWrapper h-full p-10">
                    <div class="">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'header-menu',
                            'container_class' => 'header-menu-mobile font-medium text-xl text-primary font-plus',
                            'menu_class' => 'mobile-menu-list w-full',
                            'walker' => new Custom_Walker_Nav_Menu(),
                        ]);
                        ?>
                    </div>
                    <div class="pb-20">
                        <div class="headerButton_wrapper w-full h-fit my-auto lg:hidden flex justify-center">
                            <?php if (have_rows('header_button', 'option')): ?>
                                <?php while (have_rows('header_button', 'option')): the_row();
                                    $headerAddButton = get_sub_field('add_header_button', 'option');
                                    if ($headerAddButton) {
                                        $add_cta_button = get_sub_field('header_add_cta_button', 'option');
                                        $add_custom_link = get_sub_field('header_add_custom_link', 'option');
                                        $popup_form_content = get_sub_field('header_popup_form', 'option');
                                        $custom_link = get_sub_field('header_custom_link_group', 'option');
                                        $form_id = $popup_form_content['select_form']->ID;

                                        if ($add_cta_button && $popup_form_content) { ?>
                                            <button class="header-button font-plus cta-button font-giga text-sm font-extrabold uppercase tracking-tighter rounded-lg"
                                                data-form-id="<?php echo esc_attr($form_id); ?>">
                                                <a class="block px-5 py-3" href=""><?php echo esc_html($popup_form_content['button_name']); ?></a>
                                            </button>
                                        <?php }
                                        if ($add_custom_link && $custom_link) { ?>
                                            <button class="header-button font-plus rounded-xl text-base font-extrabold uppercase tracking-tighter mt-10">
                                                <a class="block px-5 py-3" href="<?php echo esc_url($custom_link['custom_button_link']); ?>">
                                                    <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                                </a>
                                            </button>
                                        <?php }
                                    }
                                endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="headerButton_wrapper my-auto hidden lg:block">
                <?php if (have_rows('header_button', 'option')): ?>
                    <?php while (have_rows('header_button', 'option')): the_row();
                        $headerAddButton = get_sub_field('add_header_button', 'option');
                        if ($headerAddButton) {
                            $add_cta_button = get_sub_field('header_add_cta_button', 'option');
                            $add_custom_link = get_sub_field('header_add_custom_link', 'option');
                            $popup_form_content = get_sub_field('header_popup_form', 'option');
                            $custom_link = get_sub_field('header_custom_link_group', 'option');
                            $form_id = $popup_form_content['select_form']->ID;

                            if ($add_cta_button && $popup_form_content) { ?>
                                <button class="header-button font-plus cta-button font-giga text-sm font-extrabold uppercase tracking-tighter rounded-lg"
                                    data-form-id="<?php echo esc_attr($form_id); ?>">
                                    <a class="block px-5 py-3" href=""><?php echo esc_html($popup_form_content['button_name']); ?></a>
                                </button>
                            <?php }
                            if ($add_custom_link && $custom_link) { ?>
                                <button class="header-button font-plus rounded-xl text-base font-extrabold uppercase tracking-tighter mt-10">
                                    <a class="block px-5 py-3" href="<?php echo esc_url($custom_link['custom_button_link']); ?>">
                                        <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                    </a>
                                </button>
                            <?php }
                        }
                    endwhile; ?>
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

<?php } ?>