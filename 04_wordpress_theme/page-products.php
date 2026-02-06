<?php
/**
 * Template Name: Products Page
 *
 * @package Bootscore
 */

get_header();
?>

<div class="page-products">

    <!-- Category Hero -->
    <section class="category-hero">
        <div class="container">
            <h1>Foundation Bottles &amp; Liquid Foundation Packaging</h1>
            <p class="lead">
                Elevate your base makeup products with packaging that speaks to precision and luxury.
                Explore our collection of 50+ premium foundation bottles.
            </p>
        </div>
    </section>

    <!-- Visual Filter Layout (Redesign) -->
    <div class="container">
        <!-- Filter Bar -->
        <div class="filter-bar sticky-top z-3" style="top: var(--navbar-height);">
            <div class="d-flex align-items-center justify-content-between mb-0">
                <span class="text-uppercase fw-bold small text-secondary-custom">Filter By <span
                        class="text-primary ms-1">3 Active</span></span>
                <button class="btn btn-sm btn-outline-dark d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterPanel" aria-expanded="false" aria-controls="filterPanel">
                    Filters <i data-lucide="chevron-down" class="filter-chevron ms-1" style="width: 14px;"></i>
                </button>
                <button class="btn btn-link text-decoration-none text-secondary small d-none d-lg-block">Reset
                    All</button>
            </div>

            <div class="collapse d-lg-block mt-3" id="filterPanel">
                <div class="d-flex flex-column gap-3">
                    <!-- Row 1: Shape -->
                    <div class="d-flex align-items-center overflow-x-auto pb-2 filter-row">
                        <span class="filter-category-label text-secondary-custom text-uppercase fw-bold">Shape</span>
                        <div class="filter-pills d-flex gap-2 flex-nowrap" role="group" aria-label="Shape Filter">
                            <input type="checkbox" class="btn-check" id="shape-round" autocomplete="off" checked>
                            <label class="btn btn-sm btn-outline-secondary" for="shape-round">Round</label>

                            <input type="checkbox" class="btn-check" id="shape-square" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="shape-square">Square</label>

                            <input type="checkbox" class="btn-check" id="shape-oval" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="shape-oval">Oval</label>

                            <input type="checkbox" class="btn-check" id="shape-irregular" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="shape-irregular">Geometric</label>
                        </div>
                    </div>

                    <!-- Row 2: Material -->
                    <div class="d-flex align-items-center overflow-x-auto pb-2 filter-row">
                        <span class="filter-category-label text-secondary-custom text-uppercase fw-bold">Material</span>
                        <div class="filter-pills d-flex gap-2 flex-nowrap" role="group" aria-label="Material Filter">
                            <input type="checkbox" class="btn-check" id="mat-glass" autocomplete="off" checked>
                            <label class="btn btn-sm btn-outline-secondary" for="mat-glass">Glass</label>

                            <input type="checkbox" class="btn-check" id="mat-petg" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="mat-petg">PETG (Heavy Wall)</label>

                            <input type="checkbox" class="btn-check" id="mat-acrylic" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="mat-acrylic">Acrylic</label>

                            <input type="checkbox" class="btn-check" id="mat-pcr" autocomplete="off" disabled>
                            <label class="btn btn-sm btn-outline-secondary" for="mat-pcr">PCR (Coming Soon)</label>
                        </div>
                    </div>

                    <!-- Row 3: Capacity -->
                    <div class="d-flex align-items-center overflow-x-auto pb-2 filter-row">
                        <span class="filter-category-label text-secondary-custom text-uppercase fw-bold">Capacity</span>
                        <div class="filter-pills d-flex gap-2 flex-nowrap" role="group" aria-label="Capacity Filter">
                            <input type="checkbox" class="btn-check" id="cap-15" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="cap-15">15ml</label>

                            <input type="checkbox" class="btn-check" id="cap-30" autocomplete="off" checked>
                            <label class="btn btn-sm btn-outline-secondary" for="cap-30">30ml (Standard)</label>

                            <input type="checkbox" class="btn-check" id="cap-50" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="cap-50">50ml</label>

                            <input type="checkbox" class="btn-check" id="cap-100" autocomplete="off">
                            <label class="btn btn-sm btn-outline-secondary" for="cap-100">100ml+</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row g-4 mb-5">
            <!-- Product 1 -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <span class="badge-ip">IP: Patent #2024</span>
                            <img src="https://iph.href.lu/300x400?text=Product+1"
                                alt="Serenity Cylinder Foundation Bottle" class="img-fluid" itemprop="image"
                                loading="lazy">
                            <!-- Hover Actions -->
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Serenity Cylinder</h2>
                            <p class="product-meta mb-0">SKU: B-AP40 | 30ml/50ml</p>
                            <meta itemprop="description"
                                content="Minimalist cylinder design compatible with dropper and pump.">
                        </div>
                    </a>
                </article>
            </div>

            <!-- Product 2 -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <img src="https://iph.href.lu/300x400?text=Product+2" alt="Geo-Architecture Square Bottle"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Geo-Arch Square</h2>
                            <p class="product-meta mb-0">SKU: B-SQ22 | 30ml</p>
                        </div>
                    </a>
                </article>
            </div>

            <!-- Product 3 -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <img src="https://iph.href.lu/300x400?text=Product+3" alt="Velvet Touch Round"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Velvet Touch</h2>
                            <p class="product-meta mb-0">SKU: B-RND55 | 30ml/40ml</p>
                        </div>
                    </a>
                </article>
            </div>

            <!-- Product 4 -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <span class="badge-ip">IP: Exclusive</span>
                            <img src="https://iph.href.lu/300x400?text=Product+4" alt="Dual-Chamber Fusion Bottle"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Dual Fusion</h2>
                            <p class="product-meta mb-0">SKU: B-DUAL10 | 15ml x 2</p>
                        </div>
                    </a>
                </article>
            </div>

            <!-- Product 5 -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <img src="https://iph.href.lu/300x400?text=Product+5" alt="Organic Pebble Bottle"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Organic Pebble</h2>
                            <p class="product-meta mb-0">SKU: B-PEB01 | 50ml</p>
                        </div>
                    </a>
                </article>
            </div>

            <!-- Product 6 -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <img src="https://iph.href.lu/300x400?text=Product+6" alt="Precision Dropper Bottle"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Precision Dropper</h2>
                            <p class="product-meta mb-0">SKU: B-DRP20 | 15ml/30ml</p>
                        </div>
                    </a>
                </article>
            </div>

            <!-- Duplicated items to fill grid for demo -->
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <img src="https://iph.href.lu/300x400?text=Product+7" alt="Classic Oval Bottle"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Classic Oval</h2>
                            <p class="product-meta mb-0">SKU: B-OVL05 | 30ml</p>
                        </div>
                    </a>
                </article>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <article class="product-card h-100" itemscope itemtype="https://schema.org/Product">
                    <a href="product-detail.html" class="d-block h-100 text-decoration-none" itemprop="url">
                        <div class="product-img-wrapper position-relative">
                            <span class="badge-ip">New Arrival</span>
                            <img src="https://iph.href.lu/300x400?text=Product+8" alt="Crystal Diamond Bottle"
                                class="img-fluid" itemprop="image" loading="lazy">
                            <div class="hover-actions text-center justify-content-center">
                                <span class="btn btn-sm btn-primary w-100">View Specs</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="product-title" itemprop="name">Crystal Diamond</h2>
                            <p class="product-meta mb-0">SKU: B-DIA88 | 50ml</p>
                        </div>
                    </a>
                </article>
            </div>

        </div>

        <!-- Load More -->
        <div class="text-center mb-5">
            <button class="btn btn-outline-dark" disabled>Load More (Demo)</button>
        </div>

    </div>

    <!-- USP Bar -->
    <section class="usp-bar">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="usp-item">
                        <div class="usp-icon-wrapper">
                            <i data-lucide="shield-check"></i>
                        </div>
                        <div class="usp-content">
                            <h5>Mold Ownership</h5>
                            <p>Private molds guaranteed exclusive for 2 years.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="usp-item">
                        <div class="usp-icon-wrapper">
                            <i data-lucide="zap"></i>
                        </div>
                        <div class="usp-content">
                            <h5>Fast Prototyping</h5>
                            <p>3D samples in 48 hours. Production molds in 25 days.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="usp-item">
                        <div class="usp-icon-wrapper">
                            <i data-lucide="globe"></i>
                        </div>
                        <div class="usp-content">
                            <h5>Global Logistics</h5>
                            <p>DDP shipping to US/EU. We handle customs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Secondary Categories -->
    <section class="secondary-category-section text-center">
        <div class="container">
            <h2 class="cat-heading font-serif">Explore Other Categories</h2>
            <div class="row g-4 justify-content-center mt-4">
                <div class="col-6 col-md-3">
                    <a href="#" class="d-block text-decoration-none text-dark">
                        <img src="https://iph.href.lu/200x200?text=Lipstick" class="img-fluid rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="h6 text-uppercase fw-bold letter-spacing-1">Lipstick</h4>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#" class="d-block text-decoration-none text-dark">
                        <img src="https://iph.href.lu/200x200?text=Cushion" class="img-fluid rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="h6 text-uppercase fw-bold letter-spacing-1">Cushion</h4>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#" class="d-block text-decoration-none text-dark">
                        <img src="https://iph.href.lu/200x200?text=Skincare" class="img-fluid rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="h6 text-uppercase fw-bold letter-spacing-1">Skincare Jars</h4>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#" class="d-block text-decoration-none text-dark">
                        <img src="https://iph.href.lu/200x200?text=Accessories" class="img-fluid rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="h6 text-uppercase fw-bold letter-spacing-1">Accessories</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
get_footer();
