# Contact / RFQ Page (联系 / 询盘页)

> **Marketing Framework**: Conversion-Focused Minimalism  
> **Primary Goal**: Reduce form abandonment, maximize inquiry submissions

---

## SEO Metadata

- **Meta Title** (58 chars): `Contact Us | Request a Quote or Samples | YUSU Packaging`
- **Meta Description** (148 chars): `Get a free quote or samples for cosmetic packaging. 24-hour response guaranteed. Trusted by 500+ brands. Contact YUSU Packaging today.`

**Target Keywords**:
| Type | Keyword | Intent |
|------|---------|--------|
| Primary | cosmetic packaging quote | Transactional |
| Primary | cosmetic packaging inquiry | Transactional |
| Secondary | request cosmetic packaging samples | Transactional |
| Long-tail | contact cosmetic packaging manufacturer | Transactional |

---

## Page Header (H1 Section)

**H1**: Let's Start Your Project

**Subheadline**: Free samples available. Get a response within 24 hours.

---

## Inquiry Form Section

**Section Title (H2)**: Request a Quote or Samples

### Form Fields

| Field | Label | Type | Required | Placeholder / Options |
|-------|-------|------|----------|----------------------|
| name | Your Name | text | ✓ | e.g., John Smith |
| email | Business Email | email | ✓ | e.g., john@yourcompany.com |
| company | Company Name | text | | e.g., ABC Cosmetics |
| country | Country / Region | select | | Indonesia, Vietnam, Thailand, Philippines, Malaysia, Singapore, Others |
| inquiry_type | What can we help you with? | select | | Request Quote, Request Samples, Custom Design Inquiry, General Question |
| product_interest | Products You're Interested In | multi-select | | Foundation Bottles, Lipstick Tubes, Air Cushion Cases, Others |
| message | Your Message | textarea | | Tell us about your project (optional) |

**CTA Button**: `Submit Inquiry`

**Form Note** (below button): 
> We typically respond within 24 hours on business days.

---

## Trust Signals Section

**Headline (H3)**: Why Contact Us?

**Trust Points**:
- ✓ **Free Samples** – No cost. You only pay shipping.
- ✓ **24-Hour Response** – We reply within 1 business day.
- ✓ **NDA Available** – Your designs stay confidential.
- ✓ **Trusted Partner** – Serving COSMAX, NBC, and 500+ brands.

**Client Logo Bar**: 
> Display 4-6 client logos: Perfect Diary, ZEESEA, COSMAX, NBC, FOCALLURE, O.TWO.O

---

## Alternative Contact Section

**Headline (H2)**: Other Ways to Reach Us

| Channel | Details |
|---------|---------|
| **Email** | sales@yusupackaging.com |
| **WhatsApp** | +86 XXX XXXX XXXX |
| **WeChat** | [QR Code + ID: yusu_packaging] |

**Factory Address**:
> Guangzhou Yusu Packaging Products Co., Ltd.  
> [Full Address], Guangzhou, Guangdong, China  
> [Embed Google Maps or static map image]

---

## FAQ Mini Section

**Headline (H2)**: Common Questions

### FAQ 1
- **Q**: How long does it take to receive samples?
- **A**: Samples ship within 3-5 business days. Delivery takes 5-10 days depending on your location.

### FAQ 2
- **Q**: What is the minimum order quantity (MOQ)?
- **A**: MOQ starts at 10,000 pieces for most products. Lower MOQ available for select items.

### FAQ 3
- **Q**: Do you ship internationally?
- **A**: Yes. We ship to 50+ countries. Common destinations include Indonesia, Vietnam, Thailand, the Philippines, and Malaysia.

---

## Structured Data (Schema.org JSON-LD)

```json
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "mainEntity": {
    "@type": "Organization",
    "name": "Guangzhou Yusu Packaging Products Co., Ltd.",
    "url": "https://www.yusupackaging.com",
    "email": "sales@yusupackaging.com",
    "telephone": "+86-XXX-XXXX-XXXX",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Guangzhou",
      "addressRegion": "Guangdong",
      "addressCountry": "CN"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "sales",
      "availableLanguage": ["English", "Chinese"]
    }
  }
}
```

---

## Implementation Notes

### Placeholder Information (需替换)
- [ ] Email 地址
- [ ] WhatsApp 号码
- [ ] WeChat ID 和二维码
- [ ] 工厂完整地址

### Client Logo Usage
根据 `brand_voice.md`，可使用以下客户 Logo（需确认授权）：
- Perfect Diary (完美日记)
- ZEESEA (滋色)
- COSMAX (科丝美诗)
- NBC (诺斯贝尔)
- FOCALLURE (菲鹿儿)
- O.TWO.O

### Form Optimization Tips
- 表单字段越少，转化率越高
- 核心必填字段：Name + Email
- 其他字段可选，降低用户心理负担

### CTA Alternatives
- 当前: "Submit Inquiry"
- 备选: "Get Free Quote" / "Send My Request"
