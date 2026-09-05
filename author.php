<?php
/**
 * Tema: MOCCO MX
 * Archivo: author.php
 */
get_header(); 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
    
    <div class="bg-mocco-card rounded-3xl p-10 flex flex-col md:flex-row items-center gap-8 mb-16 text-center md:text-left">
        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-mocco-accent shrink-0">
            <?php echo get_avatar($curauth->user_email, 128, '', '', array('class' => 'w-full h-full object-cover')); ?>
        </div>
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2"><?php echo $curauth->display_name; ?></h1>
            <p class="text-mocco-subtext text-lg max-w-2xl"><?php echo $curauth->user_description ?: 'Redactor en MOCCO MX.'; ?></p>
        </div>
    </div>

    <h3 class="text-2xl font-bold mb-8 border-b border-white/10 pb-4">Artículos publicados</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="group block cursor-pointer flex flex-col h-full">
                <div class="w-full h-[200px] rounded-2xl overflow-hidden mb-5 bg-mocco-card relative flex-shrink-0">
                    <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <?php endif; ?>
                </div>
                <h3 class="text-lg font-bold leading-snug mb-3 group-hover:text-mocco-accent transition-colors"><?php the_title(); ?></h3>
                <span class="text-xs text-mocco-subtext"><?php echo get_the_date(); ?></span>
            </a>
        <?php endwhile; else: ?>
            <p class="text-gray-400">Este autor aún no tiene artículos.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>