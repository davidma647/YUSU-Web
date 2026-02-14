document.addEventListener('DOMContentLoaded', function () {
    // ==========================================
    // 1. Scroll Animations (IntersectionObserver)
    // ==========================================
    const fadeUpObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeUpObserver.unobserve(entry.target); // Animate only once
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    });

    // Target elements to automatically add fade-up class
    const autoAnimatedElements = document.querySelectorAll(
        '.section-heading, .section-subheading, .product-card, .process-step, .hero-section h1, .hero-section .lead, .hero-section .btn'
    );

    autoAnimatedElements.forEach((el, index) => {
        el.classList.add('fade-up');
        // Optional: Add staggering delay classes based on visual groups
        if (el.classList.contains('product-card')) {
            // Simple staggering for grids
            const delay = (index % 3) * 100; // 0, 100, 200ms
            el.style.transitionDelay = `${delay}ms`;
        }
        fadeUpObserver.observe(el);
    });

    // Observe ALL elements with fade-up class (both auto-added and manually added)
    document.querySelectorAll('.fade-up').forEach(el => {
        fadeUpObserver.observe(el);
    });
});
