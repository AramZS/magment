<?php
/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        StrapPress 
 * @author         Brad Williams 
 * @copyright      2011 - 2012 Brag Interactive
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
?>
    </div><!-- end of #wrapper -->
    <?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>

<div id="footer" class="clearfix">
    <div class="container">

    <div id="footer-wrapper">
    
    <div class="grid col-940">
    
        <div class="grid col-460">
		<?php if (has_nav_menu('footer-menu', 'responsive')) { ?>
	        <?php wp_nav_menu(array(
				    'container'       => '',
					'menu_class'      => 'footer-menu',
					'theme_location'  => 'footer-menu')
					); 
				?>
         <?php } ?>
         </div><!-- end of col-460 -->
         
         <div class="grid col-460 fit social">
         <?php $options = get_option('responsive_theme_options'); ?>
					<?php if ($options['footer_social'] == 0): ?>
            <?php
            // First let's check if any of this was set
		
                echo '<ul class="social-icons">';
					
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
         </div><!-- end of col-460 fit -->

          <?php $options = get_option('responsive_theme_options');?> 
          <div class="grid col-300 copyright">
              <?php
                if($options['cr_txt']) { ?>
                <?php echo $options['cr_txt']; ?>
                <?php } else { ?>
                <?php esc_attr_e('&copy;', 'responsive'); ?> <?php _e(date('Y')); ?><a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                    <?php bloginfo('name'); ?>
              <?php } ?>
          </div> <!-- end copyright -->
                
        <?php $options = get_option('responsive_theme_options'); ?>
        <?php if ($options['arrow'] == 0): ?>
        <div class="grid col-300 scroll-top"><a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '&uarr;', 'responsive' ); ?></a></div>
        <?php endif; ?>

        <div class="grid col-300 fit powered">
          <?php
                if($options['power_txt']) { ?>
                <?php echo $options['power_txt']; ?>
                <?php } else { ?>
               <a href="<?php echo esc_url(__('http://strappress.com','responsive')); ?>" title="<?php esc_attr_e('StrapPress', 'responsive'); ?>">
                    <?php printf('StrapPress'); ?></a>
            developed by <a href="<?php echo esc_url(__('http://braginteractive','responsive')); ?>" title="<?php esc_attr_e('Brag Interactive', 'responsive'); ?>">
                    <?php printf('Brag Interactive'); ?></a>
              <?php } ?>    
        </div><!-- end .powered -->
        
    </div><!-- end of col-940 -->
    </div><!-- end #footer-wrapper -->
  </div>  
</div><!-- end #footer -->

<?php wp_footer(); ?>

</body>
</html>