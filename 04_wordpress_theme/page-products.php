<?php
/**
 * Template Name: Products Page
 * Description: 产品展示页 (Category: Foundation & Packaging)
 */

get_header();
?>

<!-- 1. 核心英雄区域 (Foundation Bottles) -->
<section class="category-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate-on-scroll">
                <span class="d-block text-primary fw-bold text-uppercase ls-1 mb-3">
                    <?php echo esc_html__('Core Collection', 'bootscore-child'); ?>
                </span>
                <h1>
                    <?php echo esc_html__('Trend-Setting Foundation Bottles &', 'bootscore-child'); ?> <br>
                    <span
                        class="text-primary"><?php echo esc_html__('Liquid Foundation Packaging', 'bootscore-child'); ?></span>
                </h1>
                <p class="lead mb-4">
                    <?php echo esc_html__('Define your brand with our R&D-driven packaging architecture. Select from 100+ market-ready originals, engineered for precision application and visual dominance.', 'bootscore-child'); ?>
                </p>
                <div class="mb-4">
                    <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#leadGenModal"
                        data-bs-whatever="<?php echo esc_attr__('Catalog Download', 'bootscore-child'); ?>">
                        <?php echo esc_html__('Request Full Catalog', 'bootscore-child'); ?>
                    </button>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="sparkles" class="text-primary" size="20"></i>
                        <span
                            class="text-secondary-custom"><?php echo esc_html__('Trend-Setting R&D', 'bootscore-child'); ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="check-circle" class="text-primary" size="20"></i>
                        <span
                            class="text-secondary-custom"><?php echo esc_html__('In-House Mold Workshop', 'bootscore-child'); ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="package" class="text-primary" size="20"></i>
                        <span
                            class="text-secondary-custom fw-medium"><?php echo esc_html__('MOQ: 10,000 pcs', 'bootscore-child'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. 视觉筛选栏 (Dynamic via SCF & Taxonomies) -->
<section class="filter-bar shadow-sm">
    <div class="container">
        <!-- Header (Toggle) -->
        <div class="d-flex justify-content-between align-items-center animate-on-scroll delay-100">
            <button class="btn btn-link text-decoration-none text-dark p-0 d-flex align-items-center gap-2"
                type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false"
                aria-controls="filterCollapse">
                <i data-lucide="settings-2" size="18"></i> <!-- "Filter" icon -->
                <span class="h6 text-uppercase fw-bold letter-spacing-1 mb-0">
                    <?php echo esc_html__('Filter Designs', 'bootscore-child'); ?>
                </span>
                <i data-lucide="chevron-down" size="16" class="ms-1 filter-chevron transition-icon"></i>
            </button>

            <button id="clearFiltersBtn" class="btn btn-link p-0 text-decoration-none text-secondary small d-none">
                <i data-lucide="x" size="14"
                    class="me-1"></i><?php echo esc_html__('Clear All Filters', 'bootscore-child'); ?>
            </button>
        </div>

        <!-- Collapsible Filter Grid -->
        <div class="collapse" id="filterCollapse">
            <div class="filter-grid d-flex flex-column gap-3 pt-4 border-top mt-3">

                <?php
                // --- 1. Collections (Product Categories - Level 1) ---
                // 获取所有顶级分类
                $parent_terms = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => 0,
                    'orderby' => 'meta_value_num', // 假设有排序字段
                    'meta_key' => 'category_sort_order', // SCF 排序字段
                    'order' => 'ASC'
                ));

                // 为了处理子分类联动，我们需要先构建一个数据结构
                // format: { parent_slug: [ {term_id, name, slug} ] }
                $sub_categories_map = array();

                if (!is_wp_error($parent_terms) && !empty($parent_terms)):
                    ?>
                    <!-- Row 1: Collections (Grand Categories) -->
                    <div class="row align-items-center g-0">
                        <div class="col-12 col-md-auto">
                            <span class="filter-category-label text-secondary text-uppercase fw-bold d-block mb-2 mb-md-0">
                                <?php echo esc_html__('Collections', 'bootscore-child'); ?>
                            </span>
                        </div>
                        <div class="col-12 col-md">
                            <div class="filter-pills d-flex flex-wrap gap-2">
                                <?php foreach ($parent_terms as $term):
                                    // 获取子分类
                                    $child_terms = get_terms(array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => false, // 即使没有文章也可能想显示
                                        'parent' => $term->term_id
                                    ));

                                    if (!empty($child_terms)) {
                                        $sub_categories_map[$term->slug] = array_map(function ($child) {
                                            return array(
                                                'slug' => $child->slug,
                                                'name' => $child->name
                                            );
                                        }, $child_terms);
                                    }
                                    ?>
                                    <input type="checkbox" class="btn-check parent-cat-trigger"
                                        id="cat-<?php echo esc_attr($term->slug); ?>" autocomplete="off"
                                        data-filter-value=".cat-<?php echo esc_attr($term->slug); ?>"
                                        data-term-slug="<?php echo esc_attr($term->slug); ?>">
                                    <label class="btn btn-sm btn-outline-secondary"
                                        for="cat-<?php echo esc_attr($term->slug); ?>">
                                        <?php echo esc_html($term->name === 'YUSU Originals' ? '✨ ' . $term->name : $term->name); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Row 1.5: Sub-Categories (Dynamic - Level 2) -->
                <!-- 数据传递给 JS -->
                <script>
                    window.subCategoriesMap = <?php echo json_encode($sub_categories_map); ?>;
                </script>
                <div id="subCategoryRow" class="row align-items-center g-0 sub-category-row"
                    style="display: none; overflow: hidden;">
                    <div class="col-12 col-md-auto">
                        <span class="filter-category-label text-secondary text-uppercase fw-bold d-block mb-2 mb-md-0"
                            id="subCategoryLabel"><?php echo esc_html__('Refine', 'bootscore-child'); ?></span>
                    </div>
                    <div class="col-12 col-md">
                        <div class="filter-pills d-flex flex-wrap gap-2" id="subCategoryPills">
                            <!-- Dynamically populated via JS -->
                        </div>
                    </div>
                </div>

                <?php
                /**
                 * 辅助函数：生成 SCF 字段筛选行
                 * 注意：请确保在 SCF 设置中将这些字段类型设置为 Select (下拉选择) 或 Radio/Checkbox，
                 * 这样 get_field_object 才能获取到 'choices' 数组。
                 */
                function render_scf_filter_row($label, $field_name, $filter_prefix)
                {
                    // 获取字段对象
                    // 主要问题：在 Page 页面上直接调用 get_field_object可能获取不到 product Post Type 的字段设置
                    $field = get_field_object($field_name);

                    // 如果获取失败或者没有 choices，尝试找一个真实的产品 ID 来获取字段定义
                    if (!$field || empty($field['choices'])) {
                        // 尝试获取一个已发布的产品 ID
                        $example_products = get_posts(array(
                            'post_type' => 'product',
                            'posts_per_page' => 1,
                            'fields' => 'ids',
                            'post_status' => 'publish',
                        ));

                        if ($example_products) {
                            $product_id = $example_products[0];
                            $field = get_field_object($field_name, $product_id);
                        }
                    }

                    // 再次检查，如果还是没有 choices，则无法渲染筛选行
                    if (!$field || empty($field['choices'])) {
                        // 调试信息 (仅管理员可见或开发者模式)
                        // echo '<!-- Field ' . esc_html($field_name) . ' not found or has no choices. -->';
                        return;
                    }
                    ?>
                    <div class="row align-items-center g-0">
                        <div class="col-12 col-md-auto">
                            <span class="filter-category-label text-secondary text-uppercase fw-bold d-block mb-2 mb-md-0">
                                <?php echo esc_html($label); ?>
                            </span>
                        </div>
                        <div class="col-12 col-md">
                            <div class="filter-pills d-flex flex-wrap gap-2">
                                <?php foreach ($field['choices'] as $value => $label_text):
                                    // 构建 filter value key, e.g. "vol-30ml"
                                    // 使用 sanitize_html_class 确保 CSS 类名安全
                                    $safe_value = sanitize_html_class($filter_prefix . '-' . $value);
                                    ?>
                                    <input type="checkbox" class="btn-check" id="<?php echo esc_attr($safe_value); ?>"
                                        autocomplete="off" data-filter-value=".<?php echo esc_attr($safe_value); ?>">
                                    <label class="btn btn-sm btn-outline-secondary" for="<?php echo esc_attr($safe_value); ?>">
                                        <?php echo esc_html($label_text); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                /**
                 * 辅助函数：生成 Taxonomy 分类筛选行
                 * 用于 Volume (product_capacity) 和 Material (product_material)
                 */
                function render_taxonomy_filter_row($label, $taxonomy_slug, $filter_prefix)
                {
                    // 检查分类法是否存在
                    if (!taxonomy_exists($taxonomy_slug)) {
                        return;
                    }

                    // 获取非空 terms
                    $terms = get_terms(array(
                        'taxonomy' => $taxonomy_slug,
                        'hide_empty' => false, // 仅显示有产品的选项
                    ));

                    if (empty($terms) || is_wp_error($terms)) {
                        return;
                    }
                    ?>
                    <div class="row align-items-center g-0">
                        <div class="col-12 col-md-auto">
                            <span class="filter-category-label text-secondary text-uppercase fw-bold d-block mb-2 mb-md-0">
                                <?php echo esc_html($label); ?>
                            </span>
                        </div>
                        <div class="col-12 col-md">
                            <div class="filter-pills d-flex flex-wrap gap-2">
                                <?php foreach ($terms as $term):
                                    // 构建 filter value key, e.g. "vol-slug"
                                    $safe_value = sanitize_html_class($filter_prefix . '-' . $term->slug);
                                    ?>
                                    <input type="checkbox" class="btn-check" id="<?php echo esc_attr($safe_value); ?>"
                                        autocomplete="off" data-filter-value=".<?php echo esc_attr($safe_value); ?>">
                                    <label class="btn btn-sm btn-outline-secondary" for="<?php echo esc_attr($safe_value); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                // --- 2. Filters ---
                
                // Volume (Taxonomy: product_capacity)
                // ⚠️ 如果您的分类法 slug 不是 product_capacity，请修改此处
                render_taxonomy_filter_row(__('Volume', 'bootscore-child'), 'product_capacity', 'vol');

                // Material (Taxonomy: product_material)
                // ⚠️ 如果您的分类法 slug 不是 product_material，请修改此处
                render_taxonomy_filter_row(__('Material', 'bootscore-child'), 'product_material', 'mat');
                ?>

            </div> <!-- End Filter Grid -->
        </div> <!-- End Collapse -->
    </div> <!-- End Container -->
</section>



<!-- 3. 产品网格 (Dynamic WP_Query) -->
<section class="pb-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="product-grid">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,        // Load all items, hide extra via JS/CSS
                'orderby' => 'menu_order title',
                'order' => 'ASC',
            );

            $product_query = new WP_Query($args);
            $loop_index = 0; // Initialize counter
            
            // Prepare Interceptor Card HTML for dynamic insertion
            ob_start();
            ?>
            <div class="col interceptor-card animate-on-scroll delay-300">
                <div class="product-card bg-dark text-white h-100 d-flex flex-column justify-content-center align-items-center text-center p-4 position-relative overflow-hidden"
                    style="min-height: 480px; cursor: default;">
                    <!-- Background Pattern/Effect -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10"
                        style="background: radial-gradient(circle at top right, #B08968, transparent);"></div>
                    <div class="position-relative z-1">
                        <i data-lucide="book-open" class="text-primary mb-3" style="width: 48px; height: 48px;"></i>
                        <h3 class="h4 fw-bold mb-2"><?php echo esc_html__('Not finding the one?', 'bootscore-child'); ?>
                        </h3>
                        <p class="small text-white-50 mb-4" style="line-height: 1.4;">
                            <?php echo wp_kses_post(__('Download our full 2026 Catalog with <strong>500+ designs</strong> not shown here.', 'bootscore-child')); ?>
                        </p>
                        <button class="btn btn-primary w-100 text-uppercase letter-spacing-1" data-bs-toggle="modal"
                            data-bs-target="#leadGenModal"
                            data-bs-whatever="<?php echo esc_attr__('Catalog Download: Interceptor Card', 'bootscore-child'); ?>">
                            <?php echo esc_html__('SEND REQUIREMENTS', 'bootscore-child'); ?>
                        </button>
                    </div>
                </div>
            </div>
            <?php
            $interceptor_html = ob_get_clean();

            if ($product_query->have_posts()):
                while ($product_query->have_posts()):
                    $product_query->the_post();
                    $loop_index++;

                    // Logic: Insert at 6th position (Index 6) if found_posts >= 6
                    if ($loop_index === 6 && $product_query->found_posts >= 6) {
                        echo $interceptor_html;
                    }

                    // --- 获取筛选数据 ---
                    $filter_classes = array();

                    // 1. Categories (Parent & Child)
                    $terms = get_the_terms(get_the_ID(), 'product_cat');
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            // 添加当前分类 (可能是子分类)
                            $filter_classes[] = 'cat-' . $term->slug;

                            // 如果是子分类，也添加其父分类的 Class
                            if ($term->parent != 0) {
                                $parent_term = get_term($term->parent, 'product_cat');
                                if ($parent_term && !is_wp_error($parent_term)) {
                                    $filter_classes[] = 'cat-' . $parent_term->slug;
                                }
                            }
                        }
                    }

                    // 2. Filters (Volume & Material now via Taxonomy)
            
                    // Volume (Taxonomy: product_capacity)
                    $vol_terms = get_the_terms(get_the_ID(), 'product_capacity');
                    if ($vol_terms && !is_wp_error($vol_terms)) {
                        foreach ($vol_terms as $term) {
                            $filter_classes[] = 'vol-' . $term->slug;
                        }
                    }

                    // Material (Taxonomy: product_material)
                    $mat_terms = get_the_terms(get_the_ID(), 'product_material');
                    if ($mat_terms && !is_wp_error($mat_terms)) {
                        foreach ($mat_terms as $term) {
                            $filter_classes[] = 'mat-' . $term->slug;
                        }
                    }

                    // 3. SCF Fields (Aesthetic & Closure remain common fields)
            
                    // Aesthetic
                    $aesthetic = get_field('product_aesthetic');
                    if (is_array($aesthetic)) {
                        foreach ($aesthetic as $a)
                            $filter_classes[] = 'style-' . sanitize_html_class($a);
                    } else if ($aesthetic) {
                        $filter_classes[] = 'style-' . sanitize_html_class($aesthetic);
                    }

                    // Closure
                    $closure = get_field('product_closure');
                    if (is_array($closure)) {
                        foreach ($closure as $c)
                            $filter_classes[] = 'close-' . sanitize_html_class($c);
                    } else if ($closure) {
                        $filter_classes[] = 'close-' . sanitize_html_class($closure);
                    }

                    // 其他 Tags (如 yusu-original based on product_featured)
                    $is_featured = get_field('product_featured');
                    if ($is_featured) {
                        $filter_classes[] = 'yusu-original';
                    }

                    // 将类名去重并组合
                    $filter_class_string = implode(' ', array_unique($filter_classes));
                    // Add standard filter-item class
                    $filter_class_string = 'filter-item ' . $filter_class_string;

                    // Add 'd-none' and 'to-be-loaded' class if index > 6
                    if ($loop_index > 6) {
                        $filter_class_string .= ' d-none to-be-loaded';
                    }

                    // --- 获取其他显示字段 ---
                    $sku = get_field('product_sku');
                    $subtitle = get_field('product_subtitle') ?: get_the_title(); // Fallback
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    ?>

                    <!-- Product Card -->
                    <div class="col animate-on-scroll <?php echo esc_attr($filter_class_string); ?>">
                        <div class="product-card">
                            <?php if (has_term('yusu-originals', 'product_cat')): ?>
                                <span class="badge-ip"><?php echo esc_html__('✨ YUSU Original', 'bootscore-child'); ?></span>
                            <?php endif; ?>

                            <div class="product-img-wrapper">
                                <img src="<?php echo esc_url($image_url ?: 'https://placehold.co/400x400/F5F5F5/d1d1d1?text=No+Image'); ?>"
                                    alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                                <div class="hover-actions d-flex flex-column gap-2 p-3">
                                    <a href="<?php echo esc_url(get_permalink()); ?>"
                                        class="btn btn-primary btn-sm text-uppercase fw-medium ls-1 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                        <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
                                        <?php echo esc_html__('View Details', 'bootscore-child'); ?>
                                    </a>
                                    <button
                                        class="btn btn-outline-dark btn-sm text-uppercase fw-medium ls-1 d-flex align-items-center justify-content-center gap-2 bg-white"
                                        data-bs-toggle="modal" data-bs-target="#leadGenModal"
                                        data-bs-whatever="<?php echo esc_attr__('Sample Request: ', 'bootscore-child') . esc_attr($sku ?: get_the_title()); ?>">
                                        <i data-lucide="package" style="width: 14px; height: 14px;"></i>
                                        <?php echo esc_html__('Request Sample', 'bootscore-child'); ?>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="product-title" style="cursor: default;"><?php echo esc_html($sku ?: get_the_title()); ?></h3>
                                <div class="product-subtitle mt-2" style="cursor: default;">
                                    <?php
                                    $specs = array();

                                    // Volume
                                    if (!empty($vol_terms) && !is_wp_error($vol_terms)) {
                                        $vol_names = wp_list_pluck($vol_terms, 'name');
                                        $specs[] = esc_html(implode('/', $vol_names));
                                    }

                                    // Material
                                    if (!empty($mat_terms) && !is_wp_error($mat_terms)) {
                                        $mat_names = wp_list_pluck($mat_terms, 'name');
                                        $specs[] = esc_html(implode('/', $mat_names));
                                    }

                                    if (!empty($specs)): ?>
                                                    <p class="small text-secondary text-uppercase fw-semibold mb-0 letter-spacing-1">
                                                        <?php echo implode('<span class="mx-2 opacity-25">|</span>', $specs); ?>
                                                    </p>
                                            <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                endwhile;
                wp_reset_postdata();
            endif; // End if have_posts
            ?>

            <!-- No Results State (Controlled by JS) -->
            <div id="js-no-results"
                class="col-12 w-100 d-none d-flex flex-column justify-content-center align-items-center py-5"
                style="min-height: 400px;">
                <div class="empty-state-card text-center" style="max-width: 400px;">
                    <i data-lucide="search-x" class="text-secondary mb-3 opacity-50"
                        style="width: 64px; height: 64px;"></i>
                    <h4 class="h5 fw-bold text-dark mb-2">
                        <?php echo esc_html__('No products found', 'bootscore-child'); ?>
                    </h4>
                    <p class="text-secondary small mb-4">
                        <?php echo esc_html__('We may have custom solutions not listed online. Tell us exactly what you need.', 'bootscore-child'); ?>
                    </p>
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#leadGenModal"
                        data-bs-whatever="<?php echo esc_attr__('Custom Product Request', 'bootscore-child'); ?>">
                        <?php echo esc_html__('Send Requirements', 'bootscore-child'); ?>
                    </button>
                </div>
            </div>

            <!-- Interceptor Card (Dynamic Fallback) -->
            <?php
            // If total products < 6, show interceptor at the end
            if ($product_query->found_posts < 6) {
                echo $interceptor_html;
            }
            ?>

        </div>

        <!-- Pagination / Load More -->
        <?php if ($product_query->found_posts > 6): ?>
            <div class="text-center mt-5">
                <button id="loadMoreBtn"
                    class="btn btn-outline-dark px-5"><?php echo esc_html__('Load More Designs', 'bootscore-child'); ?></button>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 4. 信任信号/USP 栏 (Trust Signals) -->
<aside class="usp-bar">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="usp-item">
                    <div class="usp-icon-wrapper">
                        <i data-lucide="zap" size="24"></i>
                    </div>
                    <div class="usp-content">
                        <h5><?php echo esc_html__('Continuous Innovation', 'bootscore-child'); ?></h5>
                        <p><?php echo esc_html__('Launching 100+ market-ready designs annually.', 'bootscore-child'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 animate-on-scroll delay-100">
                <div class="usp-item">
                    <div class="usp-icon-wrapper">
                        <i data-lucide="factory" size="24"></i>
                    </div>
                    <div class="usp-content">
                        <h5><?php echo esc_html__('In-House Manufacturing', 'bootscore-child'); ?></h5>
                        <p><?php echo esc_html__('From mold to production, 100% controlled internally.', 'bootscore-child'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 animate-on-scroll delay-200">
                <div class="usp-item">
                    <div class="usp-icon-wrapper">
                        <i data-lucide="shield-check" size="24"></i>
                    </div>
                    <div class="usp-content">
                        <h5><?php echo esc_html__('Exclusive Protection', 'bootscore-child'); ?></h5>
                        <p><?php echo esc_html__('Secure your market share with verified patents.', 'bootscore-child'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 animate-on-scroll delay-300">
                <div class="usp-item">
                    <div class="usp-icon-wrapper">
                        <i data-lucide="search-check" size="24"></i>
                    </div>
                    <div class="usp-content">
                        <h5><?php echo esc_html__('Quality Assurance', 'bootscore-child'); ?></h5>
                        <p><?php echo esc_html__('Rigorous compatibility testing and pump precision checks.', 'bootscore-child'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Global Trade Terms Hint -->
        <div class="row mt-5 pt-4 border-top border-light">
            <div class="col-12 text-center">
                <div class="d-inline-flex align-items-center gap-4 py-2 px-4 rounded-pill bg-light border">
                    <span
                        class="text-secondary-custom small fw-bold text-uppercase ls-1"><?php echo esc_html__('Trade Terms:', 'bootscore-child'); ?></span>
                    <span class="text-dark small"><i data-lucide="anchor" size="14" class="me-1 text-primary"></i>
                        FOB Guangzhou</span>
                    <span class="text-dark small"><i data-lucide="credit-card" size="14" class="me-1 text-primary"></i>
                        <?php echo esc_html__('T/T, L/C Accepted', 'bootscore-child'); ?></span>
                    <span class="text-dark small"><i data-lucide="truck" size="14" class="me-1 text-primary"></i>
                        <?php echo esc_html__('Global Shipping', 'bootscore-child'); ?></span>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- 5. 辅助品类展示区 (Secondary Categories) -->

<!-- Lip Packaging -->
<section class="secondary-category-section bg-light">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate-on-scroll">
                <h2 class="cat-heading"><?php echo esc_html__('Trend-Setting Lip Artistry', 'bootscore-child'); ?></h2>
                <p class="lead text-secondary-custom mb-4">
                    <?php echo esc_html__('Engineered for performance: heavy-weight luxury monuments and leak-proof glaze wands that define premium quality.', 'bootscore-child'); ?>
                </p>
                <ul class="feature-list">
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Airtight Integrity:</strong> Zero-drying technology preserves complex formulas.', 'bootscore-child')); ?>
                    </li>
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Tactile Experience:</strong> Premium magnetic closure with a satisfying "click".', 'bootscore-child')); ?>
                    </li>
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Surface Mastery:</strong> Soft-touch, PVD metallization, or crystal-clear lensing.', 'bootscore-child')); ?>
                    </li>
                </ul>
                <a href="#"
                    class="btn btn-primary mt-3"><?php echo esc_html__('Explore Lip Collection', 'bootscore-child'); ?></a>
            </div>
            <div class="col-lg-6 animate-on-scroll delay-100">
                <img loading="lazy" src="https://placehold.co/800x500/EAEAEA/B08968?text=Lipstick+Tubes+Render"
                    alt="<?php echo esc_attr__('Lipstick Packaging', 'bootscore-child'); ?>"
                    class="img-fluid rounded shadow-sm">
            </div>
        </div>
    </div>
</section>

<!-- Sun Protection -->
<section class="secondary-category-section bg-white">
    <div class="container">
        <div class="row align-items-center flex-lg-row-reverse mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-5 animate-on-scroll">
                <h2 class="cat-heading"><?php echo esc_html__('High-Performance SPF Shielding', 'bootscore-child'); ?>
                </h2>
                <p class="lead text-secondary-custom mb-4">
                    <?php echo esc_html__('Packaging that protects your formula as effectively as it protects skin. UV-stable, travel-ready architectures.', 'bootscore-child'); ?>
                </p>
                <ul class="feature-list">
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Agile Launch:</strong> Rapid prototyping to meet seasonal summer deadlines.', 'bootscore-child')); ?>
                    </li>
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Nomadic Design:</strong> Ergonomic, leak-proof designs for on-the-go application.', 'bootscore-child')); ?>
                    </li>
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Formula Stability:</strong> Materials rigorously tested for UV resistance and compatibility.', 'bootscore-child')); ?>
                    </li>
                </ul>
                <a href="#"
                    class="btn btn-outline-dark mt-3"><?php echo esc_html__('Explore SPF Solutions', 'bootscore-child'); ?></a>
            </div>
            <div class="col-lg-6 animate-on-scroll delay-100">
                <img loading="lazy" src="https://placehold.co/800x500/EAEAEA/B08968?text=Sunscreen+Bottles+Render"
                    alt="<?php echo esc_attr__('Sun Screen Packaging', 'bootscore-child'); ?>"
                    class="img-fluid rounded shadow-sm">
            </div>
        </div>
    </div>
</section>

<!-- Air Cushion -->
<section class="secondary-category-section bg-light">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate-on-scroll">
                <h2 class="cat-heading"><?php echo esc_html__('Next-Gen Cushions & Compacts', 'bootscore-child'); ?>
                </h2>
                <p class="lead text-secondary-custom mb-4">
                    <?php echo esc_html__('The perfect balance of portability and seal integrity. Slim, airtight designs for modern formulations.', 'bootscore-child'); ?>
                </p>
                <ul class="feature-list">
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Engineered Closures:</strong> Security you can feel with every close.', 'bootscore-child')); ?>
                    </li>
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Leak-Proof Core:</strong> Double-sealed inner structure prevents spillage.', 'bootscore-child')); ?>
                    </li>
                    <li><i data-lucide="check"></i>
                        <?php echo wp_kses_post(__('<strong>Premium Optics:</strong> High-definition glass mirrors included standard.', 'bootscore-child')); ?>
                    </li>
                </ul>
                <a href="#"
                    class="btn btn-outline-dark mt-3"><?php echo esc_html__('Explore Compacts', 'bootscore-child'); ?></a>
            </div>
            <div class="col-lg-6 animate-on-scroll delay-100">
                <img loading="lazy" src="https://placehold.co/800x500/EAEAEA/B08968?text=Cushion+Compact+Render"
                    alt="<?php echo esc_attr__('Air Cushion Compacts', 'bootscore-child'); ?>"
                    class="img-fluid rounded shadow-sm">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="bg-dark text-white rounded p-5 text-center animate-on-scroll">
            <h2 class="font-serif text-white mb-3">
                <?php echo esc_html__('Searching for a Unique Brand Identity?', 'bootscore-child'); ?>
            </h2>
            <p class="text-white-50 mb-4" style="max-width: 650px; margin: 0 auto; line-height: 1.6;">
                <?php echo wp_kses_post(__('Our R&D team launches <strong>100s of new designs annually</strong>. Partner with us to create your private mold or select from our Innovation Library.', 'bootscore-child')); ?>
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="contact.html"
                    class="btn btn-primary"><?php echo esc_html__('Start Your Project', 'bootscore-child'); ?></a>
                <a href="https://wa.me/861234567890?text=Hi,%20I'm%20interested%20in%20your%20packaging%20solutions"
                    class="btn btn-outline-light d-inline-flex align-items-center justify-content-center"
                    target="_blank">
                    <i data-lucide="message-circle" style="width: 18px; height: 18px; margin-right: 6px;"></i>
                    <?php echo esc_html__('Discuss Requirements', 'bootscore-child'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 6. 认证证书条 (Trust Signals) -->
<section class="py-4 border-top border-bottom bg-light">
    <div class="container">
        <div class="row row-cols-2 row-cols-md-4 g-4 justify-content-center align-items-center text-center opacity-75">
            <!-- Cert 1: ISO 9001 -->
            <div class="col animate-on-scroll">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2">
                    <i data-lucide="award" class="text-secondary" size="24"></i>
                    <div class="text-start">
                        <span class="d-block fw-bold text-uppercase small text-dark"
                            style="font-size: 0.75rem; letter-spacing: 0.05em;">ISO 9001</span>
                        <span class="d-block text-secondary-custom"
                            style="font-size: 0.7rem;"><?php echo esc_html__('Quality Certified', 'bootscore-child'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Cert 2: ISO 14001 -->
            <div class="col animate-on-scroll delay-100">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2">
                    <i data-lucide="leaf" class="text-secondary" size="24"></i>
                    <div class="text-start">
                        <span class="d-block fw-bold text-uppercase small text-dark"
                            style="font-size: 0.75rem; letter-spacing: 0.05em;">ISO 14001</span>
                        <span class="d-block text-secondary-custom"
                            style="font-size: 0.7rem;"><?php echo esc_html__('Eco Standard', 'bootscore-child'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Cert 3: SGS -->
            <div class="col animate-on-scroll delay-200">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2">
                    <i data-lucide="shield-check" class="text-secondary" size="24"></i>
                    <div class="text-start">
                        <span class="d-block fw-bold text-uppercase small text-dark"
                            style="font-size: 0.75rem; letter-spacing: 0.05em;"><?php echo esc_html__('SGS Verified', 'bootscore-child'); ?></span>
                        <span class="d-block text-secondary-custom"
                            style="font-size: 0.7rem;"><?php echo esc_html__('Audited Factory', 'bootscore-child'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Cert 4: Patents -->
            <div class="col animate-on-scroll delay-300">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2">
                    <i data-lucide="scroll-text" class="text-secondary" size="24"></i>
                    <div class="text-start">
                        <span class="d-block fw-bold text-uppercase small text-dark"
                            style="font-size: 0.75rem; letter-spacing: 0.05em;"><?php echo esc_html__('130+ Patents', 'bootscore-child'); ?></span>
                        <span class="d-block text-secondary-custom"
                            style="font-size: 0.7rem;"><?php echo esc_html__('IP Protection', 'bootscore-child'); ?></span>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- 7. SEO/采购情报 (Collapsed) -->
<section class="py-4 bg-light border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="accordion shadow-sm rounded-3 overflow-hidden" id="sourcingIntelAccordion">
                    <div class="accordion-item border-0 animate-on-scroll">
                        <h2 class="accordion-header" id="headingIntel">
                            <button
                                class="accordion-button collapsed bg-white py-4 fw-bold text-uppercase letter-spacing-1"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseIntel"
                                aria-expanded="false" aria-controls="collapseIntel">
                                <div class="d-flex align-items-center gap-3 w-100">
                                    <i data-lucide="book-open-check" class="text-primary"></i>
                                    <span><?php echo esc_html__('Sourcing Intelligence', 'bootscore-child'); ?></span>
                                    <span
                                        class="ms-auto me-3 text-secondary small fw-normal text-capitalize d-none d-md-block opacity-75">
                                        <?php echo esc_html__('Material Comparison • MOQ • Customization', 'bootscore-child'); ?>
                                    </span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseIntel" class="accordion-collapse collapse" aria-labelledby="headingIntel"
                            data-bs-parent="#sourcingIntelAccordion">
                            <div class="accordion-body bg-light p-4 p-md-5">
                                <div class="row g-5">
                                    <!-- GEO Component 1: Material Comparison Table -->
                                    <div class="col-lg-6 border-end-lg border-light-subtle">
                                        <h3 class="font-serif fw-bold h5 mb-3">
                                            <?php echo esc_html__('strategies: Glass vs. Polymer', 'bootscore-child'); ?>
                                        </h3>
                                        <p class="text-secondary small mb-4">
                                            <?php echo esc_html__('Compare material properties to align with your brand positioning.', 'bootscore-child'); ?>
                                        </p>
                                        <div class="table-responsive bg-white rounded shadow-sm p-3">
                                            <table
                                                class="table table-borderless table-striped table-hover align-middle small mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-uppercase" style="font-size: 0.7rem;">
                                                        <th scope="col" class="py-2 text-secondary">
                                                            <?php echo esc_html__('Feature', 'bootscore-child'); ?>
                                                        </th>
                                                        <th scope="col" class="py-2">
                                                            <?php echo esc_html__('Heavy-Glass', 'bootscore-child'); ?>
                                                        </th>
                                                        <th scope="col" class="py-2">
                                                            <?php echo esc_html__('PETG (Polymer)', 'bootscore-child'); ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-bold text-secondary">
                                                            <?php echo esc_html__('Aesthetic', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><?php echo esc_html__('Premium, Crystal', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><?php echo esc_html__('Optical Clarity', 'bootscore-child'); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold text-secondary">
                                                            <?php echo esc_html__('Tactile', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><?php echo esc_html__('Heavy Luxury', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><?php echo esc_html__('Lightweight', 'bootscore-child'); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold text-secondary">
                                                            <?php echo esc_html__('Suitability', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><?php echo esc_html__('Prestige Tier', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><?php echo esc_html__('Masstige / Travel', 'bootscore-child'); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold text-secondary">
                                                            <?php echo esc_html__('Eco-Profile', 'bootscore-child'); ?>
                                                        </td>
                                                        <td><span
                                                                class="badge bg-success bg-opacity-10 text-success rounded-pill"><?php echo esc_html__('Recyclable', 'bootscore-child'); ?></span>
                                                        </td>
                                                        <td><span
                                                                class="badge bg-primary bg-opacity-10 text-primary rounded-pill"><?php echo esc_html__('PCR Available', 'bootscore-child'); ?></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- GEO Component 2: Sourcing FAQ -->
                                    <div class="col-lg-6">
                                        <h3 class="font-serif fw-bold h5 mb-3">
                                            <?php echo esc_html__('Sourcing Guide', 'bootscore-child'); ?>
                                        </h3>
                                        <div class="accordion accordion-flush" id="faqAccordion">
                                            <!-- FAQ 1 -->
                                            <div
                                                class="accordion-item bg-transparent border-bottom border-light-subtle">
                                                <h2 class="accordion-header">
                                                    <button
                                                        class="accordion-button collapsed bg-transparent shadow-none fw-semibold small py-3"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                                        <?php echo esc_html__('What is the MOQ for custom finishing?', 'bootscore-child'); ?>
                                                    </button>
                                                </h2>
                                                <div id="faq1" class="accordion-collapse collapse"
                                                    data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body text-secondary small pt-0 pb-3">
                                                        <?php echo wp_kses_post(__('Standard MOQ is <strong>10,000 units</strong> for custom decoration (silk screen, hot stamping).', 'bootscore-child')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FAQ 2 -->
                                            <div
                                                class="accordion-item bg-transparent border-bottom border-light-subtle">
                                                <h2 class="accordion-header">
                                                    <button
                                                        class="accordion-button collapsed bg-transparent shadow-none fw-semibold small py-3"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                                        <?php echo esc_html__('Do you support Private Molds?', 'bootscore-child'); ?>
                                                    </button>
                                                </h2>
                                                <div id="faq2" class="accordion-collapse collapse"
                                                    data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body text-secondary small pt-0 pb-3">
                                                        <?php echo wp_kses_post(__('Yes. Our in-house R&D can deliver T1 samples in <strong>35 days</strong>.', 'bootscore-child')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FAQ 3 -->
                                            <div
                                                class="accordion-item bg-transparent border-bottom border-light-subtle">
                                                <h2 class="accordion-header">
                                                    <button
                                                        class="accordion-button collapsed bg-transparent shadow-none fw-semibold small py-3"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                                        <?php echo esc_html__('What are the lead times?', 'bootscore-child'); ?>
                                                    </button>
                                                </h2>
                                                <div id="faq3" class="accordion-collapse collapse"
                                                    data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body text-secondary small pt-0 pb-3">
                                                        <?php echo wp_kses_post(__('Production typically takes <strong>35-45 days</strong> after sample approval.', 'bootscore-child')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FAQ 4 -->
                                            <div class="accordion-item bg-transparent">
                                                <h2 class="accordion-header">
                                                    <button
                                                        class="accordion-button collapsed bg-transparent shadow-none fw-semibold small py-3"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                                        <?php echo esc_html__('Can I get samples?', 'bootscore-child'); ?>
                                                    </button>
                                                </h2>
                                                <div id="faq4" class="accordion-collapse collapse"
                                                    data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body text-secondary small pt-0 pb-3">
                                                        <?php echo wp_kses_post(__('Yes, stock samples are free. <a href="#" data-bs-toggle="modal" data-bs-target="#leadGenModal" class="fw-bold text-primary">Request now</a>.', 'bootscore-child')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
get_footer();
?>