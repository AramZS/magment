<?php
/**
 * Theme Options
 *
 *
 * @file           theme-options.php
 * @package        WordPress 
 * @subpackage     responsive 
 * @author         Brad Williams 
 * @copyright      2012 Brag Interactive
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/responsive/includes/theme-options.php
 * @link           http://themeshaper.com/2010/06/03/sample-theme-options/
 * @since          available since Release 1.0
 */
?>
<?php
add_action('admin_init', 'responsive_theme_options_init');
add_action('admin_menu', 'responsive_theme_options_add_page');




/**
 * A safe way of adding javascripts to a WordPress generated page.
 */
function responsive_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'responsive-theme-options', get_template_directory_uri() . '/includes/theme-options.css', false, '1.0' );

	wp_enqueue_script( 'responsive-theme-options', get_template_directory_uri() . '/includes/theme-options.js', array( 'jquery' ), '1.0' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'responsive_admin_enqueue_scripts' );

/**
 * Init plugin options to white list our options
 */
function responsive_theme_options_init() {
    register_setting('responsive_options', 'responsive_theme_options', 'responsive_theme_options_validate');
}

/**
 * Load up the menu page
 */
function responsive_theme_options_add_page() {
    add_theme_page(__('Theme Options', 'responsive'), __('Theme Options', 'responsive'), 'edit_theme_options', 'theme_options', 'responsive_theme_options_do_page');
}

/**
 * Redirect users to Theme Options after activation
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
	wp_redirect( 'themes.php?page=theme_options' );

/**
 * Site Verification and Webmaster Tools
 * If user sets the code we're going to display meta verification
 * And if left blank let's not display anything at all in case there is a plugin that does this
 */
 
function responsive_google_verification() {
    $options = get_option('responsive_theme_options');
    if ($options['google_site_verification']) {
		echo '<meta name="google-site-verification" content="' . $options['google_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'responsive_google_verification');

function responsive_bing_verification() {
    $options = get_option('responsive_theme_options');
    if ($options['bing_site_verification']) {
        echo '<meta name="msvalidate.01" content="' . $options['bing_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'responsive_bing_verification');

function responsive_yahoo_verification() {
    $options = get_option('responsive_theme_options');
    if ($options['yahoo_site_verification']) {
        echo '<meta name="y_key" content="' . $options['yahoo_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'responsive_yahoo_verification');

function responsive_site_statistics_tracker() {
    $options = get_option('responsive_theme_options');
    if ($options['site_statistics_tracker']) {
        echo $options['site_statistics_tracker'];
	}
}

add_action('wp_head', 'responsive_site_statistics_tracker');
	
/**
 * Create the options page
 */
function responsive_theme_options_do_page() {

	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
    <div class="wrap">
        <?php screen_icon();
        echo "<h2>" . get_current_theme() . __(' Theme Options', 'responsive') . "</h2>"; ?>

		<?php if (false !== $_REQUEST['settings-updated']) : ?>
		<div class="updated fade"><p><strong><?php _e('Options Saved', 'responsive'); ?></strong></p></div>
		<?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields('responsive_options'); ?>
            <?php $options = get_option('responsive_theme_options'); ?>
            
            <div id="rwd" class="grid col-940">

            <h3 class="rwd-toggle"><a href="#"><?php _e('Theme Elements', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block"> 
                               
                <?php
                /**
                 * Breadcrumb Lists
                 */
                ?>
                <div class="grid col-300"><?php _e('Disable Breadcrumb Lists?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
					    <input id="responsive_theme_options[breadcrumb]" name="responsive_theme_options[breadcrumb]" type="checkbox" value="1" <?php isset($options['breadcrumb']) ? checked( '1', $options['breadcrumb'] ) : checked('0', '1'); ?> />
						<label class="description" for="responsive_theme_options[breadcrumb]"><?php _e('Check to disable', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                     <?php
                /**
                 * Feature Home Page
                 */
                ?>
                <div class="grid col-300"><?php _e('Disable Featured Homepage?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[featuredh]" name="responsive_theme_options[featuredh]" type="checkbox" value="1" <?php isset($options['featuredh']) ? checked( '1', $options['featuredh'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[featuredh]"><?php _e('Check to disable', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->


                <?php
                /**
                 * CTA Button
                 */
                ?>
                <div class="grid col-300"><?php _e('Disable Call to Action Button?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
					    <input id="responsive_theme_options[cta_button]" name="responsive_theme_options[cta_button]" type="checkbox" value="1" <?php isset($options['cta_button']) ? checked( '1', $options['cta_button'] ) : checked('0', '1'); ?> />
						<label class="description" for="responsive_theme_options[cta_button]"><?php _e('Check to disable', 'responsive'); ?></label>
                         <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>
                    </div><!-- end of .grid col-620 -->
                                    
                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->

            <h3 class="rwd-toggle"><a href="#"><?php _e('Logo Upload', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block">
                <?php
                /**
                 * Logo Upload
                 */
                ?>
                <div class="grid col-300"><?php _e('Custom Logo', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[site_logo]" class="regular-text" type="text" name="responsive_theme_options[site_logo]" value="<?php if (!empty($options['site_logo'])) esc_attr_e($options['site_logo']); ?>" />
                        <label class="description" for="responsive_theme_options[site_logo]"><?php _e('*Complete URL path', 'responsive'); ?></label>
                        
                        <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>

                     			
                    </div><!-- end of .grid col-620 -->
                    
                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->
                        
            <h3 class="rwd-toggle"><a href="#"><?php _e('Home Page', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block">
                <?php
                /**
                 * Homepage Headline
                 */
                ?>
                <div class="grid col-300"><?php _e('Headline', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[home_headline]" class="regular-text" type="text" name="responsive_theme_options[home_headline]" value="<?php if (!empty($options['home_headline'])) esc_attr_e($options['home_headline']); ?>" />
                        <label class="description" for="responsive_theme_options[home_headline]"><?php _e('Enter your headline', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <?php
                /**
                 * Homepage Subheadline
                 */
                ?>
                <div class="grid col-300"><?php _e('Subheadline', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[home_subheadline]" class="regular-text" type="text" name="responsive_theme_options[home_subheadline]" value="<?php if (!empty($options['home_subheadline'])) esc_attr_e($options['home_subheadline']); ?>" />
                        <label class="description" for="responsive_theme_options[home_subheadline]"><?php _e('Enter your subheadline', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                    
                <?php
                /**
                 * Homepage Content Area
                 */
                ?>
                <div class="grid col-300"><?php _e('Content Area', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <textarea id="responsive_theme_options[home_content_area]" class="large-text" cols="50" rows="10" name="responsive_theme_options[home_content_area]"><?php if (!empty($options['home_content_area'])) esc_attr_e($options['home_content_area']); ?></textarea>
                        <label class="description" for="responsive_theme_options[home_content_area]"><?php _e('Enter your content', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                     <?php
                /**
                 * CTA Button
                 */
                ?>

                            <div class="grid col-300"><?php _e('CTA Button Color', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <button class="btn btn-large"> </button>
                        <button class="btn btn-large btn-primary">primary</button>
                        <button class="btn btn-large btn-info">info</button>
                        <button class="btn btn-large btn-success">success</button>
                        <button class="btn btn-large btn-warning">warning</button>
                        <button class="btn btn-large btn-danger">danger</button>
                        <button class="btn btn-large btn-inverse">inverse</button>
                        </div><!-- end of .grid col-620 -->

                        <div class="grid col-300"><?php _e('Which color CTA button would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[cta_color]" class="regular-text" type="text" name="responsive_theme_options[cta_color]" value="<?php if (!empty($options['cta_color'])) esc_attr_e($options['cta_color']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[cta_color]"><?php _e('Leave blank for default grey or type in button label above.', 'responsive'); ?></label>
                    </div>

                    <div class="grid col-300"><?php _e('CTA Button Size', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <button class="btn btn-mini btn-primary">mini</button>
                        <button class="btn btn-small btn-primary">small</button>
                        <button class="btn btn-large btn-primary">large</button>
                        </div><!-- end of .grid col-620 -->

                             <div class="grid col-300"><?php _e('Which button size would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[cta_btn]" class="regular-text" type="text" name="responsive_theme_options[cta_btn]" value="<?php if (!empty($options['cta_btn'])) esc_attr_e($options['cta_btn']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[cta_btn]"><?php _e('Leave blank for default size.', 'responsive'); ?></label>
                    </div>    
                                
                <?php
                /**
                 * Homepage Call to Action URL
                 */
                ?>
                <div class="grid col-300"><?php _e('Button - Call to Action (URL)', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[cta_url]" class="regular-text" type="text" name="responsive_theme_options[cta_url]" value="<?php if (!empty($options['cta_url'])) esc_attr_e($options['cta_url']); ?>" />
                        <label class="description" for="responsive_theme_options[cta_url]"><?php _e('Enter your call to action URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                
                <?php
                /**
                 * Homepage Call to Action Text
                 */
                ?>
                <div class="grid col-300"><?php _e('Button - Call to Action (Text)', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[cta_text]" class="regular-text" type="text" name="responsive_theme_options[cta_text]" value="<?php if (!empty($options['cta_text'])) esc_attr_e($options['cta_text']); ?>" />
                        <label class="description" for="responsive_theme_options[cta_text]"><?php _e('Enter your call to action text', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <?php
                /**
                 * Homepage Featured Content
                 */
                ?>
                <div class="grid col-300"><?php _e('Featured Content', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <textarea id="responsive_theme_options[featured_content]" class="large-text" cols="50" rows="10" name="responsive_theme_options[featured_content]"><?php if (!empty($options['featured_content'])) esc_attr_e($options['featured_content']); ?></textarea>
                        <label class="description" for="responsive_theme_options[featured_content]"><?php _e('Paste your video or image source', 'responsive'); ?></label>
                        <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>
                    </div><!-- end of .grid col-620 -->
                    
                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->

                      <h3 class="rwd-toggle"><a href="#"><?php _e('Gallery', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block">
                               <?php
                /**
                 * Gallery
                 */
                ?>
                <div class="grid col-300"><?php _e('Disable Filter Buttons?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[filterb]" name="responsive_theme_options[filterb]" type="checkbox" value="1" <?php isset($options['filterb']) ? checked( '1', $options['filterb'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[filterb]"><?php _e('Check to disable', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Disable Project Buttons?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[projectb]" name="responsive_theme_options[projectb]" type="checkbox" value="1" <?php isset($options['projectb']) ? checked( '1', $options['projectb'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[projectb]"><?php _e('Check to disable', 'responsive'); ?></label>
                </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Disable Project Titles?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[projectt]" name="responsive_theme_options[projectt]" type="checkbox" value="1" <?php isset($options['projectt']) ? checked( '1', $options['projectt'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[projectt]"><?php _e('Check to disable', 'responsive'); ?></label>
                </div><!-- end of .grid col-620 -->


                <div class="grid col-300"><?php _e('Button Colors', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <button class="btn btn-large"> </button>
                        <button class="btn btn-large btn-primary">primary</button>
                        <button class="btn btn-large btn-info">info</button>
                        <button class="btn btn-large btn-success">success</button>
                        <button class="btn btn-large btn-warning">warning</button>
                        <button class="btn btn-large btn-danger">danger</button>
                        <button class="btn btn-large btn-inverse">inverse</button>
                        </div><!-- end of .grid col-620 -->

                        <div class="grid col-300"><?php _e('Which color filter buttons would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[fbtn_color]" class="regular-text" type="text" name="responsive_theme_options[fbtn_color]" value="<?php if (!empty($options['fbtn_color'])) esc_attr_e($options['fbtn_color']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[fbtn_color]"><?php _e('Leave blank for default grey or type in button label above.', 'responsive'); ?></label>
                    </div>

                        <div class="grid col-300"><?php _e('Which color project buttons would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[btn_color]" class="regular-text" type="text" name="responsive_theme_options[btn_color]" value="<?php if (!empty($options['btn_color'])) esc_attr_e($options['btn_color']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[btn_color]"><?php _e('Leave blank for default grey or type in button label above.', 'responsive'); ?></label>
                    </div>

                    <div class="grid col-300"><?php _e('Button Size', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <button class="btn btn-mini btn-primary">mini</button>
                        <button class="btn btn-small btn-primary">small</button>
                        <button class="btn btn-large btn-primary">large</button>
                        </div><!-- end of .grid col-620 -->

                             <div class="grid col-300"><?php _e('Which filter button size would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[fbtn_size]" class="regular-text" type="text" name="responsive_theme_options[fbtn_size]" value="<?php if (!empty($options['fbtn_size'])) esc_attr_e($options['fbtn_size']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[fbtn_size]"><?php _e('Leave blank for default size.', 'responsive'); ?></label>
                    </div>

                        <div class="grid col-300"><?php _e('Which project button size would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[btn_size]" class="regular-text" type="text" name="responsive_theme_options[btn_size]" value="<?php if (!empty($options['btn_size'])) esc_attr_e($options['btn_size']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[btn_size]"><?php _e('Leave blank for default size.', 'responsive'); ?></label>
                    </div>

                           <div class="grid col-300"><?php _e('Button Text?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[btn_text]" class="regular-text" type="text" name="responsive_theme_options[btn_text]" value="<?php if (!empty($options['btn_text'])) esc_attr_e($options['btn_text']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[btn_text]"><?php _e('Default is "View Project".', 'responsive'); ?></label>
                    </div>

                             <div class="grid col-300"><?php _e('What size titles would you like?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[title_size]" class="regular-text" type="text" name="responsive_theme_options[title_size]" value="<?php if (!empty($options['title_size'])) esc_attr_e($options['title_size']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[title_size]"><?php _e('1-6. 1=Largest, 6=Smallest. Default is 4.', 'responsive'); ?></label>
                    </div>

                          <div class="grid col-300"><?php _e('How many columns?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[portfolio_column]" class="regular-text" type="text" name="responsive_theme_options[portfolio_column]" value="<?php if (!empty($options['portfolio_column'])) esc_attr_e($options['portfolio_column']); ?>" />
                        <br /><label class="description" for="responsive_theme_options[portfolio_column]"><?php _e('two or three. Leave blank for four.', 'responsive'); ?></label>


                        <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>
                    </div><!-- end of .grid col-620 -->
                    
                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->

            <h3 class="rwd-toggle"><a href="#"><?php _e('Footer', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block">
                <?php
                /**
                 * Footer
                 */
                ?>

                 <div class="grid col-300"><?php _e('Disable Scroll to Top Arrow?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[arrow]" name="responsive_theme_options[arrow]" type="checkbox" value="1" <?php isset($options['arrow']) ? checked( '1', $options['arrow'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[arrow]"><?php _e('Check to disable', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->


                <div class="grid col-300"><?php _e('Copyright Text', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[cr_txt]" class="regular-text" type="text" name="responsive_theme_options[cr_txt]" value="<?php if (!empty($options['cr_txt'])) esc_attr_e($options['cr_txt']); ?>" />
                        <label class="description" for="responsive_theme_options[cr_txt]"><?php _e('Text you would displayed in Footer', 'responsive'); ?></label>              
                    </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Powered by Text', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[power_txt]" class="regular-text" type="text" name="responsive_theme_options[power_txt]" value="<?php if (!empty($options['power_txt'])) esc_attr_e($options['power_txt']); ?>" />
                        <label class="description" for="responsive_theme_options[power_txt]"><?php _e('Text you would displayed in Footer', 'responsive'); ?></label>
                        
                        <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>

                                
                    </div><!-- end of .grid col-620 -->
                    
                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->

            <h3 class="rwd-toggle"><a href="#"><?php _e('Webmaster Tools', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block"> 
                               
                <?php
                /**
                 * Google Site Verification
                 */
                ?>
                <div class="grid col-300"><?php _e('Google Site Verification', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[google_site_verification]" class="regular-text" type="text" name="responsive_theme_options[google_site_verification]" value="<?php if (!empty($options['google_site_verification'])) esc_attr_e($options['google_site_verification']); ?>" />
                        <label class="description" for="responsive_theme_options[google_site_verification]"><?php _e('Enter your Google ID number only', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                
                <?php
                /**
                 * Bing Site Verification
                 */
                ?>
                <div class="grid col-300"><?php _e('Bing Site Verification', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[bing_site_verification]" class="regular-text" type="text" name="responsive_theme_options[bing_site_verification]" value="<?php if (!empty($options['bing_site_verification'])) esc_attr_e($options['bing_site_verification']); ?>" />
                        <label class="description" for="responsive_theme_options[bing_site_verification]"><?php _e('Enter your Bing ID number only', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                
                <?php
                /**
                 * Yahoo Site Verification
                 */
                ?>
                <div class="grid col-300"><?php _e('Yahoo Site Verification', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[yahoo_site_verification]" class="regular-text" type="text" name="responsive_theme_options[yahoo_site_verification]" value="<?php if (!empty($options['yahoo_site_verification'])) esc_attr_e($options['yahoo_site_verification']); ?>" />
                        <label class="description" for="responsive_theme_options[yahoo_site_verification]"><?php _e('Enter your Yahoo ID number only', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                    
                <?php
                /**
                 * Site Statistics Tracker
                 */
                ?>
                <div class="grid col-300"><?php _e('Site Statistics Tracker', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <textarea id="responsive_theme_options[site_statistics_tracker]" class="large-text" cols="50" rows="10" name="responsive_theme_options[site_statistics_tracker]"><?php if (!empty($options['site_statistics_tracker'])) esc_attr_e($options['site_statistics_tracker']); ?></textarea>
                        <label class="description" for="responsive_theme_options[site_statistics_tracker]"><?php _e('Google Analytics, StatCounter, any other or all of them.', 'responsive'); ?></label>
                        <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>
                    </div><!-- end of .grid col-620 -->
                
                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->

            <h3 class="rwd-toggle"><a href="#"><?php _e('Social Icons', 'responsive'); ?></a></h3>
            <div class="rwd-container">
                <div class="rwd-block"> 
                            
                <?php
                /**
                 * Social Media
                 */
                ?>
                <div class="grid col-300"><?php _e('Disable Header Social Icons?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[header_social]" name="responsive_theme_options[header_social]" type="checkbox" value="1" <?php isset($options['header_social']) ? checked( '1', $options['header_social'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[header_social]"><?php _e('Check to disable', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Disable Footer Social Icons?', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[footer_social]" name="responsive_theme_options[footer_social]" type="checkbox" value="1" <?php isset($options['footer_social']) ? checked( '1', $options['footer_social'] ) : checked('0', '1'); ?> />
                        <label class="description" for="responsive_theme_options[footer_social]"><?php _e('Check to disable', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->


                <div class="grid col-300"><?php _e('Twitter', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[twitter_uid]" class="regular-text" type="text" name="responsive_theme_options[twitter_uid]" value="<?php if (!empty($options['twitter_uid'])) esc_attr_e($options['twitter_uid']); ?>" />
                        <label class="description" for="responsive_theme_options[twitter_uid]"><?php _e('Enter your Twitter URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Facebook', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[facebook_uid]" class="regular-text" type="text" name="responsive_theme_options[facebook_uid]" value="<?php if (!empty($options['facebook_uid'])) esc_attr_e($options['facebook_uid']); ?>" />
                        <label class="description" for="responsive_theme_options[facebook_uid]"><?php _e('Enter your Facebook URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Reddit', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[reddit_uid]" class="regular-text" type="text" name="responsive_theme_options[reddit_uid]" value="<?php if (!empty($options['reddit_uid'])) esc_attr_e($options['reddit_uid']); ?>" /> 
                        <label class="description" for="responsive_theme_options[reddit_uid]"><?php _e('Enter your Reddit URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                 <div class="grid col-300"><?php _e('Pinterest', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[pinterest_uid]" class="regular-text" type="text" name="responsive_theme_options[pinterest_uid]" value="<?php if (!empty($options['pinterest_uid'])) esc_attr_e($options['pinterest_uid']); ?>" />
                        <label class="description" for="responsive_theme_options[pinterest_uid]"><?php _e('Enter your Pinterest URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                 <div class="grid col-300"><?php _e('Tumblr', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[tumblr_uid]" class="regular-text" type="text" name="responsive_theme_options[tumblr_uid]" value="<?php if (!empty($options['tumblr_uid'])) esc_attr_e($options['tumblr_uid']); ?>" />
                        <label class="description" for="responsive_theme_options[tumblr_uid]"><?php _e('Enter your Tumblr URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                
                <div class="grid col-300"><?php _e('LinkedIn', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[linkedin_uid]" class="regular-text" type="text" name="responsive_theme_options[linkedin_uid]" value="<?php if (!empty($options['linkedin_uid'])) esc_attr_e($options['linkedin_uid']); ?>" /> 
                        <label class="description" for="responsive_theme_options[linkedin_uid]"><?php _e('Enter your LinkedIn URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                    
                <div class="grid col-300"><?php _e('YouTube', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[youtube_uid]" class="regular-text" type="text" name="responsive_theme_options[youtube_uid]" value="<?php if (!empty($options['youtube_uid'])) esc_attr_e($options['youtube_uid']); ?>" /> 
                        <label class="description" for="responsive_theme_options[youtube_uid]"><?php _e('Enter your YouTube URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->

                <div class="grid col-300"><?php _e('Vimeo', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[vimeo_uid]" class="regular-text" type="text" name="responsive_theme_options[vimeo_uid]" value="<?php if (!empty($options['vimeo_uid'])) esc_attr_e($options['vimeo_uid']); ?>" /> 
                        <label class="description" for="responsive_theme_options[vimeo_uid]"><?php _e('Enter your Vimeo URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                    
                <div class="grid col-300"><?php _e('StumbleUpon', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[stumble_uid]" class="regular-text" type="text" name="responsive_theme_options[stumble_uid]" value="<?php if (!empty($options['stumble_uid'])) esc_attr_e($options['stumble_uid']); ?>" /> 
                        <label class="description" for="responsive_theme_options[youtube_uid]"><?php _e('Enter your StumbleUpon URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                    
                <div class="grid col-300"><?php _e('RSS Feed', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[rss_uid]" class="regular-text" type="text" name="responsive_theme_options[rss_uid]" value="<?php if (!empty($options['rss_uid'])) esc_attr_e($options['rss_uid']); ?>" /> 
                        <label class="description" for="responsive_theme_options[rss_uid]"><?php _e('Enter your RSS Feed URL', 'responsive'); ?></label>
                    </div><!-- end of .grid col-620 -->
                
                <div class="grid col-300"><?php _e('Google+', 'responsive'); ?></div><!-- end of .grid col-300 -->
                    <div class="grid col-620 fit">
                        <input id="responsive_theme_options[google_plus_uid]" class="regular-text" type="text" name="responsive_theme_options[google_plus_uid]" value="<?php if (!empty($options['google_plus_uid'])) esc_attr_e($options['google_plus_uid']); ?>" />  
                        <label class="description" for="responsive_theme_options[google_plus_uid]"><?php _e('Enter your Google+ URL', 'responsive'); ?></label>
                        <p class="submit">
                        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'responsive'); ?>" />
                        </p>
                    </div><!-- end of .grid col-620 -->

                </div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->
            
            </div><!-- end of .grid col-940 -->

            <div class="grid col-940">

            </div>
        </form>
    </div>
    <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function responsive_theme_options_validate($input) {

	// checkbox value is either 0 or 1
	foreach (array(
		'breadcrumb',
		'cta_button',
        'filterb',
        'projectb',
        'projectt',
        'arrow',
        'header_social',
        'footer_social',
        'featuredh'
		) as $checkbox) {
		if (!isset( $input[$checkbox]))
			$input[$checkbox] = null;
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	}
	
    $input['home_headline'] = wp_kses_stripslashes($input['home_headline']);
	$input['home_subheadline'] = wp_kses_stripslashes($input['home_subheadline']);
    $input['home_content_area'] = wp_kses_stripslashes($input['home_content_area']);
    $input['cta_text'] = wp_kses_stripslashes($input['cta_text']);
    $input['cta_url'] = esc_url_raw($input['cta_url']);
    $input['site_logo'] = esc_url_raw($input['site_logo']);
    $input['featured_content'] = wp_kses_stripslashes($input['featured_content']);
    $input['cta_color'] = wp_kses_stripslashes($input['cta_color']);
    $input['cta_btn'] = wp_kses_stripslashes($input['cta_btn']);
    $input['btn_color'] = wp_kses_stripslashes($input['btn_color']);
    $input['fbtn_color'] = wp_kses_stripslashes($input['fbtn_color']);
    $input['btn_text'] = wp_kses_stripslashes($input['btn_text']);
    $input['btn_size'] = wp_kses_stripslashes($input['btn_size']);
    $input['fbtn_size'] = wp_kses_stripslashes($input['fbtn_size']);
    $input['title_size'] = wp_kses_stripslashes($input['title_size']);
    $input['portfolio_column'] = wp_kses_stripslashes($input['portfolio_column']);
    $input['cr_txt'] = wp_filter_post_kses($input['cr_txt']);
    $input['power_txt'] = wp_filter_post_kses($input['power_txt']);
    $input['google_site_verification'] = wp_filter_post_kses($input['google_site_verification']);
    $input['bing_site_verification'] = wp_filter_post_kses($input['bing_site_verification']);
    $input['yahoo_site_verification'] = wp_filter_post_kses($input['yahoo_site_verification']);
    $input['site_statistics_tracker'] = wp_kses_stripslashes($input['site_statistics_tracker']);
	$input['twitter_uid'] = esc_url_raw($input['twitter_uid']);
	$input['facebook_uid'] = esc_url_raw($input['facebook_uid']);
    $input['pinterest_uid'] = esc_url_raw($input['pinterest_uid']);
    $input['tumblr_uid'] = esc_url_raw($input['tumblr_uid']);
    $input['vimeo_uid'] = esc_url_raw($input['vimeo_uid']);
    $input['reddit_uid'] = esc_url_raw($input['reddit_uid']);
    $input['linkedin_uid'] = esc_url_raw($input['linkedin_uid']);
	$input['youtube_uid'] = esc_url_raw($input['youtube_uid']);
	$input['stumble_uid'] = esc_url_raw($input['stumble_uid']);
	$input['rss_uid'] = esc_url_raw($input['rss_uid']);
	$input['google_plus_uid'] = esc_url_raw($input['google_plus_uid']);
	
    return $input;
}