<?php
/**
 * Tema: MOCCO MX
 * Archivo: index.php
 */
get_header(); ?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <h1 class="text-5xl font-extrabold mb-12">Publicaciones Generales</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
        <?php if (have_posts()) : while (have_posts()) : the_post(); 
            $word_count = str_word_count(strip_tags(get_the_content()));
            $read_time = max(1, ceil($word_count / 200)) . ' MIN';
            $cat = get_the_category();
            $cat_name = !empty($cat) ? $cat[0]->name : 'General';
        ?>
            <a href="<?php the_permalink(); ?>" class="group block cursor-pointer flex flex-col h-full">
                <div class="w-full h-[260px] rounded-2xl overflow-hidden mb-5 bg-mocco-card relative flex-shrink-0">
                    <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <?php else: ?>
                        <img src="https://placehold.co/600x400/162440/f3ebd5?text=MOCCO" class="w-full h-full object-cover">
                    <?php endif; ?>
                </div>
                <div class="flex justify-between items-center text-[10px] font-bold tracking-widest text-mocco-subtext uppercase mb-3">
                    <span class="text-mocco-accent"><?php echo esc_html($cat_name); ?></span>
                    <span><i class="far fa-clock mr-1"></i> <?php echo esc_html($read_time); ?></span>
                </div>
                <h3 class="text-xl font-bold leading-snug mb-3 group-hover:text-mocco-accent transition-colors"><?php the_title(); ?></h3>
                <p class="text-sm text-gray-400 mb-4 line-clamp-2 flex-grow"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
            </a>
        <?php endwhile; else: ?>
            <p class="text-gray-400">No se encontraron artículos.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>