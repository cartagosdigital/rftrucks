<?php
/**
 * RFTRUCKS — Produto Individual (single-product.php)
 * Substitui completamente o template padrão do WooCommerce.
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
    the_post();

    global $product;
    $product = wc_get_product( get_the_ID() );
    if ( ! $product ) { wp_redirect( wc_get_page_permalink( 'shop' ) ); exit; }

    $title          = get_the_title();
    $price_html     = $product->get_price_html();
    $description    = $product->get_description();
    $short_desc     = $product->get_short_description();
    $categories     = wc_get_product_category_list( $product->get_id(), ', ' );
    $tags           = wc_get_product_tag_list( $product->get_id(), ', ' );
    $sku            = $product->get_sku();
    $gallery_ids    = $product->get_gallery_image_ids();
    $main_img_id    = $product->get_image_id();
    $main_img_url   = $main_img_id ? wp_get_attachment_image_url( $main_img_id, 'large' ) : wc_placeholder_img_src( 'large' );
    $main_img_src   = $main_img_id ? wp_get_attachment_image( $main_img_id, 'large' ) : wc_placeholder_img( 'large' );

    // URL de adicionar ao carrinho
    $add_to_cart_url = ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() )
        ? $product->add_to_cart_url()
        : get_the_permalink();

    do_action( 'woocommerce_before_single_product' );
?>

<!-- ═══ PRODUTO INDIVIDUAL ══════════════════════════════════ -->
<div class="woo-single-wrap">

  <?php woocommerce_output_all_notices(); ?>

  <!-- Breadcrumb -->
  <nav class="woo-breadcrumb" aria-label="Localização">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
    <span aria-hidden="true">·</span>
    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Loja</a>
    <?php if ( $categories ) : ?>
      <span aria-hidden="true">·</span>
      <span><?php echo wp_strip_all_tags( $categories ); ?></span>
    <?php endif; ?>
    <span aria-hidden="true">·</span>
    <span><?php echo esc_html( $title ); ?></span>
  </nav>

  <!-- Layout principal -->
  <div class="woo-single-layout" itemscope itemtype="https://schema.org/Product">

    <!-- Galeria -->
    <div class="woo-single-gallery">
      <div class="woo-single-main-img">
        <img
          src="<?php echo esc_url( $main_img_url ); ?>"
          alt="<?php echo esc_attr( $title ); ?>"
          id="wooMainImg"
          loading="eager"
        >
      </div>

      <?php if ( $gallery_ids ) : ?>
        <div class="woo-single-thumbs" role="list">
          <!-- Thumbnail da imagem principal -->
          <div class="woo-single-thumb active" role="listitem" style="cursor:pointer;">
            <img
              src="<?php echo esc_url( wp_get_attachment_image_url( $main_img_id, 'thumbnail' ) ); ?>"
              alt="<?php echo esc_attr( $title ); ?>"
              loading="lazy"
            >
          </div>
          <?php foreach ( $gallery_ids as $img_id ) :
            $thumb_url = wp_get_attachment_image_url( $img_id, 'thumbnail' );
            if ( ! $thumb_url ) continue;
          ?>
            <div class="woo-single-thumb" role="listitem" style="cursor:pointer;">
              <img
                src="<?php echo esc_url( $thumb_url ); ?>"
                alt="<?php echo esc_attr( get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ?: $title ); ?>"
                loading="lazy"
              >
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <!-- /Galeria -->

    <!-- Informações -->
    <div class="woo-single-info">

      <?php if ( $categories ) : ?>
        <p class="woo-single-cats"><?php echo wp_strip_all_tags( $categories ); ?></p>
      <?php endif; ?>

      <h1 class="woo-single-title" itemprop="name"><?php echo esc_html( $title ); ?></h1>

      <?php if ( $price_html ) : ?>
        <div class="woo-single-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
          <?php echo $price_html; ?>
        </div>
      <?php endif; ?>

      <?php if ( $short_desc ) : ?>
        <div class="woo-single-desc">
          <?php echo wp_kses_post( $short_desc ); ?>
        </div>
      <?php endif; ?>

      <!-- Formulário de adicionar ao carrinho -->
      <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
        <form class="woo-single-form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', get_the_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>

          <?php if ( $product->is_type( 'simple' ) ) : ?>
            <div class="woo-qty-row">
              <span class="woo-qty-label">Quantidade</span>
              <div class="woo-qty-wrap">
                <button type="button" class="woo-qty-btn" data-action="minus" aria-label="Diminuir quantidade">−</button>
                <input
                  type="number"
                  class="woo-qty-input qty"
                  name="quantity"
                  value="<?php echo esc_attr( isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : 1 ); ?>"
                  min="1"
                  max="<?php echo esc_attr( $product->get_max_purchase_quantity() ); ?>"
                  step="1"
                  aria-label="Quantidade"
                >
                <button type="button" class="woo-qty-btn" data-action="plus" aria-label="Aumentar quantidade">+</button>
              </div>
            </div>

            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>">
            <?php wp_nonce_field( 'woocommerce-cart', '_wpnonce' ); ?>

            <button type="submit" class="woo-single-atc single_add_to_cart_button button alt">
              <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
            </button>

          <?php else : ?>
            <?php do_action( 'woocommerce_single_product_summary' ); ?>
          <?php endif; ?>

        </form>
      <?php else : ?>
        <p style="font-size:0.85rem; color:var(--gray-text); margin-bottom:2rem; padding:1rem; border:1px solid var(--border);">
          <?php echo esc_html( $product->is_in_stock() ? __( 'Não é possível comprar este produto.', 'rftrucks-child' ) : __( 'Produto esgotado.', 'rftrucks-child' ) ); ?>
        </p>
      <?php endif; ?>

      <!-- Meta (SKU, tags) -->
      <div class="woo-single-meta">
        <?php if ( $sku ) : ?>
          <p>Ref.: <span><?php echo esc_html( $sku ); ?></span></p>
        <?php endif; ?>
        <?php if ( $tags ) : ?>
          <p>Tags: <?php echo wp_kses_post( $tags ); ?></p>
        <?php endif; ?>
      </div>

    </div>
    <!-- /Informações -->

  </div>
  <!-- /Layout principal -->

  <!-- Descrição completa -->
  <?php if ( $description ) : ?>
    <div style="max-width:720px; margin:5rem auto 0; padding-top:4rem; border-top:1px solid var(--border);">
      <p class="sec-label" style="margin-bottom:1.5rem;">Descrição</p>
      <div style="font-size:0.92rem; font-weight:300; color:var(--gray-light); line-height:1.85;">
        <?php echo wp_kses_post( $description ); ?>
      </div>
    </div>
  <?php endif; ?>

</div>
<!-- /woo-single-wrap -->


<!-- ═══ PRODUTOS RELACIONADOS ═══════════════════════════════ -->
<?php
$related_ids = wc_get_related_products( $product->get_id(), 4 );
if ( $related_ids ) :
    $related_products = array_map( 'wc_get_product', $related_ids );
    $related_products = array_filter( $related_products );
?>
<section class="woo-related" aria-labelledby="related-title">
  <h2 class="woo-related-title" id="related-title">Produtos Relacionados</h2>
  <div class="woo-related-grid">
    <?php foreach ( $related_products as $rel ) :
      $rel_permalink = get_permalink( $rel->get_id() );
      $rel_title     = $rel->get_name();
      $rel_price     = $rel->get_price_html();
      $rel_img       = get_the_post_thumbnail( $rel->get_id(), 'medium' );
    ?>
      <article class="woo-product-card">
        <?php if ( $rel_img ) : ?>
          <a href="<?php echo esc_url( $rel_permalink ); ?>" class="woo-product-img" tabindex="-1" aria-hidden="true">
            <?php echo $rel_img; ?>
          </a>
        <?php endif; ?>
        <div class="woo-product-body">
          <h3 class="woo-product-title" style="font-size:1.1rem;">
            <a href="<?php echo esc_url( $rel_permalink ); ?>"><?php echo esc_html( $rel_title ); ?></a>
          </h3>
          <div class="woo-product-footer">
            <div class="woo-product-price"><?php echo $rel_price; ?></div>
            <a href="<?php echo esc_url( $rel_permalink ); ?>" class="woo-add-to-cart">Ver Produto</a>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<?php
endwhile;
get_footer();
?>
