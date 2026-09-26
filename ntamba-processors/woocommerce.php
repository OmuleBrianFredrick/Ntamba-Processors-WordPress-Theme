<?php
if(!defined('ABSPATH')) exit;
get_header('shop');
?>
<main id="primary" class="content-area woocommerce-area">
  <div class="container">
    <?php ntamba_wc_render(); ?>
  </div>
</main>
<?php get_footer(); ?>