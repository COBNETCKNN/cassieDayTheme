<?php 
// Global variables for width
global $footerLogoWidth;
$columns = get_field('show_section_in_footer', 'option') ? 4 : 3;
?>

<footer class="py-14 relative">
    <div class="container mx-auto">
        <!-- Upper footer -->
        <div class="my-14">
            <div class="grid gap-4" style="grid-template-columns: repeat(<?php echo $columns; ?>, 1fr);">
                        <!-- Logo and Partners -->
                        <div class="relative z-10">
                            <!-- Logo -->
                            <div class="mb-12">
                                <?php if( have_rows('footer_logo_group', 'option') ): ?>
                                    <?php while( have_rows('footer_logo_group', 'option') ): the_row(); 
                                    
                                    $footerLogoImage = get_sub_field('footer_logo_image', 'option');
                                    ?>
                                    <a href="<?php echo site_url(); ?>">
                                        <?php 
                                            if( $footerLogoImage ) {
                                                echo wp_get_attachment_image( $footerLogoImage, 'full', false, array( 'class' => 'footerLogo' ) );
                                            }else {
            
                                            }
                                        ?>
                                    </a>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Partners -->
                             <div class="relative z-10">
                                <?php if( have_rows('footer_partners', 'option') ): ?>
                                    <?php while( have_rows('footer_partners', 'option') ): the_row(); 
                                    
                                    $partnersLogo = get_sub_field('partners_logo', 'option');
                                    $partnersLogoSize = 'full';
                                    $partnersLink = get_sub_field('partners_link', 'option');
                                    ?>

                                    <a href="<?php echo esc_url($partnersLink); ?>" target="_blank">
                                        <?php 
                                        if( $partnersLogo ) {
                                            echo wp_get_attachment_image( $partnersLogo, $partnersLogoSize );
                                        }
                                        ?>
                                    </a>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                             </div>
                        </div>
                        <!-- Opening hours -->
                        <?php if ( get_field('show_section_in_footer', 'option') ) : ?>
                            <div class="flex justify-center relative z-10">
                                <div class="">
                                    <h5 class="footerInfo_card__heading font-plus uppercase text-base font-extrabold mb-3 text-tertiary">Opening Hours</h5>
                                    <ul class="footer_openingHours__wrapper text-lg font-plus font-medium text-primary">
                                    <?php if( have_rows('footer_opening_hours', 'option') ): ?>
                                        <?php while( have_rows('footer_opening_hours', 'option') ): the_row(); 
                                        
                                        $openingDay = get_sub_field('opening_hours_days', 'option');
                                        $openingHour = get_sub_field('opening_hours_hours', 'option');
                                        ?>

                                        <li>
                                            <span class="inline-block w-[70px]"><?php echo substr($openingDay, 0, 3); ?></span>
                                            <span><?php echo $openingHour; ?></span>
                                        </li>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Contact -->
                        <div class="flex justify-center relative z-10">
                            <div class="">
                                <h5 class="footerInfo_card__heading font-plus uppercase text-base font-extrabold mb-3 text-tertiary">Contact</h5>
                                <!-- Phone -->
                                <div class="">
                                    <span class="footerInfo_contact__heading font-plus text-base uppercase font-normal block text-primary-light">Phone</span>
                                    <?php if( have_rows('contact_phone_number_repeater', 'option') ): ?>
                                        <?php while( have_rows('contact_phone_number_repeater', 'option') ): the_row(); 
                                        
                                        $contactPhoneNumber = get_sub_field('contact_phone_number', 'option');
                                        ?>

                                        <a class="contactInfo_link text-lg font-plus font-bold mb-1 block text-primary" href="tel:<?php echo $contactPhoneNumber; ?>"><?php echo $contactPhoneNumber; ?></a>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- Email -->
                                <div class="my-3">
                                    <span class="footerInfo_contact__heading font-plus text-base uppercase font-normal block text-primary-light">Email</span>
                                    <?php if( have_rows('contact_email_repeater', 'option') ): ?>
                                        <?php while( have_rows('contact_email_repeater', 'option') ): the_row(); 
                                        
                                        $contactEmail = get_sub_field('contact_email', 'option');
                                        ?>

                                        <a class="contactInfo_link text-lg font-plus font-bold mb-1 block text-primary" href="mailto:<?php echo $contactEmail; ?>"><?php echo $contactEmail; ?></a>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- Social Media -->
                                <div class="">
                                    <span class="footerInfo_contact__heading font-plus text-base uppercase font-normal block mb-2">Social</span>
                                    <div class="flex justify-start">
                                        <?php if( have_rows('footer_social_media_icons', 'option') ): ?>
                                            <?php while( have_rows('footer_social_media_icons', 'option') ): the_row(); 
                                            
                                            $socialMediaIcon = get_sub_field('social_media_icon', 'option');
                                            $socialMediaIconSize = 'social-media';
                                            $socialMediaIconLink = get_sub_field('social_media_link', 'option');
                                            ?>

                                            <a class="mr-4" href="<?php echo esc_url($socialMediaIconLink); ?>" target="_blank">
                                                <?php 
                                                    if( $socialMediaIcon ) {
                                                        echo wp_get_attachment_image( $socialMediaIcon, $socialMediaIconSize );
                                                    }
                                                ?>
                                            </a>

                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="flex justify-center">
                            <div class="">
                                <h5 class="footerInfo_card__heading font-plus uppercase text-base font-extrabold mb-3 text-tertiary">Address</h5>
                                <?php 
                                
                                $addressName = get_field('gym_name', 'option');
                                $addressStreet = get_field('gym_street', 'option');
                                $addressCity = get_field('gym_city', 'option');
                                $addressState = get_field('gym_state', 'option');
                                $addressPostalCode = get_field('gym_postal_code', 'option');
                                $addressMapLink = get_field('gym_map_link', 'option');
                                ?>

                                <span class="footerInfo_contact__heading font-plus text-base uppercase font-normal block text-primary-light"><?php echo $addressName; ?></span>
                                <a class="addressLink" href="<?php echo esc_url($addressMapLink); ?>">
                                    <div class="font-bold font-plus text-base text-primary">
                                        <span><?php echo $addressStreet; ?>,</span>
                                        <span><?php echo $addressCity; ?>,</span>
                                        <span><?php echo $addressState; ?>,</span>
                                        <span><?php echo $addressPostalCode; ?></span>
                                    </div>
                                </a>

                            </div>
                        </div>

            </div>
        </div>
        <!-- Bottom Footer -->
        <div class="bottom-footer relative z-10">
            <div class="flex justify-between">
                <!-- Copyright -->
                <?php 
                    $footerCopyright = get_field('footer_copyright', 'option');
                ?>
                <div class="footerCopyright flex font-plus text-base font-semibold text-primary">
                    Copyright &copy; <span id="year"><?php echo date("Y"); ?>&nbsp;<?php echo $footerCopyright; ?></span>
                </div>
                <!-- Footer menu -->
                <div class="footerNavigation">
                <?php 
                    wp_nav_menu(
                        array(
                        'theme_location' => 'footer-menu',
                        'container_class' => 'footer-menu font-medium font-plus font-semibold text-primary',
                        )
                    );
                ?>
                </div>
            </div>
        </div>
    </div>
    <svg class="footerDeco" width="600" height="586" viewBox="0 0 951 586" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g filter="url(#filter0_f_78_2312)">
        <ellipse cx="475.5" cy="293" rx="410.5" ry="228" fill="#FEF1FA"/>
        </g>
        <defs>
        <filter id="filter0_f_78_2312" x="0" y="0" width="951" height="586" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
        <feGaussianBlur stdDeviation="32.5" result="effect1_foregroundBlur_78_2312"/>
        </filter>
        </defs>
    </svg>

</footer>

<style>
    .footerLogo {
        width: <?php echo esc_attr($footerLogoWidth); ?>;
    }

    .footer_openingHours__wrapper, .footerCopyright, .footer-menu, .contactInfo_link {
        color: <?php echo esc_attr($primary_text_color); ?>
    }

    .footerInfo_contact__heading {
        color: <?php echo esc_attr($primary_light_text_color); ?>
    }


</style>


<?php wp_footer(); ?>
</body>
</html>