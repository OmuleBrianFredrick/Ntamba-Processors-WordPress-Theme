# Ntamba Processors WordPress Theme

Original WordPress/WooCommerce theme for Ntamba Processors Limited.

## Production baseline

- WordPress 6.3 or newer
- PHP 8.3 or newer
- WooCommerce installed and activated for the storefront
- HTTPS enabled on the live site
- A MySQL/MariaDB database supported by the installed WordPress version

The theme is a classic PHP WordPress theme. It is **not** a standalone Vercel/Node application.

## Dynamic WooCommerce

WooCommerce is the source of truth for the catalogue. The theme does not hardcode the 17 Ntamba catalogue records.

At runtime the theme reads available WooCommerce data including:

- Product name
- Product image and gallery
- Price
- SKU
- Weight
- Stock/purchasability
- Product categories
- Product description and short description
- GTIN/EAN metadata where available
- Related products
- Cart and checkout data

The shop/archive presentation is rendered by the theme while individual products, cart, checkout, account and order functionality remain powered by WooCommerce.

## Product media

Use the approved Ntamba product photography in WooCommerce:

1. Front Hero
2. Back
3. Front 3/4
4. Front + Back
5. Side 3/4
6. Packaging Detail
7. Lifestyle / Premium Marketing

Set the approved Front Hero image as the WooCommerce featured image and use the remaining approved views in the product gallery.

## Design

Brand palette:
- Deep Coffee Brown `#4A3728`
- Agroecology Green `#2D5A27`
- Warm Honey Gold `#D4A017`
- Warm Cream `#F9F7F2`

The visual direction is original to Ntamba Processors and uses the provided Kaffa site only as a high-level presentation reference. No Kaffa code, branding, artwork or content is included.

## Installation

1. Install WordPress on a PHP 8.3+ hosting environment.
2. Install and activate WooCommerce.
3. Download or clone this repository.
4. The installable theme directory is `ntamba-processors/`.
5. Zip the theme directory as one folder named `ntamba-processors`.
6. In WordPress go to **Appearance → Themes → Add New → Upload Theme**.
7. Upload the resulting `ntamba-processors.zip`.
8. Activate **Ntamba Processors**.
9. Theme activation creates Home, About Us, Wholesale & Export, Contact and Journal pages if those slugs do not already exist.
10. Go to **Settings → Permalinks** and click **Save Changes** once after activation.
11. Configure the WordPress Site Title, Site Icon and logo as appropriate.
12. Go to **Appearance → Customize → Ntamba Brand & Contact** and configure contact email, phone, social URLs, hero image and the Fluent Forms RFQ shortcode if Fluent Forms is installed.
13. Confirm **Settings → Reading** uses the Home page as the static front page.
14. Configure WooCommerce pages, currency, tax, shipping, payment gateways and email settings in WooCommerce.
15. Verify each product's featured image, gallery, price, SKU, weight, GTIN/EAN and stock status in **Products**.

## Optional integrations

The theme does not require Fluent Forms to activate. If Fluent Forms is installed and a valid RFQ shortcode is entered in the Customizer, the Wholesale & Export page renders that form.

Social links are optional and are configured in the Customizer.

## ZIP structure

For WordPress upload, the ZIP should have this structure:

    ntamba-processors.zip
    └── ntamba-processors/
        ├── style.css
        ├── functions.php
        ├── index.php
        ├── front-page.php
        ├── header.php
        ├── footer.php
        ├── page.php
        ├── single.php
        ├── archive.php
        ├── search.php
        ├── 404.php
        ├── woocommerce.php
        ├── page-about-us.php
        ├── page-wholesale.php
        ├── page-contact-us.php
        └── assets/
            └── js/
                └── main.js

Do not create a ZIP containing an extra outer repository directory such as `Ntamba-Processors-WordPress-Theme-main/`.

## Important

This repository is a WordPress theme, not the complete WordPress installation. WordPress core, the database, WooCommerce, payment gateways, shipping configuration, email delivery and other required plugins belong to the hosting/site environment.

The theme should be tested in a real WordPress + WooCommerce installation before production launch.