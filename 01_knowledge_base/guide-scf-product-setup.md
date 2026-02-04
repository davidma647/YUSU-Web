# 使用 SCF (Secure Custom Fields) 创建产品和分类列表指南

本指南将指导您如何使用 **SCF 插件**（原 ACF）在 WordPress 后台构建独立的“产品管理”板块。

## 目标
1.  在后台添加一个独立的 **“产品 (Products)”** 菜单。
2.  为产品添加 **“产品分类 (Categories)”** 功能。
3.  为产品添加自定义参数（如：SKU、容量、材质）。

---

## 第一步：创建“产品”文章类型 (Post Type)

SCF 6.1+ 版本自带“文章类型”注册功能，无需写代码。

1.  进入 WordPress 后台，点击左侧菜单的 **SCF** > **Post Types**。
2.  点击 **"Add New"**（新建）。
3.  填写以下核心信息：
    *   **Plural Label (复数名称)**: `Products` (或 “产品中心”)
    *   **Singular Label (单数名称)**: `Product` (或 “产品”)
    *   **Post Type Key (关键字)**: `product`  **(重要：请全小写，不要改动，后续代码会用到)**
    *   **Public**: 开启 (Yes)
    *   **Hierarchical (层级)**: 关闭 (No) - *产品通常像文章一样是列表，不需要像页面一样有父子关系*
4.  **Advanced Configuration (高级配置)**:
    *   **Supports (支持功能)**: 勾选 `Title` (标题), `Editor` (正文编辑器), `Featured Image` (特色图片/产品主图), `Excerpt` (摘要).
5.  点击 **"Save Changes"**。

👉 **结果**：您的左侧菜单会出现一个名为 “Products” 的新栏目。

---

## 第二步：创建“产品分类” (Taxonomy)

1.  点击左侧菜单的 **SCF** > **Taxonomies**。
2.  点击 **"Add New"**（新建）。
3.  填写核心信息：
    *   **Plural Label**: `Product Categories` (或 “产品分类”)
    *   **Singular Label**: `Category`
    *   **Taxonomy Key**: `product_cat` **(重要：请全小写)**
    *   **Select Post Types (关联文章类型)**: 勾选刚才创建的 `Product`。
4.  **Advanced Configuration (高级配置)**:
    *   **Hierarchical (层级)**: **开启 (Yes)** - *这让分类像“目录”一样可以包含子分类（推荐）。如果选 No，就像“标签”一样。*
5.  点击 **"Save Changes"**。

👉 **结果**：在 “Products” 菜单下，会出现 “Product Categories” 子菜单。

---

## 第三步：添加产品自定义字段 (Field Group)

现在我们为产品添加具体的参数（如材质、规格等）。

1.  点击 **SCF** > **Field Groups**。
2.  点击 **"Add New"**。
3.  **标题**: 输入 “Product Details” (或 “产品参数”)。
4.  **添加字段 (Add Fields)**:
    *   **Sub-title (副标题/Slogan)**:
        *   Type: Text
        *   Field Name: `product_subtitle`
    *   **SKU / Model (型号)**:
        *   Type: Text
        *   Field Name: `product_sku`
    *   **Material (材质)**:
        *   Type: Text
        *   Field Name: `product_material`
    *   **Capacity (容量)**:
        *   Type: Text
        *   Field Name: `product_capacity`
5.  **位置设置 (Location Rules)**:
    *   Show this field group if: **Post Type** is equal to **Product**。
6.  点击 **"Save Changes"**。

---

## 第四步：录入测试数据

1.  点击左侧菜单 **Products** > **Add New**。
2.  **标题**: 输入 "Gold Bar Foundation Bottle" (示例)。
3.  **正文**: 输入产品描述文本。
4.  **右侧栏**:
    *   **Product Categories**: 点击 "Add New Category"，创建如 "Foundation Bottles"。
    *   **Featured Image**: 上传一张作为列表页显示的图片。
5.  **下方 Product Details 对话框**:
    *   输入型号 (B-AP40)、材质 (AS/ABS) 等信息。
6.  点击 **Publish**。

---

## 下一步计划：如何在前端显示？

完成上述步骤后，您的后台就有了完善的数据结构。但前台（网站）还不会自动显示出来。我们需要在代码中创建模板文件来读取这些数据。

接下来的开发任务（我会负责）：
1.  创建 `archive-product.php`：用于显示**产品列表**。
2.  创建 `taxonomy-product_cat.php`：用于显示**分类列表**。
3.  创建 `single-product.php`：用于显示**产品详情页**。

您可以先按照上述指南在后台完成 1-4 步的配置。
