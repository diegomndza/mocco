<?php
/**
 * Tema: MOCCO MX
 * Archivo: functions.php
 * Descripción: Configuración principal del tema.
 */

if ( ! function_exists( 'mocco_setup' ) ) :
    function mocco_setup() {
        // Habilita las portadas de los artículos
        add_theme_support('post-thumbnails');
        // Habilita las etiquetas de título dinámicas
        add_theme_support('title-tag');
        
        register_nav_menus(array(
            'primary' => 'Menú Principal'
        ));
    }
endif;
add_action( 'after_setup_theme', 'mocco_setup' );

function mocco_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'mocco_custom_excerpt_length', 999 );

function mocco_custom_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'mocco_custom_excerpt_more' );
?>