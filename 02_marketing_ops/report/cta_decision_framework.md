# 独立站首页 CTA 跳转决策框架 (Buyer Persona Perspective)

**分析对象**: 首页 (`home.html`) 关键按钮
**目标用户 (Persona)**: 东南亚/全球化妆品品牌采购经理 (Time-poor, Risk-averse, Efficiency-driven)

---

## 核心决策逻辑图 (The "Mental Click" Flow)

用户的每一次点击都代表着一个具体的**心理诉求 (Micro-Intent)**。除了"随便看看"，B2B 买家的点击通常由以下三个问题驱动：
1.  **"你能做什么？"** (Capabilities) → *Explore / Discover*
2.  **"质量如何？"** (Validation) → *Request Samples*
3.  **"成本多少？"** (Commercials) → *Get a Quote*

---

## 1. 按钮分析: "EXPLORE INNOVATIONS"
*   **位置**: 首屏 Hero Section (主视觉区)
*   **当前状态**: 指向 `/products`
*   **用户心理 (The Inner Monologue)**:
    > "这家主要做公模还是私模？有没有我看过没见过的设计？我不想看通用的瓶子，我想看点新的。"
*   **点击动机**:
    *   寻找灵感 (Inspiration Hunting)
    *   验证供应商的所谓"创新"是否属实
*   **决策框架**:
    *   **IF** 我正在寻找新品/要做差异化包装 **THEN** 点击此按钮。
    *   **EXPECTATION**: 点击后应立即看到"New Arrivals"或"Patent Design"列表，而不是普通的 Catalog。

## 2. 按钮分析: "REQUEST SAMPLES" (首屏)
*   **位置**: 首屏 Hero Section (副按钮)
*   **当前状态**: 指向 `/contact` (建议优化为弹窗)
*   **用户心理**:
    > "看起来不错，但这只是渲染图还是实物？我想摸摸手感。如果拿样太麻烦（要填长表单），我就先存书签再说。"
*   **点击动机**:
    *   低承诺转化 (Low-Commitment Conversion)
    *   验证实物质量 (Physical Validation)
*   **决策框架**:
    *   **IF** 我对主图的产品感兴趣 **AND** 我不想马上谈判价格 **THEN** 点击此按钮索取样品。
    *   **CRITICAL**: 如果点击后跳转到通用 Contact 页面，流失率极高。**最佳路径**是弹出 "Quick Sample Request" 模态框。

## 3. 按钮分析: "DISCOVER OUR INNOVATION"
*   **位置**: Innovation / R&D 版块
*   **当前状态**: 指向 `/innovation`
*   **用户心理**:
    > "他们说有 100+ 专利和 7 天打样，是真的吗？你们的工厂长什么样？有没有知名品牌背书？"
*   **点击动机**:
    *   深度尽职调查 (Due Diligence)
    *   评估供应链能力 (Supply Chain Assessment)
*   **决策框架**:
    *   **IF** 我是大型品牌采购（比起现成产品更看重开发能力） **THEN** 点击此按钮查看通过 ISO 认证的实验室和案例。

## 4. 按钮分析: "REQUEST SAMPLES" (底部/重复)
*   **位置**: 页面底部 Final CTA 或 Product Specific
*   **当前状态**: 触发模态框 (Modal) / 指向 `/contact`
*   **用户心理**:
    > "我看完了，这几个款式（如 Gold Bar Bottle）可以备选。在找老板汇报前，我最好手头有实物。"
*   **点击动机**:
    *   加入候选名单 (Shortlisting)
    *   准备内部提案 (Internal Proposal Prep)
*   **决策框架**:
    *   **IF** 我已经浏览了具体产品 **AND** 即使不马上购买也希望能感受材质 **THEN** 申请样品包 (Sample Kit)。

## 5. 按钮分析: "GET A QUOTE"
*   **位置**: 导航栏右侧 (Sticky) & 页面底部
*   **当前状态**: 指向 `/contact` (询盘页)
*   **用户心理**:
    > "这个月就要定供应商了。规格差不多符合，关键看价格和 MOQ。只要条件合适就下单。"
*   **点击动机**:
    *   高意向询价 (High-Intent Inquiry)
    *   项目启动 (Project Initiation)
*   **决策框架**:
    *   **IF** 我有明确的需求清单 (BOM) **OR** 我时间紧迫需要马上知道成本 **THEN** 点击此按钮。
    *   **EXPECTATION**: 希望能直接上传我的需求文档，或者有专人对接，而不是漫长的等待。

---

## ⚡️ 优化行动清单 (Actionable Insights)

基于以上框架，我们需要确保 `home.html` 的行为符合预期：

1.  **Hero "REQUEST SAMPLES"**:
    *   **当前**: `<a href="/contact">`
    *   **建议**: 改为触发 `data-bs-target="#sampleModal"`，与底部 CTA 保持一致，减少跳转摩擦。
2.  **"EXPLORE INNOVATIONS"**:
    *   **确认**: 链接到 `/products` 是否默认展示 "Featured/New" 排序？如果没有，建议链接改为 `/products?sort=new`。
3.  **"GET A QUOTE"**:
    *   **建议**: 在 Mobile 端导航栏保持该按钮常驻（Sticky），因为手机端用户更倾向于直接联系而非慢慢浏览。
