<?php
/**
 * RFTRUCKS — Carrinho (cart/cart.php)
 * Substitui completamente o template padrão do WooCommerce.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="woo-cart-wrap">

  <?php woocommerce_output_all_notices(); ?>

  <h1 class="woo-cart-title">Carrinho</h1>

  <?php if ( WC()->cart->is_empty() ) : ?>

    <div class="cart-empty-msg">
      <p>O seu carrinho está vazio.</p>
      <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-white">
        Continuar a Comprar
      </a>
    </div>

  <?php else : ?>

    <div class="woo-cart-layout">

      <!-- Tabela de produtos -->
      <div class="woo-cart-items">
        <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" id="woo-cart-form">

          <table class="shop_table cart" cellspacing="0">
            <thead>
              <tr>
                <th class="product-thumbnail" scope="col">&nbsp;</th>
                <th class="product-name" scope="col">Produto</th>
                <th class="product-price" scope="col">Preço</th>
                <th class="product-quantity" scope="col">Quantidade</th>
                <th class="product-subtotal" scope="col">Subtotal</th>
                <th class="product-remove" scope="col">&nbsp;</th>
              </tr>
            </thead>
            <tbody>

              <?php do_action( 'woocommerce_before_cart_contents' ); ?>

              <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $product      = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_link = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                $thumbnail    = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image( 'thumbnail' ), $cart_item, $cart_item_key );
                $product_name = apply_filters( 'woocommerce_cart_item_name', $product_link ? sprintf( '<a href="%s" class="cart-product-name">%s</a>', esc_url( $product_link ), get_the_title( $product_id ) ) : get_the_title( $product_id ), $cart_item, $cart_item_key );
                $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $cart_item, $cart_item_key );
                $product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

                if ( ! $product || ! $product->exists() || 0 === $cart_item['quantity'] ) continue;
              ?>
                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                  <!-- Imagem -->
                  <td class="product-thumbnail">
                    <div class="cart-product-row">
                      <div class="cart-product-img">
                        <?php if ( $product_link ) : ?>
                          <a href="<?php echo esc_url( $product_link ); ?>"><?php echo $thumbnail; ?></a>
                        <?php else : ?>
                          <?php echo $thumbnail; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </td>

                  <!-- Nome -->
                  <td class="product-name" data-title="Produto">
                    <?php echo $product_name; ?>
                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                  </td>

                  <!-- Preço unitário -->
                  <td class="product-price cart-product-price" data-title="Preço">
                    <?php echo $product_price; ?>
                  </td>

                  <!-- Quantidade -->
                  <td class="product-quantity cart-quantity" data-title="Quantidade">
                    <?php
                    if ( $product->is_sold_individually() ) {
                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1">', $cart_item_key );
                    } else {
                        $product_quantity = woocommerce_quantity_input(
                            [
                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                'input_value'  => $cart_item['quantity'],
                                'max_value'    => $product->get_max_purchase_quantity(),
                                'min_value'    => '0',
                                'product_name' => $product->get_name(),
                            ],
                            $product,
                            false
                        );
                    }
                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                    ?>
                  </td>

                  <!-- Subtotal -->
                  <td class="product-subtotal cart-product-subtotal" data-title="Subtotal">
                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                  </td>

                  <!-- Remover -->
                  <td class="product-remove cart-product-remove">
                    <?php echo apply_filters(
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">×</a>',
                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            esc_attr__( 'Remover este item', 'rftrucks-child' ),
                            esc_attr( $product_id ),
                            esc_attr( $product->get_sku() )
                        ),
                        $cart_item_key
                    ); ?>
                  </td>

                </tr>
              <?php endforeach; ?>

              <?php do_action( 'woocommerce_cart_contents' ); ?>

            </tbody>
          </table>

          <!-- Ações do carrinho -->
          <div class="cart-actions">
            <div class="coupon">
              <input
                type="text"
                name="coupon_code"
                class="input-text"
                id="coupon_code"
                value=""
                placeholder="<?php esc_attr_e( 'Código de desconto', 'rftrucks-child' ); ?>"
              >
              <button
                type="submit"
                class="btn btn-ghost"
                name="apply_coupon"
                value="<?php esc_attr_e( 'Aplicar', 'rftrucks-child' ); ?>"
              >
                <?php esc_html_e( 'Aplicar', 'rftrucks-child' ); ?>
              </button>
            </div>

            <button
              type="submit"
              class="btn btn-ghost"
              name="update_cart"
              value="<?php esc_attr_e( 'Atualizar carrinho', 'rftrucks-child' ); ?>"
              <?php wc_cart_needs_payment() ? '' : ''; ?>
            >
              <?php esc_html_e( 'Atualizar Carrinho', 'rftrucks-child' ); ?>
            </button>

            <?php do_action( 'woocommerce_cart_actions' ); ?>
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
          </div>

          <?php do_action( 'woocommerce_after_cart_contents' ); ?>
          <?php do_action( 'woocommerce_after_cart_table' ); ?>

        </form>

        <div style="margin-top:2rem;">
          <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-ghost">
            ← Continuar a Comprar
          </a>
        </div>
      </div>
      <!-- /Tabela de produtos -->


      <!-- Totais -->
      <div class="cart-totals-box" aria-label="Totais do carrinho">
        <h2>Resumo</h2>

        <?php do_action( 'woocommerce_before_cart_totals' ); ?>

        <!-- Subtotal -->
        <div class="cart-totals-row">
          <span class="cart-totals-label">Subtotal</span>
          <span class="cart-totals-value"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <!-- Portes e descontos -->
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
          <div class="cart-totals-row">
            <span class="cart-totals-label">
              <?php wc_cart_totals_coupon_label( $coupon ); ?>
            </span>
            <span class="cart-totals-value">
              <?php wc_cart_totals_coupon_html( $coupon ); ?>
            </span>
          </div>
        <?php endforeach; ?>

        <?php foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) :
          $chosen = isset( WC()->session->chosen_shipping_methods[ $package_id ] ) ? WC()->session->chosen_shipping_methods[ $package_id ] : '';
          $available = $package['rates'];
          foreach ( $available as $rate_id => $rate ) :
            if ( $chosen === $rate_id ) :
        ?>
          <div class="cart-totals-row">
            <span class="cart-totals-label">Envio</span>
            <span class="cart-totals-value"><?php echo wc_price( $rate->get_cost() ); ?></span>
          </div>
        <?php endif; endforeach; endforeach; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
          <div class="cart-totals-row">
            <span class="cart-totals-label"><?php echo esc_html( $fee->name ); ?></span>
            <span class="cart-totals-value"><?php echo wc_price( $fee->total ); ?></span>
          </div>
        <?php endforeach; ?>

        <!-- IVA -->
        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
          <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
            <div class="cart-totals-row">
              <span class="cart-totals-label"><?php echo esc_html( $tax->label ); ?></span>
              <span class="cart-totals-value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

        <!-- Total -->
        <div class="cart-totals-row">
          <span class="cart-totals-label">Total</span>
          <span class="cart-totals-value total"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="cart-totals-checkout">
          Finalizar Encomenda →
        </a>

        <?php do_action( 'woocommerce_after_cart_totals' ); ?>

      </div>
      <!-- /Totais -->

    </div>
    <!-- /woo-cart-layout -->

  <?php endif; ?>

</div>
<!-- /woo-cart-wrap -->

<?php get_footer(); ?>
