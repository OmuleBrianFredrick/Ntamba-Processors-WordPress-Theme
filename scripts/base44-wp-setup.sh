#!/bin/sh
set -e

cd /var/www/html

# Skip if already done
if [ -f .base44-setup-done ]; then
  echo "Base44 setup already complete, skipping."
  exit 0
fi

# Wait for database (use PHP mysqli instead of mariadb-check to avoid SSL issues)
echo "Waiting for database..."
max_tries=30
i=0
while [ $i -lt $max_tries ]; do
  if php -r "\$r=new mysqli('db','wordpress','wordpress','wordpress');exit(\$r->connect_error?1:0);" 2>/dev/null; then
    echo "Database is ready."
    break
  fi
  i=$((i + 1))
  sleep 2
done
if [ $i -ge $max_tries ]; then
  echo "ERROR: Database not available after $max_tries tries."
  exit 1
fi

# Install WordPress
echo "Installing WordPress..."
wp core install \
  --url=http://localhost \
  --title="Ntamba Processors" \
  --admin_user=admin \
  --admin_password=admin \
  --admin_email=admin@ntamba.co.ug \
  --skip-email \
  || echo "WordPress may already be installed."

# Set permalink structure for pretty URLs
echo "Setting permalink structure..."
wp rewrite structure '/%postname%/' --hard 2>/dev/null || true

# Install and activate WooCommerce
echo "Installing WooCommerce (this may take a moment)..."
wp plugin install woocommerce --activate || echo "WARNING: WooCommerce installation issue."

# Skip WooCommerce setup wizard
wp option update woocommerce_onboarding_opt_in 0 2>/dev/null || true
wp option update woocommerce_task_list_complete '["products","appearance"]' 2>/dev/null || true
wp option update woocommerce_task_list_hidden 1 2>/dev/null || true

# Activate our theme (triggers page creation via after_switch_theme hook)
echo "Activating Ntamba Processors theme..."
wp theme activate ntamba-processors

# Create product categories
echo "Creating product categories..."
wp wc product_cat create coffee --name="Coffee" --user=admin 2>/dev/null || echo "Category 'coffee' may already exist."
wp wc product_cat create honey --name="Honey" --user=admin 2>/dev/null || echo "Category 'honey' may already exist."
wp wc product_cat create dried-fruits --name="Dried Fruits" --user=admin 2>/dev/null || echo "Category 'dried-fruits' may already exist."

# Create sample products
echo "Creating sample products..."
wp wc product create --name="Ntamba Robusta Coffee 250g" --type=simple --regular_price="18.00" --sku="NT-COF-250" --weight="0.25" --user=admin --categories='[{"slug":"coffee"}]' 2>/dev/null || echo "Product NT-COF-250 may already exist."
wp wc product create --name="Ntamba Pure Honey 500g" --type=simple --regular_price="12.00" --sku="NT-HON-500" --weight="0.5" --user=admin --categories='[{"slug":"honey"}]' 2>/dev/null || echo "Product NT-HON-500 may already exist."
wp wc product create --name="Ntamba FruitTreat 60g" --type=simple --regular_price="3.50" --sku="NT-FRT-060" --weight="0.06" --user=admin --categories='[{"slug":"dried-fruits"}]' 2>/dev/null || echo "Product NT-FRT-060 may already exist."

# Flush rewrite rules
wp rewrite flush --hard 2>/dev/null || true

# Mark as done
touch .base44-setup-done
echo "Base44 setup complete!"
