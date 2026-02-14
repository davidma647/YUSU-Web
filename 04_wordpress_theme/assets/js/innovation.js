document.addEventListener('DOMContentLoaded', function () {
    // 1. Preloader Logic
    const preloader = document.getElementById('preloader');
    if (preloader) {
        window.addEventListener('load', function () {
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.remove();
            }, 500); // Wait for transition to finish
        });

        // Fallback: Force remove after 3s if load event hangs
        setTimeout(() => {
            if (document.body.contains(preloader)) {
                preloader.classList.add('fade-out');
                setTimeout(() => preloader.remove(), 500);
            }
        }, 3000);
    }

    // 2. Scroll Animations (IntersectionObserver)
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

    // Target elements to animate
    const animatedElements = document.querySelectorAll('.section-heading, .section-subheading, .product-card, .process-step, .stat-item, .hero-section h1, .hero-section .lead, .hero-section .btn, .feature-box');

    animatedElements.forEach((el, index) => {
        el.classList.add('fade-up');
        // Optional: Add staggering delay classes based on visual groups
        if (el.classList.contains('product-card') || el.classList.contains('feature-box')) {
            // Simple staggering for grids
            const delay = (index % 3) * 100; // 0, 100, 200ms
            el.style.transitionDelay = `${delay}ms`;
        }
        fadeUpObserver.observe(el);
    });

    // 3. Count-up Animation for Stats
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const valueDisplay = entry.target.querySelector('.counter-value');
                if (!valueDisplay) return; // Guard clause

                const targetValue = parseInt(valueDisplay.getAttribute('data-value') || '0', 10);
                const suffix = valueDisplay.getAttribute('data-suffix') || '+';
                const duration = 2000;
                let startTimestamp = null;

                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);

                    // Easing function for smooth stop
                    const easeOutQuad = 1 - Math.pow(1 - progress, 3);

                    const currentVal = Math.floor(easeOutQuad * targetValue);
                    valueDisplay.textContent = currentVal + suffix;

                    if (progress < 1) {
                        requestAnimationFrame(step);
                    } else {
                        valueDisplay.textContent = targetValue + suffix;
                    }
                };

                requestAnimationFrame(step);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.counter-card').forEach(el => {
        statsObserver.observe(el);
    });

    // 4. Certificate Auto-Scroller with Pause & Arrows
    const scrollerWrapper = document.querySelector('.cert-scroller-wrapper');
    const scrollerContainer = document.querySelector('.cert-scroller-container');
    const prevBtn = document.querySelector('.cert-scroller-nav.prev');
    const nextBtn = document.querySelector('.cert-scroller-nav.next');

    if (scrollerWrapper && prevBtn && nextBtn) {
        let isPaused = false;
        let animationFrameId;

        // Auto-scroll loop
        const loopScroll = () => {
            if (!isPaused) {
                // Slower scroll for readability (0.5px/frame ~ 30px/sec)
                scrollerWrapper.scrollLeft += 0.5;

                // Stop at end or loop? For now, stop at end to avoid jump.
                // If dynamic cloning is added later, this can loop.
                if (scrollerWrapper.scrollLeft + scrollerWrapper.clientWidth >= scrollerWrapper.scrollWidth - 1) {
                    // Start over?
                    scrollerWrapper.scrollLeft = 0;
                }
            }
            animationFrameId = requestAnimationFrame(loopScroll);
        };

        // Start only if content overflows
        if (scrollerWrapper.scrollWidth > scrollerWrapper.clientWidth) {
            loopScroll();
        }

        // Pause on Hover (Container level)
        if (scrollerContainer) {
            scrollerContainer.addEventListener('mouseenter', () => { isPaused = true; });
            scrollerContainer.addEventListener('mouseleave', () => { isPaused = false; });
        }

        // Arrow Navigation
        const scrollAmount = 300; // Jump size
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            scrollerWrapper.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            scrollerWrapper.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Touch interaction: Stop auto-scroll to avoid fighting user
        scrollerWrapper.addEventListener('touchstart', () => {
            isPaused = true;
            // Optional: cancelAnimationFrame(animationFrameId) if you want it stopped forever
        }, { passive: true });
    }

    // Initialize Lucide icons for new elements if using the library
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

});