# Ntamba Product Media Implementation

The theme intentionally uses **live WooCommerce product media** rather than hardcoded placeholder images.

## Approved media sequence

For each approved SKU, use the original Ntamba packaging exactly as supplied:

1. Front Hero — straight-on 0°
2. Back — straight-on 0°
3. Front 3/4 — approximately 30–45°
4. Front + Back
5. Side 3/4
6. Packaging Detail
7. Lifestyle / Premium Marketing

The lifestyle treatment is the established Ntamba style: product upright on a warm natural wooden table, slightly zoomed out with comfortable margins, soft professional lighting, gentle grounding shadow and warm neutral background.

## WooCommerce mapping

The product's **Featured Image** should always be the approved Front Hero. The remaining approved views belong in the WooCommerce product gallery.

Current commercial SKU set:

- NPL01 — Ground Coffee 1kg
- NPL02 — Ground Coffee 500g
- NPL03 — Ground Coffee 250g
- NPL04 — Ground Coffee 100g
- NPL06 — Roasted Coffee Beans 1kg
- NPL07 — Roasted Coffee Beans 500g
- NPL08 — Roasted Coffee Beans 250g
- NPL09 — Roasted Coffee Beans 100g
- NPL16 — Ntamba Pure Natural Farm Honey 150g
- NPL18 — Ntamba Pure Natural Farm Honey 490g
- NPL19 — Ntamba Honey Premium Jar 650g
- NPL10 — Ntamba Chewable Coffee Beans 10g
- NPL11 — Ntamba FruitTreat Dried Pineapple 60g
- NPL12 — Ntamba FruitTreat Dried Mango 60g
- NPL13 — Ntamba FruitTreat Dried Jackfruit 60g
- NPL14 — Ntamba FruitTreat Dried Banana 60g
- NPL15 — Ntamba FruitTreat Tropical Mixed Fruits 60g

## Important pack-size rule

The current approved commercial catalogue uses **60g** for the FruitTreat dried-fruit SKUs NPL11–NPL15. Do not replace those with older 120g artwork/catalogue entries.

## Theme behaviour

- Home category cards pull category thumbnails, with a fallback to a live product image from that category.
- Featured product cards pull the live WooCommerce featured image, title, SKU and price.
- Shop/archive cards pull live WooCommerce media and product data.
- Single-product pages remain WooCommerce-native so gallery, cart, checkout and variation behaviour stay compatible with the store.
- The homepage hero uses the Customizer hero image when configured; otherwise it falls back to the latest published WooCommerce product image.

## Brand reference

The Kaffa reference is used only for broad visual direction: editorial spacing, premium coffee presentation, hierarchy and storefront rhythm. No Kaffa code, branding, artwork or proprietary content is copied into this theme.

## Publishing workflow

1. Upload the approved Ntamba Front Hero to the matching WooCommerce product.
2. Add the approved Back, 3/4, Front + Back, Side 3/4, Packaging Detail and Lifestyle images to the product gallery where available.
3. Set the correct WooCommerce product category.
4. Confirm SKU, GTIN/EAN, price and stock against the approved product catalogue.
5. Set the approved Front Hero as Featured Image.
6. Clear any WordPress/WooCommerce/CDN cache after bulk media changes.

