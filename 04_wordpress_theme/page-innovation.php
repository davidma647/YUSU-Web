<?php
/**
 * Template Name: Innovation Page
 * Description: 创新页面
 */

// 获取 SCF 自定义字段 (返回格式需为 Image Array)
$hero_banner_data = function_exists('get_field') ? get_field('hero_banner') : '';
$hero_banner_mobile_data = function_exists('get_field') ? get_field('hero_banner_mobile') : '';

// 解析 Hero Banner (Array or String fallback)
if (is_array($hero_banner_data)) {
    $hero_banner_url = isset($hero_banner_data['sizes']['full'])
        ? $hero_banner_data['sizes']['full']
        : $hero_banner_data['url'];
    $hero_banner_alt = $hero_banner_data['alt'] ?: 'YUSU Innovation - Cosmetic Packaging R&D';
} else {
    $hero_banner_url = $hero_banner_data ?: 'https://iph.href.lu/1920x800?text=Innovation+Banner';
    $hero_banner_alt = 'YUSU Innovation - Cosmetic Packaging R&D';
}

// 解析 Mobile Banner
if (is_array($hero_banner_mobile_data)) {
    $hero_banner_mobile_url = isset($hero_banner_mobile_data['sizes']['full'])
        ? $hero_banner_mobile_data['sizes']['full']
        : $hero_banner_mobile_data['url'];
} else {
    $hero_banner_mobile_url = $hero_banner_mobile_data ?: $hero_banner_url;
}

get_header();
?>

<!-- ============================================
     1. Innovation Hero Section
     ============================================ -->
<section id="innovation-hero" class="hero-section hero-innovation" aria-labelledby="hero-heading">
    <!-- Background Images (SCF Dynamic) -->
    <div class="hero-background">
        <!-- Desktop Banner -->
        <img src="<?php echo esc_url($hero_banner_url); ?>" alt="<?php echo esc_attr($hero_banner_alt); ?>"
            class="d-none d-lg-block">
        <!-- Mobile Banner -->
        <img src="<?php echo esc_url($hero_banner_mobile_url); ?>" alt="<?php echo esc_attr($hero_banner_alt); ?>"
            class="d-lg-none">
    </div>
    <!-- Gradient Overlay for Text Readability -->
    <div class="hero-overlay"></div>

    <div class="container position-relative z-1">
        <div class="row">
            <div class="col-lg-8 col-xl-7 hero-text-padding">
                <!-- H1 -->
                <h1 id="hero-heading" class="mb-3">
                    Trend-Setting Packaging Innovations
                </h1>

                <!-- Subheadline -->
                <p class="lead mb-4">
                    Empower Your Brand with our R&D. <strong>100+ Original Designs Created Annually</strong>. 130+
                    Available for Exclusive IP Protection.
                </p>

                <!-- Supporting Text -->
                <p class="mb-5 text-secondary-custom" style="max-width: 540px;">
                    Stand out in a crowded market with packaging solutions engineered for your success. Turn global
                    trends into your brand's exclusive assets—protected, premium, and ready for launch.
                </p>

                <!-- Trust Indicators -->
                <div class="d-flex flex-wrap gap-4 mb-5">
                    <span class="trust-indicator">
                        <i data-lucide="sparkles" style="width: 18px; height: 18px;"></i>
                        Trend-Setting R&D
                    </span>
                    <span class="trust-indicator-divider d-none d-md-inline">|</span>
                    <span class="trust-indicator">
                        <i data-lucide="factory" style="width: 18px; height: 18px;"></i>
                        In-House Mold Workshop
                    </span>
                    <span class="trust-indicator-divider d-none d-md-inline">|</span>
                    <span class="trust-indicator">
                        <i data-lucide="lock" style="width: 18px; height: 18px;"></i>
                        Exclusive Private Molds
                    </span>
                </div>

                <!-- CTA Buttons -->
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo esc_url(home_url('/products/')); ?>" class="btn btn-primary">
                        Explore Our Creations
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-outline-dark">
                        Start Custom Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     2. Data Visualization Section
     ============================================ -->
<section id="innovation-data" class="data-viz-section py-5">
    <div class="container py-lg-4">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="text-white mb-2">Innovation by the Numbers</h2>
            </div>
        </div>

        <div class="row g-0">
            <!-- Data Point 1 -->
            <div class="col-lg-4">
                <div class="counter-card h-100">
                    <div class="counter-value" data-value="130">130+</div>
                    <div class="counter-label">Exclusively Protected Originals</div>
                    <p class="counter-text">Secure your market share with verified patents.</p>
                </div>
            </div>

            <!-- Data Point 2 -->
            <div class="col-lg-4">
                <div class="counter-card h-100">
                    <div class="counter-value" data-value="1000">1000+</div>
                    <div class="counter-label">Market-Ready Library</div>
                    <p class="counter-text">Ready-to-customize designs across all categories.</p>
                </div>
            </div>

            <!-- Data Point 3 -->
            <div class="col-lg-4">
                <div class="counter-card h-100">
                    <div class="counter-value" data-value="10">10+</div>
                    <div class="counter-label">New Designs Annually</div>
                    <p class="counter-text">Launching market-ready designs consistently.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     3. Design Philosophy Section
     ============================================ -->
<section id="design-philosophy" class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-heading">Our Approach to Innovation</h2>
        </div>

        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-lg-4">
                <div class="feature-box">
                    <i data-lucide="sparkles" class="text-primary mb-3" style="width: 32px; height: 32px;"></i>
                    <h3>Trend-Setting Aesthetics</h3>
                    <p>Define the market rather than following it. Equip your brand with distinct visual identities
                        crafted to elevate your perceived value and command attention.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-lg-4">
                <div class="feature-box">
                    <i data-lucide="wrench" class="text-primary mb-3" style="width: 32px; height: 32px;"></i>
                    <h3>Precision Engineering</h3>
                    <p>Precision-engineered for heavy-wall luxury feel and airtight performance. We control every
                        micron from critical dimensions to final assembly.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-lg-4">
                <div class="feature-box">
                    <i data-lucide="shield-check" class="text-primary mb-3" style="width: 32px; height: 32px;"></i>
                    <h3>Full IP Protection</h3>
                    <p>Secure your market uniqueness. We provide comprehensive intellectual property protection for
                        our original designs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     LEAD MAGNET: Trend Report
     ============================================ -->
<section id="trend-report" class="py-5 bg-dark text-white position-relative overflow-hidden">
    <!-- Background decorative element -->
    <div class="position-absolute top-0 end-0 overflow-hidden h-100 w-50 d-none d-lg-block"
        style="background: linear-gradient(90deg, transparent, rgba(176, 137, 104, 0.1)); transform: skewX(-20deg);">
    </div>

    <div class="container position-relative z-1 py-lg-4">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <span class="text-primary text-uppercase fw-bold mb-2 d-block"
                    style="letter-spacing: 0.1em; font-size: 0.875rem;">Exclusive Insight</span>
                <h2 class="font-serif display-5 mb-3 text-white">2026 Cosmetic Packaging Trend Report</h2>
                <p class="text-white-50 lead mb-4" style="max-width: 600px;">
                    Stay ahead of the curve. Download our comprehensive analysis of sustainable materials,
                    luxury finishes, and smart packaging technologies shaping the future of beauty.
                </p>
                <div class="d-flex gap-4">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="check-circle" class="text-primary" style="width: 20px; height: 20px;"></i>
                        <span class="small text-white-50">Color Trends</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="check-circle" class="text-primary" style="width: 20px; height: 20px;"></i>
                        <span class="small text-white-50">Material Science</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="check-circle" class="text-primary" style="width: 20px; height: 20px;"></i>
                        <span class="small text-white-50">Consumer Shifts</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg bg-white text-dark p-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3 font-serif">Get Your Free Copy</h5>
                        <form>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label visually-hidden">Business Email</label>
                                <input type="email" class="form-control form-control-lg bg-light border-0"
                                    id="emailInput" placeholder="Business Email Address">
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary btn-lg">
                                    Download Report
                                    <i data-lucide="download" class="ms-2"
                                        style="width: 18px; height: 18px; vertical-align: text-bottom;"></i>
                                </button>
                            </div>
                            <div class="mt-3 text-center">
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    Join 5,000+ beauty brand founders. No spam.
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     4. IP-Protected Gallery Section
     ============================================ -->
<section id="protected-gallery" class="py-5">
    <div class="container py-lg-4">
        <!-- Section Title -->
        <div class="text-center mb-5">
            <h2 class="section-heading">Exclusive Originals</h2>
            <p class="section-subheading">Protected designs available only through YUSU. Each creation is registered
                for intellectual property protection.</p>
        </div>

        <!-- Product Cards (Dynamic Query: yusu-original) -->
        <div class="row g-4 mb-5">
            <?php
            $original_products = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => 3,
                'meta_query' => array(
                    array(
                        'key' => 'product_featured',
                        'value' => '1',
                        'compare' => '=',
                    ),
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($original_products->have_posts()):
                while ($original_products->have_posts()):
                    $original_products->the_post();
                    $sku = get_field('product_sku');
                    $capacity = get_field('product_capacity');
                    $patent = get_field('product_patent');
                    $description = get_field('product_description');
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    $alt_text = get_the_title();
                    ?>
                    <div class="col-md-4">
                        <article class="product-card h-100">
                            <div class="product-card-image">
                                <?php if ($thumbnail): ?>
                                    <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($alt_text); ?>"
                                        loading="lazy">
                                <?php else: ?>
                                    <img src="https://iph.href.lu/400x400?text=<?php echo urlencode($alt_text); ?>"
                                        alt="<?php echo esc_attr($alt_text); ?>" loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <?php if ($patent): ?>
                                    <div class="product-badge mb-2">
                                        <i data-lucide="lock" style="width: 14px; height: 14px;"></i>
                                        IP-Protected Design
                                    </div>
                                <?php endif; ?>
                                <h4 class="mb-2 fs-5 font-serif fw-bold"><?php the_title(); ?></h4>
                                <?php if ($sku || $capacity): ?>
                                    <div class="small text-muted mb-3">
                                        <?php if ($sku): ?>Code: <?php echo esc_html($sku); ?><?php endif; ?>
                                        <?php if ($sku && $capacity): ?> | <?php endif; ?>
                                        <?php if ($capacity): ?>
                                            <?php echo esc_html(is_array($capacity) ? implode(' / ', $capacity) : $capacity); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($description): ?>
                                    <p class="mb-3 text-secondary-custom" style="font-size: 0.9375rem;">
                                        <?php echo esc_html(wp_trim_words($description, 15, '...')); ?>
                                    </p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="product-detail-link">
                                    View Details <span class="link-arrow">→</span>
                                </a>
                            </div>
                        </article>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <!-- Fallback: 如果没有 yusu-original 产品，显示提示 -->
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Exclusive original products coming soon.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Gallery CTA -->
        <div class="text-center">
            <a href="<?php echo esc_url(home_url('/products/?filter=yusu-original')); ?>" class="btn btn-outline-dark">
                View All Signature Designs
                <i data-lucide="arrow-right" class="ms-2" style="width: 16px; height: 16px;"></i>
            </a>
        </div>

        <!-- Contextual Evidence: Certificate Grid -->
        <div class="mt-5 pt-4 border-top border-light-subtle">
            <p class="text-center text-secondary-custom small text-uppercase letter-spacing-1 mb-4">
                Verified Patent Certificates (Design & Utility)
            </p>
            <!-- Dynamic Certificates Scroller (Horizontal) -->
            <div class="cert-scroller-container position-relative">
                <button class="cert-scroller-nav prev" aria-label="Scroll Left">
                    <i data-lucide="chevron-left" style="width: 20px; height: 20px;"></i>
                </button>
                <button class="cert-scroller-nav next" aria-label="Scroll Right">
                    <i data-lucide="chevron-right" style="width: 20px; height: 20px;"></i>
                </button>

                <div class="cert-scroller-wrapper ps-lg-4 pe-lg-4 text-center text-lg-start">
                    <?php
                    $certificates = get_field('certificates');
                    if ($certificates):
                        foreach ($certificates as $cert):
                            $cert_title = $cert['cert_title'];
                            $cert_type_value = $cert['cert_type']; // 'patent' or 'factory'
                            $cert_image = $cert['cert_image'];

                            // Map select values to display labels
                            $cert_type_label = ($cert_type_value === 'factory') ? 'Factory Certification' : 'Design Patent';
                            if ($cert_type_value && !in_array($cert_type_value, ['patent', 'factory'])) {
                                $cert_type_label = ucfirst($cert_type_value); // Fallback for other values
                            }

                            // Image handling
                            $cert_img_url_full = is_array($cert_image) ? $cert_image['url'] : '';
                            $cert_img_url_thumb = is_array($cert_image) && isset($cert_image['sizes']['medium'])
                                ? $cert_image['sizes']['medium']
                                : $cert_img_url_full;
                            $cert_alt = is_array($cert_image) && !empty($cert_image['alt']) ? $cert_image['alt'] : $cert_title;

                            if ($cert_img_url_full):
                                ?>
                                <div class="cert-item-card cursor-pointer" data-bs-toggle="modal" data-bs-target="#certificateModal"
                                    data-cert-title="<?php echo esc_attr($cert_title); ?>"
                                    data-cert-type="<?php echo esc_attr($cert_type_label); ?>"
                                    data-cert-image="<?php echo esc_url($cert_img_url_full); ?>">
                                    <img src="<?php echo esc_url($cert_img_url_thumb); ?>" alt="<?php echo esc_attr($cert_alt); ?>"
                                        class="rounded">
                                    <div class="cert-meta">
                                        <span class="cert-title"><?php echo esc_html($cert_title); ?></span>
                                        <span class="cert-type-badge"><?php echo esc_html($cert_type_label); ?></span>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                    else:
                        ?>
                        <div class="col-12 text-center text-muted py-5">
                            <small>Certificates loading...</small>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Interaction Hint -->
                <div class="text-center mt-3 d-lg-none">
                    <small class="text-muted"><i data-lucide="move-horizontal"
                            style="width:14px; vertical-align:middle; margin-right:4px;"></i> Swipe to explore</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     5. Process Showcase Section
     ============================================ -->
<section id="process-showcase" class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="text-center mb-5">
            <h2 class="section-heading">From Trend to Product</h2>
            <p class="section-subheading">Bring your vision to life faster. A streamlined 5-step journey from
                trend insight to finished product, designed for your speed-to-market.</p>
        </div>

        <div class="row g-4 mb-5">
            <!-- Step 1 -->
            <div class="col-6 col-lg">
                <div class="process-step">
                    <div class="process-icon">
                        <i data-lucide="search" style="width: 28px; height: 28px;"></i>
                    </div>
                    <h4>Trend Analysis</h4>
                    <p>Global market insights.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-6 col-lg">
                <div class="process-step">
                    <div class="process-icon">
                        <i data-lucide="lightbulb" style="width: 28px; height: 28px;"></i>
                    </div>
                    <h4>Concept</h4>
                    <p>Original sketches.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-6 col-lg">
                <div class="process-step">
                    <div class="process-icon">
                        <i data-lucide="box" style="width: 28px; height: 28px;"></i>
                    </div>
                    <h4>3D Modeling</h4>
                    <p>Precision detailing.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-6 col-lg">
                <div class="process-step">
                    <div class="process-icon">
                        <i data-lucide="hammer" style="width: 28px; height: 28px;"></i>
                    </div>
                    <h4>In-House Mold</h4>
                    <p>Closed-loop fabrication.</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="col-6 col-lg">
                <div class="process-step">
                    <div class="process-icon">
                        <i data-lucide="factory" style="width: 28px; height: 28px;"></i>
                    </div>
                    <h4>Production</h4>
                    <p>Quality manufacturing.</p>
                </div>
            </div>
        </div>

        <!-- Process Differentiator Box -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="proof-points p-4 text-center"
                    style="background: rgba(176, 137, 104, 0.05); border-color: rgba(176, 137, 104, 0.2);">
                    <h5 class="font-serif fw-bold text-primary mb-2">Closed-Loop Control</h5>
                    <p class="mb-0 text-secondary-custom">
                        Gain full transparency and speed. With our entire process in-house—from design to mold to
                        production—you avoid third-party delays and enjoy consistent, premium quality controlled at
                        every step.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     R&D FAQ (GEO Optimized)
     ============================================ -->
<section id="innovation-faq" class="py-5 bg-white border-top border-light-subtle">
    <div class="container py-lg-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="section-heading mb-3">Common Questions</h2>
                </div>

                <div class="accordion accordion-flush" id="accordionRnD">
                    <!-- FAQ 1: Timeline -->
                    <div class="accordion-item border-bottom border-light-subtle">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-4 bg-transparent fw-bold font-serif fs-5"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                What is the typical timeline for a private mold project?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionRnD">
                            <div class="accordion-body pb-4 text-secondary-custom">
                                For a standard custom project, our "Rapid 35" protocol applies:
                                <strong>7 days</strong> for 3D engineering, <strong>25 days</strong> for mold
                                piloting, and <strong>3 days</strong> for T1 sampling.
                                Total development time is approximately 5-7 weeks, significantly faster than the
                                industry average of 12 weeks.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2: Cost -->
                    <div class="accordion-item border-bottom border-light-subtle">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-4 bg-transparent fw-bold font-serif fs-5"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                                How much does a custom cosmetic bottle mold cost?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionRnD">
                            <div class="accordion-body pb-4 text-secondary-custom">
                                Investment varies by complexity, typically ranging from <strong>$2,000 to
                                    $8,000</strong> for injection molds.
                                However, YUSU offers a <strong class="text-primary">"Volume Rebate
                                    Program"</strong>—mold costs can be fully refunded once orders reach a
                                agreed-upon volume threshold.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3: IP Ownership -->
                    <div class="accordion-item border-bottom border-light-subtle">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-4 bg-transparent fw-bold font-serif fs-5"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree">
                                Who owns the intellectual property (IP) of the design?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionRnD">
                            <div class="accordion-body pb-4 text-secondary-custom">
                                You do. For all Private Mold projects, <strong>the client retains 100% IP
                                    ownership</strong> universally.
                                We sign a binding NDA and Non-Compete Agreement before starting, ensuring your
                                unique design remains exclusively yours.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4: Minimum Order Quantity (MOQ) -->
                    <div class="accordion-item border-bottom border-light-subtle">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-4 bg-transparent fw-bold font-serif fs-5"
                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour">
                                What is the MOQ for custom developed items?
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionRnD">
                            <div class="accordion-body pb-4 text-secondary-custom">
                                While our standard stock items have an MOQ of 5,000 units, custom private mold
                                projects generally require an MOQ of <strong>10,000 to 20,000 units</strong>
                                per run to ensure production efficiency and cost-effectiveness.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     6. Final CTA Section
     ============================================ -->
<section id="final-cta" class="final-cta-section py-5">
    <div class="container py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="section-heading mb-3">Innovating Your Brand,<br>Protecting Your Uniqueness.</h2>
                <p class="mb-5" style="font-size: 1.125rem;">
                    Launch your next bestseller with packaging that is uniquely yours. Integrate our R&D power,
                    rapid engineering, and smart manufacturing into your supply chain.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-outline-white">
                        Start Private Mold Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>