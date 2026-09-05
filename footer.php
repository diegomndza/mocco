<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <section id="newsletter" class="bg-mocco-card rounded-3xl p-10 md:p-16 text-center max-w-5xl mx-auto my-24 scroll-mt-32">
            <h2 class="text-3xl md:text-5xl font-bold mb-8 max-w-2xl mx-auto leading-tight text-white">Recibe lo mejor de la moda mexicana en tu correo.</h2>
            
            <div class="flex justify-center max-w-lg mx-auto">
                <!-- Formulario funcional de Jetpack -->
                <?php 
                    if (shortcode_exists('jetpack_subscription_form')) {
                        echo do_shortcode('[jetpack_subscription_form title="" subscribe_text="" subscribe_button="Suscribirme" show_subscribers_total="false"]'); 
                    } else {
                        echo '<p class="text-mocco-subtext text-sm">Asegúrate de activar el módulo de suscripciones en Jetpack.</p>';
                    }
                ?>
            </div>
        </section>
    </main>

    <footer class="border-t border-white/5 pt-16 pb-12 mt-10 bg-mocco-bg">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
                <div class="text-white font-extrabold text-2xl tracking-widest cursor-pointer">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo_mocco_transparente.png'); ?>" alt="MOCCO MX" class="h-8 md:h-10 w-auto object-contain">
                    </a>
                </div>
                
                <div class="flex flex-wrap justify-center gap-8 text-sm font-medium text-mocco-subtext">
                    <?php
                    $footer_categories = get_categories(array('orderby' => 'name', 'order' => 'ASC', 'number' => 4));
                    foreach($footer_categories as $fcat) {
                        echo '<a href="' . esc_url(get_category_link($fcat->term_id)) . '" class="hover:text-white transition-colors">' . esc_html($fcat->name) . '</a>';
                    }
                    ?>
                </div>

                <div class="flex gap-6 text-mocco-subtext text-xl">
                    <a href="https://www.instagram.com/mocco.mx" target="_blank" class="hover:text-white transition-colors"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@mocco.mx" target="_blank" class="hover:text-white transition-colors"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
            
            <div class="text-center text-xs text-mocco-subtext border-t border-white/10 pt-8">
                &copy; <?php echo date('Y'); ?> MOCCO MX. Ciudad de México. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>