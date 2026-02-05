<?php
/**
 * Header 部分的 Products 超级菜单内容
 * 为了复刻 HTML 中的复杂布局（图片、锁定图标等），这里暂时保持静态 HTML
 * 后期可以通过高级自定义字段 (SCF) 改为动态读取
 */
?>
<div class="dropdown-menu mega-menu shadow-lg" aria-labelledby="productsDropdown">
    <div class="container mega-menu-content">
        <div class="row">
            <!-- 左侧栏: 签名原创系列 -->
            <!-- 左侧栏: 移动端隐藏，只在桌面端显示 -->
            <div class="col-lg-7 border-end pe-lg-5 d-none d-lg-block">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="mega-menu-header mb-0 border-0 p-0 text-primary">★ Signature Originals</div>
                    <a href="<?php echo esc_url(home_url('/products/?filter=ip-protected')); ?>"
                        class="text-secondary-custom text-decoration-none small view-all-link">
                        View All Originals <i data-lucide="arrow-right"
                            style="width: 12px; height: 12px; vertical-align: middle;"></i>
                    </a>
                </div>

                <div class="row g-4">
                    <?php
                    // 查询主推产品 (product_featured = true)
                    $featured_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 3,
                        'meta_query' => array(
                            array(
                                'key' => 'product_featured',
                                'value' => '1',
                                'compare' => '='
                            )
                        )
                    );
                    $featured_products = new WP_Query($featured_args);

                    if ($featured_products->have_posts()):
                        while ($featured_products->have_posts()):
                            $featured_products->the_post();
                            $sku = get_field('product_sku');
                            $capacity = get_field('product_capacity');

                            // 获取分类
                            $terms = get_the_terms(get_the_ID(), 'product_cat');
                            $cat_name = '';
                            if ($terms && !is_wp_error($terms)) {
                                $cat_name = $terms[0]->name;
                            }

                            // 构建副标题 parts
                            $subtitle_parts = [];
                            if ($capacity)
                                $subtitle_parts[] = $capacity;
                            if ($cat_name)
                                $subtitle_parts[] = $cat_name;
                            $subtitle_text = implode(' · ', $subtitle_parts);
                            ?>
                            <div class="col-4">
                                <a href="<?php the_permalink(); ?>" class="menu-product-card">
                                    <div class="menu-product-img">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                        <?php else: ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.png"
                                                alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="menu-product-title">
                                        <?php echo esc_html($sku); ?> <i data-lucide="lock"
                                            style="width: 12px; height: 12px; color: var(--bs-primary)"></i>
                                    </div>
                                    <?php if ($subtitle_text): ?>
                                        <div class="menu-product-subtitle small text-muted">
                                            <?php echo esc_html($subtitle_text); ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        // 无主推产品时的占位提示
                        echo '<div class="col-12 text-center text-muted small py-4">No featured products at the moment.</div>';
                    endif;
                    ?>
                </div>

                <div class="mt-3 p-2 bg-light rounded text-center small text-secondary-custom">
                    <i data-lucide="shield-check" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                    All designs above are exclusive IP-protected originals by YUSU.
                </div>
            </div>

            <!-- 右侧栏: 分类 -->
            <!-- 右侧栏: 移动端全宽 -->
            <div class="col-12 col-lg-5 ps-lg-5">
                <div class="mega-menu-header">By Category</div>
                <div class="row">
                    <?php
                    // 获取所有产品分类
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false, // 显示空分类（可改为 true 只显示有产品的）
                        'orderby' => 'count',
                        'order' => 'DESC'
                    ));

                    if (!empty($categories) && !is_wp_error($categories)):
                        // 将分类分成两列
                        $total = count($categories);
                        $half = ceil($total / 2);
                        $col1 = array_slice($categories, 0, $half);
                        $col2 = array_slice($categories, $half);
                        ?>
                        <div class="col-12 col-sm-6">
                            <?php foreach ($col1 as $cat): ?>
                                <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="mega-menu-link">
                                    <?php echo esc_html($cat->name); ?> <span class="count"><?php echo $cat->count; ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <?php foreach ($col2 as $cat): ?>
                                <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="mega-menu-link">
                                    <?php echo esc_html($cat->name); ?> <span class="count"><?php echo $cat->count; ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="col-12 text-muted small">暂无分类，请在后台添加产品分类。</div>
                    <?php endif; ?>
                </div>
                <div class="mt-4">
                    <a href="<?php echo esc_url(home_url('/products')); ?>" class="btn btn-outline-dark w-100 py-3"
                        style="letter-spacing: 0.15em; font-weight: 600;">
                        BROWSE FULL CATALOG
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>