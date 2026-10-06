<?php
/**
 * Tema: MOCCO MX
 * Archivo: front-page.php
 * Optimizado para Mobile-First, SEO y Core Web Vitals
 */
get_header(); ?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10 relative">

    <!-- H1 accesible para motores de búsqueda -->
    <h1 class="sr-only"><?php bloginfo('name'); ?> — Cultura, Moda y Estilo de Vida</h1>

    <!-- 1. HERO CARRUSEL & TENDENCIAS TOP 5 -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-16 md:mb-24">
        
        <?php 
        $hero_query = new WP_Query(array(
            'posts_per_page' => 3, 
            'post_status'    => 'publish',
            'ignore_sticky_posts' => 1
        ));
        $hero_slides = array();
        if ($hero_query->have_posts()) : 
            while ($hero_query->have_posts()) : $hero_query->the_post();
                $cat = get_the_category();
                $hero_slides[] = array(
                    'title' => get_the_title(),
                    'link'  => get_permalink(),
                    'cat'   => !empty($cat) ? $cat[0]->name : 'Destacado',
                    'img'   => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://placehold.co/1200x800/162440/f3ebd5?text=MOCCO'
                );
            endwhile; 
            wp_reset_postdata(); 
        endif; 
        ?>
        
        <!-- Carrusel Deslizable -->
        <div class="lg:col-span-2 relative rounded-3xl overflow-hidden group">
            <div id="hero-slider" class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth hide-scrollbar w-full h-[450px] md:h-[520px] lg:h-[600px]">
                <?php if (!empty($hero_slides)) : foreach ($hero_slides as $index => $slide) : ?>
                    <article class="w-full flex-shrink-0 snap-start relative h-full bg-cover bg-center flex flex-col justify-end p-6 md:p-12 text-white" 
                             style="background-image: url('<?php echo esc_url($slide['img']); ?>');">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        
                        <div class="relative z-10 max-w-3xl">
                            <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-md text-mocco-accent text-[11px] font-bold tracking-widest uppercase rounded-full mb-3">
                                <?php echo esc_html($slide['cat']); ?>
                            </span>
                            <h2 class="text-2xl sm:text-4xl md:text-5xl font-black leading-tight mb-4 text-white line-clamp-3">
                                <?php echo esc_html($slide['title']); ?>
                            </h2>
                            <a href="<?php echo esc_url($slide['link']); ?>" class="inline-flex items-center gap-2 bg-white text-black px-6 py-3 rounded-full font-bold text-sm hover:bg-mocco-accent hover:text-white transition-all transform active:scale-95 shadow-lg">
                                Leer artículo <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; endif; ?>
            </div>

            <!-- Indicadores -->
            <div class="absolute bottom-4 right-6 z-20 flex gap-2" id="hero-indicators">
                <?php for($i = 0; $i < count($hero_slides); $i++): ?>
                    <button aria-label="Ir a diapositiva <?php echo $i+1; ?>" onclick="goToSlide(<?php echo $i; ?>)" class="indicator-btn w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white transition-all focus:outline-none focus:ring-2 focus:ring-white <?php echo $i === 0 ? 'bg-white' : ''; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Tendencias Top 5 (Jetpack 7 Días) -->
        <aside class="bg-mocco-card border border-white/5 rounded-3xl p-6 md:p-8 flex flex-col justify-between shadow-xl">
            <div>
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-white/10">
                    <h3 class="text-xl md:text-2xl font-black text-white flex items-center gap-2">
                        Tendencias <span class="text-xs px-2 py-0.5 bg-red-500/20 text-red-400 font-bold rounded-full">Top 5</span>
                    </h3>
                    <span class="text-xs text-mocco-subtext tracking-wider uppercase font-semibold">Destacado</span>
                </div>

                <div class="space-y-5">
                    <?php 
                    $trend_items = array();
                    
                    // 1. Obtener de Jetpack (Más vistas en últimos 7 días)
                    if ( function_exists( 'stats_get_csv' ) ) {
                        // Pedimos límite 15 para tener margen por si varias son la página de inicio u otras páginas
                        $top_posts_jetpack = stats_get_csv( 'postviews', array( 'days' => 7, 'limit' => 15 ) );
                        
                        if ( ! empty( $top_posts_jetpack ) && is_array( $top_posts_jetpack ) ) {
                            foreach ( $top_posts_jetpack as $jp_post ) {
                                $post_id = isset( $jp_post['post_id'] ) ? (int) $jp_post['post_id'] : 0;
                                
                                // Filtro: Evitar ID 0 (Home), la página asignada como front-page, y asegurar que sea 'post'
                                if ( $post_id === 0 || $post_id == get_option('page_on_front') || get_post_type($post_id) !== 'post' ) {
                                    continue;
                                }

                                $trend_items[] = array(
                                    'title' => get_the_title( $post_id ),
                                    'link'  => get_permalink( $post_id ),
                                );

                                if ( count( $trend_items ) === 5 ) break;
                            }
                        }
                    }

                    // 2. Respaldo: Si Jetpack no está activo o no hay datos, mostrar últimas 5 entradas
                    if ( empty( $trend_items ) ) {
                        $fallback_tendencias = new WP_Query(array(
                            'posts_per_page'      => 5, 
                            'post_status'         => 'publish',
                            'ignore_sticky_posts' => 1
                        ));
                        if ( $fallback_tendencias->have_posts() ) {
                            while ( $fallback_tendencias->have_posts() ) {
                                $fallback_tendencias->the_post();
                                $trend_items[] = array(
                                    'title' => get_the_title(),
                                    'link'  => get_permalink(),
                                );
                            }
                            wp_reset_postdata();
                        }
                    }

                    // 3. Imprimir Lista
                    if ( !empty( $trend_items ) ) : 
                        $counter = 1;
                        foreach ( $trend_items as $item ) :
                    ?>
                        <a href="<?php echo esc_url($item['link']); ?>" class="flex items-start gap-4 group cursor-pointer">
                            <span class="text-2xl md:text-3xl font-black text-white/20 group-hover:text-mocco-accent transition-colors shrink-0">
                                <?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?>
                            </span>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-200 group-hover:text-white leading-snug line-clamp-2 transition-colors">
                                    <?php echo esc_html($item['title']); ?>
                                </h4>
                            </div>
                        </a>
                    <?php 
                        $counter++;
                        endforeach; 
                    else: ?>
                        <p class="text-gray-400 text-sm">Explora las últimas notas para marcar tendencia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </aside>
    </section>

    <!-- 2. LO MÁS RECIENTE -->
    <section class="mb-16 md:mb-24">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-4xl font-black tracking-tight text-white">Lo más reciente</h2>
            <div class="h-0.5 flex-1 bg-white/10 ml-6 hidden sm:block"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            <?php 
            $recent_query = new WP_Query(array(
                'posts_per_page' => 8, 
                'post_status'    => 'publish',
                'offset'         => 3 // Evita duplicar las 3 del Hero
            ));
            if ($recent_query->have_posts()) : 
                while ($recent_query->have_posts()) : $recent_query->the_post(); 
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? $cat[0]->name : 'General';
            ?>
                <article>
                    <a href="<?php the_permalink(); ?>" class="group flex flex-col h-full">
                        <div class="w-full h-52 rounded-2xl overflow-hidden mb-4 bg-mocco-card relative flex-shrink-0">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>" 
                                     alt="<?php the_title_attribute(); ?>" 
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            <?php endif; ?>
                        </div>
                        <div class="text-[10px] font-black tracking-widest text-mocco-accent uppercase mb-2">
                            <?php echo esc_html($cat_name); ?>
                        </div>
                        <h3 class="text-base font-bold text-white group-hover:text-mocco-accent transition-colors leading-snug line-clamp-2">
                            <?php the_title(); ?>
                        </h3>
                    </a>
                </article>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </section>

    <!-- 3. MOCCO TALKS -->
    <section class="mb-20">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#121b2d] via-[#1a2744] to-[#0f172a] border border-white/10 p-8 md:p-14 text-center flex flex-col items-center justify-center shadow-2xl">
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-red-500 mb-3 z-10">
                <i class="fab fa-youtube mr-1 text-sm"></i> Formato Audiovisual
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-white mb-4 z-10">
                Mocco Talks
            </h2>
            <p class="text-lg md:text-xl text-gray-300 max-w-xl mb-8 font-medium z-10">
                Pronto encontrarás nuestras entrevistas exclusivas con las voces más influyentes.
            </p>
            
            <a href="https://www.youtube.com/channel/UCKpwM4mu61XKbvq2lDY6uyw?sub_confirmation=1" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-xl shadow-red-600/20 z-10 text-sm md:text-base">
                <i class="fab fa-youtube text-lg"></i>
                Suscríbete en YouTube
            </a>
        </div>
    </section>

    <!-- 4. NEWSLETTER (JETPACK) -->
    <section class="mb-12 md:mb-20 px-4">
        <div class="max-w-5xl mx-auto bg-[#131f37] rounded-[2rem] p-8 md:p-10 lg:p-14 text-center shadow-2xl">
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-black text-white mb-8 leading-tight">
                Recibe lo mejor de la moda <br class="hidden md:block"> mexicana en tu correo.
            </h2>
            
            <!-- Contenedor ÚNICO del Formulario Jetpack -->
            <div class="mocco-jetpack-newsletter flex justify-center w-full">
                <?php 
                if ( shortcode_exists( 'jetpack_subscription_form' ) ) {
                    echo do_shortcode('[jetpack_subscription_form title="" subscribe_text="" subscribe_button="Suscríbete" show_subscribers_total="0" show_only_email_and_button="1" custom_background_button_color="#f6ebd8" custom_text_button_color="#111827"]'); 
                } else {
                    echo '<p class="text-white/50">El módulo de Jetpack no está activo.</p>';
                }
                ?>
            </div>
        </div>
    </section>

</main>

<style>
/* -------------------------------------- */
/* CARROUSEL HIDE SCROLLBAR               */
/* -------------------------------------- */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* -------------------------------------- */
/* ESTILOS FORZADOS PARA JETPACK FORM     */
/* -------------------------------------- */
.mocco-jetpack-newsletter form {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 12px !important;
    width: 100% !important;
    max-width: 500px !important; 
    margin: 0 auto !important;
}

.mocco-jetpack-newsletter p {
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
}

.mocco-jetpack-newsletter p:first-of-type {
    flex-grow: 1 !important;
    width: 100% !important;
}

.mocco-jetpack-newsletter label {
    display: none !important;
}

.mocco-jetpack-newsletter input[type="email"] {
    width: 100% !important;
    background-color: #0b1221 !important; 
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    padding: 0 1.5rem !important;
    border-radius: 9999px !important;
    outline: none !important;
    box-shadow: none !important;
    height: 54px !important;
    font-size: 1rem !important;
}

.mocco-jetpack-newsletter input[type="email"]::placeholder {
    color: rgba(255, 255, 255, 0.5) !important;
}

.mocco-jetpack-newsletter input[type="submit"], 
.mocco-jetpack-newsletter button[type="submit"] {
    background-color: #f6ebd8 !important; 
    color: #111827 !important; 
    font-weight: 800 !important;
    padding: 0 2rem !important;
    border-radius: 9999px !important;
    border: none !important;
    cursor: pointer !important;
    height: 54px !important;
    transition: transform 0.2s ease, opacity 0.2s ease !important;
}

.mocco-jetpack-newsletter input[type="submit"]:hover, 
.mocco-jetpack-newsletter button[type="submit"]:hover {
    transform: scale(1.02) !important;
    opacity: 0.9 !important;
}

@media (max-width: 640px) {
    .mocco-jetpack-newsletter form {
        flex-direction: column !important;
    }
    .mocco-jetpack-newsletter input[type="email"],
    .mocco-jetpack-newsletter input[type="submit"], 
    .mocco-jetpack-newsletter button[type="submit"] {
        width: 100% !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('hero-slider');
    const indicators = document.querySelectorAll('.indicator-btn');
    
    if(!slider || indicators.length <= 1) return;
    
    const totalSlides = indicators.length;
    let currentSlide = 0;
    let autoSlideInterval;

    window.goToSlide = function(index) {
        currentSlide = index;
        const slideWidth = slider.offsetWidth;
        slider.scrollTo({
            left: slideWidth * currentSlide,
            behavior: 'smooth'
        });
        updateIndicators();
        resetInterval();
    }

    function updateIndicators() {
        indicators.forEach((btn, idx) => {
            if(idx === currentSlide) {
                btn.classList.replace('bg-white/40', 'bg-white');
            } else {
                btn.classList.replace('bg-white', 'bg-white/40');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        goToSlide(currentSlide);
    }

    function startInterval() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetInterval() {
        clearInterval(autoSlideInterval);
        startInterval();
    }

    slider.addEventListener('scroll', () => {
        const slideWidth = slider.offsetWidth;
        const newIndex = Math.round(slider.scrollLeft / slideWidth);
        if (newIndex !== currentSlide) {
            currentSlide = newIndex;
            updateIndicators();
        }
    });

    startInterval();
});
</script>

<?php get_footer(); ?>