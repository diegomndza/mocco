<?php
/**
 * Tema: MOCCO MX
 * Archivo: single.php
 */
get_header(); ?>

<main class="w-full relative">
    <?php if (have_posts()) : while (have_posts()) : the_post(); 
        $cat = get_the_category();
        $cat_name = !empty($cat) ? $cat[0]->name : 'Artículo';
        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
        
        <!-- Portada Desenfocada -->
        <?php if (has_post_thumbnail()): ?>
        <div class="relative w-full h-[40vh] md:h-[60vh] flex items-center justify-center overflow-hidden bg-black mb-12">
            <div class="absolute inset-0 bg-cover bg-center opacity-40 blur-xl scale-110" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
            <img src="<?php echo esc_url($img_url); ?>" class="relative z-10 w-full md:w-auto h-full object-contain" alt="<?php the_title_attribute(); ?>">
        </div>
        <?php endif; ?>

        <!-- Contenedor del Texto Ampliado (max-w-5xl) -->
        <article class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            
            <div class="mb-10 text-left border-b border-white/10 pb-8">
                <span class="text-xs font-semibold uppercase tracking-widest text-mocco-accent mb-4 block"><?php echo esc_html($cat_name); ?></span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 text-white"><?php the_title(); ?></h1>
                
                <div class="flex flex-wrap items-center gap-4 text-xs text-mocco-subtext uppercase tracking-widest font-semibold">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="hover:text-white transition-colors">POR <?php echo get_the_author(); ?></a>
                    <span>•</span>
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </div>

            <div class="prose prose-invert lg:prose-xl max-w-none text-lg leading-relaxed text-gray-300">
                <?php the_content(); ?>
            </div>

        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>