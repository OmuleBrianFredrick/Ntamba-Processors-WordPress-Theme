# Base44 Setup Notes

## Project type
WordPress/WooCommerce classic PHP theme (not a Node.js app). The repo contains the theme source in `ntamba-processors/`.

## Architecture
- `wordpress:php8.2-apache` — serves the site on host port 3000; theme is bind-mounted into the container
- `mariadb:10.11` — database
- `wordpress:cli` — one-shot setup container: installs WordPress, WooCommerce, activates the theme, creates product categories and sample products

## Running
```
docker compose -f docker-compose.base44.yml up -d
```
The setup container runs automatically on first boot. Check its logs with:
```
docker compose -f docker-compose.base44.yml logs setup
```

## Admin access
- URL: `/wp-admin`
- Username: `admin`
- Password: `admin`

## Development
- Theme PHP/CSS/JS files are bind-mounted; changes appear on page refresh (OPcache revalidates within ~2s)
- No hot reload — call `reload_preview` after backend changes if the preview doesn't update
- WooCommerce must be installed and activated for the shop, product grid, and category sections to render

## Reverse proxy
WordPress runs behind the Base44 preview proxy. `WP_HOME` and `WP_SITEURL` are set dynamically in `wp-config.php` via `WORDPRESS_CONFIG_EXTRA`, using the `BASE44_PUBLIC_HOST_SUFFIX` env var. HTTPS is forced when behind the proxy.

## Permalinks
Permalink structure is set to `/%postname%/` for pretty URLs (e.g., `/about/`, `/shop/`).

## Theme activation
The theme's `after_switch_theme` hook (`ntamba_activate` in `functions.php`) creates default pages (Home, About, Wholesale, Contact, Journal) and sets the front page. This fires when `wp theme activate ntamba-processors` runs in the setup container.
