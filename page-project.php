<?php
/**
 Template Name: Project
 *
 *
 * @file           page.php
 * @package        StrapPress 
 * @author         Brad Williams
 * @copyright      2003 - 2012 Brag Interactive
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/page-work.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

        <div id="content" class="grid col-940">

            <?php $options = get_option('responsive_theme_options');  ?>

            <?php $btn_color = 'btn-'.$options['btn_color']; 
            $btn_size = 'btn-'.$options['btn_size'];
            ?>

            <?php if ($options['filterb'] == 0): ?>
            <?php
                 $terms = get_terms("tagportfolio");
                 $count = count($terms);
                 $fbtn_color = 'btn-'.$options['fbtn_color'];
                 $fbtn_size = 'btn-'.$options['fbtn_size'];
                 echo '<div id="portfolio-filter" class="btn-group" data-toggle="buttons-radio">';
                 echo '<a class="btn '.$fbtn_color.' '.$fbtn_size.' active" href="#all" title="">All</a>';
                 if ( $count > 0 ){

                        foreach ( $terms as $term ) {

                            $termname = strtolower($term->name);
                            $termname = str_replace(' ', '-', $termname);
                            echo '<a class="btn '.$fbtn_color.' '.$fbtn_size.'" href="#'.$termname.'" title="" rel="'.$termname.'">'.$term->name.'</a>';
                        }
                 }
                 echo "</div>";
            ?>
             <?php endif; ?>

            <?php
                // get portfolio column count
                if($options['portfolio_column'] != '') {
                $portfolio_count = $options['portfolio_column'];
                } else { $portfolio_count = 'four'; }

                 // title size
                if($options['title_size'] != '') {
                $tit_size = $options['title_size'];
                } else { $tit_size = '4'; }
            ?>

            <?php
                $loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
                $count =0;
            ?>

            <div id="portfolio-wrapper portfolio-<?php echo $portfolio_count ?>-column">
                <ul id="portfolio-list">

                <?php if ( $loop ) : 

                    while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <?php
                        $terms = get_the_terms( $post->ID, 'tagportfolio' );

                        if ( $terms && ! is_wp_error( $terms ) ) :
                            $links = array();

                            foreach ( $terms as $term )
                            {
                                $links[] = $term->name;
                            }
                            $links = str_replace(' ', '-', $links);
                            $tax = join( " ", $links );
                        else :
                            $tax = '';
                        endif;
                        ?>

                        <?php $infos = get_post_custom_values('_url'); ?>

                        <li class="portfolio-item <?php echo strtolower($tax); ?> all">
                            <div class="thumb"><a class="thumbnail" href="<?php the_permalink() ?>"><?php the_post_thumbnail('portfolio-'. $portfolio_count .'-column'); ?></a></div>
                            <?php if ($options['projectt'] == 0): ?>
                            <h<?php echo $tit_size ?>><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h<?php echo $tit_size ?>>
                            <?php endif; ?>
                            <?php if ($options['projectb'] == 0): ?>
                            <p class="project-links"><a class="btn <?php echo ($btn_color); ?> <?php echo ($btn_size); ?>" href="<?php the_permalink() ?>"> <?php
                                if($options['btn_text']) { ?>
                                <?php echo $options['btn_text']; ?>
                                <?php } else { ?>
                               View Project
                              <?php } ?>  <i class="icon-chevron-right icon-white"></i></a></p>
                            <?php endif; ?>
                        </li>

                    <?php endwhile; else: ?>

                    <li class="error-not-found">Sorry, no portfolio entries for while.</li>

                <?php endif; ?>

                </ul>

                <div class="clearboth"></div>

            </div> <!-- end #portfolio-wrapper-->

            <script>
                jQuery(document).ready(function() {
                    jQuery("#portfolio-list").filterable();
                });
            </script>

      
        </div><!-- end of #content -->

<?php get_footer(); ?>