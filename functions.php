<?php
function mocco_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    
    // Tamaños optimizados
    add_image_size('mocco-grid', 600, 400, true);
    add_image_size('mocco-hero-slide', 1000, 600, true);
    
    register_nav_menus(array(
        'primary' => 'Menú Principal (Desktop/Mobile)'
    ));
}
add_action('after_setup_theme', 'mocco_setup');

// Consulta de notas populares (Últimos 7 días)
function get_mocco_tendencias_7_days() {
    return new WP_Query(array(
        'posts_per_page' => 5,
        'meta_key'       => 'post_views_count', // Asegúrate de que tu plugin use este meta_key
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'date_query'     => array(array('after' => '1 week ago'))
    ));
}
?>