<?php 
/**
 * Flexible content template for Homepage Hero Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesBenefitCards';
$default_id = 'pagesBenefitCards';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showShapeDecoration = get_sub_field('show_section_decoration');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_benefit_cards($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_benefit_cards($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_benefit_cards($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_benefit_cards($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-24 relative font-plus">
    <div class="container mx-auto w-full h-full">
        <div class="mx-5 lg:mx-0">
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
            <div class="pagesBenefitCards my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
                <div class="pagesEditor pagesBenefitCards_wrapper relative">
                    <!-- Content -->
                    <?php echo $editorContent; ?>
                </div>
            </div>
        </div>
        <!-- Cards Repeater -->
        <div class="pagesBenefitCards_repeater__wrapper mx-5 lg:mx-0">
            <div class="grid md:grid-cols-3 gap-3 lg:gap-14 my-20">
                <?php if( have_rows('benefit_cards') ): 
                    $cardIndex = 1; // Initialize a counter
                ?>
                    <?php while( have_rows('benefit_cards') ): the_row(); 
                        $benefitTitle = get_sub_field('benefit_title');
                        $benefitDescription = get_sub_field('description');
                        $formattedIndex = str_pad($cardIndex, 2, '0', STR_PAD_LEFT); // Format index with leading zero
                    ?>

                        <div class="h-fit w-full relative">
                            <div class="benefitCard benefitCardLayout<?php echo $formattedIndex; ?> py-5 lg:py-10 px-2 lg:px-5 rounded-3xl m-0.5 relative z-10 bg-white">
                                <!-- Title -->
                                <div class="flex justify-start items-center mx-3 mb-6 lg:mb-10">
                                    <div class="benefitCardNumber relative benefitCardNumber<?php echo $formattedIndex; ?>">
                                        <div class="benefitNumber w-full h-full">
                                            <?php echo $formattedIndex; ?>
                                        </div>
                                        <div class="benefitNumberShadow w-full h-full absolute top-0 right-0"></div>
                                    </div>
                                    <div class="benefitCardTitle ml-3 text-2xl font-extrabold text-secondary">
                                        <?php echo $benefitTitle; ?>
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="benefitDescription_wrapper mx-5 lg:mx-7">
                                    <p><?php echo $benefitDescription; ?></p>
                                </div>
                            </div>
                            <div class="cardBorder<?php echo $formattedIndex; ?> w-full h-full"></div>
                        </div>
                    <?php 
                        $cardIndex++; // Increment the counter
                    endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    if ($showShapeDecoration) {
    ?>
        <svg class="benefitCardsDeco" width="226" height="701" viewBox="0 0 226 701" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.14" clip-path="url(#clip0_93_3693)">
            <path d="M0.134094 0.724915V486.958L0.196045 489.352C0.467102 496.284 0.73822 503.293 1.38104 510.194C4.38123 538.206 12.9135 565.343 26.483 590.031C46.858 627.095 77.7778 657.275 115.324 676.747C152.869 696.219 195.351 704.106 237.384 699.408C265.373 696.295 292.466 687.655 317.089 673.989C347.874 656.921 373.957 632.501 393.012 602.905C412.066 573.309 423.501 539.458 426.296 504.37L427.071 485.007L427.264 463.746C427.303 463.006 427.303 462.264 427.264 461.523C427.253 461.208 427.3 460.892 427.404 460.594C427.495 460.274 427.56 459.948 427.597 459.618C427.659 459.27 427.706 458.844 427.76 458.418C427.812 457.568 427.987 456.731 428.279 455.931C428.442 455.381 428.542 454.948 428.635 454.514C428.78 453.694 429.041 452.898 429.41 452.152C431.215 447.069 433.996 442.389 437.596 438.373C441.152 434.389 445.466 431.154 450.287 428.857C455.108 426.56 460.338 425.248 465.673 424.997C466.447 424.997 467.136 424.889 467.872 424.78L961.657 424.78V422.736L467.717 422.736C466.943 422.852 466.238 422.914 465.572 422.945C459.965 423.209 454.467 424.59 449.4 427.005C444.334 429.42 439.799 432.821 436.063 437.01C432.315 441.182 429.421 446.047 427.543 451.331C427.121 452.2 426.826 453.126 426.668 454.08C426.583 454.475 426.49 454.855 426.381 455.258C426.028 456.2 425.817 457.189 425.754 458.193C425.708 458.58 425.661 458.967 425.599 459.362C425.57 459.609 425.52 459.852 425.452 460.09C425.297 460.591 425.228 461.115 425.251 461.64C425.251 462.259 425.251 462.925 425.251 463.591L425.049 466.24L425.01 488.701L424.809 493.883L424.267 504.261C420.595 549.562 402.421 592.474 372.441 626.633C342.46 660.792 302.269 684.38 257.827 693.898C213.385 703.417 167.059 698.359 125.718 679.475C84.3766 660.591 50.222 628.887 28.3187 589.063C14.8833 564.616 6.4353 537.745 3.46448 510.008C2.82159 503.185 2.55054 496.191 2.28717 489.429L2.21753 482.28V0.724915H0.134094Z" fill="#586470"/>
            <path d="M170.806 487.137C170.799 487.355 170.82 487.574 170.868 487.787C170.991 488.761 171.053 489.741 171.054 490.723V491.97C171.648 497.573 173.356 503.002 176.077 507.937C178.798 512.871 182.478 517.212 186.901 520.704C192.398 525.092 198.893 528.054 205.81 529.328C212.727 530.603 219.851 530.149 226.551 528.008C233.25 525.867 239.318 522.105 244.214 517.056C249.11 512.007 252.683 505.826 254.617 499.064C255.368 496.381 255.86 493.631 256.088 490.854V490.792C256.088 490.018 256.088 489.398 256.174 488.755L256.344 486.61L256.476 461.616L256.7 456.419L257.289 446.048C257.421 443.671 257.785 441.239 258.141 438.884C258.296 437.846 258.451 436.808 258.59 435.786C259.713 428.165 260.712 421.845 262.501 415.378C264.05 409.096 265.878 401.994 268.442 395.387C282.353 355.834 307.725 321.319 341.324 296.239C374.924 271.16 415.231 256.652 457.106 254.565L467.516 254.139L561.418 254.139H961.657V252.102L467.446 252.102L457.013 252.528C414.754 254.668 374.084 269.323 340.172 294.63C306.26 319.938 280.638 354.756 266.56 394.659C263.958 401.359 262.153 408.515 260.565 414.835C258.745 421.372 257.73 427.785 256.592 435.492C256.46 436.537 256.305 437.56 256.15 438.59C255.786 440.991 255.376 443.469 255.283 445.94L254.33 466.287L254.175 488.554C254.107 489.293 254.076 490.035 254.082 490.777C253.862 493.397 253.393 495.991 252.681 498.522C250.471 506.251 246.024 513.153 239.899 518.358C233.773 523.564 226.245 526.841 218.261 527.775C212.928 528.386 207.527 527.937 202.369 526.454C197.21 524.97 192.396 522.482 188.202 519.132C184.002 515.815 180.506 511.694 177.916 507.011C175.327 502.327 173.697 497.174 173.122 491.853C173.122 491.513 173.122 491.079 173.122 490.707C173.123 489.671 173.056 488.636 172.921 487.609L172.874 487.346V0.724915H170.83V487.121L170.806 487.137Z" fill="#586470"/>
            <path d="M28.5743 486.23C28.5743 487.005 28.5743 487.865 28.644 489.127L28.7292 491.226C28.9538 496.454 29.1785 501.868 29.6664 507.181C32.2639 531.45 39.6536 554.962 51.407 576.353C69.0766 608.474 95.8825 634.629 128.429 651.502C160.975 668.376 197.798 675.21 234.232 671.138C258.477 668.438 281.947 660.953 303.28 649.119C329.953 634.327 352.552 613.166 369.062 587.52C385.572 561.875 395.48 532.543 397.902 502.139L398.599 485.045L398.824 462.584L398.956 459.068V458.991C398.978 458.365 399.061 457.742 399.204 457.132C399.296 456.667 399.389 456.202 399.444 455.722C399.498 455.242 399.606 454.646 399.684 454.08C399.857 452.425 400.192 450.791 400.683 449.201C400.861 448.542 401.008 447.954 401.148 447.373C401.475 445.78 401.96 444.223 402.596 442.726C405.62 434.117 410.31 426.187 416.398 419.39C422.465 412.622 429.814 407.125 438.019 403.215C446.224 399.305 455.123 397.061 464.201 396.611L467.71 396.363L961.657 396.363V394.319L467.671 394.319L464.124 394.566C450.054 395.294 436.518 400.181 425.229 408.609C413.939 417.036 405.405 428.624 400.706 441.905C400.028 443.497 399.509 445.152 399.157 446.846C399.018 447.412 398.878 447.985 398.723 448.55C398.196 450.246 397.838 451.989 397.654 453.755L397.414 455.405C397.36 455.869 397.275 456.272 397.198 456.683C397.029 457.447 396.93 458.224 396.903 459.006L396.555 466.279L396.508 488.507L395.858 502.007C392.211 547.404 371.76 589.808 338.504 620.923C305.247 652.038 261.579 669.627 216.04 670.249C170.501 670.871 126.369 654.481 92.2751 624.285C58.1815 594.089 36.5799 552.26 31.6956 506.98C31.2155 501.728 30.983 496.346 30.7662 491.141L30.6732 489.034C30.6113 487.578 30.6113 486.711 30.6113 485.82V0.724915H28.5665V486.23H28.5743Z" fill="#586470"/>
            <path d="M57.0223 486.254C57.0223 487.028 57.0223 487.849 57.092 488.871L57.2546 492.419C57.425 496.291 57.6031 500.241 57.9517 504.153C60.1467 524.678 66.3966 544.562 76.3387 562.652C91.2927 589.84 113.981 611.976 141.529 626.257C169.076 640.537 200.243 646.319 231.079 642.869C251.584 640.598 271.433 634.279 289.478 624.28C312.05 611.76 331.174 593.849 345.144 572.144C359.115 550.44 367.498 525.616 369.547 499.885L369.973 491.551C370.082 489.228 370.198 486.773 370.159 485.022V466.287C370.159 465.148 370.237 464.195 370.299 463.258L370.407 461.291L370.624 456.435C370.666 455.463 370.788 454.497 370.988 453.546C371.096 452.934 371.205 452.322 371.282 451.71L371.538 449.96C371.843 447.396 372.361 444.863 373.087 442.385L373.59 440.395C374.134 437.941 374.875 435.534 375.805 433.199C380.09 421.078 386.719 409.919 395.315 400.36C403.879 390.794 414.258 383.025 425.849 377.505C437.441 371.984 450.014 368.822 462.838 368.202L467.71 367.923L561.426 367.923H961.657V365.878L467.624 365.878L462.706 366.157C449.614 366.791 436.779 370.02 424.946 375.656C413.112 381.292 402.517 389.223 393.774 398.989C385.012 408.735 378.251 420.109 373.877 432.463C372.901 434.874 372.124 437.361 371.553 439.899L371.065 441.812C370.336 444.383 369.818 447.01 369.516 449.665L369.253 451.424C369.183 452.035 369.083 452.609 368.974 453.182C368.757 454.233 368.627 455.3 368.587 456.373L368.37 461.206L368.262 463.127C368.192 464.095 368.13 465.078 368.114 466.271V485.045C368.161 486.757 368.037 489.15 367.929 491.458L367.51 499.746C364.423 538.076 347.148 573.876 319.065 600.146C290.982 626.415 254.11 641.265 215.659 641.791C177.208 642.317 139.944 628.481 111.153 602.989C82.3624 577.497 64.1155 542.183 59.9809 503.951C59.6401 500.079 59.4698 496.152 59.2916 492.334L59.129 488.763C59.0592 487.555 59.0593 486.649 59.067 485.735V0.732605H57.0223V486.254Z" fill="#586470"/>
            <path d="M85.4625 483.001C85.4625 484.86 85.4626 486.718 85.5323 488.569C85.6174 490.064 85.6871 491.528 85.7568 492.992C85.8807 495.703 86.0046 498.414 86.237 501.117C88.0024 517.902 93.0953 534.166 101.218 548.961C109.341 563.755 120.33 576.782 133.544 587.282C146.711 597.808 161.82 605.642 178.009 610.339C194.216 614.975 211.169 616.422 227.927 614.599C244.704 612.765 260.948 607.606 275.709 599.424C290.471 591.242 303.453 580.199 313.898 566.943C329.699 547.068 339.215 522.934 341.231 497.624C341.285 496.113 341.37 494.657 341.456 493.193C341.603 490.529 341.727 487.772 341.75 485.038V472.537C341.75 468.804 341.75 464.436 342.021 460.106L342.339 453.84C342.411 452.54 342.569 451.247 342.811 449.968C342.935 449.193 343.059 448.48 343.152 447.729L343.392 446.18C343.829 442.631 344.523 439.119 345.468 435.67L345.94 433.827C346.713 430.401 347.733 427.036 348.992 423.758C354.532 408.107 363.092 393.697 374.187 381.345C385.24 368.984 398.641 358.946 413.611 351.813C428.58 344.681 444.819 340.597 461.382 339.8L467.632 339.483L961.657 339.483V337.438L467.586 337.438L461.289 337.756C444.449 338.56 427.938 342.707 412.716 349.955C397.495 357.203 383.868 367.408 372.63 379.975C361.376 392.51 352.692 407.134 347.071 423.014C345.794 426.359 344.759 429.792 343.973 433.285L343.516 435.074C342.548 438.609 341.836 442.21 341.386 445.847L341.146 447.45C341.053 448.225 340.929 448.914 340.813 449.635C340.556 450.998 340.39 452.377 340.317 453.763L340 459.959C339.697 464.343 339.682 468.773 339.721 472.521V485.045C339.721 487.725 339.581 490.467 339.434 493.077C339.349 494.549 339.264 496.02 339.202 497.5C337.219 522.388 327.856 546.119 312.311 565.657C302.039 578.697 289.273 589.561 274.756 597.613C260.24 605.665 244.265 610.744 227.764 612.554C211.269 614.346 194.583 612.923 178.629 608.364C162.695 603.738 147.827 596.025 134.869 585.663C121.858 575.34 111.036 562.527 103.034 547.973C95.0328 533.419 90.0122 517.416 88.2662 500.9C88.0416 498.243 87.9177 495.563 87.7938 492.876C87.7241 491.404 87.6544 489.933 87.5692 488.461C87.4917 485.82 87.4995 483.132 87.5072 480.468C87.5072 478.973 87.5072 477.486 87.5072 476.007V0.724915H85.4702V483.001H85.4625Z" fill="#586470"/>
            <path d="M113.91 486.184C113.91 487.067 113.911 487.81 113.98 488.353C114.089 489.832 114.158 491.358 114.228 492.868C114.305 494.603 114.383 496.33 114.522 498.05C115.896 511.106 119.86 523.758 126.182 535.264C132.504 546.771 141.058 556.9 151.343 565.061C161.587 573.252 173.345 579.345 185.945 582.99C198.545 586.635 211.739 587.762 224.775 586.306C237.818 584.872 250.444 580.853 261.916 574.484C273.389 568.116 283.477 559.525 291.592 549.214C299.732 538.952 305.772 527.188 309.367 514.593C311.14 508.304 312.302 501.859 312.837 495.346L313.139 489.367C313.217 488.105 313.294 486.788 313.263 484.999V466.263C313.263 464.676 313.379 462.778 313.465 460.919L313.976 451.222C314.079 449.573 314.275 447.931 314.564 446.304C314.704 445.437 314.836 444.577 314.952 443.709L315.114 442.617C315.699 437.979 316.597 433.386 317.802 428.87L318.158 427.46C319.189 422.988 320.516 418.589 322.131 414.293C332.291 385.388 350.83 360.164 375.384 341.838C399.938 323.512 429.394 312.915 459.995 311.399L467.624 311.043L961.657 311.043V308.998L467.516 308.998L459.84 309.346C428.856 310.922 399.038 321.671 374.174 340.227C349.311 358.783 330.522 384.31 320.195 413.565C318.55 417.931 317.202 422.402 316.16 426.949L315.804 428.328C314.58 432.937 313.667 437.623 313.07 442.354L312.899 443.462C312.791 444.329 312.659 445.173 312.52 446.018C312.22 447.716 312.015 449.431 311.908 451.153L311.404 460.85C311.311 462.732 311.219 464.652 311.195 466.271V485.045C311.195 486.78 311.157 488.051 311.079 489.267L310.777 495.23C310.261 501.603 309.133 507.91 307.408 514.067C303.878 526.402 297.963 537.925 289.997 547.983C282.046 558.077 272.164 566.488 260.929 572.724C249.694 578.961 237.33 582.898 224.558 584.307C211.787 585.734 198.861 584.631 186.516 581.062C174.172 577.492 162.652 571.526 152.613 563.504C142.546 555.511 134.171 545.593 127.98 534.328C121.788 523.063 117.903 510.678 116.552 497.895C116.42 496.222 116.342 494.518 116.265 492.814C116.195 491.265 116.126 489.716 116.017 488.213C115.948 487.532 115.947 486.563 115.955 485.634V0.724915H113.918V486.184H113.91Z" fill="#586470"/>
            <path d="M142.359 486.23C142.338 486.885 142.364 487.539 142.436 488.19C142.552 489.452 142.606 490.808 142.661 492.163C142.661 493.116 142.738 494.076 142.8 495.029C143.789 504.357 146.627 513.394 151.148 521.613C155.669 529.831 161.784 537.066 169.133 542.894C183.952 554.66 202.812 560.109 221.622 558.059C230.938 557.029 239.954 554.153 248.146 549.6C256.337 545.047 263.54 538.907 269.333 531.54C275.133 524.214 279.44 515.823 282.011 506.84C283.271 502.353 284.096 497.754 284.474 493.108L284.815 485.045L284.947 462.143L285.644 448.643C285.783 446.634 286.024 444.633 286.364 442.648C286.511 441.68 286.659 440.712 286.783 439.752C287.53 433.805 288.655 427.912 290.152 422.108L290.322 421.442C291.62 415.801 293.278 410.25 295.287 404.821C307.321 370.596 329.273 340.729 358.347 319.029C387.42 297.328 422.297 284.777 458.531 282.974L467.539 282.587L561.395 282.587H961.657V280.542L467.516 280.542L458.462 280.929C421.842 282.784 386.601 295.482 357.213 317.408C327.825 339.335 305.618 369.502 293.412 404.077C291.38 409.578 289.699 415.202 288.378 420.915L288.223 421.543C286.708 427.35 285.57 433.248 284.815 439.202V439.457C284.691 440.402 284.544 441.355 284.397 442.308C284.087 444.329 283.77 446.42 283.622 448.504L282.794 466.24L282.755 487.671L282.461 492.938C282.083 497.439 281.279 501.894 280.06 506.244C277.568 514.977 273.384 523.135 267.745 530.254C262.122 537.409 255.129 543.372 247.176 547.794C239.222 552.216 230.466 555.008 221.421 556.007C203.148 558.011 184.823 552.722 170.427 541.291C163.29 535.634 157.353 528.611 152.964 520.631C148.575 512.652 145.823 503.876 144.868 494.82C144.806 493.914 144.775 492.976 144.736 492.039C144.682 490.653 144.62 489.259 144.488 487.872C144.426 487.508 144.434 486.323 144.434 485.549V0.70166H142.389V486.23H142.359Z" fill="#586470"/>
            </g>
            <defs>
            <clipPath id="clip0_93_3693">
            <rect width="700" height="961.523" fill="white" transform="matrix(0 -1 -1 0 961.656 700.725)"/>
            </clipPath>
            </defs>
        </svg>
    <?php 
    }
    ?>

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