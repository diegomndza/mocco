<footer class="site-footer" style="padding: 4rem 0 2rem; text-align: center; border-top: 1px solid #172439; margin-top: 4rem;">
    <div class="container">
        <div class="newsletter-banner" style="background: #172439; padding: 3rem; border-radius: 12px; margin-bottom: 3rem;">
            <h3 style="margin-top:0;">Únete a MOCCO</h3>
            <form action="TU_URL_DE_MAILCHIMP_O_BREVO" method="POST" style="display: flex; justify-content: center; gap: 10px; margin-top: 1.5rem; flex-wrap: wrap;">
                <input type="email" name="EMAIL" placeholder="Tu correo electrónico" required style="padding: 12px; width: 100%; max-width: 300px; border-radius: 6px; border: none;">
                <button type="submit" style="padding: 12px 24px; background: #fff; color: #000; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">Suscribirme</button>
            </form>
        </div>
        <p style="color: #526075; font-size: 0.9rem;">&copy; <?php echo date('Y'); ?> MOCCO MX.</p>
    </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Menú Mobile
    const toggle = document.getElementById('mobile-toggle');
    const nav = document.getElementById('mobile-nav');
    if(toggle && nav) {
        toggle.addEventListener('click', () => nav.classList.toggle('active'));
    }

    // Slider
    const track = document.getElementById('slider-track');
    const lines = document.querySelectorAll('.slider-indicators .line');
    if(track && lines.length > 0) {
        let currentIndex = 0;
        function goToSlide(index) {
            track.style.transform = `translateX(-${index * 100}%)`;
            lines.forEach(line => line.classList.remove('active'));
            lines[index].classList.add('active');
            currentIndex = index;
        }
        lines.forEach((line, index) => line.addEventListener('click', () => goToSlide(index)));
        setInterval(() => goToSlide((currentIndex + 1) % 3), 6000); // Rota cada 6 segundos
    }
});
</script>
<?php wp_footer(); ?>
</body>
</html>