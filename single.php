<?php get_header(); ?>

<div id="content" class="wrap clearfix">

  <div id="main" class="col620 left first clearfix" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

      <header>

        <h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>

        <p class="meta"><?php _e("By", "bonestheme"); ?> <?php the_author(); ?> <?php _e("on", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>

      </header> <!-- end article header -->

      <section class="post_content clearfix" itemprop="articleBody">

        <?php the_content(); ?>

      </section> <!-- end article section -->
      <hr>
      <footer>

        <?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>

        <p>Got something to say about the post. Well, it would be great to <a href="#commentform">hear more from you.</a></p>

        <?php twitter_follow(); ?>

        <?php previous_next_post(); ?>

      </footer> <!-- end article footer -->

    </article> <!-- end article -->

    <?php comments_template(); ?>

  <?php endwhile; ?>

<?php else : ?>

  <article id="post-not-found">
    <header>
      <h1>Not Found</h1>
    </header>
    <section class="post_content">
      <p>Sorry, but the requested resource was not found on this site.</p>
    </section>
    <footer>
    </footer>
  </article>

<?php endif; ?>

</div> <!-- end #main -->

<?php get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>