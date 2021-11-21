<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage forwebdev-theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

  <div class="main-content row">
    <div class="col-xl-12 col-lg-12 col-xs-12">
      <section class="content">
        <h2 class="content_header"><?= function_exists('pll__') ? pll__('error_404') : 'Error 404'?></h2>
        <!--/.content_header-->
        <div class="content-wrapper">
          <section>
            <h3 class="content_post-block__head-mobile"><?= function_exists('pll__') ? pll__('page_not_found') : 'Sorry but such page is not found'?></h3>
            <h3 class="content_post-block__head"><?= function_exists('pll__') ? pll__('page_not_found') : 'Sorry but such page is not found'?></h3>
            <img class="img404" src="<?= get_template_directory_uri() ?>/assets/img/404.jpg" alt="">
          </section>
        </div>
        <!--/.content-wrapper-->  
      </section>
      <!--/.content-->
    </div>
    <!-- /.col-6 pl pr -->
  </div>
</main>

<?php get_footer();
