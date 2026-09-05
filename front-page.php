<?php
/**
 * Tema: MOCCO MX
 * Archivo: front-page.php
 */
get_header(); ?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-10 relative">

    <!-- 1. CARRUSEL Y TENDENCIAS TOP 5 -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-24">
        
        <?php 
        $hero_query = new WP_Query(array('posts_per_page' => 3, 'post_status' => 'publish'));
        $hero_slides = array();
        if ($hero_query->have_posts()) : while ($hero_query->have_posts()) : $hero_query->the_post();
            $cat = get_the_category();
            $hero_slides[] = array(
                'title' => get_the_title(),
                'link' => get_permalink(),
                'cat' => !empty($cat) ? $cat[0]->name : 'Destacado',
                'img' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://placehold.co/1200x600/162440/f3ebd5?text=MOCCO'
            );
        endwhile; wp_reset_postdata(); endif; 
        ?>
        
        <div id="hero-container" class="lg:col-span-2 relative rounded-2xl overflow-hidden h-[400px] md:h-[500px] lg:h-[600px] bg-cover bg-center transition-all duration-500" style="background-image: url('<?php echo !empty($hero_slides) ? esc_url($hero_slides[0]['img']) : ''; ?>')">
            <div class="absolute inset-0 img-gradient-overlay"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12 z-10 flex flex-col justify-end h-full">
                <span id="hero-category" class="text-xs font-semibold tracking-wider uppercase text-mocco-accent mb-3 block">
                    <?php echo !empty($hero_slides) ? esc_html($hero_slides[0]['cat']) : ''; ?>
                </span>
                <h2 id="hero-title" class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 max-w-3xl text-white">
                    <?php echo !empty($hero_slides) ? esc_html($hero_slides[0]['title']) : 'Bienvenido a MOCCO MX'; ?>
                </h2>
                <div>
                    <a id="hero-link" href="<?php echo !empty($hero_slides) ? esc_url($hero_slides[0]['link']) : '#'; ?>" class="inline-flex items-center gap-2 bg-mocco-btn text-mocco-bg px-6 py-3 rounded-full font-semibold hover:bg-mocco-btnHover transition-colors">
                        Leer artículo <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tendencias Top 5 -->
        <div class="bg-mocco-card rounded-2xl p-6 md:p-8 flex flex-col h-auto lg:h-[600px]">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-white/10">
                <h3 class="text-2xl font-bold text-white">Tendencias</h3>
            </div>
            <div class="flex-1 overflow-y-auto hide-scrollbar space-y-6 pr-2">
                <?php 
                $tendencias = get_mocco_tendencias();
                $counter = 1;
                if ($tendencias->have_posts()) : while ($tendencias->have_posts()) : $tendencias->the_post();
                ?>
                    <a href="<?php the_permalink(); ?>" class="flex gap-5 group items-center">
                        <span class="text-3xl font-bold text-white/20 group-hover:text-mocco-accent transition-colors">
                            <?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?>
                        </span>
                        <h4 class="text-sm md:text-base font-medium leading-relaxed group-hover:text-white text-gray-300 transition-colors line-clamp-3">
                            <?php the_title(); ?>
                        </h4>
                    </a>
                <?php 
                $counter++;
                endwhile; wp_reset_postdata(); else: ?>
                    <p class="text-gray-400">Aún no hay tendencias suficientes.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 2. LO MÁS RECIENTE -->
    <section class="mb-24">
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-extrabold">Lo más reciente</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
            <?php 
            $recent_query = new WP_Query(array('posts_per_page' => 8, 'post_status' => 'publish'));
            if ($recent_query->have_posts()) : while ($recent_query->have_posts()) : $recent_query->the_post(); 
                $cat = get_the_category();
                $cat_name = !empty($cat) ? $cat[0]->name : 'General';
            ?>
                <a href="<?php the_permalink(); ?>" class="group block cursor-pointer flex flex-col h-full">
                    <div class="w-full h-[200px] rounded-2xl overflow-hidden mb-5 bg-mocco-card relative flex-shrink-0">
                        <?php if(has_post_thumbnail()): ?>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-bold tracking-widest text-mocco-subtext uppercase mb-3">
                        <span class="text-mocco-accent"><?php echo esc_html($cat_name); ?></span>
                    </div>
                    <h3 class="text-lg font-bold leading-snug mb-3 group-hover:text-mocco-accent transition-colors"><?php the_title(); ?></h3>
                </a>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

    <!-- 3. MOCCO TALKS (YOUTUBE) -->
    <section class="mb-24">
        <div class="mb-10 text-center md:text-left">
            <span class="text-xs font-semibold tracking-wider uppercase text-mocco-subtext">Entrevistas Exclusivas</span>
            <h2 class="text-3xl md:text-4xl font-extrabold mt-1">Mocco Talks</h2>
        </div>

        <?php 
        include_once( ABSPATH . WPINC . '/feed.php' );
        $youtube_rss_url = 'https://www.youtube.com/feeds/videos.xml?channel_id=UCKpwM4mu61XKbvq2lDY6uyw';
        $rss = fetch_feed( $youtube_rss_url );
        
        $yt_videos = array();
        if ( ! is_wp_error( $rss ) ) {
            $maxitems = $rss->get_item_quantity( 4 );
            $rss_items = $rss->get_items( 0, $maxitems );
            foreach ( $rss_items as $item ) {
                $vid_url = $item->get_permalink();
                parse_str( parse_url( $vid_url, PHP_URL_QUERY ), $vid_vars );
                $vid_id = isset($vid_vars['v']) ? $vid_vars['v'] : '';
                if($vid_id) {
                    $yt_videos[] = array('title' => $item->get_title(), 'id' => $vid_id, 'date' => $item->get_date('j M Y'));
                }
            }
        }
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php if(!empty($yt_videos)): ?>
                <div class="lg:col-span-2">
                    <div class="relative w-full rounded-2xl overflow-hidden bg-black" style="padding-top: 56.25%;">
                        <iframe id="main-yt-player" class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/<?php echo esc_attr($yt_videos[0]['id']); ?>?autoplay=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <h3 id="main-yt-title" class="text-2xl font-bold mt-5 text-white"><?php echo esc_html($yt_videos[0]['title']); ?></h3>
                </div>

                <div class="flex flex-col space-y-4 bg-mocco-card p-6 rounded-2xl h-[400px] lg:h-auto overflow-y-auto hide-scrollbar">
                    <h4 class="text-xs font-semibold tracking-widest uppercase text-white/50 mb-4 border-b border-white/10 pb-2">Últimos Videos</h4>
                    <?php for($i = 1; $i < count($yt_videos); $i++): ?>
                    <div class="flex gap-4 items-center p-3 rounded-xl cursor-pointer hover:bg-mocco-hover transition-colors" onclick="document.getElementById('main-yt-player').src='https://www.youtube.com/embed/<?php echo esc_attr($yt_videos[$i]['id']); ?>?autoplay=1'; document.getElementById('main-yt-title').innerText='<?php echo esc_js($yt_videos[$i]['title']); ?>';">
                        <div class="w-28 h-16 rounded-lg bg-black relative flex-shrink-0 flex items-center justify-center overflow-hidden">
                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_videos[$i]['id']); ?>/mqdefault.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60">
                            <i class="fas fa-play text-white text-xs relative z-10"></i>
                        </div>
                        <div>
                            <h5 class="text-sm font-bold leading-tight text-gray-300 line-clamp-2"><?php echo esc_html($yt_videos[$i]['title']); ?></h5>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>