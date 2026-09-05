<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-inner container">
        <a href="<?php echo home_url('/'); ?>" class="logo-link">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo_mocco_transparente.png.jpg" alt="MOCCO MX" class="main-logo">
        </a>

        <nav class="desktop-nav">
            <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>
        </nav>

        <a href="<?php echo home_url('/merch'); ?>" class="btn-merch">MERCH</a>

        <!-- Toggle Mobile -->
        <button id="mobile-toggle" class="mobile-toggle" aria-label="Menú">
            <span></span><span></span><span></span>
        </button>
    </div>

    <!-- Menú Desplegable Mobile -->
    <nav id="mobile-nav" class="mobile-nav">
        <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>
        <a href="<?php echo home_url('/merch'); ?>" style="display:block; margin-top:1rem; color:#3b82f6;">MERCH</a>
    </nav>
</header>