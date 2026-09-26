# Ntamba Processors WordPress Theme

Original WordPress/WooCommerce theme for Ntamba Processors Limited.

This repository is the source of the Ntamba website theme. Product data is intentionally pulled dynamically from WooCommerce rather than hardcoded.

## Brand
- Deep Coffee Brown: #4A3728
- Agroecology Green: #2D5A27
- Warm Honey Gold: #D4A017
- Warm Cream: #F9F7F2

## Stack
WordPress core, WooCommerce, Gutenberg-compatible templates, optional Fluent Forms.

## Theme directory
`ntamba-processors/`

## Product data
The theme reads live products, categories, prices, stock, images, weights and available product metadata from WooCommerce.

## Setup
1. Install WordPress and WooCommerce.
2. Upload/activate the `ntamba-processors` theme.
3. Configure logo, hero image, social links and contact details under Appearance > Customize.
4. Create/verify primary navigation menus.
5. Confirm WooCommerce shop and product categories.
6. Configure Fluent Forms for the B2B RFQ shortcode when available.

## Design note
The visual direction is original to Ntamba Processors and uses the provided Kaffa reference only as high-level presentation inspiration. No Kaffa code, branding, artwork or content is included.


## Build an installable WordPress ZIP

From the repository root, package the `ntamba-processors` theme directory as the installable WordPress ZIP.

### Windows PowerShell

```powershell
.\scripts\package-theme.ps1
```

### macOS/Linux

```bash
bash ./scripts/package-theme.sh
```

Both scripts produce `ntamba-processors.zip` with the correct top-level theme folder. Upload that ZIP in WordPress under **Appearance → Themes → Add New → Upload Theme**.
