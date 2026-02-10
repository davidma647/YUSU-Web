<?php

/**
 * @package Bootscore Child
 *
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;


/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles', 20);
function bootscore_child_enqueue_styles()
{

    // 1. 父主题 style.css (Theme Metadata)
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    /**
     * 2. 智能 Bootstrap 核心样式加载 (Dual Fallback System)
     * 优先级：
     * A. 子主题编译版 main.css (用户自定义编译，优先级最高)
     * B. CDN 兜底 (防止本地文件缺失导致样式崩坏)
     */

    $child_css_path = get_stylesheet_directory() . '/assets/css/main.css';

    $bootstrap_source = ''; // 记录最终加载源，用于依赖管理

    // 检查子主题 CSS 是否存在且有效 (>10KB 说明包含 Bootstrap 库)
    if (file_exists($child_css_path) && filesize($child_css_path) > 10240) {
        // [A方案] 加载子主题本地 CSS
        $modified_child = date('YmdHi', filemtime($child_css_path));
        wp_enqueue_style('child-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('parent-style'), $modified_child);
        $bootstrap_source = 'child-main';
    } else {
        // [B方案] CDN 兜底
        wp_enqueue_style('bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');
        wp_enqueue_script('bootstrap-bundle-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
        $bootstrap_source = 'bootstrap-cdn';
    }

    // Explicitly dequeue parent main styles if they exist to prevent 404
    wp_dequeue_style('bootscore-main');
    wp_deregister_style('bootscore-main');
    wp_dequeue_style('main');
    wp_deregister_style('main');

    // 4. 自定义 JS (global.js)
    $modificated_CustomJS = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/global.js'));

    // JS 依赖：CDN 模式下依赖 CDN bundle，本地模式下假设父/子主题已处理或依赖 jQuery
    $js_dependencies = array('jquery');
    if ($bootstrap_source === 'bootstrap-cdn') {
        $js_dependencies[] = 'bootstrap-bundle-cdn';
    }

    wp_enqueue_script('global-js', get_stylesheet_directory_uri() . '/assets/js/global.js', $js_dependencies, $modificated_CustomJS, false, true);

    // 5. Lucide Icons
    wp_enqueue_script('lucide-icons', 'https://unpkg.com/lucide@latest', array(), null, true);
    wp_add_inline_script('lucide-icons', 'lucide.createIcons();');

    // ========== 页面专属 JS ==========

    // 首页
    if (is_front_page()) {
        $home_js_ver = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/home.js'));
        wp_enqueue_script('yusu-home', get_stylesheet_directory_uri() . '/assets/js/home.js', array('jquery', 'lucide-icons'), $home_js_ver, true);
    }

    // 产品页面 & 分类归档 & Search
    if (is_page_template('page-products.php') || is_tax('product_cat') || is_post_type_archive('product')) {
        $products_js_ver = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/products.js'));
        wp_enqueue_script('yusu-products', get_stylesheet_directory_uri() . '/assets/js/products.js', array('jquery', 'lucide-icons'), $products_js_ver, true);
    }
}


/**
 * 注册自定义菜单位置
 */
add_action('after_setup_theme', 'register_custom_nav_menus');
function register_custom_nav_menus()
{
    register_nav_menus(array(
        'primary-menu' => '主导航菜单 (Header)',
        'footer-company' => '页脚 - 公司链接组'
    ));
}
