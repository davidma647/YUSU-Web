<?php
/**
 * Template Part: Home Page Content
 * Description: Extracted from home.html with Header/Footer removed and images replaced.
 * Usage: Copy content below into WordPress Editor for the Home page.
 */
?>

<!-- Attributes for Page Animations -->
<style>
    /* ============================================
       YUSU Design System - Custom SCSS Variables Override
       ============================================ */
    :root {
        /* Brand Colors */
        --bs-primary: #B08968;
        --bs-primary-hover: #9A7759;
        --bs-primary-active: #85674D;
        --bs-secondary: #5A5A5A;
        --bs-dark: #2D2D2D;
        --bs-light: #F8F8F8;
        --bs-text-secondary: #6B6B6B;

        /* Status Colors */
        --bs-danger: #B91C1C;
        --bs-success: #15803D;

        /* Typography */
        --font-serif: 'Cormorant Garamond', serif;
        --font-sans: 'Inter', sans-serif;

        /* Shadows */
        --shadow-primary: 0 4px 14px 0 rgba(176, 137, 104, 0.35);
        --shadow-card-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.05);

        /* Navbar Dimensions */
        --navbar-height: 80px;
        --navbar-scrolled-height: 70px;
    }

    /* ============================================
       Base Styles
       ============================================ */
    /* Scope body styles to prevent breaking theme */
    .home-page-wrapper {
        font-family: var(--font-sans);
        background-color: var(--bs-light);
        color: var(--bs-dark);
    }

    /* Fix for Anchor Scrolling behind Fixed Navbar */
    #categories-heading,
    section[id] {
        scroll-margin-top: 100px;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: var(--font-serif);
        color: var(--bs-dark);
    }

    .font-serif {
        font-family: var(--font-serif);
    }

    .text-primary {
        color: var(--bs-primary) !important;
    }

    .text-secondary-custom {
        color: var(--bs-text-secondary);
    }

    /* ============================================
       Button Overrides
       ============================================ */
    .btn-primary {
        background-color: var(--bs-primary);
        border: none;
        font-family: var(--font-sans);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        border-radius: 4px;
        box-shadow: var(--shadow-primary);
        padding: 0.75rem 1.5rem;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: var(--bs-primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(176, 137, 104, 0.25);
    }

    .btn-primary:active {
        background-color: var(--bs-primary-active);
        transform: translateY(0);
    }

    .btn-outline-dark {
        background: transparent;
        border: 1px solid var(--bs-dark);
        color: var(--bs-dark);
        font-family: var(--font-sans);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        transition: all 0.2s ease;
    }

    .btn-outline-dark:hover {
        background-color: var(--bs-dark);
        color: #fff;
    }

    /* ============================================
       Animation & Micro-interactions
       ============================================ */
    /* Preloader */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--bs-light);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
    }

    #preloader.fade-out {
        opacity: 0;
        visibility: hidden;
    }

    /* Scroll Animations */
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        will-change: opacity, transform;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Staggered delays */
    .delay-100 {
        transition-delay: 0.1s;
    }

    .delay-200 {
        transition-delay: 0.2s;
    }

    .delay-300 {
        transition-delay: 0.3s;
    }

    /* Product Card Interactions */
    .product-card {
        background: #fff;
        border: 1px solid #F3F4F6;
        border-radius: 4px;
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
        cursor: pointer;
    }

    .product-card:hover {
        box-shadow: var(--shadow-card-hover);
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }

    .product-card-image {
        position: relative;
        aspect-ratio: 1 / 1;
        background-color: #F8F8F8;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-card-image img {
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
    }

    /* Category Card Redesign */
    .category-card {
        display: block;
        text-decoration: none;
        transition: transform 0.3s ease;
        background: #fff;
        border: 1px solid #F3F4F6;
        border-radius: 4px;
        overflow: hidden;
        text-align: center;
        cursor: pointer;
    }

    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-card-hover);
    }

    .category-card-image-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 1 / 1;
        /* Was defined in inline style as 4/3 but CSS had 1/1 overrides, sticking to consistent square or 4/3 */
        aspect-ratio: 4 / 3;
        background-color: #F8F8F8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .category-card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.2, 1, 0.3, 1);
    }

    .category-card:hover .category-card-image-wrapper img {
        transform: scale(1.08);
    }

    /* Certification Hover Overlay */
    .cert-item {
        position: relative;
        cursor: pointer;
    }

    .cert-icon-wrapper {
        position: relative;
        z-index: 2;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), background-color 0.3s ease;
    }

    .cert-item:hover .cert-icon-wrapper {
        transform: scale(1.1);
        background-color: var(--bs-primary) !important;
        color: white !important;
    }

    .cert-view-hint {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%) translateY(10px);
        white-space: nowrap;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--bs-primary);
        font-weight: 600;
        pointer-events: none;
    }

    .cert-item:hover .cert-view-hint {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    /* Category Overlay Arrow */
    .category-overlay {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .category-card:hover .category-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .category-overlay i {
        color: var(--bs-primary);
        width: 20px;
        height: 20px;
    }

    .category-card-title {
        font-family: var(--font-serif);
        font-size: 1.125rem;
        font-weight: 500;
        color: var(--bs-dark);
        margin-bottom: 0.25rem;
        transition: color 0.3s ease;
        margin-top: 1rem;
    }

    .category-card:hover .category-card-title {
        color: var(--bs-primary);
    }

    .category-card-count {
        font-size: 0.875rem;
        color: var(--bs-text-secondary);
        margin-bottom: 1rem;
    }

    /* ============================================
       Hero Section
       ============================================ */
    .hero-section {
        min-height: 80vh;
        /* Using placeholder for banner */
        background: linear-gradient(90deg, rgba(248, 248, 248, 1) 30%, rgba(248, 248, 248, 0.8) 50%, rgba(248, 248, 248, 0) 100%), url('https://iph.href.lu/1920x800?text=Banner');
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        position: relative;
        /* Pull up behind navbar handled by negative margin in original, but here we might want to respect theme */
        margin-top: -30px;
        padding-top: 200px;
        padding-bottom: 100px;
        overflow: hidden;
    }

    @media (max-width: 992px) {
        .hero-section {
            background: linear-gradient(180deg, rgba(248, 248, 248, 1) 0%, rgba(248, 248, 248, 0.9) 100%), url('https://iph.href.lu/1920x800?text=Banner');
            background-size: cover;
            padding-top: 150px;
        }
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 600;
        color: var(--bs-dark);
        line-height: 1.2;
    }

    .hero-section .lead {
        font-size: 1.25rem;
        color: var(--bs-text-secondary);
        font-weight: 400;
    }

    .trust-indicator {
        display: inline-block;
        color: var(--bs-text-secondary);
        font-size: 0.875rem;
        font-weight: 500;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .trust-indicator-divider {
        color: rgba(0, 0, 0, 0.2);
    }

    /* Trust Bar (Client Logos) */
    .trust-bar {
        background-color: var(--bs-light);
        border-bottom: 1px solid #cccccc;
    }

    .logo-scroll-container {
        overflow: hidden;
        position: relative;
    }

    .logo-scroll-container::before,
    .logo-scroll-container::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 60px;
        z-index: 2;
        pointer-events: none;
    }

    .logo-scroll-container::before {
        left: 0;
        background: linear-gradient(90deg, var(--bs-light) 0%, transparent 100%);
    }

    .logo-scroll-container::after {
        right: 0;
        background: linear-gradient(-90deg, var(--bs-light) 0%, transparent 100%);
    }

    .logo-track {
        display: flex;
        gap: 3rem;
        animation: scrollLogos 30s linear infinite;
    }

    .logo-track img {
        height: 60px;
        /* Reduced slightly for placeholders */
        width: auto;
        object-fit: contain;
        filter: grayscale(100%);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .logo-track img:hover {
        filter: grayscale(0%);
        opacity: 1;
    }

    @keyframes scrollLogos {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Innovation Section */
    .innovation-section {
        background: linear-gradient(135deg, var(--bs-dark) 0%, #1a1a1a 100%);
        color: #fff;
    }

    .stat-value {
        font-family: var(--font-serif);
        font-size: 3.5rem;
        font-weight: 600;
        color: var(--bs-primary);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 0.5rem;
    }

    .innovation-section h2 {
        color: #fff;
    }

    .innovation-section p {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Process Steps */
    .process-step {
        text-align: center;
        position: relative;
    }

    .process-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: rgba(176, 137, 104, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: var(--bs-primary);
    }

    .process-step h4 {
        font-family: var(--font-sans);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .process-step p {
        font-size: 0.875rem;
        color: var(--bs-text-secondary);
        margin-bottom: 0;
    }

    @media (min-width: 992px) {
        .process-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 32px;
            right: -10%;
            width: 20%;
            height: 2px;
            background: linear-gradient(90deg, var(--bs-primary) 0%, rgba(176, 137, 104, 0.2) 100%);
        }
    }

    .proof-points {
        background-color: #fff;
        border-radius: 4px;
        border: 1px solid #F3F4F6;
    }

    .proof-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--bs-dark);
    }

    .proof-item i {
        color: var(--bs-success);
    }

    /* Testimonials */
    .testimonial-quote {
        font-family: var(--font-serif);
        font-size: 1.5rem;
        font-style: italic;
        color: var(--bs-dark);
        line-height: 1.6;
        position: relative;
    }

    .testimonial-quote::before {
        content: '"';
        font-size: 4rem;
        color: var(--bs-primary);
        opacity: 0.3;
        position: absolute;
        top: -1rem;
        left: -1.5rem;
        font-family: var(--font-serif);
    }

    .partner-logo {
        height: 40px;
        width: auto;
        filter: grayscale(100%);
        opacity: 0.6;
        transition: all 0.3s ease;
    }

    .partner-logo:hover {
        filter: grayscale(0%);
        opacity: 1;
    }

    /* Final CTA */
    .final-cta-section {
        background: linear-gradient(135deg, rgba(176, 137, 104, 0.95) 0%, rgba(154, 119, 89, 0.95) 100%),
            url('https://iph.href.lu/1920x800?text=Factory') center/cover no-repeat;
        color: #fff;
    }

    .final-cta-section h2 {
        color: #fff;
    }

    .final-cta-section p {
        color: rgba(255, 255, 255, 0.9);
    }

    .btn-white {
        background-color: #fff;
        color: var(--bs-dark);
        border: none;
        font-family: var(--font-sans);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        transition: all 0.2s ease;
    }

    .btn-white:hover {
        background-color: var(--bs-dark);
        color: #fff;
    }

    .btn-outline-white {
        background: transparent;
        border: 1px solid #fff;
        color: #fff;
        font-family: var(--font-sans);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        transition: all 0.2s ease;
    }

    .btn-outline-white:hover {
        background-color: #fff;
        color: var(--bs-dark);
    }

    /* FAQ Accordion */
    .accordion-premium .accordion-item {
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .accordion-premium .accordion-button {
        background: transparent;
        box-shadow: none;
        color: var(--bs-dark);
        font-family: var(--font-sans);
        font-size: 1.125rem;
        font-weight: 500;
        padding: 1.5rem 0;
    }

    .accordion-premium .accordion-button:not(.collapsed) {
        color: var(--bs-primary);
        background: transparent;
        box-shadow: none;
    }

    .accordion-premium .accordion-body {
        padding: 0 0 1.5rem 0;
        margin-top: -0.5rem;
        color: var(--bs-text-secondary);
        font-size: 1rem;
        line-height: 1.7;
        max-width: 90%;
    }
</style>

<div class="home-page-wrapper">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Module 1: Hero Section -->
    <section id="hero" class="hero-section" aria-labelledby="hero-heading">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-text-wrapper">
                    <span class="d-block text-primary fw-bold text-uppercase ls-1 mb-3 fade-up delay-100">
                        Top 100 China Beauty Packaging
                    </span>
                    <h1 class="display-3 fw-bold mb-4 fade-up delay-200">
                        Trend-Setting Packaging <br>
                        <span class="text-primary fst-italic">Innovations.</span>
                    </h1>
                    <p class="lead mb-5 fade-up delay-300">
                        Empower your brand with our R&D-driven architecture.
                        Launching <strong>100s of new designs annually</strong> to keep you ahead of the curve.
                        Select from 130+ exclusive originals or create your private mold.
                    </p>

                    <div class="d-flex gap-3 mb-5 fade-up delay-300">
                        <a href="products.html" class="btn btn-primary btn-lg">Explore Innovations</a>
                        <button type="button" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal"
                            data-bs-target="#sampleModal">Request Samples</button>
                    </div>

                    <div class="trust-indicators fade-up delay-300">
                        <div class="trust-indicator">
                            <i data-lucide="microscope" class="text-primary me-2" style="width: 18px;"></i>
                            In-House R&D
                        </div>
                        <span class="trust-indicator-divider">|</span>
                        <div class="trust-indicator">
                            <i data-lucide="shield-check" class="text-primary me-2" style="width: 18px;"></i>
                            IP Protection
                        </div>
                        <span class="trust-indicator-divider">|</span>
                        <div class="trust-indicator">
                            <i data-lucide="globe" class="text-primary me-2" style="width: 18px;"></i>
                            Global Logistics
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Module 2: Trust Bar -->
    <section id="trust-bar" class="trust-bar py-4" aria-label="Trusted by Leading Brands">
        <div class="container">
            <div class="text-center mb-4">
                <p class="text-secondary-custom text-uppercase"
                    style="font-size: 0.875rem; letter-spacing: 0.1em; font-weight: 600;">Brands We Work With</p>
            </div>
            <div class="logo-scroll-container">
                <div class="logo-track">
                    <!-- Repeated logos for scrolling effect -->
                    <img src="https://iph.href.lu/200x80?text=Brand+A" alt="Brand A" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+B" alt="Brand B" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+C" alt="Brand C" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+D" alt="Brand D" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+E" alt="Brand E" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+F" alt="Brand F" loading="lazy">

                    <img src="https://iph.href.lu/200x80?text=Brand+A" alt="Brand A" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+B" alt="Brand B" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+C" alt="Brand C" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+D" alt="Brand D" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+E" alt="Brand E" loading="lazy">
                    <img src="https://iph.href.lu/200x80?text=Brand+F" alt="Brand F" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Module 3: Hero Products Spotlight -->
    <section id="featured-products" class="py-5" aria-labelledby="featured-products-heading">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <h2 id="featured-products-heading" class="section-heading">Featured Originals</h2>
                <p class="section-subheading">Signature designs. Exclusively protected.</p>
            </div>

            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-md-4">
                    <article class="product-card h-100">
                        <div class="product-card-image">
                            <img src="https://iph.href.lu/200x300?text=Perfume" alt="Gold Bar Foundation Bottle"
                                loading="lazy">
                        </div>
                        <div class="p-4" style="cursor: default;">
                            <div class="product-badge mb-2">
                                <i data-lucide="lock" style="width: 14px; height: 14px;"></i>
                                YUSU Originals
                            </div>
                            <p class="mb-3 text-secondary-custom" style="font-size: 0.9375rem;">
                                Command shelf attention with this iconic, IP-protected silhouette.
                            </p>
                            <a href="product-detail.html" class="product-card-link">
                                View Details <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Product 2 -->
                <div class="col-md-4">
                    <article class="product-card h-100">
                        <div class="product-card-image">
                            <img src="https://iph.href.lu/200x300?text=Perfume" alt="Plum Blossom Bottle"
                                loading="lazy">
                        </div>
                        <div class="p-4" style="cursor: default;">
                            <div class="product-badge mb-2">
                                <i data-lucide="lock" style="width: 14px; height: 14px;"></i>
                                YUSU Originals
                            </div>
                            <p class="mb-3 text-secondary-custom" style="font-size: 0.9375rem;">
                                Infuse Eastern elegance into your line. A cultural icon.
                            </p>
                            <a href="product-detail.html" class="product-card-link">
                                View Details <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Product 3 -->
                <div class="col-md-4">
                    <article class="product-card h-100">
                        <div class="product-card-image">
                            <img src="https://iph.href.lu/200x300?text=Perfume" alt="Chamfered Bottle" loading="lazy">
                        </div>
                        <div class="p-4" style="cursor: default;">
                            <div class="product-badge mb-2">
                                <i data-lucide="lock" style="width: 14px; height: 14px;"></i>
                                YUSU Originals
                            </div>
                            <p class="mb-3 text-secondary-custom" style="font-size: 0.9375rem;">
                                Precision geometric engineering. Minimalist branding.
                            </p>
                            <a href="product-detail.html" class="product-card-link">
                                View Details <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- Module 4: Category Overview -->
    <section id="categories" class="py-5 bg-white" aria-labelledby="categories-heading">
        <div class="container py-lg-4">
            <div class="text-center mb-5 mw-800 mx-auto">
                <h2 id="categories-heading" class="section-heading display-5 fw-semibold mb-3">One Stop for Every
                    Category</h2>
                <p class="section-subheading text-secondary-custom lead">
                    Simplify your supply chain. 1000+ in-stock designs.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4">
                    <a href="products.html" class="category-card">
                        <div class="category-card-image-wrapper">
                            <img src="https://iph.href.lu/200x300?text=Foundation" alt="Foundation Bottles"
                                loading="lazy">
                            <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                        </div>
                        <div class="category-card-content">
                            <h3 class="category-card-title">Foundation Bottles</h3>
                            <p class="category-card-count">80+ Designs</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="products.html" class="category-card">
                        <div class="category-card-image-wrapper">
                            <img src="https://iph.href.lu/200x300?text=Lips" alt="Lipstick & Lip Glaze" loading="lazy">
                            <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                        </div>
                        <div class="category-card-content">
                            <h3 class="category-card-title">Lipstick & Glaze</h3>
                            <p class="category-card-count">60+ Designs</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="products.html" class="category-card">
                        <div class="category-card-image-wrapper">
                            <img src="https://iph.href.lu/200x300?text=Cushion" alt="Air Cushion Compacts"
                                loading="lazy">
                            <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                        </div>
                        <div class="category-card-content">
                            <h3 class="category-card-title">Compact Cushions</h3>
                            <p class="category-card-count">50+ Designs</p>
                        </div>
                    </a>
                </div>
                <!-- Row 2 -->
                <div class="col-6 col-md-4">
                    <a href="products.html" class="category-card">
                        <div class="category-card-image-wrapper">
                            <img src="https://iph.href.lu/200x300?text=Sunscreen" alt="Sunscreen" loading="lazy">
                            <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                        </div>
                        <div class="category-card-content">
                            <h3 class="category-card-title">Sun Protection</h3>
                            <p class="category-card-count">40+ Designs</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="products.html" class="category-card">
                        <div class="category-card-image-wrapper">
                            <img src="https://iph.href.lu/200x300?text=Perfume" alt="Perfume" loading="lazy">
                            <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                        </div>
                        <div class="category-card-content">
                            <h3 class="category-card-title">Perfume Bottles</h3>
                            <p class="category-card-count">30+ Designs</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="products.html" class="btn btn-outline-dark">
                    View All Products <i data-lucide="arrow-right" class="ms-2" style="width: 16px; height: 16px;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Module 5: Innovation Snapshot -->
    <section id="innovation" class="innovation-section py-5" aria-labelledby="innovation-heading">
        <div class="container py-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="position-relative rounded-3 overflow-hidden shadow-lg" style="min-height: 400px;">
                        <img src="https://iph.href.lu/400x500?text=Lab" alt="R&D Lab"
                            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                            style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white">
                            <div class="row g-2 text-center">
                                <div class="col-4 border-end border-white-50">
                                    <div class="h4 fw-bold mb-0">130+</div>
                                    <div class="small text-white-50" style="font-size: 0.75rem;">Patents</div>
                                </div>
                                <div class="col-4 border-end border-white-50">
                                    <div class="h4 fw-bold mb-0">1000+</div>
                                    <div class="small text-white-50" style="font-size: 0.75rem;">Molds</div>
                                </div>
                                <div class="col-4">
                                    <div class="h4 fw-bold mb-0">7 Days</div>
                                    <div class="small text-white-50" style="font-size: 0.75rem;">Prototyping</div>
                                </div>
                            </div>
                        </div>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 64px; height: 64px; cursor: pointer; opacity: 0.9;" data-bs-toggle="modal"
                                data-bs-target="#videoModal">
                                <i data-lucide="play" class="text-primary fill-primary"
                                    style="width: 24px; height: 24px; margin-left: 4px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 id="innovation-heading" class="section-heading mb-4">Where Beauty Meets Engineering</h2>
                    <p class="mb-4" style="font-size: 1.0625rem; line-height: 1.7;">
                        Our in-house R&D team develops hundreds of new designs annually.
                        From concept to mold, we control every step.
                        That's why 130+ of our designs are selected for IP protection.
                    </p>
                    <a href="innovation.html" class="btn btn-primary">
                        Discover Our Innovation <i data-lucide="arrow-right" class="ms-2"
                            style="width: 16px; height: 16px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Module 6: One-Stop Service -->
    <section id="services" class="py-5" aria-labelledby="services-heading">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <h2 id="services-heading" class="section-heading">Tired of Delays? We Control Every Step.</h2>
                <p class="section-subheading">Faster timelines. Fewer headaches. One trusted partner.</p>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-6 col-lg">
                    <div class="process-step">
                        <div class="process-icon"><i data-lucide="pencil-ruler" style="width: 28px; height: 28px;"></i>
                        </div>
                        <h4>Design</h4>
                        <p>Your idea meets our expertise.</p>
                    </div>
                </div>
                <div class="col-6 col-lg">
                    <div class="process-step">
                        <div class="process-icon"><i data-lucide="box" style="width: 28px; height: 28px;"></i></div>
                        <h4>Mold Dev</h4>
                        <p>50%+ faster than avg.</p>
                    </div>
                </div>
                <div class="col-6 col-lg">
                    <div class="process-step">
                        <div class="process-icon"><i data-lucide="factory" style="width: 28px; height: 28px;"></i></div>
                        <h4>Production</h4>
                        <p>Consistent quality at scale.</p>
                    </div>
                </div>
                <div class="col-6 col-lg">
                    <div class="process-step">
                        <div class="process-icon"><i data-lucide="palette" style="width: 28px; height: 28px;"></i></div>
                        <h4>Finishing</h4>
                        <p>Plating, UV, Screen Print.</p>
                    </div>
                </div>
                <div class="col-6 col-lg">
                    <div class="process-step">
                        <div class="process-icon"><i data-lucide="shield-check" style="width: 28px; height: 28px;"></i>
                        </div>
                        <h4>QC</h4>
                        <p>Zero compromise.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Module 6.5: Certifications -->
    <section class="py-5 bg-light border-top border-bottom">
        <div class="container">
            <div class="row text-center justify-content-center g-4">
                <div class="col-6 col-md-3 d-flex flex-column align-items-center cert-item" data-bs-toggle="modal"
                    data-bs-target="#certModal" data-cert-title="ISO 9001 Certification"
                    data-cert-img="https://iph.href.lu/600x800?text=ISO+9001">
                    <div class="cert-icon-wrapper mb-3 text-primary bg-white p-3 rounded-circle shadow-sm">
                        <i data-lucide="award" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="h6 text-uppercase fw-bold letter-spacing-1 mb-1">ISO 9001</h5>
                    <p class="small text-secondary-custom mb-0">Quality Management</p>
                </div>
                <div class="col-6 col-md-3 d-flex flex-column align-items-center cert-item" data-bs-toggle="modal"
                    data-bs-target="#certModal" data-cert-title="ISO 14001 Certification"
                    data-cert-img="https://iph.href.lu/600x800?text=ISO+14001">
                    <div class="cert-icon-wrapper mb-3 text-primary bg-white p-3 rounded-circle shadow-sm">
                        <i data-lucide="leaf" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="h6 text-uppercase fw-bold letter-spacing-1 mb-1">ISO 14001</h5>
                    <p class="small text-secondary-custom mb-0">Eco-Friendly Certified</p>
                </div>
                <div class="col-6 col-md-3 d-flex flex-column align-items-center cert-item" data-bs-toggle="modal"
                    data-bs-target="#certModal" data-cert-title="SGS Verification Report"
                    data-cert-img="https://iph.href.lu/600x800?text=SGS+Report">
                    <div class="cert-icon-wrapper mb-3 text-primary bg-white p-3 rounded-circle shadow-sm">
                        <i data-lucide="shield-check" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="h6 text-uppercase fw-bold letter-spacing-1 mb-1">SGS Verified</h5>
                    <p class="small text-secondary-custom mb-0">Safety & Compliance</p>
                </div>
                <div class="col-6 col-md-3 d-flex flex-column align-items-center cert-item" data-bs-toggle="modal"
                    data-bs-target="#certModal" data-cert-title="Top 100 China Beauty Packaging"
                    data-cert-img="https://iph.href.lu/600x800?text=Top+100+Award">
                    <div class="cert-icon-wrapper mb-3 text-primary bg-white p-3 rounded-circle shadow-sm">
                        <i data-lucide="star" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="h6 text-uppercase fw-bold letter-spacing-1 mb-1">Top 100</h5>
                    <p class="small text-secondary-custom mb-0">China Beauty Packaging</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Module 7: Testimonials -->
    <section id="testimonials" class="py-5 bg-white" aria-labelledby="testimonials-heading">
        <div class="container py-lg-4">
            <div class="text-center mb-5 mw-800 mx-auto">
                <h2 id="testimonials-heading" class="section-heading display-5 fw-semibold mb-3">Trusted by Global
                    Brands</h2>
                <p class="section-subheading text-secondary-custom lead">See why 500+ brands choose YUSU.</p>
            </div>
            <!-- Testimonial Carousel -->
            <div id="testimonialCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="text-center p-4">
                                    <i data-lucide="quote" class="text-primary mb-4"
                                        style="width: 48px; height: 48px; opacity: 0.2;"></i>
                                    <blockquote class="blockquote mb-4">
                                        <p class="fs-4 mb-0 fst-italic lh-base">"YUSU's R&D team helped us reduce our
                                            development cycle by 30%. Their foundation bottles are now our
                                            best-sellers."</p>
                                    </blockquote>
                                    <div class="mt-4">
                                        <h5 class="fw-bold mb-1 font-serif">Sarah Jenkins</h5>
                                        <p class="text-secondary-custom small text-uppercase letter-spacing-1">Product
                                            Director, LuxeBeauty (USA)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"
                        style="background-size: 50%;"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"
                        style="background-size: 50%;"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Module 8: Final CTA -->
    <section id="final-cta" class="final-cta-section py-5" aria-labelledby="final-cta-heading">
        <div class="container py-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 id="final-cta-heading" class="section-heading mb-3">Searching for a Unique Brand Identity?</h2>
                    <p class="mb-5" style="font-size: 1.125rem;">
                        Our R&D team launches <strong>100s of new designs annually</strong>.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <button type="button" class="btn btn-white" data-bs-toggle="modal"
                            data-bs-target="#sampleModal">
                            Request Samples
                        </button>
                        <a href="contact.html" class="btn btn-outline-white">Get a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Module 8.5: FAQ -->
    <section id="faq" class="py-5 bg-light border-top" aria-labelledby="faq-heading">
        <div class="container py-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 id="faq-heading" class="section-heading mb-3">Frequently Asked Questions</h2>
                    </div>
                    <div class="accordion accordion-flush accordion-premium" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    What is the Minimum Order Quantity (MOQ)?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our standard MOQ is <strong>10,000 units</strong> for most in-stock designs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How long does it take to get samples?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    For <strong>stock samples</strong>, we ship within 48 hours.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div> <!-- End .home-page-wrapper -->

<!-- Modals -->
<!-- 1. Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-black border-0">
            <div class="modal-header border-0 position-absolute end-0 top-0 z-3">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <!-- Video placeholder -->
                    <div class="d-flex align-items-center justify-content-center bg-dark text-white">Video Placeholder
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. Certification Modal -->
<div class="modal fade" id="certModal" tabindex="-1" aria-labelledby="certModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title font-serif fw-bold" id="certModalLabel">Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="certModalImage" src="" alt="Certificate" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

<!-- 3. Sample Request Modal -->
<div class="modal fade" id="sampleModal" tabindex="-1" aria-labelledby="sampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title font-serif fw-bold" id="sampleModalLabel">Request Free Samples</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-secondary small mb-4">Experience YUSU quality firsthand.</p>
                <form>
                    <div class="mb-3">
                        <label for="sampleEmail" class="form-label small text-uppercase fw-bold text-secondary">Business
                            Email</label>
                        <input type="email" class="form-control bg-light border-0" id="sampleEmail"
                            placeholder="name@company.com" required>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Init Icons
        if (typeof lucide !== 'undefined') { lucide.createIcons(); }

        // Preloader
        const preloader = document.getElementById('preloader');
        if (preloader) {
            window.addEventListener('load', function () {
                preloader.classList.add('fade-out');
                setTimeout(() => { preloader.remove(); }, 500);
            });
            setTimeout(() => { if (document.body.contains(preloader)) { preloader.classList.add('fade-out'); setTimeout(() => preloader.remove(), 500); } }, 3000);
        }

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
</script>