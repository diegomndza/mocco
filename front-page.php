<?php get_header(); ?>

<main class="home-main">
    
    <section class="hero-section container">
        <!-- Slider 3 Notas -->
        <div class="hero-slider-container">
            <div class="slider-track" id="slider-track">
                <?php 
                $slider_query = new WP_Query(array('posts_per_page' => 3));
                while($slider_query->have_posts()): $slider_query->the_post(); 
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? esc_html($cat[0]->name) : 'TENDENCIAS';
                ?>
                <div class="slide" style="background-image: linear-gradient(to top, rgba(11,17,26,1) 0%, rgba(11,17,26,0) 60%), url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'mocco-hero-slide'); ?>');">
                    <div style="position: relative; z-index: 10;">
                        <span class="slide-cat"><?php echo $cat_name; ?></span>
                        <h2><?php the_title(); ?></h2>
                        <a href="<?php the_permalink(); ?>" class="btn-read-more">Leer artículo &rarr;</a>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <div class="slider-indicators">
                <div class="line active" data-index="0"></div>
                <div class="line" data-index="1"></div>
                <div class="line" data-index="2"></div>
            </div>
        </div>

        <!-- Sidebar Populares 7 días -->
        <aside class="popular-sidebar">
            <h3>Populares</h3>
            <ul class="popular-list">
                <?php 
                $populares = get_mocco_tendencias_7_days();
                $count = 1;
                if($populares->have_posts()): 
                    while($populares->have_posts()): $populares->the_post(); ?>
                        <li>
                            <span class="num"><?php echo sprintf('%02d', $count); ?></span>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php $count++; endwhile; wp_reset_postdata();
                endif; ?>
            </ul>
        </aside>
    </section>

    <!-- Grid de Recientes -->
    <section class="recent-posts container" style="margin-bottom: 4rem;">
        <h2 style="border-bottom: 1px solid #172439; padding-bottom: 1rem; margin-bottom: 2rem;">Lo más reciente</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php 
            // Omitimos los 3 del slider usando offset
            $recent = new WP_Query(array('posts_per_page' => 6, 'offset' => 3));
            while($recent->have_posts()): $recent->the_post(); 
            ?>
                <article>
                    <a href="<?php the_permalink(); ?>" style="display:block; border-radius:12px; overflow:hidden; margin-bottom:1rem;">
                        <?php the_post_thumbnail('mocco-grid', array('style' => 'width:100%; height:auto; display:block; transition:0.3s;')); ?>
                    </a>
                    <h3 style="font-size:1.2rem; margin:0;"><a href="<?php the_permalink(); ?>" style="color:#fff;"><?php the_title(); ?></a></h3>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>

    <!-- Mocco Talks -->
    <section class="mocco-talks-section container">
        <div style="margin-bottom: 1rem;">
            <span style="color:#8b96a5; font-size:0.75rem; font-weight:bold; letter-spacing:1px; text-transform:uppercase;">Entrevistas Exclusivas</span>
            <h2 style="font-size: 2.8rem; margin: 0;">Mocco Talks</h2>
        </div>
        <div class="mocco-talks-video-box">
            <p style="color:#8b96a5; font-size:1.1rem; margin:0;">Próximamente podrás consultar nuestros contenidos extendidos.</p>
        </div>
    </section>

</main>

<?php get_footer(); ?>