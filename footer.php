<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <section id="newsletter" class="bg-mocco-card rounded-3xl p-10 md:p-16 text-center max-w-5xl mx-auto my-24 scroll-mt-32">
            <h2 class="text-3xl md:text-5xl font-bold mb-8 max-w-2xl mx-auto leading-tight text-white">Recibe lo mejor de la moda mexicana en tu correo.</h2>
            <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto" onsubmit="event.preventDefault(); alert('¡Gracias por suscribirte!');">
                <input type="email" placeholder="tu@correo.com" class="px-6 py-4 rounded-full bg-mocco-bg border border-white/20 text-white focus:outline-none focus:border-mocco-accent w-full sm:w-2/3" required>
                <button type="submit" class="px-8 py-4 rounded-full bg-mocco-btn text-mocco-bg font-bold hover:bg-mocco-btnHover transition-colors w-full sm:w-auto">
                    Suscríbete
                </button>
            </form>
        </section>
    </main>

    <footer class="border-t border-white/5 pt-16 pb-12 mt-10 bg-mocco-bg">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
                <div class="text-white font-extrabold text-2xl tracking-widest cursor-pointer">
                    <a href="<?php echo esc_url(home_url('/')); ?>">MOCCO<span class="text-xs font-normal align-top ml-1 opacity-70">MX</span></a>
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