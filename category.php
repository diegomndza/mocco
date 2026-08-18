<?php
/**
 * Tema: MOCCO MX
 * Archivo: category.php
 */
get_header();

$current_cat = get_queried_object();
$cat_name = $current_cat->name;
?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-10 relative">
    
    <!-- Título de la Categoría -->
    <div class="mb-12 border-b border-white/10 pb-8 flex items-center justify-between">
        <h1 class="text-5xl md:text-7xl font-extrabold uppercase tracking-tight text-white"><?php echo esc_html($cat_name); ?></h1>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-mocco-subtext hover:text-white text-sm flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i> Volver al Inicio
        </a>
    </div>

    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $cat_query = new WP_Query(array(
        'category_name' => $current_cat->slug,
        'posts_per_page' => 12,
        'paged' => $paged,
        'post_status' => 'publish'
    ));

    $posts_array = array();
    if ($cat_query->have_posts()) {
        while ($cat_query->have_posts()) {
            $cat_query->the_post();
            $posts_array[] = array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'img' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x400/162440/f3ebd5?text=MOCCO',
                'author' => 'Por ' . get_the_author(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 15, '...'),
                'word_count' => str_word_count(strip_tags(get_the_content()))
            );
        }
    }
    ?>

    <?php if (!empty($posts_array)): ?>
        
        <!-- SECCIÓN: LAS 3 NOTAS DESTACADAS -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            
            <!-- Nota Principal (Izquierda) -->
            <?php $main_post = $posts_array[0]; ?>
            <a href="<?php echo esc_url($main_post['permalink']); ?>" class="relative rounded-2xl overflow-hidden h-[400px] lg:h-[500px] group block">
                <img src="<?php echo esc_url($main_post['img']); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 img-gradient-overlay"></div>
                <div class="absolute bottom-0 left-0 p-8 z-10 w-full">
                    <span class="text-xs font-semibold uppercase text-mocco-accent mb-3 block"><?php echo esc_html($cat_name); ?></span>
                    <h2 class="text-3xl lg:text-4xl font-bold leading-tight mb-3 text-white"><?php echo esc_html($main_post['title']); ?></h2>
                    <p class="text-xs text-white/70"><?php echo esc_html($main_post['author']); ?></p>
                </div>
            </a>

            <!-- Notas Secundarias (Derecha) -->
            <?php if (count($posts_array) > 1): ?>
                <div class="flex flex-col gap-6">
                    <?php for ($i = 1; $i < min(3, count($posts_array)); $i++): $sec_post = $posts_array[$i]; ?>
                        <a href="<?php echo esc_url($sec_post['permalink']); ?>" class="relative rounded-2xl overflow-hidden h-[190px] lg:h-[238px] group block">
                            <img src="<?php echo esc_url($sec_post['img']); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 img-gradient-subtle"></div>
                            <div class="absolute bottom-0 left-0 p-6 z-10 w-full">
                                <h3 class="text-xl font-bold leading-tight mb-2 text-white"><?php echo esc_html($sec_post['title']); ?></h3>
                                <p class="text-[10px] text-white/70 uppercase tracking-widest"><?php echo esc_html($sec_post['author']); ?></p>
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        </section>

        <!-- SECCIÓN: RESTO DE LOS ARTÍCULOS EN CUADRÍCULA -->
        <?php if (count($posts_array) > 3): ?>
            <section>
                <div class="flex items-center gap-4 mb-10">
                    <h3 class="text-3xl font-bold">Más artículos de <?php echo esc_html($cat_name); ?></h3>
                    <div class="flex-1 h-px bg-white/10"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                    <?php for ($i = 3; $i < count($posts_array); $i++): 
                        $post_item = $posts_array[$i];
                        $read_time = max(1, ceil($post_item['word_count'] / 200)) . ' MIN';
                    ?>
                        <a href="<?php echo esc_url($post_item['permalink']); ?>" class="group block cursor-pointer flex flex-col h-full">
                            <div class="w-full h-[260px] rounded-2xl overflow-hidden mb-5 bg-mocco-card relative flex-shrink-0">
                                <img src="<?php echo esc_url($post_item['img']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-bold tracking-widest text-mocco-subtext uppercase mb-3">
                                <span class="text-mocco-accent"><?php echo esc_html($cat_name); ?></span>
                                <span><i class="far fa-clock mr-1"></i> <?php echo esc_html($read_time); ?></span>
                            </div>
                            <h3 class="text-xl font-bold leading-snug mb-3 group-hover:text-mocco-accent transition-colors"><?php echo esc_html($post_item['title']); ?></h3>
                            <p class="text-sm text-gray-400 mb-4 line-clamp-2 flex-grow"><?php echo esc_html($post_item['excerpt']); ?></p>
                            <p class="text-[11px] text-mocco-subtext uppercase tracking-wider font-semibold"><?php echo esc_html($post_item['author']); ?></p>
                        </a>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

    <?php else: ?>
        <div class="text-center py-20 text-gray-400">
            <p class="text-xl">No hay artículos publicados en esta categoría todavía.</p>
        </div>
    <?php endif; wp_reset_postdata(); ?>

</main>

<?php get_footer(); ?>