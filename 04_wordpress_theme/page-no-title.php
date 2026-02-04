<?php
/*
Template Name: Page without Title (Custom H1)
*/

get_header();
?>

<!-- Layout Wrapper: Removed 'container' and 'py-5' to allow full control via Page Editor -->
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <?php
      while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>

        <?php
      endwhile;
      ?>

    </main>
  </div>
</div>

<?php
get_footer();
