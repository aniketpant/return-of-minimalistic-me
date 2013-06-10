<?php
/*
Template Name: The Graveyard
*/
?>

<?php get_header(); ?>

<div id="content" class="wrap clearfix">
    <h1 class="page-title">The Graveyard</h1>
    <div class="fourcol first clearfix">
        <h2 class="section-title">Categorical Graveyard</h2>
        <ul class="archive-list awesome-list category">
            <?php list_categories(); ?>
        </ul>
    </div>
    <div class="fourcol last clearfix">
        <h2 class="section-title">The Monthly Graveyard</h2>
        <ul class="archive-list awesome-list monthly">
            <?php wp_get_archives('monthly'); ?>
        </ul>
    </div>

    <?php get_sidebar(); ?>

</div> <!-- end #content -->

<?php get_footer(); ?>