<?php

//Buttons
function sp_buttons( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'  => '#',
    'style' => '',
    'target' => '',
    'size'  => '',
    'poptitle' => '',
    'popcontent' => '',
    ), $atts));

    $content = sp_content_helper($content);
    $target = ($target == 'blank') ? 'target="_blank"' : '';
    $size = ($size <> '') ? "btn-$size " : '';
    $style = ($style <> '') ? "btn-$style" : '';
    $poptitle = ($poptitle <> '') ? "rel='popover' data-original-title='$poptitle'" : '';
    $popcontent = ($popcontent <> '') ? "data-content='$popcontent'" : '';

    $out = '<a ' . $poptitle . '' . $popcontent . '' . $target. ' class="btn ' . $size . '' . $style. '" href="' .$link. '">' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('button', 'sp_buttons');

//Button Group
function sp_buttong( $atts, $content = null ) {
        $content = sp_content_helper($content);
    $output = '
        <div class="btn-group">
            '.do_shortcode($content).'
        </div>';
        
    return $output;
}
add_shortcode('buttongroup', 'sp_buttong');

//Button Dropdown
function sp_buttondd( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'label' => '',
    'style' => '',
    'size' => '',
    ), $atts));

        $content = sp_content_helper($content);
        $style = ($style <> '') ? "btn-$style" : '';
        $size = ($size <> '') ? "btn-$size " : '';

    $output = '
        <div class="btn-group">
            <a class="btn ' . $size . '' . $style. ' dropdown-toggle" data-toggle="dropdown" href="#">' .$label. ' <span class="caret"></span></a>
            <ul class="dropdown-menu">
                '.do_shortcode($content).'
            </ul>
        </div>';
        
    return $output;
}
add_shortcode('buttondd', 'sp_buttondd');

//Button Split Dropdown
function sp_buttonsplit( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'label' => '',
    'style' => '',
    'size' => '',
    'link' => '',
    'target' => '',
    ), $atts));

        $content = sp_content_helper($content);
        $style = ($style <> '') ? "btn-$style" : '';
        $size = ($size <> '') ? "btn-$size " : '';
        $target = ($target == 'blank') ? 'target="_blank"' : '';


    $output = '
        <div class="btn-group">
        <a ' . $target. ' class="btn ' . $size . '' . $style. '" href="'. $link .'">' .$label. ' </a><a class="btn ' . $size . '' . $style. ' dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
            <ul class="dropdown-menu">
                '.do_shortcode($content).'
            </ul>
        </div>';
        
    return $output;
}
add_shortcode('buttonsplit', 'sp_buttonsplit');

//Button Dropdown Link
function sp_ddlink( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link' => '',
    'target' => '',
    ), $atts));

        $content = sp_content_helper($content);
        $target = ($target == 'blank') ? 'target="_blank"' : '';

    $output = '
        <li><a ' . $target. ' href="'. $link .'">'.do_shortcode($content).'</a></li>';
        
    return $output;
}
add_shortcode('ddlink', 'sp_ddlink');

//Dropdown Divider
function sp_divider( $atts, $content = null ) {


    $output = '
        <li class="divider"></li>';
        
    return $output;
}
add_shortcode('divider', 'sp_divider');


//Carousel
function sp_carousel( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'name' => '',
    ), $atts));

        $content = sp_content_helper($content);

    $output = '
        <div id="'.$name.'" class="carousel">
            <div class="carousel-inner">
            '.do_shortcode($content).'
            </div>
            <a class="carousel-control left" href="#'.$name.'" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#'.$name.'" data-slide="next">&rsaquo;</a>
        </div>';
        
    return $output;
}
add_shortcode('carousel', 'sp_carousel');

//Single Carousel Image
function sp_cimage( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'first' => '',
    'title' => '',
    'link' => '',
    'caption' => '',
    ), $atts));

    $content = sp_content_helper($content);
    $first = ($first == 'yes') ? 'active' : '';
    $content = ($content <> '') ? "<div class='carousel-caption'><h4>$title</h4><p>$content</p></div></div>" : '';

    $out = '<div class="item '  .$first. '"><img src="'  .$link. '">' .do_shortcode($content).'';

    return $out;
}
add_shortcode('cimage', 'sp_cimage');

//Accordion
function sp_accordion( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'name' => '',
    ), $atts));

        $content = sp_content_helper($content);

    $output = '
        <div id="'.$name.'" class="accordion">
            '.do_shortcode($content).'
        </div>';
        
    return $output;
}
add_shortcode('accordion', 'sp_accordion');

//Accordion Content
function sp_caccordion( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'name' => '',
    'heading' => '',
    'number' => '',
    'open' => '',
    ), $atts));

        $content = sp_content_helper($content);
        $open = ($open == 'yes') ? 'in' : '';

    $output = '
       
    <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$name.'" href="#collapse'.$number.'">'. $heading .'</a>
            </div>
        <div id="collapse'.$number.'" class="accordion-body collapse ' .$open. '">
            <div class="accordion-inner"> 
            '.do_shortcode($content).'
            </div>
        </div>
    </div>

  ';
        
    return $output;
}
add_shortcode('caccordion', 'sp_caccordion');

//Tabs
function sp_tabs( $atts, $content = null ) {
        extract(shortcode_atts(array(
        'location' => '',
        ), $atts));

        $content = sp_content_helper($content);

    $output = '
        <div class="tabbable ' .$location. '">
            '.do_shortcode($content).'
        </div>';
        
    return $output;
}
add_shortcode('tabs', 'sp_tabs');

//Tab Title Section
function sp_titlesection( $atts, $content = null ) {
        extract(shortcode_atts(array(
        'type' => '',
        ), $atts));

        $content = sp_content_helper($content);

    $output = '
        <ul class="nav nav-' .$type. '">
    '.do_shortcode($content).'
  </ul>';
        
    return $output;
}
add_shortcode('titlesection', 'sp_titlesection');

//Tab Titles
function sp_tabtitle( $atts, $content = null ) {
         extract(shortcode_atts(array(
    'active' => '',
    'number' => '',
    ), $atts));

        $content = sp_content_helper($content);
        $active = ($active == 'yes') ? "class='active'" : '';

    $output = '
     <li ' .$active. '><a href="#' .$number. '" data-toggle="tab">'.do_shortcode($content).'</a></li>';
        
    return $output;
}
add_shortcode('tabtitle', 'sp_tabtitle');

//Tab Title Section
function sp_contentsection( $atts, $content = null ) {
   
        $content = sp_content_helper($content);

    $output = '
        <div class="tab-content">
    '.do_shortcode($content).'
  </div>';
        
    return $output;
}
add_shortcode('contentsection', 'sp_contentsection');

//Tab Content
function sp_tabcontent( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'active' => '',
    'number' => '',
    ), $atts));

        $content = sp_content_helper($content);
        $active = ($active == 'yes') ? "active" : '';

    $output = '
     
    <div class="tab-pane ' .$active. '" id="' .$number. '">
      <p>'.do_shortcode($content).'</p>
    </div>';
        
    return $output;
}
add_shortcode('tabcontent', 'sp_tabcontent');

//Icons
function sp_icons( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'style' => '',
    'color'  => '',
    ), $atts));

    $color = ($color <> '') ? "icon-$color" : '';

    $out = '<i class="icon-' . $style . ' ' . $color. '"></i>';

    return $out;
}
add_shortcode('icon', 'sp_icons');

//Heading
function sp_heading( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'size' => '',
    'small'  => '',
    ), $atts));

    $small = ($small <> '') ? "<small>$small</small>" : '';

    $out = '<h'. $size . '>'.do_shortcode($content). ''. $small .'</h'. $size . '>';

    return $out;
}
add_shortcode('heading', 'sp_heading');

//Code
function sp_codes( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'scroll' => '',
    ), $atts));

    $scroll = ($scroll == 'yes') ? 'class="pre-scrollable"' : '';

    $out = '<pre ' . $scroll . '>'.do_shortcode($content). '</pre>';

    return $out;
}
add_shortcode('codes', 'sp_codes');

//Single line of Code
function sp_code( $atts, $content = null ) {
    return '<code>'.$content.'</code>';
}
add_shortcode('code', 'sp_code');

//Labels
function sp_labels( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'style' => '',
    ), $atts));

    $out = '<span class="label ' . $style . '">' .do_shortcode($content). '</span>';

    return $out;
}
add_shortcode('label', 'sp_labels');

//Badges
function sp_badges( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'style' => '',
    ), $atts));

    $out = '<span class="badge ' . $style . '">' .do_shortcode($content). '</span>';

    return $out;
}
add_shortcode('badge', 'sp_badges');


//Progress Bars
function sp_bars( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'width' => '',
    'strip' => '',
    'animate' => '',
    'style' => '',
    ), $atts));

    $strip = ($strip == 'yes') ? 'progress-striped' : '';
    $animate = ($animate == 'yes') ? 'active' : '';
    $style = ($style <> '') ? "progress-$style" : '';

    $out = '<div class="progress ' . $style . ' ' . $strip . ' ' . $animate . '"><div class="bar" style="width:' . $width . '%">' .do_shortcode($content). '</div></div>';

    return $out;
}
add_shortcode('bar', 'sp_bars');


//Well
function sp_well( $atts, $content = null ) {
    return '<div class="well">'.$content.'</div>';
}
add_shortcode('well', 'sp_well');

//Alerts
function sp_alerts( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'type' => '',
    'heading' => '',
    ), $atts));

    $type = ($type <> '') ? "alert-$type" : '';
    $heading = ($heading <> '') ? "<h4 class='alert-heading'>$heading</h4>" : '';

    $out = '<div class="alert alert-block ' . $type .'"><a class="close" data-dismiss="alert">×</a>' . $heading . '<p>' .do_shortcode($content). '</p></div>';

    return $out;
}
add_shortcode('alert', 'sp_alerts');

//Tooltips
function sp_tooltips( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'tip' => '',
    ), $atts));

    $out = '<a href="#" rel="tooltip" title="' . $tip .'">' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('tooltip', 'sp_tooltips');

//Popovers
function sp_popovers( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'title' => '',
    'content' => '',
    ), $atts));

    $out = '<a href="#" rel="popover" title="' . $title .'" data-content="' . $content . '">' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('popover', 'sp_popovers');

//Table
function sp_table( $atts ) {
    extract( shortcode_atts( array(
        'cols' => 'none',
        'data' => 'none',
        'strip' => '',
        'border' => '',
        'condense' => '',
    ), $atts ) );

    $strip = ($strip == 'yes') ? 'table-striped' : '';
    $border = ($border == 'yes') ? 'table-bordered' : '';
    $condense = ($condense == 'yes') ? 'table-condensed' : '';

    $cols = explode(',',$cols);
    $data = explode(',',$data);
    $total = count($cols);
    $output = '<table class="table ' . $strip . ' ' . $border . ' ' . $condense . '"><tr>';
    foreach($cols as $col):
        $output .= '<th>'. $col . '</th>';
    endforeach;
    $output .= '</tr><tr>';
    $counter = 1;
    foreach($data as $datum):
        $output .= '<td>'. $datum .'</td>';
        if($counter%$total==0):
            $output .= '</tr>';
        endif;
        $counter++;
    endforeach;
    $output .= '</table>';
    return $output;
}
add_shortcode( 'table', 'sp_table' );

//Columns
function sp_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'sp_one_third');

function sp_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'sp_one_third_last');

function sp_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'sp_two_third');

function sp_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'sp_two_third_last');

function sp_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'sp_one_half');

function sp_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'sp_one_half_last');

function sp_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'sp_one_fourth');

function sp_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'sp_one_fourth_last');

function sp_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'sp_three_fourth');

function sp_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'sp_three_fourth_last');

function sp_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'sp_one_fifth');

function sp_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'sp_one_fifth_last');

function sp_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'sp_two_fifth');

function sp_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'sp_two_fifth_last');

function sp_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'sp_three_fifth');

function sp_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'sp_three_fifth_last');

function sp_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'sp_four_fifth');

function sp_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'sp_four_fifth_last');

function sp_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'sp_one_sixth');

function sp_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'sp_one_sixth_last');

function sp_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'sp_five_sixth');

function sp_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'sp_five_sixth_last');

//Remove p and br tags
function sp_formatter($content) {
    $new_content = '';

    /* Matches the contents and the open and closing tags */
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';

    /* Matches just the contents */
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

    /* Divide content into pieces */
    $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    /* Loop over pieces */
    foreach ($pieces as $piece) {
        /* Look for presence of the shortcode */
        if (preg_match($pattern_contents, $piece, $matches)) {

            /* Append to content (no formatting) */
            $new_content .= $matches[1];
        } else {

            /* Format and append to content */
            $new_content .= wptexturize(wpautop($piece));
        }
    }

    return $new_content;
}

function sp_delete_htmltags($content,$paragraph_tag=false,$br_tag=false){   
    #$content = preg_replace('#<\/p>(\s)*<p>$|^<\/p>(\s)*<p>#', '', trim($content));
    $content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
    
    $content = preg_replace('#<br \/>#', '', $content);
    
    if ( $paragraph_tag ) $content = preg_replace('#<p>|</p>#', '', $content);
        
    return trim($content);
}

function sp_content_helper($content,$paragraph_tag=false,$br_tag=false){
    return sp_delete_htmltags( do_shortcode(shortcode_unautop($content)), $paragraph_tag, $br_tag );
}

function custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
    </style>';
}
add_action('login_head', 'custom_login_logo');

add_filter( 'login_headerurl', 'my_custom_login_url' );
function my_custom_login_url($url) {
    return 'http://strappress.com';
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter( 'the_content', 'wpautop' , 12);
add_filter('the_content', 'sp_formatter', 99);
add_filter('widget_text', 'sp_formatter', 99);

//widget support
add_filter('widget_text', 'do_shortcode')
?>