<?php
/*
Template Name: Custom Page - Home
*/
?>
<?php get_header(); ?>

<div id="content" class="wrap clearfix">

  <div id="about" class="eightcol first clearfix" role="about">
    <h1 class="h3 section-title">A Little About Me</h2>
      <p><?php echo about_me_text(); ?></p>
      <p><?php get_latest_post(); ?></p>
      <?php info_on_me(); ?>
    </div>

    <?php get_sidebar('home'); // sidebar 1 ?>

  </div> <!-- end #content -->

  <?php get_footer(); ?>
