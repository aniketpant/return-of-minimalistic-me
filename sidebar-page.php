    <div id="sidebar_page" class="sidebar fourcol first clearfix" role="complementary">

      <?php if ( is_active_sidebar( 'sidebar_page' ) ) : ?>

      <?php dynamic_sidebar( 'sidebar_page' ); ?>

    <?php else : ?>

    <!-- This content shows up if there are no widgets defined in the backend. -->

    <div class="help">

      <p>Please activate some Widgets.</p>

    </div>

  <?php endif; ?>

</div>