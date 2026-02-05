<?php
/**
 * Header 模板
 * 复刻 YUSU 定制设计
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts 放在这里或通过 functions.php 加载 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <div id="page" class="site">
        <header id="masthead" class="site-header">

            <!-- Navbar: 添加了 navbar-transparent id="mainNavbar" -->
            <nav class="navbar navbar-expand-lg fixed-top navbar-transparent" id="mainNavbar">
                <div class="container">

                    <!-- Logo 部分 -->
                    <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if (has_custom_logo()) {
                            $custom_logo_id = get_theme_mod('custom_logo');
                            echo wp_get_attachment_image($custom_logo_id, 'full', false, array(
                                'class' => 'd-inline-block',
                                'style' => 'height: 48px; width: auto; margin-right: -15px;',
                                'alt' => get_bloginfo('name')
                            ));
                        }
                        ?>

                        <div class="d-flex flex-column ms-2">
                            <span class="font-serif fw-bold text-dark fs-4 lh-1"
                                style="letter-spacing: 0.05em;">YUSU</span>
                            <span class="font-serif text-secondary-custom font-sans fw-medium"
                                style="font-size: 1rem; color: black;">宇塑包装</span>
                        </div>
                    </a>

                    <!-- 移动端切换按钮 -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i data-lucide="menu" class="navbar-toggler-icon-custom"></i>
                    </button>

                    <!-- 导航内容 -->
                    <div class="collapse navbar-collapse" id="navbarContent">

                        <!-- 1. 使用 WordPress 动态菜单 (Main Menu) -->
                        <!-- 我们手动构建 UL 以便插入特殊 Mega Menu 逻辑 -->
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">

                            <li class="nav-item">
                                <a class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>" aria-current="page"
                                    href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                            </li>

                            <!-- 2. Products 菜单 - 桌面端 Mega Menu / 移动端 Collapse -->
                            <!-- 桌面端：dropdown hover -->
                            <li class="nav-item dropdown position-static d-none d-lg-block">
                                <a class="nav-link dropdown-toggle" href="<?php echo esc_url(home_url('/products')); ?>"
                                    id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    onclick="if(event.target === this) window.location.href=this.href;">
                                    Products
                                </a>
                                <?php get_template_part('mega-menu-products'); ?>
                            </li>

                            <!-- 移动端：collapse 展开 -->
                            <li class="nav-item d-lg-none">
                                <a class="nav-link d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" href="#mobileProductsMenu" role="button"
                                    aria-expanded="false" aria-controls="mobileProductsMenu">
                                    <span>Products</span>
                                    <i data-lucide="chevron-down" style="width: 16px; height: 16px;"></i>
                                </a>
                                <div class="collapse" id="mobileProductsMenu">
                                    <div class="mobile-submenu py-2 ps-3">
                                        <?php
                                        // 动态获取产品分类
                                        $categories = get_terms(array(
                                            'taxonomy' => 'product_cat',
                                            'hide_empty' => true,
                                            'orderby' => 'count',
                                            'order' => 'DESC'
                                        ));

                                        if (!empty($categories) && !is_wp_error($categories)):
                                            foreach ($categories as $cat):
                                                ?>
                                                <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                                                    class="nav-link py-2 d-flex justify-content-between">
                                                    <span><?php echo esc_html($cat->name); ?></span>
                                                    <span class="badge bg-light text-dark"><?php echo $cat->count; ?></span>
                                                </a>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                        <hr class="my-2">
                                        <a href="<?php echo esc_url(home_url('/products')); ?>"
                                            class="nav-link py-2 text-primary fw-medium">
                                            <i data-lucide="grid"
                                                style="width: 14px; height: 14px; margin-right: 6px;"></i>
                                            View All Products
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo esc_url(home_url('/innovation')); ?>">Innovation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo esc_url(home_url('/services')); ?>">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo esc_url(home_url('/about')); ?>">About</a>
                            </li>

                            <!-- 资源菜单 - 桌面端 dropdown -->
                            <li class="nav-item dropdown d-none d-lg-block">
                                <a class="nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Resources
                                </a>
                                <ul class="dropdown-menu border-0 shadow-lg p-2" aria-labelledby="resourcesDropdown"
                                    style="min-width: 200px; border-radius: 4px; margin-top: 0;">
                                    <li><a class="dropdown-item py-2 rounded"
                                            href="<?php echo esc_url(home_url('/blog')); ?>">
                                            <i data-lucide="file-text"
                                                style="width: 16px; height: 16px; margin-right: 8px;"></i> Blog &
                                            Insights
                                        </a></li>
                                    <li><a class="dropdown-item py-2 rounded"
                                            href="<?php echo esc_url(home_url('/faq')); ?>">
                                            <i data-lucide="help-circle"
                                                style="width: 16px; height: 16px; margin-right: 8px;"></i> FAQ
                                        </a></li>
                                </ul>
                            </li>

                            <!-- 移动端：直接显示 Blog 和 FAQ -->
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="<?php echo esc_url(home_url('/blog')); ?>">
                                    Blog & Insights
                                </a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="<?php echo esc_url(home_url('/faq')); ?>">
                                    FAQ
                                </a>
                            </li>

                            <!-- 移动端导航底部添加 CTA 按钮 -->
                            <li class="nav-item d-lg-none mt-3 pt-3 border-top">
                                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary w-100">
                                    Get a Quote
                                </a>
                            </li>

                        </ul>

                        <!-- 右侧 CTA 按钮 (桌面端) -->
                        <div class="d-none d-lg-flex align-items-center gap-3">
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                                Get a Quote
                            </a>
                        </div>

                    </div>
                </div>
            </nav>
        </header>