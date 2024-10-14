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
$header_class = 'py-5 ' . $header_fixed;
?>

<header class="<?php echo esc_attr($header_class); ?> relative">
    <div class="container mx-auto h-auto">
        <div class="flex justify-between items-center mx-10 lg:mx-0">
            <!-- Logo -->
            <?php if (have_rows('header_logo', 'option')): ?>
                <?php while (have_rows('header_logo', 'option')): the_row(); ?>
                    <div class="">
                        <a href="<?php echo site_url(); ?>">
                            <?php
                            $headerLogo = get_sub_field('header_logo_image', 'option');
                            if ($headerLogo) {
                                echo wp_get_attachment_image($headerLogo, 'full', false, ['class' => 'headerLogo']);
                            }
                            ?>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <!-- Hamburger Menu Icon -->
            <button id="hamburger" class="block md:hidden">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>

            <!-- Nav items -->
            <div class="header_navItems__wrapper my-auto hidden md:block">
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
            <div id="mobileMenu" class="mobile-menu hidden fixed inset-0 bg-white z-50">
                <button id="closeMenu" class="absolute top-3 right-10 text-5xl font-bold">&times;</button>
                <div class="flex flex-col items-center justify-center h-full">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header-menu',
                        'container_class' => 'header-menu-mobile font-medium text-xl text-primary',
                        'walker' => new Custom_Walker_Nav_Menu(),
                    ]);
                    ?>
                </div>
            </div>

            <!-- Button -->
            <div class="headerButton_wrapper my-auto hidden md:block">
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