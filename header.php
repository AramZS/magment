<?php
/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        StrapPress 
 * @author         Brad Williams 
 * @copyright      2011 - 2012 Brag Interactive
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<?php wp_enqueue_style('responsive-style', get_stylesheet_uri(), false, '1.2.0');?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
                 
<?php responsive_container(); // before container hook ?>

         
    <?php responsive_header(); // before header hook ?>
    <div id="header">
  
        
    <?php responsive_in_header(); // header hook ?>
   
	

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
               <?php $options = get_option('responsive_theme_options'); ?>

                <?php if($options['site_logo']) { ?>
            <div id="logo"><a href=" <?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage">
            <img src="<?php echo $options['site_logo']; ?>" alt="<?php bloginfo( 'name' ) ?>" />
            </a></div><!-- end of #logo -->
            <?php } else { ?>
            <?php if (is_front_page()) { ?>
            <a class="brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
            <?php } else { ?>
            <a class="brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
            <?php } } ?>
        



          <div class="nav-collapse">
			   <?php

                $args = array(
                    'theme_location' => 'top-bar',
                    'depth'      => 2,
                    'container'  => false,
                    'menu_class'     => 'nav',
                    'walker'     => new Bootstrap_Walker_Nav_Menu()
                );

                wp_nav_menu($args);

            ?>
            </div>
 

            <?php $options = get_option('responsive_theme_options'); ?>
            <?php if ($options['header_social'] == 0): ?>

            <?php        
            // First let's check if any of this was set
        
                echo '<ul class="social-icons nav pull-right">';
                    
                if ($options['twitter_uid']) echo '<li class="twitter-icon"><a href="' . $options['twitter_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/twitter.png" alt="Twitter">'
                    .'</a></li>';

                if ($options['facebook_uid']) echo '<li class="facebook-icon"><a href="' . $options['facebook_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/facebook.png" alt="Facebook">'
                    .'</a></li>';

                 if ($options['reddit_uid']) echo '<li class="reddit-icon"><a href="' . $options['reddit_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/reddit.png" alt="Reddit">'
                    .'</a></li>';  

                if ($options['pinterest_uid']) echo '<li class="pinterest-icon"><a href="' . $options['pinterest_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/pinterest.png" alt="Pinterest">'
                    .'</a></li>'; 

                if ($options['tumblr_uid']) echo '<li class="tumblr-icon"><a href="' . $options['tumblr_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/tumblr.png" alt="Tumblr">'
                    .'</a></li>';   
  
                if ($options['linkedin_uid']) echo '<li class="linkedin-icon"><a href="' . $options['linkedin_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/linkedin.png" alt="LinkedIn">'
                    .'</a></li>';
                    
                if ($options['youtube_uid']) echo '<li class="youtube-icon"><a href="' . $options['youtube_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/youtube.png" alt="YouTube">'
                    .'</a></li>';

                if ($options['vimeo_uid']) echo '<li class="vimeo-icon"><a href="' . $options['vimeo_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/vimeo.png" alt="YouTube">'
                    .'</a></li>';
                    
                if ($options['stumble_uid']) echo '<li class="stumble-upon-icon"><a href="' . $options['stumble_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/stumble-upon.png" alt="YouTube">'
                    .'</a></li>';
                    
                if ($options['rss_uid']) echo '<li class="rss-feed-icon"><a href="' . $options['rss_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/rss.png" alt="RSS Feed">'
                    .'</a></li>';
       
                if ($options['google_plus_uid']) echo '<li class="google-plus-icon"><a href="' . $options['google_plus_uid'] . '">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/icons/googleplus.png" alt="Google Plus">'
                    .'</a></li>';
             
                echo '</ul><!-- end of .social-icons -->';
         ?>
         <?php endif; ?>

        </div>
        </div>
     </div>           

           
 
    </div><!-- end of #header -->
    <?php responsive_header_end(); // after header hook ?>
    
	<?php responsive_wrapper(); // before wrapper ?>
    <div class="container">
    <div id="wrapper" class="clearfix">
    <?php responsive_in_wrapper(); // wrapper hook ?>
