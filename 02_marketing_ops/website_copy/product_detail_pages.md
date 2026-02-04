# Product Detail Page (产品详情页) 文案

> **Version**: v1.0
> **Date**: 2026-01-23
> **Framework**: PAS (Problem-Agitate-Solution) + FAB (Features-Advantages-Benefits)

---

## 1. SEO Metadata

### 1.1 Gold Bar Foundation Bottle (B-AP40) ★

- **Meta Title** (59 chars): `Gold Bar Foundation Bottle (B-AP40) | IP-Protected Design | YUSU`
- **Meta Description** (149 chars): `30ML premium foundation bottle with precision spray-plated metallic finish. IP-protected exclusive design. Free samples available. Get a quote today.`

### 1.2 Plum Blossom Foundation Bottle (A-BE23) ★

- **Meta Title** (60 chars): `Plum Blossom Foundation Bottle (A-BE23) | Oriental Design | YUSU`
- **Meta Description** (152 chars): `Elegant 30ML foundation bottle featuring rose gold electroplating. Oriental plum blossom motif. IP-protected exclusive. Request samples from YUSU.`

### 1.3 Chamfered Foundation Bottle (B-AP37) ★

- **Meta Title** (60 chars): `Chamfered Foundation Bottle (B-AP37) | Geometric Design | YUSU`
- **Meta Description** (148 chars): `Minimalist 30ML foundation bottle with angular geometric design. Precision spray-plated finish. IP-protected exclusive. Request samples today.`

---

## 2. Page Content Modules

### Module 1: Product Visual Gallery

*   **Main Display**: High-resolution hero shot
*   **Gallery**: 4 alternate angles (Front, Side, Top/Detail, Bottom)
*   **Context**: Usage scenario image (Lifestyle shot)
*   **Video** (Optional): 15-30 second product video showing finish details

---

### Module 2: Product Quick Info

**UI Elements**:
-   Badge: `🔒 IP-Protected Design`
-   Rating: ⭐⭐⭐⭐⭐ (Optional: based on reviews/sales)

**Content**:
```text
[Product Name]
Model: [Product Code]

─────────────────────
Capacity: 30ML
Material: Glass + Aluminum
MOQ: 10,000 pcs

✓ Free Samples Available
✓ Fast Lead Time

[Request a Quote]  [Order Samples]
```

---

### Module 3: Product Story (PAS Framework)

#### A. Gold Bar Bottle (B-AP40)

**Headline**: Stand Out in a Crowded Market

**Problem**:
> In the competitive beauty market, standard packaging fails to capture attention. Your product gets lost among countless similar bottles on the shelf.

**Agitate**:
> Every day, potential customers walk past your product. They choose competitors with bolder, more distinctive packaging. Your brand deserves a first impression that demands attention.

**Solution**:
> The Gold Bar bottle was designed for brands that refuse to blend in. Its bold geometric silhouette and precision metallic finish create unmistakable shelf presence.
>
> As an IP-Protected Original, this design is exclusively available through YUSU. Your brand gains a competitive visual identity that competitors cannot replicate.

#### B. Plum Blossom Bottle (A-BE23)

**Headline**: Connect Through Cultural Elegance

**Problem**:
> Generic Western designs often fail to resonate with Asian consumers. Your packaging lacks the cultural depth that creates emotional connection.

**Agitate**:
> Brands that understand cultural aesthetics build stronger customer loyalty. Without meaningful design language, you miss the chance to create lasting brand recognition in key markets.

**Solution**:
> The Plum Blossom bottle draws from centuries of Oriental artistry. Delicate rose gold electroplating and subtle floral motifs speak to customers who value tradition and sophistication.
>
> As an IP-Protected Original, this culturally-rich design remains exclusively yours through YUSU partnership.

#### C. Chamfered Bottle (B-AP37)

**Headline**: Precision That Speaks Quality

**Problem**:
> Many brands struggle to convey premium quality through packaging alone. Overly decorated bottles can undermine a professional brand image.

**Agitate**:
> Sophisticated customers recognize cheap packaging instantly. Without refined design, your product appears mass-market despite premium formulations inside.

**Solution**:
> The Chamfered bottle embodies geometric precision and minimalist luxury. Clean angular lines and expert craftsmanship signal quality before the product is even opened.
>
> As an IP-Protected Original, this design provides exclusive distinction. Your brand projects the professionalism that discerning customers expect.

---

### Module 4: Specifications Table (FAB Framework)

#### Common Specs Template (Adjust per product)

| Feature | Advantage | Benefit |
|---------|-----------|---------|
| **Capacity: 30ML** | Ideal size for premium foundation | Matches market standards for luxury positioning |
| **Material: Glass + Aluminum** | Superior weight and feel | Creates premium unboxing experience for end consumers |
| **Craft: Spray-plated / Electroplated** | Consistent metallic finish | Unified luxury aesthetic increases perceived value |
| **MOQ: 10,000 pcs** | Accessible quantity for growing brands | Lower risk entry point for new product launches |
| **Pump: Injection Molded** | Precise dispensing mechanism | Consistent consumer experience, reduced waste |

> **Note**: Specific craft details vary by product (e.g., Rose Gold for A-BE23). See `product.md` for exact finish details.

**[Download Spec Sheet PDF]**

---

### Module 5: Customization Options

**Headline**: Make It Yours

| Option | Available Choices |
|--------|-------------------|
| 🎨 **Color Selection** | Custom cap colors, bottle tints |
| ⚡ **Plating Options** | Gold, Rose Gold, Silver, Custom metallic |
| 📝 **Logo Printing** | Screen printing, hot stamping, UV printing |
| 🛡️ **UV Coating** | Matte, gloss, soft-touch protective finishes |

**CTA**: `[Discuss Customization Options →]`

---

### Module 6: Craft & Quality

**Headline**: Engineered for Excellence

| Quality Pillar | Description |
|----------------|-------------|
| **Precision Plating** | Multi-layer spray or electroplating for consistent metallic finish |
| **24H Glass Production** | Dedicated cosmetic glass line running continuously for quality consistency |
| **Source QC** | Quality control begins from the first bottle leaving our in-house furnace |

---

### Module 7: FAQ Accordion

**Product-Specific FAQs**

> **Q: What is the MOQ for this product?**
> A: The minimum order quantity is 10,000 pieces. For first-time orders, we offer free samples to help you evaluate quality before committing.
>
> **Q: Can I customize the plating color?**
> A: Yes. We offer gold, rose gold, silver, and custom metallic finishes. Our team will help you select the ideal option for your brand.
>
> **Q: What is the lead time for production?**
> A: Standard lead time is 25-35 days after order confirmation. We offer faster delivery for urgent projects—contact us to discuss.
>
> **Q: Do you provide samples?**
> A: Yes. Samples are free. You only pay shipping costs. Request samples through the form on this page.
>
> **Q: Is this design exclusive to my brand?**
> A: This IP-protected design remains exclusive to YUSU's partner network. Contact us to discuss exclusivity arrangements for your market.

---

### Module 8: Sticky CTA Bar

**Position**: Fixed at bottom on scroll

**Content**:
```text
[Product Name] (Code)                           [Request a Quote]
```

---

## 3. Technical Implementation Notes

### Structured Data (JSON-LD)

Implement `Product` schema on each PDP:

```json
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Gold Bar Foundation Bottle",
  "sku": "B-AP40",
  "description": "30ML premium foundation bottle with precision spray-plated metallic finish. IP-protected exclusive design.",
  "brand": {
    "@type": "Brand",
    "name": "YUSU"
  },
  "manufacturer": {
    "@type": "Organization",
    "name": "Guangzhou Yusu Packaging Products Co., Ltd."
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "USD",
    "price": "Contact for Quote",
    "availability": "https://schema.org/InStock"
  }
}
```

Implement `FAQPage` schema for the FAQ section.

### Missing Info Checks (To be filled by Dev/Product Team)
- [ ] confirm exact Dimensions (Height/Width) for all products
- [ ] Confirm exact Weight for all products
- [ ] Verify standard production Lead Time (currently set to 25-35 days)
- [ ] Confirm Exclusivity terms for IP products
