</div>

<div class="footer_widget_area_full full_width">

  <?php get_sidebar('footer'); ?>

</div>

<div class="footer_full full_width">

  <footer role="contentinfo" class="wrap">

    <div id="inner-footer" class="clearfix">

      <nav>
        <?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
      </nav>

      <p class="attribution">&copy; <?php bloginfo('name'); ?> <?php _e("is powered by", "bonestheme"); ?> <a href="http://wordpress.org/" title="WordPress">WordPress</a> <span class="amp">&</span> <a href="http://www.themble.com/bones" title="Bones" class="footer_bones_link">Bones</a>.</p>

    </div> <!-- end #inner-footer -->

  </footer> <!-- end footer -->

</div>

</div> <!-- end #container -->

<!-- all js scripts are loaded in library/bones.php -->
<?php wp_footer(); ?>

</body>

</html>