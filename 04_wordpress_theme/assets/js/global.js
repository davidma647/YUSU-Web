document.addEventListener('DOMContentLoaded', function () {

    // 0. Scroll Animations (IntersectionObserver)
    const fadeUpObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeUpObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

    document.querySelectorAll('.fade-up').forEach(el => {
        fadeUpObserver.observe(el);
    });

    // 1. Lead Gen Modal (Global)
    const leadModal = document.getElementById('leadGenModal');
    if (leadModal) {
        leadModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever');
            // Update the modal's content.
            const modalTitle = leadModal.querySelector('.modal-title');
            const modalContext = leadModal.querySelector('#leadContext');

            if (recipient && recipient.includes('Catalog')) {
                modalTitle.textContent = 'Download 2026 Catalog';
            } else {
                modalTitle.textContent = 'Request Free Sample';
            }
            if (modalContext) modalContext.value = recipient || '';
        });
    }

    // 2. Certificate Modal (Global)
    const certModal = document.getElementById('certificateModal');
    if (certModal) {
        certModal.addEventListener('show.bs.modal', function (event) {
            const trigger = event.relatedTarget;
            // Support both naming conventions just in case, prioritizing innovation page one
            const imageSrc = trigger.getAttribute('data-cert-image') || trigger.getAttribute('data-cert-img');
            const title = trigger.getAttribute('data-cert-title');
            const type = trigger.getAttribute('data-cert-type');

            const modalImage = certModal.querySelector('#certModalImage');
            const modalTitle = certModal.querySelector('#certModalName');
            const modalType = certModal.querySelector('#certModalType');

            if (modalImage && imageSrc) modalImage.src = imageSrc;
            if (modalTitle && title) modalTitle.textContent = title;
            if (modalType && type) modalType.textContent = type;
        });
    }

    // 3. Image Preview / Lightbox (Global/Footer)
    const imageModalElement = document.getElementById('imageZoomModal');
    let imageModal;
    if (imageModalElement && typeof bootstrap !== 'undefined') {
        // Use getOrCreateInstance to prevent conflicts if initialized elsewhere
        imageModal = bootstrap.Modal.getOrCreateInstance(imageModalElement);
    }

    // Attach listener to any product image with correct selector globally
    document.querySelectorAll('.product-card-image img').forEach(img => {
        img.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Support high-res image via data-src
            const src = this.getAttribute('data-src') || this.getAttribute('src');
            const alt = this.getAttribute('alt');
            const previewImg = document.getElementById('zoomImage');

            if (previewImg && imageModal) {
                previewImg.src = src;
                previewImg.alt = alt;
                imageModal.show();
            }
        });
    });

    // 4. Sticky Navbar Logic (Header)
    const navbar = document.getElementById('mainNavbar');
    function updateNavbarStyle() {
        if (window.scrollY > 20) {
            navbar.classList.add('navbar-scrolled');
            navbar.classList.remove('navbar-transparent');
        } else {
            navbar.classList.remove('navbar-scrolled');
            navbar.classList.add('navbar-transparent');
        }
    }
    if (navbar) {
        updateNavbarStyle();
        window.addEventListener('scroll', updateNavbarStyle);
    }

    // 5. Desktop Dropdown Hover Interaction (Header)
    if (window.matchMedia('(min-width: 992px)').matches) {
        const dropdowns = document.querySelectorAll('.nav-item.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function () {
                const toggle = this.querySelector('.dropdown-toggle');
                const menu = this.querySelector('.dropdown-menu');
                if (toggle && menu) {
                    toggle.classList.add('show');
                    toggle.setAttribute('aria-expanded', 'true');
                    menu.classList.add('show');
                }
            });

            dropdown.addEventListener('mouseleave', function () {
                const toggle = this.querySelector('.dropdown-toggle');
                const menu = this.querySelector('.dropdown-menu');
                if (toggle && menu) {
                    toggle.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                    menu.classList.remove('show');
                }
            });
        });
    }

});
