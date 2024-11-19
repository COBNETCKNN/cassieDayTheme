<?php 

// Add WP login style css
function my_custom_login () {
	wp_enqueue_style( 'custom-styles', get_stylesheet_directory_uri() . '/login/custom-login-style.css', array(), '1.4' );
  }
  
  add_action( 'login_head', 'my_custom_login', 1 );

  /* WP Login */
  function my_login_logo() { ?>
<style type="text/css">
#login h1 a,
.login h1 a {
    background-image: url(<?php echo get_stylesheet_directory_uri();
    ?>/src/assets/images/logo_kilo.png);
    height: 85px;
    width: 270px;
    background-position: center;
    background-size: contain !important;
    background-repeat: no-repeat;
    padding-bottom: 30px;
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
 /* Change Lost Password Text */
function change_lost_your_password ($text) {

	if ($text == 'Lost your password?'){
		$text = 'lost credentials';

	}
		   return $text;
	}
add_filter( 'gettext', 'change_lost_your_password' );


function custom_loginlogo_url($url) {

    return 'https://usekilo.com/';

}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );