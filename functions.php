<?php
/**
 * Tema: MOCCO MX
 * Archivo: functions.php
 */

if ( ! function_exists( 'mocco_setup' ) ) :
    function mocco_setup() {
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        
        register_nav_menus(array(
            'primary' => 'Menú Principal'
        ));
    }
endif;
add_action( 'after_setup_theme', 'mocco_setup' );

// CTA automático después del primer párrafo
function mocco_inject_cta_after_first_p($content) {
    if (is_single() && in_the_loop() && is_main_query()) {
        $cta_box = '
        <div class="my-8 p-6 rounded-2xl bg-mocco-card border border-mocco-accent/30 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h4 class="text-white font-bold text-lg">¿Te apasiona la moda mexicana?</h4>
                <p class="text-sm text-mocco-subtext">Únete a nuestro newsletter exclusivo de MOCCO MX.</p>
            </div>
            <a href="#newsletter" class="px-6 py-3 rounded-full bg-mocco-accent text-white font-bold text-sm hover:bg-blue-600 transition-colors whitespace-nowrap">
                Suscribirme gratis
            </a>
        </div>';

        $paragraphs = explode('</p>', $content);
        if (count($paragraphs) > 1) {
            $paragraphs[0] .= '</p>' . $cta_box;
            return implode('</p>', $paragraphs);
        }
    }
    return $content;
}
add_filter('the_content', 'mocco_inject_cta_after_first_p');

// Extracto
function mocco_custom_excerpt_length( $length ) { return 15; }
add_filter( 'excerpt_length', 'mocco_custom_excerpt_length', 999 );
function mocco_custom_excerpt_more( $more ) { return '...'; }
add_filter( 'excerpt_more', 'mocco_custom_excerpt_more' );

// Caché de Tendencias (Se actualiza cada 24 horas)
function get_mocco_tendencias() {
    $tendencias = get_transient('mocco_top_5_tendencias');
    if (false === $tendencias) {
        $args = array(
            'posts_per_page' => 5,
            'orderby' => 'comment_count',
            'order' => 'DESC',
            'post_status' => 'publish'
        );
        $tendencias = new WP_Query($args);
        set_transient('mocco_top_5_tendencias', $tendencias, DAY_IN_SECONDS);
    }
    return $tendencias;
}