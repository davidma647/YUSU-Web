<?php
/**
 * Template Name: front Page
 * Description: 首页专用模板，直接加载 home.php 模板部件
 * 
 * WordPress 会自动将此文件用作首页模板。
 */

get_header();

// 获取 SCF 自定义字段 (返回格式需为 Image Array)
$front_page_id = get_option('page_on_front');
$hero_banner_data = function_exists('get_field') ? get_field('hero_banner', $front_page_id) : '';
$hero_banner_mobile_data = function_exists('get_field') ? get_field('hero_banner_mobile', $front_page_id) : '';
$cta_background = function_exists('get_field') ? get_field('cta_background', $front_page_id) : '';

// 解析 Hero Banner (Array or String fallback)
if (is_array($hero_banner_data)) {
    // 优先使用 sizes['full'] 确保获取原图，否则使用 url
    $hero_banner_url = isset($hero_banner_data['sizes']['full'])
        ? $hero_banner_data['sizes']['full']
        : $hero_banner_data['url'];
    $hero_banner_alt = $hero_banner_data['alt'] ?: 'YUSU Cosmetic Packaging Innovations';
    // 获取图片宽度用于 srcset
    $hero_banner_width = isset($hero_banner_data['width']) ? $hero_banner_data['width'] : '';
} else {
    $hero_banner_url = $hero_banner_data ?: 'https://iph.href.lu/1920x800?text=Banner';
    $hero_banner_alt = 'YUSU Cosmetic Packaging Innovations';
    $hero_banner_width = '';
}

// 解析 Mobile Banner
if (is_array($hero_banner_mobile_data)) {
    $hero_banner_mobile_url = isset($hero_banner_mobile_data['sizes']['full'])
        ? $hero_banner_mobile_data['sizes']['full']
        : $hero_banner_mobile_data['url'];
} else {
    $hero_banner_mobile_url = $hero_banner_mobile_data ?: $hero_banner_url;
}

// CTA Background still uses CSS background (URL only)
$cta_background_url = is_array($cta_background) ? $cta_background['url'] : ($cta_background ?: 'https://iph.href.lu/');
?>

<!-- Dynamic Banner Styles (CTA Only) -->
<style>
    .final-cta-section {
        background-image: linear-gradient(135deg, rgba(176, 137, 104, 0.95) 0%, rgba(133, 103, 77, 0.95) 100%), url('<?php echo esc_url($cta_background_url); ?>');
    }
</style>

<div class="home-page-wrapper">
    <!-- Module 1: Hero Section -->
    <section id="hero" class="hero-section" aria-labelledby="hero-heading">
        <!-- SEO Friendly Background -->
        <div class="hero-background">
            <!-- Desktop Banner: sizes="100vw" 强制使用最高分辨率 -->
            <img src="<?php echo esc_url($hero_banner_url); ?>" alt="<?php echo esc_attr($hero_banner_alt); ?>"
                class="hero-img d-none d-lg-block" sizes="100vw" loading="eager" fetchpriority="high">

            <!-- Mobile Banner -->
            <img src="<?php echo esc_url($hero_banner_mobile_url); ?>" alt="<?php echo esc_attr($hero_banner_alt); ?>"
                class="hero-img d-lg-none" sizes="100vw" loading="eager" fetchpriority="high">

            <div class="hero-gradient"></div>
        </div>

        <div class="container position-relative z-1">
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
                    <?php
                    // 获取 Trust Logos Repeater
                    $trust_logos = function_exists('get_field') ? get_field('trust_logos', $front_page_id) : false;

                    // 定义输出逻辑 (Closure to avoid global scope pollution)
                    $render_logos = function ($logos) {
                        if ($logos) {
                            foreach ($logos as $logo) {
                                // Gallery Field 直接返回 Image Array
                                if (is_array($logo)) {
                                    $img_url = $logo['url'];
                                    $img_alt = $logo['alt'] ?: 'Brand Partner';
                                } else {
                                    // 兼容如果返回格式是 URL
                                    $img_url = $logo;
                                    $img_alt = 'Brand Partner';
                                }

                                if ($img_url) {
                                    echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '" loading="lazy">';
                                }
                            }
                        } else {
                            // 兜底占位图 (Default Placeholders)
                            $placeholders = ['Brand A', 'Brand B', 'Brand C', 'Brand D', 'Brand E', 'Brand F'];
                            foreach ($placeholders as $brand) {
                                echo '<img src="https://iph.href.lu/200x80?text=' . urlencode($brand) . '" alt="' . esc_attr($brand) . '" loading="lazy">';
                            }
                        }
                    };

                    // 输出两遍以保持无限滚动效果 (Infinite Scroll)
                    $render_logos($trust_logos);
                    $render_logos($trust_logos);
                    ?>
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
                <?php
                // 查询勾选了"是否主推"的产品
                $featured_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'meta_query' => array(
                        array(
                            'key' => 'product_featured',
                            'value' => '1',
                            'compare' => '=',
                        ),
                    ),
                );
                $featured_query = new WP_Query($featured_args);

                if ($featured_query->have_posts()):
                    while ($featured_query->have_posts()):
                        $featured_query->the_post();
                        // 获取 SCF 自定义字段
                        $sku = get_field('product_sku');
                        $capacity = get_field('product_capacity');
                        $subtitle = get_field('product_subtitle');
                        $permalink = get_permalink();

                        // 组合标题：SKU + 容量
                        $title_parts = array_filter(array($sku, $capacity));
                        $product_title = !empty($title_parts) ? implode(' ', $title_parts) : get_the_title();

                        // 获取特色图片
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        $thumbnail_url = $thumbnail_url ?: 'https://iph.href.lu/200x300?text=Product';
                        $thumbnail_alt = esc_attr($product_title);
                        ?>
                        <div class="col-md-4">
                            <article class="product-card h-100">
                                <div class="product-card-image">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo $thumbnail_alt; ?>"
                                        loading="lazy">
                                </div>
                                <div class="p-4" style="cursor: default;">
                                    <div class="product-badge mb-2">
                                        <i data-lucide="lock" style="width: 14px; height: 14px;"></i>
                                        <?php echo esc_html($product_title); ?>
                                    </div>
                                    <!-- 副标题：product_subtitle -->
                                    <?php if ($subtitle): ?>
                                        <p class="mb-3 text-secondary-custom" style="font-size: 0.9375rem;">
                                            <?php echo esc_html($subtitle); ?>
                                        </p>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url($permalink); ?>" class="product-card-link">
                                        View Details <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    // 兜底占位内容 (当没有主推产品时)
                    $placeholders = array(
                        array('title' => 'YS-F001 30ml', 'subtitle' => 'Command shelf attention with this iconic design.'),
                        array('title' => 'YS-L002 15ml', 'subtitle' => 'Infuse Eastern elegance into your line.'),
                        array('title' => 'YS-C003 50ml', 'subtitle' => 'Precision geometric engineering.'),
                    );
                    foreach ($placeholders as $placeholder):
                        ?>
                        <div class="col-md-4">
                            <article class="product-card h-100">
                                <div class="product-card-image">
                                    <img src="https://iph.href.lu/200x300?text=Product"
                                        alt="<?php echo esc_attr($placeholder['title']); ?>" loading="lazy">
                                </div>
                                <div class="p-4" style="cursor: default;">
                                    <div class="product-badge mb-2">
                                        <i data-lucide="lock" style="width: 14px; height: 14px;"></i>
                                        <?php echo esc_html($placeholder['title']); ?>
                                    </div>
                                    <p class="mb-3 text-secondary-custom" style="font-size: 0.9375rem;">
                                        <?php echo esc_html($placeholder['subtitle']); ?>
                                    </p>
                                    <a href="#" class="product-card-link">
                                        View Details <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
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
                <?php
                // 获取所有 product_cat 分类
                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false, // 显示空分类
                    'number' => 6,     // 只获取6个
                    'orderby' => 'term_order', // 按顺序排序 (需要插件) 或改为 'name'
                    'order' => 'ASC',
                ));

                if (!empty($categories) && !is_wp_error($categories)):
                    foreach ($categories as $category):
                        // 获取分类封面图片 (SCF 自定义字段)
                        $category_image = get_field('category_image', 'term_' . $category->term_id);
                        $image_url = $category_image ? $category_image['url'] : 'https://iph.href.lu/400x300?text=' . urlencode($category->name);
                        $image_alt = $category_image ? ($category_image['alt'] ?: $category->name) : $category->name;

                        // 获取分类链接
                        $category_link = get_term_link($category);

                        // 产品数量显示
                        $product_count = $category->count;
                        $count_text = $product_count > 0 ? $product_count . '+ Designs' : 'Coming Soon';
                        ?>
                        <div class="col-6 col-md-4">
                            <a href="<?php echo esc_url($category_link); ?>" class="category-card">
                                <div class="category-card-image-wrapper">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                                        loading="lazy">
                                    <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                                </div>
                                <div class="category-card-content">
                                    <h3 class="category-card-title">
                                        <?php echo esc_html($category->name); ?>
                                    </h3>
                                    <p class="category-card-count">
                                        <?php echo esc_html($count_text); ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <?php
                    endforeach;
                else:
                    // 兜底：没有分类时显示占位内容
                    $placeholder_cats = array(
                        array('name' => 'Foundation Bottles', 'count' => '80+'),
                        array('name' => 'Lipstick & Glaze', 'count' => '60+'),
                        array('name' => 'Compact Cushions', 'count' => '50+'),
                        array('name' => 'Sun Protection', 'count' => '40+'),
                        array('name' => 'Perfume Bottles', 'count' => '30+'),
                        array('name' => 'Skincare Jars', 'count' => '45+'),
                    );
                    foreach ($placeholder_cats as $cat):
                        ?>
                        <div class="col-6 col-md-4">
                            <a href="#" class="category-card">
                                <div class="category-card-image-wrapper">
                                    <img src="https://iph.href.lu/400x300?text=<?php echo urlencode($cat['name']); ?>"
                                        alt="<?php echo esc_attr($cat['name']); ?>" loading="lazy">
                                    <div class="category-overlay"><i data-lucide="arrow-right"></i></div>
                                </div>
                                <div class="category-card-content">
                                    <h3 class="category-card-title">
                                        <?php echo esc_html($cat['name']); ?>
                                    </h3>
                                    <p class="category-card-count">
                                        <?php echo esc_html($cat['count']); ?> Designs
                                    </p>
                                </div>
                            </a>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>

            <div class="text-center mt-5">
                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-outline-dark">
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

<?php get_footer(); ?>