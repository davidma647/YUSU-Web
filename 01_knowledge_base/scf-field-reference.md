# SCF 字段参考手册

本文档记录了所有在 SCF 中定义的自定义字段，供 PHP 模板开发时引用。

---

## 首页 (Home Settings)

| 字段标签 | 字段名 (Field Name) | 类型 | 说明 |
|---------|---------------------|------|------|
| 桌面端 Banner | `hero_banner` | Image (Array) | 桌面端首屏大图 |
| 移动端 Banner | `hero_banner_mobile` | Image (Array) | 移动端首屏大图 |
| CTA 背景图 | `cta_background` | Image (URL) | 底部号召区域背景 |
| 合作品牌方 | `trust_logos` | Gallery | 合作伙伴 Logo 图库 (多选) |
| 合作的OEM厂 Logo | `partner_logos` | Gallery | Production Ecosystem 部分的合作工厂 Logo (多选) |

---

## 文章类型 (Post Types)

### `product` - 产品

| 字段标签 | 字段名 (Field Name) | 类型 | 说明 | PHP 调用示例 |
|---------|---------------------|------|------|-------------|
| 副标题/Slogan | `product_subtitle` | Text | 产品标语 | `get_field('product_subtitle')` |
| 型号/SKU | `product_sku` | Text | 产品编号 | `get_field('product_sku')` |
| 材质 (筛选) | `product_material` | Checkbox (推荐) | **筛选字段**。返回值设为 **值 (Value)**。 | `get_field('product_material')` |
| 容量 (筛选) | `product_capacity` | Checkbox (推荐) | **筛选字段**。返回值设为 **值 (Value)**。 | `get_field('product_capacity')` |
| 产品重量 | `product_weight` | Text | 如 50g/100g | `get_field('product_weight')` |
| 产品图库 | `product_gallery` | Gallery | 多图，用于详情页轮播 | `get_field('product_gallery')` |
| 专利号 | `product_patent` | Text | 产品专利编号 | `get_field('product_patent')` |
| MOQ | `product_moq` | Number | 最小起订量，默认 10000 | `get_field('product_moq')` |
| 描述 | `product_description` | Textarea | 产品详细描述 | `get_field('product_description')` |
| 是否主推 | `product_featured` | True/False | 标记主推产品，用于首页展示 | `get_field('product_featured')` |

**WordPress 内置字段**：
| 字段 | 说明 | PHP 调用示例 |
|------|------|-------------|
| 标题 | 产品名称 | `get_the_title()` |
| 正文 | 产品描述 | `the_content()` |
| 摘要 | 简短描述 | `get_the_excerpt()` |
| 特色图片 | 列表页缩略图 | `get_the_post_thumbnail()` |
| 永久链接 | 产品详情页URL | `get_permalink()` |

---

## 分类法 (Taxonomies)

### `product_cat` - 产品分类

| 字段标签 | 字段名 (Field Name) | 类型 | 说明 | PHP 调用示例 |
|---------|---------------------|------|------|-------------|
| 分类封面 | `category_image` | Image (Array) | 分类封面大图，用于首页展示 | `get_field('category_image', 'term_' . $term_id)` |
| 分类图标 | `category_icon` | Image | 分类展示图标 | `get_field('category_icon', 'term_' . $term_id)` |
| 分类描述 | *(内置)* | Text | WordPress 内置 | `term_description($term_id)` |

**WordPress 内置字段**：
| 字段 | 说明 | PHP 调用示例 |
|------|------|-------------|
| 名称 | 分类名 | `$term->name` |
| 别名 (Slug) | 用于 URL | `$term->slug` |
| 产品数量 | 该分类下产品数 | `$term->count` |
| 排序权重 | `category_sort_order` | Number | 分类展示顺序，数字越小越靠前 | `get_field('category_sort_order', 'product_cat_' . $term_id)` |

---

## 常用 PHP 代码片段

### 获取当前产品的所有自定义字段
```php
$subtitle = get_field('product_subtitle');
$sku = get_field('product_sku');
$material = get_field('product_material');
$capacity = get_field('product_capacity');
$gallery = get_field('product_gallery'); // 返回图片数组
```

### 循环产品图库
```php
$gallery = get_field('product_gallery');
if ($gallery):
    foreach ($gallery as $image):
        echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
    endforeach;
endif;
```

### 获取产品所属分类
```php
$terms = get_the_terms(get_the_ID(), 'product_cat');
if ($terms && !is_wp_error($terms)):
    foreach ($terms as $term):
        echo $term->name;
    endforeach;
endif;
```

### 获取分类的自定义字段（如图标）
```php
$term_id = get_queried_object_id(); // 在分类归档页
$icon = get_field('category_icon', 'term_' . $term_id);
if ($icon):
    echo '<img src="' . esc_url($icon['url']) . '">';
endif;
```

---

## 注意事项

1. **字段名区分大小写**：请严格按照本文档中的 `field_name` 使用。
2. **Taxonomy 字段前缀**：获取分类字段时，必须加 `'term_' . $term_id` 作为第二个参数。
3. **Gallery 返回格式**：确保 SCF 中设置 Return Format 为 **Image Array**。

---

*最后更新：2026-02-07*

---

## 4. 产品分类参考 (Product Categories)

请按照下表在 **WordPress 后台 > 产品 > 分类** 中创建分类。

> **设置方法**：
> 1. 创建 **一级分类** (Parent = 无)
> 2. 创建 **二级分类** (Parent = 对应的一级分类)

| 一级分类 (Parent) | Slug (别名) | 二级分类 (Child) | Slug (别名) | 中文说明 |
| :--- | :--- | :--- | :--- | :--- |
| **Face Packaging** | `face-packaging` | Foundation Bottles | `foundation-bottles` | 粉底液瓶 |
| | | Cushion & Compacts | `cushion-compacts` | 气垫/粉饼盒 |
| | | Stick Foundation | `stick-foundation` | 粉条管 |
| **Lip Packaging** | `lip-packaging` | Lipstick Tubes | `lipstick-tubes` | 口红管 |
| | | Lip Gloss & Glaze | `lip-gloss-glaze` | 唇釉管 |
| | | Lip Care Jars | `lip-care-jars` | 唇膜盒 |
| **Skincare Packaging** | `skincare-packaging` | Sun Protection | `sun-protection` | 防晒系列 |
| | | Serum & Droppers | `serum-droppers` | 精华/滴管 |
| | | Cream & Lotions | `cream-lotions` | 膏霜/乳液 |
| **Perfume Bottles** | `perfume-bottles` | Perfume Bottles | `perfume-bottles-sub` | 香水瓶 (子类) |
| **Eye Packaging** | `eye-packaging` | Mascara & Eyeliner | `mascara-eyeliner` | 睫毛膏/眼线 |
| | | Eyeshadow Palettes | `eyeshadow-palettes` | 眼影盘 |

---
