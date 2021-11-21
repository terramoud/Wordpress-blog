<?php $multy_language = function_exists('pll__') ? pll__('search_form') : 'Search …'?>
<?php $multy_submit = function_exists('pll__') ? pll__('search button') : 'Search' ?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( $multy_language, 'placeholder' ) ?>" value="<?= get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  </label>
  <input type="submit" class="search-submit" value="<?php echo esc_attr_x( $multy_submit, 'submit button' ) ?>" />
</form>