<div class="footer_widget_area wrap clearfix">
  <div id="footer_area_1" class="sidebar fourcol first clearfix" role="complementary">

    <?php if ( is_active_sidebar( 'footer_area_1' ) ) : ?>

    <?php dynamic_sidebar( 'footer_area_1' ); ?>

  <?php else : ?>

  <!-- This content shows up if there are no widgets defined in the backend. -->

  <div class="help">

    <p>Please activate some Widgets.</p>

  </div>

<?php endif; ?>

</div>
<div id="footer_area_2" class="sidebar fourcol clearfix" role="complementary">

  <?php if ( is_active_sidebar( 'footer_area_2' ) ) : ?>

  <?php dynamic_sidebar( 'footer_area_2' ); ?>

<?php else : ?>

  <!-- This content shows up if there are no widgets defined in the backend. -->

  <div class="help">

    <p>Please activate some Widgets.</p>

  </div>

<?php endif; ?>

</div>
<div id="footer_area_3" class="sidebar fourcol last clearfix" role="complementary">

  <?php if ( is_active_sidebar( 'footer_area_3' ) ) : ?>

  <?php dynamic_sidebar( 'footer_area_3' ); ?>

<?php else : ?>

  <!-- This content shows up if there are no widgets defined in the backend. -->

  <div class="help">

    <p>Please activate some Widgets.</p>

  </div>

<?php endif; ?>

</div>
</div>