document.addEventListener('DOMContentLoaded', function () {
    // Init Icons
    if (typeof lucide !== 'undefined') { lucide.createIcons(); }

    // Animation Observer
    const fadeUpObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeUpObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.section-heading, .section-subheading, .product-card, .process-step, .stat-item, .hero-section h1, .hero-section .lead, .hero-section .btn').forEach((el, index) => {
        el.classList.add('fade-up');
        if (el.classList.contains('product-card')) { el.style.transitionDelay = `${(index % 3) * 100}ms`; }
        fadeUpObserver.observe(el);
    });

    // Modals
    var certModal = document.getElementById('certModal');
    if (certModal) {
        certModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var title = button.getAttribute('data-cert-title');
            var imgSrc = button.getAttribute('data-cert-img');
            var modalTitle = certModal.querySelector('.modal-title');
            var modalImage = certModal.querySelector('#certModalImage');
            if (modalTitle) modalTitle.textContent = title;
            if (modalImage) modalImage.src = imgSrc;
        });
    }
});
