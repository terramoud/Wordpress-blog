<?php 

  function forwebdev_styles() {
  	//wp_enqueue_style( 'webfont.ttf', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.ttf');
  	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
  	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css');
  	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/jquery-ui/jquery-ui.min.css');
  	wp_enqueue_style( 'main', get_stylesheet_uri() );
  }

  function jquery_lib() {
  	wp_deregister_script('jquery');
  	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js', false, null, true);
  	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js', false, null, true);
  	wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/assets/jquery-ui/jquery-ui.min.js', array('jquery'), null, true);
  	wp_enqueue_script('slideout', get_template_directory_uri() . '/assets/js/slideout.min.js', array('jquery'), null, true);
  	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), null, true);
  }

  add_action( 'wp_enqueue_scripts', 'forwebdev_styles' );
  add_action( 'wp_enqueue_scripts', 'jquery_lib' );

  function add_defer_attribute($tag, $handle) {
     // add script handles to the array below
     $scripts_to_defer = array('jquery-ui', 'slideout', 'main');
     
     foreach($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
           return str_replace(' src', ' defer="defer" src', $tag);
        }
     }
     return $tag;
  }
  add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

  function forwebdev_setup()
  {
    load_theme_textdomain( 'forwebdev' );
  }
  add_action( 'after_setup_theme', 'forwebdev_setup' );

  add_theme_support( 'html5', array( 'search-form' ) );
  add_theme_support( 'custom-logo' );
  add_theme_support( 'post-thumbnails' );
  //add_theme_support('menus');
  
  add_filter( 'get_custom_logo', 'filter_function_name_5529', 10, 2 );
  function filter_function_name_5529( $html, $blog_id ){
  	$html = str_replace( 'custom-logo', 'header-logo', $html );
  	return $html;
  }

  /**
   * Enable ACF 5 early access
   * Requires at least version ACF 4.4.12 to work
   */
  define('ACF_EARLY_ACCESS', '5');

  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "header_sidebar-right");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "release_date");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "process_of_writing");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "new_posts_temporarily_unavailable");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "category_name");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "added_post");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "read_more");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "count_views");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "prev");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "next");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "footer_categories");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "about_blog");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "contacts");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "about_me");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "search_by");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "nothing_found");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "search_form");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "search button");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "navigation_menu_name");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "current_online");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "error_404");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "page_not_found");
  !function_exists('pll_register_string') ?: pll_register_string( 'ForWebDev', "copyright");

  register_nav_menus(
  	array(
  		'head_menu'		 					=> 'Header site',
  		'mobile_menu' 					=> 'Adaptive navigation menu',
  		'mobile_menu-Front-end' => 'Adaptive menu Front-end',
  		'mobile_menu-Back-end' 	=> 'Adaptive menu Back-end',
  		'footer_menu'				 		=> 'Site Footer',
  		'footer_contact-me' 		=> 'Contacts'
  	)
  );

  function icon_fontawesome($string)
  {
    $reg = '/^\\S*\\/([^\\/]+)\\//';
    preg_match($reg, $string, $matches);
    return $matches[1];
  }

  class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
        $indent = str_repeat("\t", $depth);
        //$output .= "\n$indent<ul class=\"sub-menu\">\n";

        // Change sub-menu to dropdown menu
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      // Most of this code is copied from original Walker_Nav_Menu
      global $wp_query, $wpdb;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';

      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

      $has_children = $wpdb->get_var("SELECT COUNT(meta_id)
                              FROM wp_postmeta
                              WHERE meta_key='_menu_item_menu_item_parent'
                              AND meta_value='".$item->ID."'");

      $output .= $indent . '<li' . $id . $value . $class_names .'>';
      $queried_object = get_queried_object();
      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
      // These lines adds your custom class and attribute

      $attributes .= ' class="' . ( $depth > 0 ? 'top-nav_menu__submenu' : 'top-nav_menu__list' ) . '"';
      
      // Add the icon tag
      $icon  = ! empty( get_field('icon', $item) ) ? '<i class="fa '. get_field('icon', $item) .'" aria-hidden="true"></i>&nbsp;' : '';

      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'>';
      
      $item_output .= $args->link_before . $icon .apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

      // Add the caret if menu level is 0
      if ( $depth === 0 && $has_children > 0  ) {
          $item_output .= '&nbsp;<i class="fa fa-caret-down fs" aria-hidden="true"></i>';
      }

      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

  }

  class Mobile_custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array(), $id = 0 ) {
        $indent = str_repeat("\t", $depth);
        //$output .= "\n$indent<ul class=\"sub-menu\">\n";

        // Change sub-menu to dropdown menu
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      // Most of this code is copied from original Walker_Nav_Menu
      global $wp_query, $wpdb;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';

      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

      $has_children = $wpdb->get_var("SELECT COUNT(meta_id)
                              FROM wp_postmeta
                              WHERE meta_key='_menu_item_menu_item_parent'
                              AND meta_value='".$item->ID."'");

      $output .= $indent . '<li' . $id . $value . $class_names .'>';

      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

      // These lines adds your custom class and attribute

      $icon  = ! empty( get_field('icon', $item) ) ? '<i class="fa '. get_field('icon', $item) .'" aria-hidden="true"></i>&nbsp;' : '';

      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'>';
      // Add the icon tag
      $item_output .=   $args->link_before . $icon .apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

  }

  class Footer_custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array(), $id = 0 ) {
        $indent = str_repeat("\t", $depth);
        //$output .= "\n$indent<ul class=\"sub-menu\">\n";

        // Change sub-menu to dropdown menu
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      // Most of this code is copied from original Walker_Nav_Menu
      global $wp_query, $wpdb;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';

      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

      $has_children = $wpdb->get_var("SELECT COUNT(meta_id)
                              FROM wp_postmeta
                              WHERE meta_key='_menu_item_menu_item_parent'
                              AND meta_value='".$item->ID."'");

      $output .= $indent . '<li' . $id . $value . $class_names .'>';

      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

      // These lines adds your custom class and attribute

      if ($args->theme_location == "footer_contact-me")
      {
        $attributes .= ' class="footer_contact-me__list"';

        $icon  = ! empty( get_field('icon', $item) ) ? '<i class="fa '. get_field('icon', $item) .'" aria-hidden="true"></i>&nbsp;' : '';
      } else {
      	$attributes .= ' class="footer_menu__list"';
      	$icon = "";
      }
   
      $item_output = $args->before;
      $item_output .= $icon . '<a'. $attributes .'>';
      // Add the icon tag
      $item_output .=   $args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

  }

  class about_me_custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array(), $id = 0 ) {
        $indent = str_repeat("\t", $depth);
        //$output .= "\n$indent<ul class=\"sub-menu\">\n";

        // Change sub-menu to dropdown menu
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
      // Most of this code is copied from original Walker_Nav_Menu
      global $wp_query, $wpdb;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';

      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

      $has_children = $wpdb->get_var("SELECT COUNT(meta_id)
                              FROM wp_postmeta
                              WHERE meta_key='_menu_item_menu_item_parent'
                              AND meta_value='".$item->ID."'");

      $output .= $indent . '<li' . $id . $value . $class_names .'>';

      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

      // These lines adds your custom class and attribute

      if ($args->theme_location == "footer_contact-me")
      {
        $attributes .= 'class="data-my"';
        
        $icon  = ! empty( get_field('icon', $item) ) ? '<i class="fa '. get_field('icon', $item) .'" aria-hidden="true"></i>' : '';
      }
   
      $item_output = $args->before;
      $item_output .= $icon . '<a'. $attributes .'>';
      // Add the icon tag
      $item_output .=   $args->link_before .apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

  }
  						
  $content = apply_filters( 'the_content', $content );
  $content = str_replace( ']]>', ']]&gt;', $content );

  add_filter( 'excerpt_length', function(){
  	return 50;
  } );

  add_filter('excerpt_more', function($more) {
  	return '...';
  });

  function limiter_lenght_excerts($symbolsNumber = 100)
  {
    $reg = '/[\\. ]*[\\.\\,]+ *[\\t\\n\\r]*$/';
    $string = strip_tags(mb_substr(get_the_excerpt($post->ID), 0, $symbolsNumber));
    echo preg_replace($reg, '', $string) . "...";  
  }

  // is removing h2 from navigation template
  add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
  function my_navigation_template( $template, $class ){

    return '
            <nav class="navigation %1$s" role="navigation">
              <div class="nav-links">%3$s</div>
            </nav>    
           ';
  }

  function js_variables(){
      $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
        'is_mobile' => wp_is_mobile(),
        'prevPageText' => function_exists('pll__') ? pll__('prev') : 'Previous',
        'nextPageText' => function_exists('pll__') ? pll__('next') : 'Next'
          // There are usually some other variables here
      );
      echo '<script type="text/javascript" defer="defer">window.wp_data = ' . json_encode($variables) . '; </script>';
  }
  add_action('wp_head','js_variables');

  function responsive_sorting_by_posts(){   
    global $post;
    if (isset($_POST['countPost']) && is_numeric($_POST['countPost'])) $count_popular_namberposts = (int)$_POST['countPost']; 
    $lang_slug = function_exists('pll_current_language') ? pll_current_language() : "";
    $category_slug = ($lang_slug) ? 'all-categories_'. $lang_slug : "all-categories_en";
    $args = array( 
      'posts_per_page'  => $count_popular_namberposts,
      'category_name' => $category_slug,
      'orderby'         => 'meta_value_num',
      'order'           => 'DESC',
      'meta_key'        => 'views',
      'post_type'       => 'post',
      'lang'            => $lang_slug 
    );

    $postslist = new WP_Query( $args );
     
    if ( $postslist->have_posts() ) : 
      while ( $postslist->have_posts() ) : 
        $postslist->the_post(); 
        $terms = get_the_terms($post->ID, 'category'); 
        //get_template_part( 'template-parts/post/content', 'sidebar' );
        include( locate_template( 'template-parts/post/content-sidebar.php' ) );     
      endwhile; 
      wp_reset_postdata(); 
    endif; 

    wp_die(); 
  }
  add_action( 'wp_ajax_postDisplaySetting', 'responsive_sorting_by_posts' ); // wp_ajax_{ЗНАЧЕНИЕ ПАРАМЕТРА ACTION!!}
  add_action( 'wp_ajax_nopriv_postDisplaySetting', 'responsive_sorting_by_posts' );  // wp_ajax_nopriv_{ЗНАЧЕНИЕ ACTION!!}

  /* Count number of page views
  ---------------------------------------------------------- */
  add_action('wp_head', 'kama_postviews');
  function kama_postviews() {

    /* ------------ Settings -------------- */
    $meta_key       = 'views';  // The key of meta field where will be being writes number of views
    $who_count      = 0;        // Whose visits count? 0 - All. 1 - Only guests. 2 - Only registered users.
    $exclude_bots   = 0;        // exclude bots, spiders, and other ? 0 - no. 1 - yes.

    global $user_ID, $post;
    if(is_singular()) {
      $id = (int)$post->ID;
      static $post_views = false;
      if($post_views) return true; // to 1 time per stream
      $post_views = (int)get_post_meta($id,$meta_key, true);
      $should_count = false;
      switch( (int)$who_count ) {
        case 0: $should_count = true;
          break;
        case 1:
          if( (int)$user_ID == 0 )
            $should_count = true;
          break;
        case 2:
          if( (int)$user_ID > 0 )
            $should_count = true;
          break;
      }
      if( (int)$exclude_bots==1 && $should_count ){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - all are equal Mozilla
        $bot = "Bot/|robot|Slurp/|yahoo";
        if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
          $should_count = false;
      }

      if($should_count)
        if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
    }
    return true;
  }

  ## leave user on the same page with entering the wrong login/password in form authorisation  wp_login_form()
  add_action( 'wp_login_failed', 'my_front_end_login_fail' );
  function my_front_end_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // whence was have come request

    // If this is a referrer and this is not a page wp-login.php we are redirecting and will have added request parameter ?login=wp_login_failed
    if( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( add_query_arg('login', 'failed', $referrer ) );  
      exit;
    }
  }

  show_admin_bar(false);

  /**
   * Redirect Registration Page
   */
/*  add_action('init', 'prevent_wp_login');

  function prevent_wp_login() {
    // WP tracks the current page - global the variable to access it
    global $pagenow;
    // Check if a $_GET['action'] is set, and if so, load it into $action variable
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';
    // Check if we're on the login page, and ensure the action is not 'logout'
    if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
    	if ( current_user_can('manage_options') ) {
    		
    	} else {
        // Load the home page url
        $page = get_bloginfo('url');
        // Redirect to the home page
        wp_redirect($page);
        // Stop execution to prevent the page loading for any reason
        exit();
    	}
    }
  }*/






