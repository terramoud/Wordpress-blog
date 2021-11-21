        <footer class="footer">
        <div class="footer-wrapper">
          <div class="footer-content row m0">
            <section class="col-xs-12 col-md-6 col-lg-3 d-xs-none footer-content_category">
              <article class="footer_categories">
                <h6 id="category" class="footer_menu__header"><?= function_exists('pll__') ? pll__('footer_categories') : 'Categories'?></h6>
                <ul class="footer_contact-me">
                  <?php             
                    wp_nav_menu( array(
                      'theme_location'  => 'footer_menu',
                      'container'       => '',
                      'menu_class'      => '', 
                      'depth'           => 1,
                      'items_wrap'      => '%3$s',
                      'walker'          => new Footer_custom_Walker_Nav_Menu,
                    ) ); 
                  ?>
                </ul>
              </article> 
            </section>

            <?php
              $lang_slug = function_exists('pll_current_language') ? pll_current_language() : "en";  
              $page_title = 'footer_' . $lang_slug;
              $current_footer_page = get_page_by_title($page_title);
            ?>
            <section class="col-xs-12 col-md-6 col-lg-3">
              <article class="footer_about-blog">
                <h6 id="about-blog" class="footer_about-blog__header"><?= function_exists('pll__') ? pll__('about_blog') : 'About blog'?></h6>
                <p class="footer_about-blog__description"><?php the_field('about-blog', $current_footer_page) ?></p>
              </article>
            </section>

            <section class="col-xs-12 col-md-6 col-lg-3">
              <section class="footer_contacts-wrapper">
                <h6 id="contact-me" class="footer_contacts-wrapper__header"><?= function_exists('pll__') ? pll__('contacts') : 'Contacts'?></h6>
                <ul class="footer_contact-me">
                  <?php    
                    $field_names = array('autor_blog','autor_blog_icon','mobile_number', 'mobile-icon', 'email', 'mobile_icon_email', 'rss', 'rss-icon');

                    for ($i=0; $i < count($field_names); $i=$i+2) { 

                      if (get_field($field_names[$i], $current_footer_page)) {
                        echo ('<li><i class="fa ' . get_field($field_names[$i+1], $current_footer_page) . '" aria-hidden="true"></i> <span class="footer_contact-me__list">' . get_field($field_names[$i], $current_footer_page) . '</span></li>');
                      } 

                    }

                    wp_nav_menu( 
                      array(
                        'theme_location'  => 'footer_contact-me',
                        'container' => '',
                        'menu_class'      => '', 
                        'depth'           => 1,
                        'items_wrap' => '%3$s',
                        'walker'          => new Footer_custom_Walker_Nav_Menu,
                      ) 
                    ); 
                  ?>
                </ul> 
              </section>
            </section>

            <section class="col-xs-12 col-md-6 col-lg-3">
              <article class="about-me">
                <h6 class="about-me_header"><?= function_exists('pll__') ? pll__('about_me') : 'About me'?></h6>
                <p class="about-me_description"><?php the_field('about_me', $current_footer_page) ?></p>
                <figure class="tag-cloud"><?= get_the_post_thumbnail( $current_footer_page, 'full', array('class' => 'tag-cloud_image') ); ?></figure>
              </article>
            </section>
          </div>
        </div>
        <div class="copyright"><?= function_exists('pll__') ? pll__('copyright') : '&#169; H. Pupkin, 2000—2005, all right reserved'?></div>
      </footer>

      <a class="up" href="#top">
        <i class="fa fa-chevron-up"></i>
      </a>

    </div>
    
    <!-- /.wrapper -->
    <?php wp_footer(); ?>
  </body>
</html>