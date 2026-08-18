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
        .img-gradient-subtle { background: linear-gradient(to top, rgba(10, 16, 29, 0.8) 0%, transparent 100%); }
    </style>
</head>
<body <?php body_class('font-sans'); ?>>
    <nav class="w-full bg-mocco-bg/95 backdrop-blur-md sticky top-0 z-50 border-b border-white/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0 cursor-pointer text-white font-extrabold text-2xl tracking-widest">
                    <a href="<?php echo esc_url(home_url('/')); ?>">MOCCO<span class="text-xs font-normal align-top ml-1 opacity-70">MX</span></a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link text-sm font-medium <?php echo is_front_page() ? 'text-white' : 'text-gray-400 hover:text-white'; ?> transition-colors">Inicio</a>
                    <?php
                    $categories = get_categories(array('orderby' => 'name', 'order' => 'ASC', 'number' => 4));
                    foreach($categories as $cat) {
                        $is_current = (is_category($cat->term_id)) ? 'text-white' : 'text-gray-400 hover:text-white';
                        echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="nav-link text-sm font-medium ' . $is_current . ' transition-colors">' . esc_html($cat->name) . '</a>';
                    }
                    ?>
                    <a href="#newsletter" class="ml-4 px-6 py-2 rounded-full border border-white/20 text-sm font-medium hover:bg-white hover:text-mocco-bg transition-colors">
                        Suscríbete
                    </a>
                </div>
            </div>
        </div>
    </nav>