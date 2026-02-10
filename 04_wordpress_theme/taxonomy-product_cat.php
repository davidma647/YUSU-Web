<?php
/**
 * Product Category Archive Template
 * Updated 2026-02-07
 */

get_header();

// Get current term
$term = get_queried_object();
?>

<div class="container pb-5" style="padding-top: 120px;">
    <!-- Header Area -->
    <header class="text-center mb-5">
        <span class="d-block text-secondary-custom text-uppercase letter-spacing-2 mb-2">Category Archive</span>
        <h1 class="font-serif display-4 mb-3"><?php single_term_title(); ?></h1>
        <!-- Description Hidden Per Request -->
    </header>

    <!-- Product Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php if (have_posts()): ?>
            <?php while (have_posts()):
                the_post(); ?>

                <?php
                // Get Fields
                $sku = get_field('product_sku');
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');

                // Get Volume Terms (Capacity)
                $vol_terms = get_the_terms(get_the_ID(), 'product_capacity');
                $vol_display = '';
                if ($vol_terms && !is_wp_error($vol_terms)) {
                    $vol_names = wp_list_pluck($vol_terms, 'name');
                    $vol_display = implode('/', $vol_names);
                }

                // Get Material Terms
                $mat_terms = get_the_terms(get_the_ID(), 'product_material');
                $mat_display = '';
                if ($mat_terms && !is_wp_error($mat_terms)) {
                    $mat_names = wp_list_pluck($mat_terms, 'name');
                    $mat_display = '<strong>' . implode('/', $mat_names) . '</strong>';
                }

                // Combine Meta
                $meta_display_parts = [];
                if ($vol_display)
                    $meta_display_parts[] = $vol_display;
                if ($mat_display)
                    $meta_display_parts[] = $mat_display;
                ?>

                <div class="col animate-on-scroll">
                    <div class="product-card"> <!-- Using identical class structure -->

                        <?php if (has_term('yusu-originals', 'product_cat')): ?>
                            <span class="badge-ip"><?php echo esc_html__('✨ YUSU Original', 'bootscore-child'); ?></span>
                        <?php endif; ?>

                        <div class="product-img-wrapper">
                            <img src="<?php echo esc_url($image_url ?: 'https://placehold.co/400x400/F5F5F5/d1d1d1?text=No+Image'); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">

                            <!-- Hover Actions Overlay -->
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
                            <h3 class="product-title"><?php echo esc_html($sku ?: get_the_title()); ?></h3>
                            <div class="product-meta">
                                <?php if (!empty($meta_display_parts)) {
                                    echo wp_kses_post(implode(' | ', $meta_display_parts));
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

            <!-- Pagination -->
            <div class="col-12 mt-5">
                <?php the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<i data-lucide="chevron-left" style="width:16px;height:16px;"></i> Previous',
                    'next_text' => 'Next <i data-lucide="chevron-right" style="width:16px;height:16px;"></i>',
                    'class' => 'pagination justify-content-center'
                )); ?>
            </div>

        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">No products found in this category.</p>
                <a href="<?php echo esc_url(home_url('/products')); ?>" class="btn btn-outline-dark">View All Products</a>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php
get_footer();
