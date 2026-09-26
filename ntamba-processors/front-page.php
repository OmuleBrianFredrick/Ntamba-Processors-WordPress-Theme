<?php get_header(); ?>
<main id="primary">
<section class="hero">
  <?php $hero=get_theme_mod('ntamba_hero_image',''); if(!$hero && class_exists('WooCommerce')){ $hero_products=wc_get_products(array('status'=>'publish','limit'=>1,'orderby'=>'date','order'=>'DESC')); if($hero_products && $hero_products[0]->get_image_id()) $hero=wp_get_attachment_image_url($hero_products[0]->get_image_id(),'full'); } if($hero): ?>
    <img class="hero-media" src="<?php echo esc_url($hero); ?>" alt="<?php echo esc_attr__('Ntamba farm and agricultural products','ntamba-processors'); ?>" loading="eager" fetchpriority="high">
  <?php endif; ?>
  <div class="container hero-content">
    <div class="section-kicker section-kicker--light">Ntamba Processors · Uganda</div>
    <h1>Premium Ugandan Coffee, Rooted in Regenerative Agroecology.</h1>
    <p>From the heart of Kyantamba Village to your cup or commercial roastery. Single-origin coffee, honey and dried fruits presented with traceability, quality and Ugandan purpose.</p>
    <div class="hero-actions">
      <a class="button button--light" href="<?php echo esc_url(function_exists('wc_get_page_permalink')?wc_get_page_permalink('shop'):home_url('/shop/')); ?>">Shop Retail Products</a>
      <a class="button button--outline" href="<?php echo esc_url(home_url('/wholesale/')); ?>">Wholesale &amp; Export Inquiries</a>
    </div>
  </div>
</section>

<section class="trust-strip">
  <div class="container trust-grid">
    <div><strong>Uganda</strong><span>Product of Uganda</span></div>
    <div><strong>385 acres</strong><span>Kyantamba agroecology hub</span></div>
    <div><strong>Farm to market</strong><span>Value addition &amp; traceability</span></div>
    <div><strong>Retail + B2B</strong><span>Domestic and export conversations</span></div>
  </div>
</section>

<section class="section">
  <div class="container story-grid">
    <div>
      <div class="section-kicker">Our Story</div>
      <h2>More Than Coffee. A Movement for Rural Empowerment.</h2>
      <p>Ntamba Processors Limited is the primary commercial engine of the Quality International Foundation (QIF). What began as a single-farm concept in Kyantamba Village, Mbarara District, has grown into a 385-acre integrated agroecology hub.</p>
      <p>We bridge rural Ugandan farming and premium markets with a focus on traceability, quality, value addition and social impact.</p>
      <a class="button" href="<?php echo esc_url(home_url('/about/')); ?>">Discover Ntamba</a>
    </div>
    <div class="story-card story-card--feature">
      <div class="section-kicker">Kyantamba Village</div>
      <h3>Farm-to-market with purpose.</h3>
      <p><strong>Primary Processing Farm:</strong> Kyantamba Village, Mbarara District, Western Uganda.</p>
      <div class="story-stats"><div><strong>01</strong><span>Origin</span></div><div><strong>02</strong><span>Processing</span></div><div><strong>03</strong><span>Value addition</span></div></div>
    </div>
  </div>
</section>

<section class="section section--compact">
  <div class="container">
    <div class="section-heading"><div class="section-kicker">Why Ntamba</div><h2>Four brand pillars.</h2></div>
    <div class="pillars">
      <article class="pillar"><div class="pillar-icon">01</div><h3>Traceability</h3><p>Single-farm origin and a clear connection between source, processing and finished product.</p></article>
      <article class="pillar"><div class="pillar-icon">02</div><h3>Climate-Smart Agroecology</h3><p>Circular farming integrating apiculture, livestock, solar and biogas.</p></article>
      <article class="pillar"><div class="pillar-icon">03</div><h3>Social Empowerment</h3><p>Female-led enterprise training women and youth in Greater Masaka and Western Uganda.</p></article>
      <article class="pillar"><div class="pillar-icon">04</div><h3>Value Addition</h3><p>Elevating farm commodities into finished, retail-ready and export-oriented products.</p></article>
    </div>
  </div>
</section>

<section class="section section--cream-dark">
  <div class="container">
    <div class="section-heading section-heading--split">
      <div><div class="section-kicker">The Collection</div><h2>From the Ntamba farm to your table.</h2></div>
      <p>Every product card below is powered by the live WooCommerce catalogue, so approved Ntamba packaging photography, names, prices and availability remain controlled from the store backend.</p>
    </div>
    <div class="category-grid">
      <?php
      $targets=array(
        'coffee'=>array('title'=>'Ntamba Coffee','copy'=>'Natural Robusta coffee in roasted whole-bean and ground formats.'),
        'honey'=>array('title'=>'Ntamba Pure Honey','copy'=>'Ugandan farm honey in convenient retail jars.'),
        'dried-fruits'=>array('title'=>'Ntamba FruitTreat','copy'=>'Ready-to-eat 60g dried tropical fruit packs.')
      );
      foreach($targets as $slug=>$meta):
        $cat=get_term_by('slug',$slug,'product_cat');
        if(!$cat) continue;
        $thumb_id=(int)get_term_meta($cat->term_id,'thumbnail_id',true);
        if(!$thumb_id && class_exists('WooCommerce')){
          $ps=wc_get_products(array('status'=>'publish','limit'=>1,'category'=>array($slug),'return'=>'objects'));
          if($ps && $ps[0]->get_image_id()) $thumb_id=$ps[0]->get_image_id();
        }
        $img=$thumb_id?wp_get_attachment_image_url($thumb_id,'large'):'';
      ?>
      <article class="category-card">
        <?php if($img): ?><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($meta['title']); ?>" loading="lazy"><?php endif; ?>
        <div class="category-content"><div class="category-eyebrow"><?php echo esc_html($cat->count); ?> products</div><h3><?php echo esc_html($meta['title']); ?></h3><p><?php echo esc_html($meta['copy']); ?></p><a class="button button--light" href="<?php echo esc_url(get_term_link($cat)); ?>">Explore collection</a></div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-heading section-heading--split">
      <div><div class="section-kicker">Shop Ntamba</div><h2>Featured products.</h2></div>
      <a class="text-link" href="<?php echo esc_url(function_exists('wc_get_page_permalink')?wc_get_page_permalink('shop'):home_url('/shop/')); ?>">View the full collection →</a>
    </div>
    <?php
    if(class_exists('WooCommerce')){
      $featured=wc_get_products(array('status'=>'publish','limit'=>8,'orderby'=>'date','order'=>'DESC','return'=>'objects'));
      if($featured){echo '<div class="product-grid product-grid--featured">';
      foreach($featured as $p){
        $image=$p->get_image_id()?wp_get_attachment_image($p->get_image_id(),'woocommerce_thumbnail',false,array('loading'=>'lazy')):'<div class="product-placeholder">NTAMBA</div>';
        echo '<article class="product-card"><a class="product-thumb" href="'.esc_url(get_permalink($p->get_id())).'">'.$image.'</a><div class="product-body"><div class="product-meta">'.esc_html($p->get_sku()?'SKU '.$p->get_sku():'Ntamba product').'</div><h3><a href="'.esc_url(get_permalink($p->get_id())).'">'.esc_html($p->get_name()).'</a></h3><div class="product-price">'.wp_kses_post($p->get_price_html()).'</div><a class="product-link" href="'.esc_url(get_permalink($p->get_id())).'">View product →</a></div></article>';
      }
      echo '</div>';
      } else echo '<div class="notice">Add approved Ntamba products to WooCommerce to populate the collection.</div>';
    }
    ?>
  </div>
</section>

<section class="section b2b">
  <div class="container b2b-grid">
    <div><div class="section-kicker section-kicker--light">Wholesale &amp; Export</div><h2>Sourcing for Your Roastery, Cafe, or Distribution Network?</h2><p>Discuss retail cartons, sample quantities or larger supply requirements for coffee, honey and dried fruits. Product specifications and commercial details can be handled through the B2B enquiry workflow.</p><a class="button button--gold" href="<?php echo esc_url(home_url('/wholesale/')); ?>">Request a Cupping Sample</a></div>
    <div class="pipeline">
      <div class="pipeline-step"><span class="step-number">1</span><div><strong>Submit request</strong><div>Share product, quantity, destination and timing.</div></div></div>
      <div class="pipeline-step"><span class="step-number">2</span><div><strong>Sample &amp; logistics</strong><div>Coordinate the appropriate sample and delivery pathway.</div></div></div>
      <div class="pipeline-step"><span class="step-number">3</span><div><strong>Evaluate</strong><div>Review quality, specifications and commercial fit.</div></div></div>
      <div class="pipeline-step"><span class="step-number">4</span><div><strong>Proceed</strong><div>Move to quotation, contract and fulfillment.</div></div></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-heading section-heading--split"><div><div class="section-kicker">Latest Stories</div><h2>The Ntamba Journal.</h2></div><a class="text-link" href="<?php echo esc_url(home_url('/journal/')); ?>">Read the journal →</a></div>
    <div class="journal-grid">
      <?php $q=new WP_Query(array('post_type'=>'post','posts_per_page'=>3,'post_status'=>'publish')); if($q->have_posts()): while($q->have_posts()):$q->the_post(); ?>
      <article class="product-card journal-card"><div class="product-thumb"><?php ntamba_thumbnail('medium_large'); ?></div><div class="product-body"><div class="product-meta"><?php ntamba_posted_on(); ?></div><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(wp_trim_words(get_the_excerpt(),20)); ?></p><a class="product-link" href="<?php the_permalink(); ?>">Read story →</a></div></article>
      <?php endwhile; wp_reset_postdata(); else: ?><div class="notice">Publish Journal posts to populate this section dynamically.</div><?php endif; ?>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>