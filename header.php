<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <?php wp_head(); ?>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        mocco: { bg: '#0a101d', card: '#162440', hover: '#1e325c', accent: '#3b82f6', text: '#f3f4f6', subtext: '#9ca3af', btn: '#f3ebd5', btnHover: '#e5dec6' }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #0a101d; color: #f3f4f6; -webkit-font-smoothing: antialiased; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .img-gradient-overlay { background: linear-gradient(to top, rgba(10, 16, 29, 0.95) 0%, rgba(10, 16, 29, 0.4) 50%, transparent 100%); }
    </style>
</head>
<body <?php body_class('font-sans pb-16 md:pb-0'); ?>>
    <nav class="w-full bg-mocco-bg/95 backdrop-blur-md sticky top-0 z-50 border-b border-white/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Menú Hamburguesa (Mobile) -->
                <button id="mobile-menu-btn" class="md:hidden text-white text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Logo PNG -->
                <div class="flex-shrink-0 cursor-pointer">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo_mocco_transparente.png'); ?>" alt="MOCCO MX" class="h-8 md:h-10 w-auto object-contain">
                    </a>
                </div>

                <!-- Menú Desktop -->
                <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link text-sm font-medium hover:text-white transition-colors">Inicio</a>
                    <a href="<?php echo esc_url(home_url('/category/moda')); ?>" class="nav-link text-sm font-medium hover:text-white transition-colors">Moda</a>
                    <a href="<?php echo esc_url(home_url('/perfiles')); ?>" class="nav-link text-sm font-medium hover:text-white transition-colors">Perfiles</a>
                    <a href="<?php echo esc_url(home_url('/work-with')); ?>" class="nav-link text-sm font-medium hover:text-white transition-colors">Work With</a>
                    <a href="<?php echo esc_url(home_url('/merch')); ?>" class="nav-link text-sm font-bold text-mocco-accent hover:text-white transition-colors">MERCH</a>
                    
                    <a href="#newsletter" class="ml-4 px-6 py-2 rounded-full border border-white/20 text-sm font-medium hover:bg-white hover:text-mocco-bg transition-colors">
                        Suscríbete
                    </a>
                </div>
                
                <!-- Espaciador para centrar logo en mobile -->
                <div class="md:hidden w-6"></div>
            </div>
        </div>

        <!-- Menú Desplegable Móvil -->
        <div id="mobile-menu" class="hidden md:hidden bg-mocco-card absolute w-full border-b border-white/10 shadow-xl">
            <div class="px-4 pt-2 pb-6 space-y-2 flex flex-col text-center">
                <a href="<?php echo esc_url(home_url('/category/moda')); ?>" class="block px-3 py-3 text-base font-medium text-white hover:bg-mocco-hover rounded-md">Moda</a>
                <a href="<?php echo esc_url(home_url('/perfiles')); ?>" class="block px-3 py-3 text-base font-medium text-white hover:bg-mocco-hover rounded-md">Perfiles</a>
                <a href="<?php echo esc_url(home_url('/work-with')); ?>" class="block px-3 py-3 text-base font-medium text-white hover:bg-mocco-hover rounded-md">Work With Mocco</a>
                <a href="<?php echo esc_url(home_url('/merch')); ?>" class="block px-3 py-3 text-base font-bold text-mocco-accent hover:bg-mocco-hover rounded-md">MERCH</a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>