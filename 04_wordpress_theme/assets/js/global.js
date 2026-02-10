document.addEventListener('DOMContentLoaded', function () {

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

    // 2. Dynamic Certification Modal (Footer Area)
    var certModal = document.getElementById('certModal');
    if (certModal) {
        certModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var title = button.getAttribute('data-cert-title');
            var imgSrc = button.getAttribute('data-cert-img');

            var modalTitle = certModal.querySelector('.modal-title');
            var modalImage = certModal.querySelector('#certModalImage');

            modalTitle.textContent = title;
            modalImage.src = imgSrc;
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
