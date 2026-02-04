document.addEventListener('DOMContentLoaded', function () {

    // 1. Preloader Logic (Global)
    const preloader = document.getElementById('preloader');
    if (preloader) {
        window.addEventListener('load', function () {
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.remove();
            }, 500);
        });

        setTimeout(() => {
            if (document.body.contains(preloader)) {
                preloader.classList.add('fade-out');
                setTimeout(() => preloader.remove(), 500);
            }
        }, 3000);
    }

    // 2. Scroll Animations Utility (Global)
    // Only defines the observer, specific elements added per page usually, 
    // but we support .fade-up auto-trigger if the class exists.
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

    // 3. Dynamic Certification Modal (Footer Area)
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

    // 4. Image Preview / Lightbox (Global/Footer)
    const imageModalElement = document.getElementById('imagePreviewModal');
    let imageModal;
    if (imageModalElement) {
        imageModal = new bootstrap.Modal(imageModalElement);
    }

    // Attach listener to any product image with correct selector globally
    document.querySelectorAll('.product-card-image img').forEach(img => {
        img.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const src = this.getAttribute('src');
            const alt = this.getAttribute('alt');
            const previewImg = document.getElementById('imagePreviewImg');
            if (previewImg && imageModal) {
                previewImg.src = src;
                previewImg.alt = alt;
                imageModal.show();
            }
        });
    });

    // 5. Sticky Navbar Logic (Header)
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

    // 6. Desktop Dropdown Hover Interaction (Header)
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
