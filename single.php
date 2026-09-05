<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php while ( have_posts() ) : the_post(); 
        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
        <div class="single-hero-wrapper">
            <div class="single-hero-bg" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
            <img class="single-hero-img" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
        </div>

        <div class="container" style="padding-top: 3rem;">
            <h1 style="font-size: 3rem; margin-bottom: 0.5rem; text-align: left; line-height: 1.1; max-width: 900px; margin-left: auto; margin-right: auto;"><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>