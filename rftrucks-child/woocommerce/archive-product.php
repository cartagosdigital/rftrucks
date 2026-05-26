<?php
/**
 * RFTRUCKS — Página da Loja (archive-product.php)
 * Substitui completamente o template padrão do WooCommerce.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- ═══ CABEÇALHO DA LOJA ════════════════════════════════════ -->
<div class="woo-page-header">
  <p class="sec-label">RFTRUCKS</p>
  <h1><?php woocommerce_page_title(); ?></h1>
</div>

<!-- ═══ CONTEÚDO PRINCIPAL ══════════════════════════════════ -->
<div class="woo-archive-wrap">

  <?php do_action( 'woocommerce_before_main_content' ); ?>

  <?php woocommerce_output_all_notices(); ?>

  <?php if ( woocommerce_product_loop() ) : ?>

    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; margin-bottom:2.5rem;">
      <?php woocommerce_result_count(); ?>
      <?php woocommerce_catalog_ordering(); ?>
    </div>

    <!-- Grid de produtos -->
    <div class="woo-products-grid">

      <?php while ( have_posts() ) : the_post(); ?>
        <?php
        global $product;
        $product = wc_get_product( get_the_ID() );
        if ( ! $product ) continue;

        $permalink    = get_the_permalink();
        $title        = get_the_title();
        $price_html   = $product->get_price_html();
        $categories   = wc_get_product_category_list( $product->get_id(), ', ' );
        $excerpt      = $product->get_short_description() ?: wp_trim_words( get_the_excerpt(), 18, '…' );
        $thumbnail    = get_the_post_thumbnail( get_the_ID(), 'medium_large' );
        $is_on_sale   = $product->is_on_sale();
        ?>
        <article class="woo-product-card" itemscope itemtype="https://schema.org/Product">

          <?php if ( $is_on_sale ) : ?>
            <span class="woo-product-badge">Promoção</span>
          <?php endif; ?>

          <?php if ( $thumbnail ) : ?>
            <a href="<?php echo esc_url( $permalink ); ?>" class="woo-product-img" aria-hidden="true" tabindex="-1">
              <?php echo $thumbnail; ?>
            </a>
          <?php endif; ?>

          <div class="woo-product-body">
            <?php if ( $categories ) : ?>
              <p class="woo-product-cats"><?php echo wp_strip_all_tags( $categories ); ?></p>
            <?php endif; ?>

            <h2 class="woo-product-title" itemprop="name">
              <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
            </h2>

            <?php if ( $excerpt ) : ?>
              <p class="woo-product-excerpt"><?php echo wp_strip_all_tags( $excerpt ); ?></p>
            <?php endif; ?>

            <div class="woo-product-footer">
              <?php if ( $price_html ) : ?>
                <div class="woo-product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                  <?php echo $price_html; ?>
                </div>
              <?php endif; ?>

              <?php
              echo apply_filters(
                  'woocommerce_loop_add_to_cart_link',
                  sprintf(
                      '<a href="%s" data-quantity="1" class="%s" %s>%s</a>',
                      esc_url( $product->add_to_cart_url() ),
                      esc_attr( implode( ' ', array_filter( [ 'woo-add-to-cart', 'add_to_cart_button', 'ajax_add_to_cart', $product->get_type() ] ) ) ),
                      wc_implode_html_attributes( [
                          'data-product_id'  => $product->get_id(),
                          'data-product_sku' => $product->get_sku(),
                          'aria-label'       => sprintf( __( 'Adicionar "%s" ao carrinho', 'rftrucks-child' ), esc_html( $title ) ),
                          'rel'              => 'nofollow',
                      ] ),
                      esc_html( $product->add_to_cart_text() )
                  ),
                  $product
              );
              ?>
            </div>
          </div>

        </article>
      <?php endwhile; ?>

    </div>
    <!-- /Grid -->

    <!-- Paginação -->
    <nav class="woo-pagination" aria-label="Páginas de produtos">
      <?php
      $paginate_links = paginate_links( [
          'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
          'format'    => '',
          'add_args'  => false,
          'current'   => max( 1, get_query_var( 'paged' ) ),
          'total'     => wc_get_loop_prop( 'total_pages' ),
          'prev_text' => '←',
          'next_text' => '→',
          'type'      => 'array',
          'end_size'  => 3,
          'mid_size'  => 3,
      ] );
      if ( $paginate_links ) {
          foreach ( $paginate_links as $link ) {
              echo $link;
          }
      }
      ?>
    </nav>

  <?php else : ?>

    <div class="cart-empty-msg">
      <?php woocommerce_no_products_found(); ?>
    </div>

  <?php endif; ?>

  <?php do_action( 'woocommerce_after_main_content' ); ?>

</div>

<?php get_footer(); ?>
