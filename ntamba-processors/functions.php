<?php
if(!defined('ABSPATH')) exit;
define('NTAMBA_VERSION','1.3.1');
define('NTAMBA_URI',get_template_directory_uri());

function ntamba_setup(){
 load_theme_textdomain('ntamba-processors',get_template_directory().'/languages');
 add_theme_support('title-tag'); add_theme_support('post-thumbnails');
 add_theme_support('custom-logo',array('height'=>80,'width'=>260,'flex-height'=>true,'flex-width'=>true));
 add_theme_support('html5',array('search-form','comment-form','comment-list','gallery','caption','style','script'));
 add_theme_support('automatic-feed-links'); add_theme_support('woocommerce',array('thumbnail_image_width'=>600,'single_image_width'=>1000,'product_grid'=>array('default_rows'=>4,'min_rows'=>1,'max_rows'=>8,'default_columns'=>4,'min_columns'=>1,'max_columns'=>4)));
 register_nav_menus(array('primary'=>'Primary Menu','footer'=>'Footer Menu'));
}
add_action('after_setup_theme','ntamba_setup');

function ntamba_assets(){
 wp_enqueue_style('ntamba-fonts','https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@500;600;700;800;900&display=swap',array(),null);
 wp_enqueue_style('ntamba-style',get_stylesheet_uri(),array('ntamba-fonts'),NTAMBA_VERSION);
 wp_enqueue_script('ntamba-main',NTAMBA_URI.'/assets/js/main.js',array(),NTAMBA_VERSION,true);
}
add_action('wp_enqueue_scripts','ntamba_assets');

function ntamba_customize($c){
 $c->add_section('ntamba_brand',array('title'=>'Ntamba Brand & Contact','priority'=>30));
 $fields=array('ntamba_contact_email'=>array('Primary contact email','inquire@ntamba.co.ug','email'),'ntamba_phone'=>array('Phone','+256 782 333 223','text'),'ntamba_instagram'=>array('Instagram URL','','url'),'ntamba_facebook'=>array('Facebook URL','','url'),'ntamba_linkedin'=>array('LinkedIn URL','','url'),'ntamba_rfq_shortcode'=>array('Fluent Forms RFQ shortcode','','text'));
 foreach($fields as $key=>$v){$sanitize=$v[2]==='email'?'sanitize_email':($v[2]==='url'?'esc_url_raw':'sanitize_text_field');$c->add_setting($key,array('default'=>$v[1],'sanitize_callback'=>$sanitize));$c->add_control($key,array('label'=>$v[0],'section'=>'ntamba_brand','type'=>$v[2]));}
 $c->add_setting('ntamba_hero_image',array('default'=>'','sanitize_callback'=>'esc_url_raw')); $c->add_control(new WP_Customize_Image_Control($c,'ntamba_hero_image',array('label'=>'Hero image','section'=>'ntamba_brand')));
 $c->add_section('ntamba_colors',array('title'=>'Ntamba Colors','priority'=>31));
 foreach(array('ntamba_color_coffee'=>array('Deep Coffee Brown','#4A3728'),'ntamba_color_green'=>array('Agroecology Green','#2D5A27'),'ntamba_color_gold'=>array('Warm Honey Gold','#D4A017'),'ntamba_color_cream'=>array('Warm Cream','#F9F7F2')) as $key=>$v){$c->add_setting($key,array('default'=>$v[1],'sanitize_callback'=>'sanitize_hex_color'));$c->add_control(new WP_Customize_Color_Control($c,$key,array('label'=>$v[0],'section'=>'ntamba_colors')));}
}
add_action('customize_register','ntamba_customize');

function ntamba_css_vars(){ $vars=array('--coffee'=>get_theme_mod('ntamba_color_coffee','#4A3728'),'--green'=>get_theme_mod('ntamba_color_green','#2D5A27'),'--gold'=>get_theme_mod('ntamba_color_gold','#D4A017'),'--cream'=>get_theme_mod('ntamba_color_cream','#F9F7F2'));$css=':root{';foreach($vars as $k=>$v)$css.=$k.':'.esc_html($v).';';$css.='}';wp_add_inline_style('ntamba-style',$css);}
add_action('wp_enqueue_scripts','ntamba_css_vars',20);

function ntamba_activate(){
 $templates=array('about'=>'page-about-us.php','wholesale'=>'page-wholesale.php','contact'=>'page-contact-us.php');
 $pages=array();
 foreach(array('home'=>'Home','about'=>'About Us','wholesale'=>'Wholesale & Export','contact'=>'Contact','journal'=>'Journal') as $slug=>$title){
  $page=get_page_by_path($slug);
  if(!$page){$id=wp_insert_post(array('post_title'=>$title,'post_name'=>$slug,'post_status'=>'publish','post_type'=>'page'));$page=get_post($id);}
  if($page){$pages[$slug]=$page->ID;if(isset($templates[$slug]))update_post_meta($page->ID,'_wp_page_template',$templates[$slug]);}
 }
 if(isset($pages['home'])){update_option('show_on_front','page');update_option('page_on_front',$pages['home']);}
}
add_action('after_switch_theme','ntamba_activate');

function ntamba_contact_submit(){
 if(!isset($_POST['ntamba_contact_nonce'])||!wp_verify_nonce($_POST['ntamba_contact_nonce'],'ntamba_contact'))wp_die('Security check failed.');
 $name=sanitize_text_field($_POST['name']??'');$email=sanitize_email($_POST['email']??'');$subject=sanitize_text_field($_POST['subject']??'');$message=sanitize_textarea_field($_POST['message']??'');
 if(!$name||!is_email($email)||!$message){wp_safe_redirect(add_query_arg('sent','0',wp_get_referer()?:home_url('/contact/')));exit;}
 $to=get_theme_mod('ntamba_contact_email','inquire@ntamba.co.ug');if(!is_email($to))$to=get_option('admin_email');
 $ok=wp_mail($to,$subject?:'Ntamba website enquiry',$message,array('Reply-To: '.$name.' <'.$email.'>'));wp_safe_redirect(add_query_arg('sent',$ok?'1':'0',wp_get_referer()?:home_url('/contact/')));exit;
}
add_action('admin_post_ntamba_contact','ntamba_contact_submit');add_action('admin_post_nopriv_ntamba_contact','ntamba_contact_submit');
function ntamba_gtin($product){foreach(array('_global_unique_id','_gtin','gtin','_wc_gla_gtin','_alg_ean','_ean') as $k){$v=get_post_meta($product->get_id(),$k,true);if($v!=='')return $v;}return '';}
function ntamba_posted_on(){echo '<span>'.esc_html(get_the_date()).'</span>';}
function ntamba_thumbnail($size='large'){if(has_post_thumbnail())the_post_thumbnail($size,array('loading'=>'lazy'));}
function ntamba_cat_url($slug){if(taxonomy_exists('product_cat')){$t=get_term_by('slug',$slug,'product_cat');if($t&&!is_wp_error($t))return get_term_link($t);}return function_exists('wc_get_page_permalink')?wc_get_page_permalink('shop'):home_url('/shop/');}
function ntamba_search_form(){echo '<form role="search" class="search-form" method="get" action="'.esc_url(home_url('/')).'"><label>Search<input type="search" name="s" value="'.esc_attr(get_search_query()).'" placeholder="Search"></label><input type="hidden" name="post_type" value="product"></form>';}

function ntamba_wc_render(){
 if(!class_exists('WooCommerce')){echo '<div class="notice">WooCommerce is required to display the shop.</div>';return;}
 if(is_shop()||is_product_category()||is_product_tag()){
  $args=array('status'=>'publish','limit'=>12,'paginate'=>true);
  if(is_product_category())$args['category']=array(get_queried_object()->slug);
  $result=wc_get_products($args);$products=$result->products;
  echo '<header class="section-heading"><div class="section-kicker">The Ntamba Collection</div><h1>'.esc_html(is_product_category()?single_term_title('',false):'The Ntamba Collection').'</h1><p>Ethically sourced, meticulously processed, and packed for freshness in Uganda.</p></header>';
  if($products){echo '<div class="product-grid">';foreach($products as $p){$weight=$p->get_weight();$unit=get_option('woocommerce_weight_unit');$gtin=ntamba_gtin($p);echo '<article class="product-card"><a class="product-thumb" href="'.esc_url(get_permalink($p->get_id())).'">';if($p->get_image_id())echo wp_get_attachment_image($p->get_image_id(),'woocommerce_thumbnail',false,array('loading'=>'lazy'));else echo '<div style="font-weight:900;color:var(--coffee)">NTAMBA</div>';echo '</a><div class="product-body"><div class="product-meta">'.esc_html($weight!==''?$weight.' '.$unit:($p->get_sku()?'SKU '.$p->get_sku():'')).'</div><h3><a href="'.esc_url(get_permalink($p->get_id())).'">'.esc_html($p->get_name()).'</a></h3><div class="product-price">'.wp_kses_post($p->get_price_html()).'</div>';if($gtin)echo '<div class="product-meta">GTIN/EAN: '.esc_html($gtin).'</div>';echo '<div class="product-actions">'.wp_kses_post(sprintf('<a class="button" href="%s">View Product</a>',esc_url(get_permalink($p->get_id())))).'</div></div></article>';}echo '</div>';}else echo '<div class="notice">No products found.</div>';
 }else woocommerce_content();
}


function ntamba_single_product_context(){
 if(!function_exists('is_product') || !is_product()) return;
 global $product;
 if(!$product) return;
 $terms=get_the_terms($product->get_id(),'product_cat');
 $label='Ntamba Collection';
 if($terms && !is_wp_error($terms)) $label=$terms[0]->name;
 echo '<div class="ntamba-product-context">';
 echo '<a class="ntamba-back-link" href="'.esc_url(wc_get_page_permalink('shop')).'">← Back to the Ntamba Collection</a>';
 echo '<span class="ntamba-product-eyebrow">'.esc_html($label).'</span>';
 echo '</div>';
}
add_action('woocommerce_single_product_summary','ntamba_single_product_context',4);

/* WooCommerce storefront polish */
add_filter('woocommerce_enqueue_styles',function($styles){return $styles;});
add_filter('woocommerce_breadcrumb_defaults',function($defaults){$defaults['delimiter']=' <span class="breadcrumb-separator">/</span> ';return $defaults;});
add_action('woocommerce_single_product_summary',function(){global $product;if($product){$gtin=ntamba_gtin($product);if($gtin)echo '<div class="product-code"><strong>GTIN/EAN:</strong> '.esc_html($gtin).'</div>'; }},39);
add_filter('body_class',function($classes){if(function_exists('is_woocommerce') && is_woocommerce())$classes[]='ntamba-commerce';return $classes;});
