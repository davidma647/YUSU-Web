# Project Design System & Coding Guidelines

## 1. Design Philosophy (Visual Identity)
- **Core Vibe**: "Industrial Precision meets High-End Beauty". The site must look like a trusted German manufacturing factory that produces packaging for French luxury brands.
- **Keywords**: Professional, Clean, Trustworthy, Elegant, Minimalist.
- **Key Balance**: Avoid being too "flashy" (Consumer style) or too "dull" (Old-school B2B style).
- **Bootstrap Philosophy**: We use Bootstrap for structure, but we **MUST override** its default look. The site should NOT look like a default Bootstrap theme.

## 2. Color Palette (Strict Enforcement)
Define these in your SCSS variables (`_variables.scss`) to override Bootstrap defaults.

### Brand Colors
- **Primary (Warm Copper)**: `#B08968` (温铜金) -> *Override `$primary`*. Used for: CTA Buttons, Active States, Key Accents.
  - *Hover*: `#9A7759` (Darken 10%)
  - *Active*: `#85674D` (Darken 15%)
- **Secondary (Neutral Grey)**: `#5A5A5A` (中性灰) -> *Override `$secondary`*. Used for: Subtitles, Neutral Elements.
- **Dark (Charcoal)**: `#2D2D2D` -> *Override `$dark`*. Used for: Headings, Text Primary.
- **Light (Neutral White)**: `#F8F8F8` -> *Override `$light`*. Used for: Page Backgrounds.
- **Text Secondary**: `#6B6B6B` -> Used for: Meta-data, Breadcrumbs, Descriptions.

### Status Colors (Functional)
- **Error / Danger**: `#B91C1C` (Deep Red) -> *Override `$danger`*. A darker, more elegant red than standard `#FF0000`. Used for: Form validation errors, critical alerts.
- **Success**: `#15803D` (Deep Green) -> *Override `$success`*.

### Background System (60% Rule)
- **Page Background**: `#F8F8F8` ($light) -> *Main body background. Neutral grey-white.*
- **Surface/Card Background**: `#FFFFFF` ($white) -> *Card containers to contrast against standard background.*

## 3. Typography System
Import from Google Fonts: `Cormorant Garamond` and `Inter`.
*Configure these in SCSS `$font-family-sans-serif` and `$font-family-serif`.*

```html
<!-- Google Fonts Import -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
```

### Font Families
- **Headings (Display)**: `font-family: 'Cormorant Garamond', serif;`
    - Class: `.font-serif` (Custom utility) or apply to h1-h6 tags.
    - Weights: 500 (Medium) for subtitles, 600 (SemiBold) for main headings.
    - Style: Elegant, high-contrast, pairs beautifully with Warm Copper `#B08968`.
- **Body (Content)**: `font-family: 'Inter', sans-serif;`
    - Class: Bootstrap default body font.
    - Weights: 400 (Regular) for text, 500 (Medium) for buttons/nav.
    - Style: Clean, geometric, highly readable.

### Type Scale (Desktop)
- **H1**: 3rem (48px) - 4rem (64px) -> `fs-1` | Cormorant Garamond, 600
- **H2**: 2.25rem (36px) -> `fs-2` | Cormorant Garamond, 600
- **H3**: 1.5rem (24px) -> `fs-3` | Cormorant Garamond, 500
- **Body**: 1rem (16px) -> `fs-6` or default | Inter, 400
- **Small/Label**: 0.875rem (14px) -> `small` tag | Inter, 400
- **Button Text**: 0.875rem (14px), Uppercase, Letter-spacing 0.05em | Inter, 500

## 4. UI Component Rules (Bootstrap 5 Overrides)

### Buttons (CTA)
- **Primary Button (`.btn-primary`)**:
    - Background: `#B08968` ($primary, Warm Copper).
    - Border: None.
    - Font: Inter, Medium (500), Uppercase.
    - Radius: `4px` ($border-radius: 4px).
    - Shadow: Custom SCSS -> `box-shadow: 0 4px 14px 0 rgba(176, 137, 104, 0.35);`
    - Hover: `#9A7759` (Darken by 10%).
- **Secondary/Ghost Button (`.btn-outline-dark` or custom)**:
    - Background: Transparent.
    - Border: 1px solid `#2D2D2D`.
    - Text: `#2D2D2D`.
    - Radius: `4px`.

### Cards (`.card`)
- **Structure**: Use Bootstrap `.card` class.
- **Style Overrides**:
    - Border: 1px solid transparent or extremely light gray (`#F3F4F6`).
    - Radius: `0px` or `4px` (Sharp edges).
    - Shadow: Hover only -> `box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);`

## 5. Layout & Spacing
- **Grid System**: Strict usage of Bootstrap 5 Grid (`.container`, `.row`, `.col-lg-*`).
- **Container**: Use `.container` (max-width 1320px on XXL).
- **Whitespace (Spacing Utilities)**:
    - **Section Padding**: Use `py-5` (3rem) or `py-lg-5` (custom spacer preferred for 64px+).
    - **Gap**: Use `gap-4` (1.5rem) or `gap-5` (3rem) in flex/grid containers.
    - *Avoid custom margins in CSS unless absolutely necessary. Use Bootstrap utilities.*

## 6. Tech Stack & Implementation (Strict Constraints)
- **CMS**: **WordPress 6.4+**.
- **CSS Framework**: **Bootstrap 5.3+**.
    - **Methodology**: Use SCSS (`.scss`).
    - **Variables**: **MUST** use `_variables.scss` to override Bootstrap defaults before importing Bootstrap.
    - **Utility Classes**: Use Bootstrap utility classes (e.g., `d-flex`, `justify-content-center`, `mb-4`) for 90% of layout and spacing. Write custom CSS **only** for specific component styling (e.g., `.hero-section`).
- **PHP / Templating**:
    - Use `get_template_part('template-parts/...')` to modularize code.
    - Keep PHP logic separate from presentation where possible.
    - **Sanitization**: Always use `esc_html()`, `esc_url()`, or `esc_attr()` when outputting dynamic data.
- **JavaScript**:
    - **Library**: **Bootstrap 5 Native JS** (No jQuery dependency for UI components).
    - Use vanilla ES6+ for custom logic.

## 7. Iconography Rules
- **Library**: `Lucide` (SVG Sprites) or `Bootstrap Icons` (SVG).
- **Implementation**: Prefer using inline SVGs or a PHP helper function `get_icon('name')` to keep the DOM clean (avoid loading heavy font files).
- **Style**: Stroke/Outline only. Stroke width 1.5px.

## 8. Navigation Bar Behavior
- **Structure**: Use standard Bootstrap Navbar (`.navbar`, `.navbar-expand-lg`).
- **Customization**:
    - **Initial**: `.navbar-transparent` (Custom class: absolute position, transparent bg).
    - **Sticky**: `.fixed-top` + `.bg-white` + `.shadow-sm` (toggled via JS on scroll).
- **Links**:
    - Use `.nav-link`.
    - Font: Inter, Uppercase, Medium.
    - Active State: Text color `#B08968` (Warm Copper).

---
**Instruction for AI**:
1. When writing CSS, always ask: "Does a Bootstrap utility class exist for this?" If yes, use the class (e.g., `text-center`) instead of writing `text-align: center` in CSS.
2. When creating variables, define them in SCSS map overrides to ensure they propagate to all Bootstrap components.