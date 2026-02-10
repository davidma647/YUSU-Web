# 项目开发指南

## 📌 项目概述

本项目是 **YUSU 宇塑包装独立站** 的开发工作目录。

**主要目的：**
1. 留存独立站开发过程中的所有内容
2. 方便与 AI 协作生成代码
3. 作为版本控制和文档管理的中心仓库

---

## ⚠️ 重要说明

> **本地只写代码，不需要编译！**

- 本地开发环境 **不需要运行任何编译命令**（如 `npm run build`、`sass` 等）
- SCSS 文件会直接复制粘贴到 WordPress 服务器上
- WordPress 网站部署在 **SiteGround** 服务器上
- WordPress 使用 **Bootscore** 作为父主题

---

## 📁 目录结构说明

```
独立站/
├── 01_knowledge_base/     # 知识库
├── 02_marketing_ops/      # 营销运营文档
├── 03_website_code/       # Bootstrap 静态 HTML
└── 04_wordpress_theme/    # WordPress 主题文件
```

### `01_knowledge_base/` - 知识库

存放公司、产品和其他参考信息，方便和 AI 沟通时提供上下文。

| 子目录/文件 | 说明 |
|------------|------|
| `scf-field-reference.md` | SCF 自定义字段参考手册 |
| `company/` | 公司信息 |
| `products/` | 产品资料 |
| `other/` | 其他参考文档（包括本指南） |

### `02_marketing_ops/` - 营销运营

存放使用 **Markdown 格式** 编写的网站文案：

- 每个页面的文案内容
- 营销素材和话术
- SEO 关键词和描述

**目的：** 留存文案内容，方便后续修改和迭代。

### `03_website_code/` - Bootstrap 静态代码

存放使用 **Bootstrap 5** 编写的 **纯静态 HTML** 代码：

- 这是独立站的 **第一版代码**
- 目的是最快速度实现视觉效果
- 之后逐个页面转换为 PHP 代码上传到 WordPress

**工作流程：**
```
HTML 静态页面 → 验证效果 → 转换为 PHP → 上传到 WordPress
```

### `04_wordpress_theme/` - WordPress 主题文件

存放需要用到的 WordPress 主题文件，**文件结构与 Bootscore 主题一致**：

```
04_wordpress_theme/
├── assets/
│   ├── css/
│   ├── js/
│   │   ├── global.js  # 全站通用交互（Header/Footer/Modals）
│   │   ├── home.js    # 首页专属逻辑（如滚动动画）
│   │   └── ...
│   └── scss/          # SCSS 源文件
├── template-parts/
│   └── global-modals.php # 全站通用模态框 HTML
├── header.php
├── footer.php
├── front-page.php
├── functions.php
└── ...
```

### 🔧 关键文件职责

| 文件 | 职责说明 |
|------|----------|
| **`assets/js/global.js`** | **全站通用逻辑**。负责 Header (Sticky Navbar), Footer, 以及 **Global Modals** (Lead Gen, Image Zoom) 的事件处理。**不包含** 页面特定的动画逻辑。 |
| **`assets/js/home.js`** | **首页专属逻辑**。仅包含首页特有的交互，核心职责是处理 **Scroll Animations** (IntersectionObserver) 等视觉效果。 |
| **`template-parts/global-modals.php`** | **通用模态框模板**。存放 "Request Sample" 和 "Image Zoom" 的 HTML 结构。由 `footer.php` 统一引入，确保全站任何页面都能调用这些模态框。 |

**重要：**
- 这个目录的代码会 **直接复制粘贴** 到服务器
- 本地 **不需要编译 SCSS**
- 修改后直接复制到服务器查看效果
- 如有问题再回到本地修改

---

## 🔄 开发工作流

```
┌─────────────────────────────────────────────────────────────┐
│  1. 本地编写代码（HTML/PHP/SCSS）                             │
│                    ↓                                        │
│  2. 复制代码到 SiteGround 服务器上的 WordPress               │
│                    ↓                                        │
│  3. 在线上查看效果                                           │
│                    ↓                                        │
│  4. 如需修改，回到本地修改后重新复制                          │
└─────────────────────────────────────────────────────────────┘
```

---

## 🛠️ 技术栈

| 类别 | 技术 |
|------|------|
| 前端框架 | Bootstrap 5 |
| CMS | WordPress 6.x |
| WordPress 主题 | Bootscore (父主题) |
| 自定义字段 | SCF (Secure Custom Fields) |
| 图片优化 | Imagify |
| 服务器 | SiteGround |

---

## 📝 与 AI 协作注意事项

1. **提供上下文**：引用 `01_knowledge_base/` 中的文档让 AI 了解项目背景
2. **明确文件路径**：指定要修改的文件路径
3. **不需要编译命令**：告知 AI 不需要运行 npm/sass 等编译命令
4. **SCSS 直接复制**：SCSS 文件会直接复制到服务器，无需担心编译

---

*最后更新：2026-02-06*
