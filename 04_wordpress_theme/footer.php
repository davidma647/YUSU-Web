<?php
/**
 * Footer 模板
 */
?>
<!-- 对应 home.html 的 footer-container -->
<div id="footer-container">
    <footer class="site-footer py-5" role="contentinfo">
        <div class="container">
            <div class="row g-4 justify-content-between">

                <!-- 1. 品牌列 -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://yusupackaging.com/wp-content/uploads/2026/02/white-logo-transparent-background.png"
                            alt="YUSU Packaging" class="d-inline-block"
                            style="height: 60px; width: auto; margin-left: -12px; margin-right: -10px;">
                        <div class="d-flex flex-column">
                            <span class="font-serif fw-bold text-white fs-4 lh-1"
                                style="letter-spacing: 0.05em;">YUSU</span>
                            <span class="font-serif font-sans fw-medium text-white" style="font-size: 1rem;">宇塑包装</span>
                        </div>
                    </div>
                    <p class="mb-4 text-white-50" style="max-width: 300px;">
                        Premier cosmetic packaging innovator. Integrating In-House R&D, rapid mold engineering, and
                        smart manufacturing.
                    </p>
                    <div class="social-icons">
                        <a href="#"><i data-lucide="linkedin"></i></a>
                        <a href="#"><i data-lucide="instagram"></i></a>
                        <a href="#"><i data-lucide="facebook"></i></a>
                    </div>
                </div>

                <!-- 2. 产品链接 (动态分类) -->
                <div class="col-lg-2 col-md-6">
                    <h5>Products</h5>
                    <ul class="footer-links list-unstyled">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 6  // 限制显示数量
                        ));

                        if (!empty($categories) && !is_wp_error($categories)):
                            foreach ($categories as $cat):
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/products/?category=' . $cat->slug)); ?>">
                                        <?php echo esc_html($cat->name); ?>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                        endif;
                        ?>
                        <li>
                            <a href="<?php echo esc_url(home_url('/products')); ?>" class="text-primary">
                                View All →
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- 3. 公司链接 (动态引用) -->
                <div class="col-lg-2 col-md-6">
                    <h5>Company</h5>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-company',
                        'container' => false,
                        'menu_class' => 'footer-links',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>

                <!-- 4. 联系我们 (静态内容) -->
                <div class="col-lg-3 col-md-6">
                    <h5>Contact Us</h5>
                    <div class="footer-contact-item">
                        <i data-lucide="map-pin"></i>
                        <span class="text-white-50">Baiyun District, Guangzhou, China</span>
                    </div>
                    <div class="footer-contact-item">
                        <i data-lucide="mail"></i>
                        <a href="mailto:sales@yusupackaging.com">sales@yusupackaging.com</a>
                    </div>
                    <div class="footer-contact-item">
                        <i data-lucide="phone"></i>
                        <a href="tel:+861234567890">+86 123 456 7890</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom mt-5 pt-4 d-flex flex-wrap justify-content-between align-items-center">
                <p>&copy;
                    <?php echo date('Y'); ?> YUSU Packaging. All rights reserved.
                </p>
                <div class="d-flex gap-3">
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"
                        class="text-white-50 small text-decoration-none">Privacy Policy</a>
                    <a href="<?php echo esc_url(home_url('/terms-and-conditions')); ?>"
                        class="text-white-50 small text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php get_template_part('global-modals'); ?>

<?php wp_footer(); ?>

</body>

</html>