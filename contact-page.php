<?php
/**
 * Contact
 *
   Template Name:  Contact Page
 *
 * @file           content-sidebar-page.php
 * @package        StrapPress 
 * @author         Brad Williams 
 * @copyright      2012 Brag Interactive
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/content-right-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
?>

<?php
if(isset($_POST['submitted'])) {
    if(trim($_POST['contactName']) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }

    if(trim($_POST['email']) === '')  {
        $emailError = 'Please enter your email address.';
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }

    if(trim($_POST['comments']) === '') {
        $commentError = 'Please enter a message.';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }

    if(!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = '[StrapPress] From '.$name;
        $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
        $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>

<?php get_header(); ?>

        <div id="content" class="grid col-620">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
        <?php $options = get_option('responsive_theme_options'); ?>
		<?php if ($options['breadcrumb'] == 0): ?>
		<?php echo responsive_breadcrumb_lists(); ?>
        <?php endif; ?>
        
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
 
               
                
                <div class="post-entry">
                    <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                       <?php custom_link_pages(array(
                            'before' => '<div class="pagination"><ul>' . __(''),
                            'after' => '</ul></div>',
                            'next_or_number' => 'next_and_number', # activate parameter overloading
                            'nextpagelink' => __('&rarr;'),
                            'previouspagelink' => __('&larr;'),
                            'pagelink' => '%',
                            'echo' => 1 )
                            ); ?>

                             <?php if(isset($emailSent) && $emailSent == true) { ?>
                            <div class="alert alert-success">
                                <p>Thanks, your email was sent successfully.</p>
                            </div>
                        <?php } else { ?>

                            <?php if(isset($hasError) || isset($captchaError)) { ?>
                                <div class="alert alert-error">
                                    <a class="close" data-dismiss="alert">×</a>
                                    <h4 class="alert-heading">Sorry, an error occured.</h4>
                                <p class="error">Please try again!<p>
                                </div>
                            <?php } ?>

                    <form action="<?php the_permalink(); ?>" id="contactForm" method="post" class="form-horizontal">
                        <fieldset>
                        <div class="control-group">
                                <label class="control-label" for="contactName">Name:</label>
                            <div class="controls">
                                <input class="input-xlarge" type="text" name="contactName" id="contactName" value="" />
                                <?php if($nameError != '') { ?>
                                    <p><span class="error"><?=$nameError;?></span></p>
                                <?php } ?>
                            </div>
                           </div>
                           <div class="control-group">
                                <label class="control-label" for="email">Email:</label>
                            <div class="controls">
                                <input type="text" name="email" id="email" value="" />
                                <?php if($emailError != '') { ?>
                                    <p><span class="error"><?=$emailError;?></span></p>
                                <?php } ?>
                             </div>
                           </div>
                            <div class="control-group">
                                <label class="control-label" for="commentsText">Message:</label>
                            <div class="controls">
                                <textarea name="comments" id="commentsText" rows="20" cols="30"></textarea>
                                 <?php if($commentError != '') { ?>
                                    <p><span class="error"><?=$commentError;?></span></p>
                                <?php } ?>
                             </div>
                           </div>
                           <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Send email</button>
                           </div>
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                    </fieldset>
                    </form>
                    <?php } ?>

                </div><!-- end of .post-entry -->
                
                <?php if ( comments_open() ) : ?>
                <div class="post-data">
				    <?php the_tags(__('Tagged with:', 'responsive') . ' ', ', ', '<br />'); ?> 
                    <?php the_category(__('Posted in %s', 'responsive') . ', '); ?> 
                </div><!-- end of .post-data -->
                <?php endif; ?>             
            
            <div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div> 
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
            
            
        <?php endwhile; ?> 
        
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div class="navigation">
			<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ) ); ?></div>
            <div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ) ); ?></div>
		</div><!-- end of .navigation -->
        <?php endif; ?>

	    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'responsive'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'responsive'); ?></p>
        <h6><?php _e( 'You can return', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'responsive' ); ?>"><?php _e( '&#9166; Home', 'responsive' ); ?></a> <?php _e( 'or search for the page you were looking for', 'responsive' ); ?></h6>
        <?php get_search_form(); ?>

<?php endif; ?>  
      
        </div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>