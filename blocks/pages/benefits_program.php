<?php 
/**
 * Flexible content template for Team Cards.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesProgramBenefits';
$default_id = 'pagesProgramBenefits';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showShapeDecoration = get_sub_field('show_section_decoration');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_program_benefits($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_program_benefits($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_program_benefits($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_program_benefits($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> relative font-plus">
    <div class="container mx-auto w-full h-full">
        <div class="mx-5 lg:mx-0">
            <!-- Content -->
            <div class="my-auto">
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
                <div class="programBenefits my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
                    <div class="pagesEditor programBenefits_wrapper relative mb-8">
                        <!-- Content -->
                        <?php echo $editorContent; ?>
                        <!-- Button -->
                        <?php get_template_part('partials/form', 'links-button'); ?>
                    </div>
                </div>
             </div>
            <!-- Benefits card repeater -->
             <div class="benefitsCard_wrapper pt-24 relative z-10">
                <div class="grid lg:grid-cols-2 gap-7">
                    <?php if( have_rows('benefit_cards') ): ?>
                        <?php $cardIndex = 1; ?>
                        <?php while( have_rows('benefit_cards') ): the_row(); 
                        
                        $benefitText = get_sub_field('benefit');
                        ?>

                        <div class="benefitCard_content__wrapper benefitCard_content__wrapper-<?php echo $cardIndex; ?> w-full relative">
                            <div class="benefitCard_content flex justify-start items-center bg-white">
                                <div class="benefitCard_number__wrapper benefitCard_number__wrapper-<?php echo $cardIndex; ?> flex justify-center items-center">
                                    <div class="benefitCard_number_thickBackground flex justify-center items-center">
                                        <span>
                                            <?php echo sprintf('%02d', $cardIndex); ?>
                                        </span>
                                    </div>
                                </div>
                                <h5 class="benefitCardTitle"><?php echo $benefitText; ?></h5>
                            </div>
                            <!-- Border div -->
                             <div class="benefitCardBorderDiv benefitCardBorderDiv-<?php echo $cardIndex; ?> w-full h-full absolute top-0 left-0"></div>
                        </div>

                        <?php 
                        $cardIndex++;
                        endwhile; ?>
                    <?php endif; ?>
                </div>
             </div>
        </div>
    </div>
    <?php if($showShapeDecoration) { ?>
        <svg class="programBenefitsDeco" width="386" height="701" viewBox="0 0 386 701" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.14" clip-path="url(#clip0_129_2403)">
            <path d="M0.133118 0.724976V486.959L0.195068 489.352C0.466125 496.284 0.737244 503.293 1.38007 510.194C4.38025 538.206 12.9125 565.343 26.4821 590.031C46.8571 627.095 77.7769 657.275 115.323 676.747C152.868 696.219 195.35 704.106 237.383 699.408C265.372 696.295 292.465 687.655 317.088 673.989C347.873 656.921 373.956 632.501 393.011 602.905C412.065 573.309 423.5 539.458 426.295 504.37L427.07 485.007L427.263 463.746C427.302 463.006 427.302 462.264 427.263 461.523C427.252 461.208 427.299 460.893 427.403 460.594C427.494 460.275 427.559 459.948 427.596 459.618C427.658 459.27 427.705 458.844 427.759 458.418C427.812 457.568 427.986 456.731 428.278 455.931C428.441 455.381 428.541 454.948 428.634 454.514C428.779 453.694 429.04 452.899 429.409 452.152C431.214 447.07 433.995 442.389 437.595 438.373C441.151 434.389 445.465 431.154 450.286 428.857C455.107 426.56 460.337 425.248 465.672 424.997C466.446 424.997 467.135 424.889 467.871 424.78L961.656 424.78V422.736L467.716 422.736C466.942 422.852 466.237 422.914 465.571 422.945C459.964 423.209 454.466 424.59 449.399 427.005C444.333 429.42 439.798 432.821 436.062 437.01C432.315 441.182 429.42 446.047 427.542 451.331C427.12 452.201 426.825 453.127 426.667 454.08C426.582 454.475 426.489 454.855 426.38 455.258C426.027 456.2 425.816 457.189 425.753 458.193C425.707 458.58 425.66 458.967 425.598 459.363C425.569 459.609 425.519 459.852 425.451 460.091C425.296 460.592 425.227 461.116 425.25 461.64C425.25 462.259 425.25 462.925 425.25 463.591L425.048 466.24L425.009 488.701L424.808 493.883L424.266 504.261C420.594 549.562 402.42 592.474 372.44 626.633C342.459 660.792 302.268 684.38 257.826 693.898C213.384 703.417 167.058 698.359 125.717 679.475C84.3756 660.591 50.2211 628.887 28.3177 589.063C14.8823 564.616 6.43433 537.745 3.4635 510.008C2.82062 503.185 2.54956 496.191 2.28619 489.429L2.21655 482.28V0.724976H0.133118Z" fill="#586470"/>
            <path d="M170.805 487.137C170.798 487.355 170.819 487.574 170.867 487.787C170.99 488.761 171.052 489.741 171.053 490.723V491.97C171.647 497.573 173.355 503.002 176.076 507.937C178.797 512.871 182.477 517.212 186.9 520.704C192.397 525.092 198.892 528.054 205.809 529.329C212.726 530.603 219.85 530.149 226.55 528.008C233.249 525.867 239.317 522.105 244.213 517.056C249.109 512.007 252.682 505.826 254.616 499.064C255.367 496.381 255.859 493.632 256.087 490.854V490.792C256.087 490.018 256.087 489.398 256.173 488.755L256.343 486.61L256.475 461.616L256.699 456.419L257.288 446.049C257.42 443.671 257.784 441.239 258.14 438.884C258.295 437.846 258.45 436.809 258.589 435.786C259.712 428.165 260.711 421.845 262.5 415.378C264.049 409.096 265.877 401.994 268.441 395.387C282.352 355.835 307.724 321.319 341.323 296.239C374.923 271.16 415.23 256.652 457.105 254.565L467.515 254.139L561.417 254.139H961.656V252.102L467.445 252.102L457.012 252.528C414.753 254.668 374.083 269.323 340.171 294.63C306.259 319.938 280.637 354.756 266.559 394.659C263.957 401.359 262.152 408.516 260.564 414.836C258.744 421.373 257.729 427.785 256.591 435.492C256.459 436.538 256.304 437.56 256.149 438.59C255.785 440.991 255.375 443.469 255.282 445.94L254.329 466.287L254.174 488.554C254.106 489.293 254.075 490.035 254.081 490.777C253.861 493.397 253.392 495.991 252.68 498.522C250.47 506.251 246.023 513.153 239.898 518.358C233.773 523.564 226.244 526.841 218.26 527.776C212.927 528.386 207.526 527.937 202.368 526.454C197.209 524.971 192.395 522.482 188.201 519.132C184.001 515.815 180.505 511.694 177.915 507.011C175.326 502.327 173.696 497.174 173.121 491.853C173.121 491.513 173.121 491.079 173.121 490.707C173.122 489.671 173.055 488.636 172.92 487.609L172.873 487.346V0.725037H170.829V487.121L170.805 487.137Z" fill="#586470"/>
            <path d="M28.5733 486.23C28.5733 487.005 28.5733 487.865 28.643 489.127L28.7282 491.226C28.9528 496.454 29.1775 501.868 29.6654 507.181C32.2629 531.45 39.6526 554.962 51.4061 576.353C69.0756 608.474 95.8815 634.629 128.428 651.502C160.974 668.376 197.797 675.21 234.231 671.138C258.477 668.438 281.946 660.953 303.279 649.119C329.952 634.327 352.551 613.166 369.061 587.52C385.571 561.875 395.479 532.543 397.901 502.139L398.598 485.045L398.823 462.584L398.955 459.068V458.991C398.977 458.365 399.06 457.742 399.203 457.132C399.295 456.667 399.388 456.202 399.443 455.722C399.497 455.242 399.605 454.646 399.683 454.08C399.856 452.425 400.191 450.791 400.682 449.201C400.86 448.542 401.007 447.954 401.147 447.373C401.474 445.78 401.959 444.223 402.595 442.726C405.62 434.117 410.309 426.187 416.397 419.39C422.464 412.622 429.813 407.125 438.018 403.215C446.223 399.305 455.122 397.061 464.2 396.611L467.709 396.363L961.656 396.363V394.319L467.67 394.319L464.123 394.566C450.053 395.294 436.517 400.181 425.228 408.609C413.938 417.036 405.404 428.624 400.705 441.905C400.027 443.497 399.508 445.152 399.156 446.846C399.017 447.412 398.877 447.985 398.722 448.55C398.195 450.246 397.837 451.989 397.654 453.755L397.413 455.405C397.359 455.869 397.274 456.272 397.197 456.683C397.028 457.447 396.929 458.224 396.902 459.006L396.554 466.279L396.507 488.507L395.857 502.007C392.211 547.404 371.759 589.808 338.503 620.923C305.246 652.038 261.578 669.627 216.039 670.249C170.5 670.871 126.368 654.481 92.2741 624.285C58.1805 594.089 36.5789 552.26 31.6946 506.98C31.2145 501.728 30.9821 496.346 30.7652 491.141L30.6722 489.034C30.6103 487.578 30.6103 486.711 30.6103 485.82V0.724915H28.5656V486.23H28.5733Z" fill="#586470"/>
            <path d="M57.0213 486.254C57.0213 487.028 57.0213 487.849 57.091 488.872L57.2537 492.419C57.4241 496.291 57.6022 500.241 57.9507 504.153C60.1458 524.678 66.3956 544.562 76.3377 562.652C91.2917 589.84 113.98 611.976 141.528 626.257C169.075 640.537 200.242 646.319 231.078 642.869C251.583 640.598 271.432 634.28 289.477 624.28C312.049 611.76 331.173 593.849 345.143 572.144C359.114 550.44 367.497 525.616 369.546 499.885L369.972 491.551C370.081 489.228 370.197 486.773 370.158 485.022V466.287C370.158 465.148 370.236 464.196 370.298 463.258L370.406 461.291L370.623 456.435C370.665 455.464 370.787 454.497 370.987 453.546C371.095 452.934 371.204 452.322 371.281 451.71L371.537 449.96C371.842 447.396 372.36 444.863 373.086 442.385L373.589 440.395C374.133 437.941 374.874 435.534 375.804 433.199C380.089 421.078 386.718 409.919 395.315 400.36C403.878 390.794 414.257 383.025 425.848 377.505C437.44 371.984 450.013 368.822 462.837 368.202L467.709 367.923L561.425 367.923H961.656V365.878L467.623 365.878L462.705 366.157C449.613 366.791 436.778 370.02 424.945 375.656C413.111 381.292 402.516 389.224 393.773 398.989C385.011 408.735 378.25 420.109 373.876 432.464C372.9 434.874 372.123 437.361 371.552 439.899L371.064 441.812C370.335 444.383 369.817 447.01 369.515 449.666L369.252 451.424C369.182 452.036 369.082 452.609 368.973 453.182C368.756 454.233 368.626 455.3 368.586 456.373L368.369 461.206L368.261 463.127C368.191 464.095 368.129 465.078 368.113 466.271V485.045C368.16 486.757 368.036 489.15 367.928 491.458L367.509 499.746C364.422 538.076 347.147 573.876 319.064 600.146C290.981 626.416 254.109 641.265 215.658 641.791C177.208 642.317 139.943 628.481 111.152 602.989C82.3614 577.498 64.1146 542.183 59.9799 503.951C59.6391 500.079 59.4688 496.152 59.2906 492.334L59.128 488.763C59.0582 487.555 59.0583 486.649 59.066 485.735V0.732727H57.0213V486.254Z" fill="#586470"/>
            <path d="M85.4615 483.001C85.4615 484.86 85.4616 486.718 85.5313 488.569C85.6165 490.064 85.6861 491.528 85.7559 492.992C85.8798 495.703 86.0037 498.414 86.236 501.117C88.0015 517.902 93.0943 534.166 101.217 548.961C109.34 563.755 120.329 576.782 133.544 587.282C146.71 597.808 161.819 605.642 178.008 610.339C194.215 614.975 211.168 616.422 227.926 614.599C244.703 612.765 260.947 607.606 275.708 599.424C290.47 591.242 303.452 580.199 313.897 566.943C329.698 547.068 339.214 522.934 341.23 497.624C341.284 496.113 341.369 494.657 341.455 493.193C341.602 490.529 341.726 487.772 341.749 485.038V472.537C341.749 468.804 341.749 464.436 342.02 460.106L342.338 453.84C342.41 452.54 342.568 451.247 342.81 449.968C342.934 449.193 343.058 448.48 343.151 447.729L343.391 446.18C343.828 442.631 344.522 439.119 345.467 435.67L345.939 433.827C346.712 430.401 347.732 427.036 348.991 423.758C354.531 408.107 363.091 393.697 374.186 381.345C385.239 368.984 398.64 358.946 413.61 351.813C428.579 344.681 444.818 340.597 461.381 339.8L467.631 339.483L961.656 339.483V337.438L467.585 337.438L461.288 337.756C444.448 338.56 427.937 342.707 412.716 349.955C397.494 357.203 383.867 367.408 372.629 379.975C361.375 392.51 352.691 407.134 347.07 423.014C345.793 426.359 344.758 429.792 343.972 433.285L343.515 435.074C342.547 438.609 341.835 442.21 341.385 445.847L341.145 447.45C341.052 448.225 340.928 448.914 340.812 449.635C340.555 450.998 340.389 452.377 340.316 453.763L339.999 459.959C339.696 464.343 339.681 468.773 339.72 472.521V485.045C339.72 487.725 339.58 490.467 339.433 493.077C339.348 494.549 339.263 496.02 339.201 497.5C337.218 522.388 327.855 546.119 312.31 565.657C302.038 578.697 289.272 589.561 274.755 597.613C260.239 605.665 244.264 610.744 227.763 612.554C211.268 614.346 194.582 612.923 178.628 608.364C162.694 603.738 147.826 596.025 134.868 585.663C121.857 575.34 111.035 562.527 103.034 547.973C95.0319 533.419 90.0112 517.416 88.2653 500.9C88.0406 498.243 87.9167 495.563 87.7928 492.876C87.7231 491.404 87.6534 489.933 87.5682 488.461C87.4907 485.82 87.4985 483.132 87.5062 480.468C87.5062 478.973 87.5062 477.486 87.5062 476.007V0.724915H85.4692V483.001H85.4615Z" fill="#586470"/>
            <path d="M113.909 486.184C113.909 487.067 113.91 487.81 113.979 488.353C114.088 489.832 114.157 491.358 114.227 492.868C114.305 494.603 114.382 496.33 114.521 498.05C115.895 511.106 119.859 523.758 126.181 535.264C132.503 546.771 141.057 556.9 151.342 565.061C161.586 573.252 173.344 579.345 185.944 582.99C198.544 586.635 211.738 587.762 224.774 586.306C237.817 584.872 250.443 580.853 261.915 574.484C273.388 568.116 283.476 559.525 291.591 549.214C299.731 538.952 305.771 527.188 309.366 514.593C311.139 508.304 312.301 501.859 312.836 495.346L313.138 489.367C313.216 488.105 313.293 486.788 313.262 484.999V466.263C313.262 464.676 313.378 462.778 313.464 460.919L313.975 451.222C314.078 449.573 314.274 447.931 314.563 446.304C314.703 445.437 314.835 444.577 314.951 443.709L315.113 442.617C315.698 437.979 316.596 433.386 317.801 428.87L318.157 427.46C319.188 422.988 320.515 418.589 322.13 414.293C332.29 385.388 350.829 360.164 375.383 341.838C399.937 323.512 429.393 312.915 459.994 311.399L467.623 311.043L961.656 311.043V308.998L467.515 308.998L459.839 309.346C428.855 310.922 399.037 321.671 374.173 340.227C349.31 358.783 330.521 384.31 320.194 413.565C318.549 417.931 317.201 422.402 316.159 426.949L315.803 428.328C314.579 432.937 313.666 437.623 313.069 442.354L312.898 443.462C312.79 444.329 312.658 445.173 312.519 446.018C312.219 447.716 312.014 449.431 311.907 451.153L311.403 460.85C311.31 462.732 311.218 464.652 311.194 466.271V485.045C311.194 486.78 311.156 488.051 311.078 489.267L310.776 495.23C310.26 501.603 309.132 507.91 307.407 514.067C303.878 526.402 297.962 537.925 289.996 547.983C282.045 558.077 272.164 566.488 260.928 572.724C249.693 578.961 237.329 582.898 224.557 584.307C211.786 585.734 198.86 584.631 186.515 581.062C174.171 577.492 162.651 571.526 152.612 563.504C142.545 555.511 134.17 545.593 127.979 534.328C121.787 523.063 117.902 510.678 116.551 497.895C116.419 496.222 116.341 494.518 116.264 492.814C116.194 491.265 116.125 489.716 116.016 488.213C115.947 487.532 115.946 486.563 115.954 485.634V0.724915H113.917V486.184H113.909Z" fill="#586470"/>
            <path d="M142.358 486.231C142.337 486.885 142.363 487.54 142.435 488.19C142.551 489.453 142.605 490.808 142.66 492.163C142.66 493.116 142.737 494.076 142.799 495.029C143.788 504.357 146.626 513.394 151.147 521.613C155.669 529.831 161.783 537.066 169.133 542.894C183.951 554.66 202.811 560.11 221.622 558.059C230.937 557.029 239.953 554.153 248.145 549.6C256.336 545.047 263.539 538.907 269.332 531.54C275.132 524.215 279.439 515.823 282.01 506.84C283.271 502.353 284.095 497.754 284.473 493.108L284.814 485.046L284.946 462.143L285.643 448.643C285.782 446.634 286.023 444.633 286.363 442.649C286.51 441.68 286.658 440.712 286.782 439.752C287.529 433.805 288.654 427.912 290.151 422.108L290.321 421.442C291.619 415.801 293.277 410.25 295.286 404.821C307.32 370.596 329.272 340.729 358.346 319.029C387.419 297.328 422.296 284.777 458.531 282.974L467.538 282.587L561.394 282.587H961.656V280.542L467.515 280.542L458.461 280.93C421.841 282.784 386.6 295.482 357.212 317.409C327.824 339.336 305.617 369.502 293.411 404.078C291.379 409.578 289.698 415.202 288.377 420.916L288.222 421.543C286.707 427.35 285.569 433.248 284.814 439.202V439.457C284.69 440.402 284.543 441.355 284.396 442.308C284.086 444.329 283.769 446.42 283.622 448.504L282.793 466.24L282.754 487.671L282.46 492.938C282.082 497.439 281.278 501.894 280.059 506.244C277.568 514.977 273.383 523.135 267.744 530.254C262.121 537.409 255.128 543.372 247.175 547.794C239.221 552.216 230.465 555.008 221.42 556.007C203.147 558.011 184.822 552.723 170.426 541.291C163.289 535.635 157.352 528.611 152.963 520.631C148.574 512.652 145.822 503.877 144.867 494.82C144.805 493.914 144.774 492.977 144.735 492.039C144.681 490.653 144.619 489.259 144.487 487.872C144.425 487.508 144.433 486.323 144.433 485.549V0.701782H142.388V486.231H142.358Z" fill="#586470"/>
            </g>
            <defs>
            <clipPath id="clip0_129_2403">
            <rect width="700" height="961.523" fill="white" transform="matrix(0 -1 -1 0 961.656 700.725)"/>
            </clipPath>
            </defs>
        </svg>
    <?php } ?>
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