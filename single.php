<?php
/**
 * Tema: MOCCO MX
 * Archivo: single.php
 */
get_header(); ?>

<main class="max-w-[800px] mx-auto px-4 sm:px-6 py-20 relative">
    <?php if (have_posts()) : while (have_posts()) : the_post(); 
        $cat = get_the_category();
        $cat_name = !empty($cat) ? $cat[0]->name : 'Artículo';
    ?>
        <article class="prose prose-invert lg:prose-xl max-w-none">
            <div class="mb-8 text-center">
                <span class="text-sm font-semibold uppercase tracking-widest text-mocco-accent mb-4 block"><?php echo esc_html($cat_name); ?></span>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 text-white"><?php the_title(); ?></h1>
                <div class="flex items-center justify-center gap-4 text-xs text-mocco-subtext uppercase tracking-widest font-semibold">
                    <span>POR <?php echo get_the_author(); ?></span>
                    <span>•</span>
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </div>

            <?php if (has_post_thumbnail()): ?>
                <div class="mb-12 rounded-2xl overflow-hidden w-full">
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" class="w-full h-auto object-cover">
                </div>
            <?php endif; ?>

            <div class="text-lg leading-relaxed text-gray-300 space-y-6">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>