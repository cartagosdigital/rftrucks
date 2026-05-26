<?php
/**
 * RFTRUCKS — Checkout (checkout/form-checkout.php)
 * Substitui completamente o template padrão do WooCommerce.
 */

defined( 'ABSPATH' ) || exit;

if ( WC()->cart->is_empty() ) {
    wp_redirect( wc_get_page_permalink( 'shop' ) );
    exit;
}

get_header();

do_action( 'woocommerce_before_checkout_form', WC()->checkout() );

$checkout = WC()->checkout();
?>

<div class="woo-checkout-wrap">

  <?php woocommerce_output_all_notices(); ?>

  <h1 class="woo-checkout-title">Finalizar Encomenda</h1>

  <!-- Formulário principal -->
  <form
    name="checkout"
    method="post"
    class="checkout woocommerce-checkout"
    action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
    enctype="multipart/form-data"
    novalidate
  >

    <?php if ( $checkout->get_checkout_fields() ) : ?>

      <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

      <div class="woo-checkout-layout">

        <!-- Coluna esquerda: dados do cliente -->
        <div class="woo-checkout-left">

          <!-- Login (se não estiver autenticado) -->
          <?php if ( ! is_user_logged_in() && $checkout->is_registration_required() === false ) : ?>
            <?php woocommerce_login_form_checkout(); ?>
          <?php endif; ?>

          <!-- Cupão -->
          <?php if ( wc_coupons_enabled() ) : ?>
            <div style="margin-bottom:2.5rem;">
              <?php woocommerce_checkout_coupon_form(); ?>
            </div>
          <?php endif; ?>

          <!-- Dados de faturação -->
          <?php do_action( 'woocommerce_checkout_before_billing' ); ?>

          <div id="billing_fields">
            <h2 class="woo-checkout-section-title">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.55" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              Dados de Faturação
            </h2>

            <?php
            // Nome próprio + Apelido na mesma linha
            $billing_fields = $checkout->get_checkout_fields( 'billing' );
            foreach ( $billing_fields as $key => $field ) :
              // Agrupamento: first_name + last_name em linha dupla
              if ( $key === 'billing_first_name' ) :
            ?>
              <div class="woo-form-row-half">
                <?php
                woocommerce_form_field( 'billing_first_name', array_merge( $billing_fields['billing_first_name'], [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'billing_first_name' ) );
                woocommerce_form_field( 'billing_last_name',  array_merge( $billing_fields['billing_last_name'],  [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'billing_last_name' ) );
                ?>
              </div>
            <?php
              elseif ( $key === 'billing_last_name' ) :
                continue;
              elseif ( $key === 'billing_postcode' ) :
            ?>
              <div class="woo-form-row-half">
                <?php
                woocommerce_form_field( 'billing_postcode', array_merge( $billing_fields['billing_postcode'], [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'billing_postcode' ) );
                if ( isset( $billing_fields['billing_city'] ) ) {
                    woocommerce_form_field( 'billing_city', array_merge( $billing_fields['billing_city'], [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'billing_city' ) );
                }
                ?>
              </div>
            <?php
              elseif ( $key === 'billing_city' ) :
                continue;
              else :
                woocommerce_form_field( $key, array_merge( $field, [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( $key ) );
              endif;
            endforeach;
            ?>
          </div>

          <?php do_action( 'woocommerce_checkout_after_billing' ); ?>

          <!-- Dados de envio (se diferente) -->
          <?php if ( wc_ship_to_billing_address_only() === false && WC()->cart->needs_shipping_address() ) : ?>

            <?php do_action( 'woocommerce_checkout_before_shipping' ); ?>

            <div id="shipping_fields" style="margin-top:3rem;">
              <h2 class="woo-checkout-section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.55" aria-hidden="true"><rect x="1" y="3" width="15" height="13"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                Morada de Envio
              </h2>

              <div class="woo-form-checkbox">
                <input
                  type="checkbox"
                  id="ship-to-different-address-checkbox"
                  name="ship_to_different_address"
                  value="1"
                  <?php checked( 1, (int) WC()->checkout()->get_value( 'ship_to_different_address' ) ); ?>
                >
                <label for="ship-to-different-address-checkbox">
                  Enviar para uma morada diferente?
                </label>
              </div>

              <div id="ship-to-different-address" style="display:none;">
                <?php
                $shipping_fields = $checkout->get_checkout_fields( 'shipping' );
                foreach ( $shipping_fields as $key => $field ) :
                  if ( $key === 'shipping_first_name' ) :
                ?>
                  <div class="woo-form-row-half">
                    <?php
                    woocommerce_form_field( 'shipping_first_name', array_merge( $shipping_fields['shipping_first_name'], [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'shipping_first_name' ) );
                    woocommerce_form_field( 'shipping_last_name',  array_merge( $shipping_fields['shipping_last_name'],  [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'shipping_last_name' ) );
                    ?>
                  </div>
                <?php
                  elseif ( $key === 'shipping_last_name' ) :
                    continue;
                  elseif ( $key === 'shipping_postcode' ) :
                ?>
                  <div class="woo-form-row-half">
                    <?php
                    woocommerce_form_field( 'shipping_postcode', array_merge( $shipping_fields['shipping_postcode'], [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'shipping_postcode' ) );
                    if ( isset( $shipping_fields['shipping_city'] ) ) {
                        woocommerce_form_field( 'shipping_city', array_merge( $shipping_fields['shipping_city'], [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( 'shipping_city' ) );
                    }
                    ?>
                  </div>
                <?php
                  elseif ( $key === 'shipping_city' ) :
                    continue;
                  else :
                    woocommerce_form_field( $key, array_merge( $field, [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( $key ) );
                  endif;
                endforeach;
                ?>
              </div>
            </div>

            <?php do_action( 'woocommerce_checkout_after_shipping' ); ?>

          <?php endif; ?>

          <!-- Notas adicionais -->
          <?php $order_notes = $checkout->get_checkout_fields( 'order' ); ?>
          <?php if ( $order_notes ) : ?>
            <div style="margin-top:3rem;">
              <h2 class="woo-checkout-section-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.55" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Informações Adicionais
              </h2>
              <?php foreach ( $order_notes as $key => $field ) :
                woocommerce_form_field( $key, array_merge( $field, [ 'class' => ['woo-form-row'] ] ), $checkout->get_value( $key ) );
              endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
        <!-- /Coluna esquerda -->


        <!-- Coluna direita: resumo + pagamento -->
        <div class="woo-checkout-right">

          <div class="woo-order-summary">
            <h3>A Sua Encomenda</h3>

            <!-- Itens do carrinho -->
            <?php
            $cart_items = WC()->cart->get_cart();
            foreach ( $cart_items as $cart_item_key => $cart_item ) :
                $product   = $cart_item['data'];
                $qty       = $cart_item['quantity'];
                $name      = $product->get_name();
                $subtotal  = WC()->cart->get_product_subtotal( $product, $qty );
            ?>
              <div class="woo-order-item">
                <span class="woo-order-item-name">
                  <strong><?php echo esc_html( $qty ); ?>×</strong>
                  <?php echo esc_html( $name ); ?>
                </span>
                <span class="woo-order-item-price"><?php echo $subtotal; ?></span>
              </div>
            <?php endforeach; ?>

            <!-- Totais -->
            <div class="woo-order-totals">

              <div class="woo-order-total-row">
                <span class="woo-order-total-label">Subtotal</span>
                <span class="woo-order-total-value"><?php wc_cart_totals_subtotal_html(); ?></span>
              </div>

              <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="woo-order-total-row">
                  <span class="woo-order-total-label"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                  <span class="woo-order-total-value"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                </div>
              <?php endforeach; ?>

              <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <?php foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) :
                  $chosen_method = isset( WC()->session->chosen_shipping_methods[ $package_id ] ) ? WC()->session->chosen_shipping_methods[ $package_id ] : '';
                  foreach ( $package['rates'] as $rate_id => $rate ) :
                    if ( $chosen_method === $rate_id ) :
                ?>
                  <div class="woo-order-total-row">
                    <span class="woo-order-total-label">Envio</span>
                    <span class="woo-order-total-value"><?php echo $rate->get_cost() ? wc_price( $rate->get_cost() ) : esc_html__( 'Grátis', 'rftrucks-child' ); ?></span>
                  </div>
                <?php endif; endforeach; endforeach; ?>
              <?php endif; ?>

              <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
                foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                  <div class="woo-order-total-row">
                    <span class="woo-order-total-label"><?php echo esc_html( $tax->label ); ?></span>
                    <span class="woo-order-total-value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                  </div>
              <?php endforeach; endif; ?>

              <div class="woo-order-total-row">
                <span class="woo-order-total-label">Total</span>
                <span class="woo-order-total-value grand"><?php wc_cart_totals_order_total_html(); ?></span>
              </div>

            </div>
            <!-- /Totais -->

            <!-- Métodos de pagamento -->
            <div class="woo-payment-box" id="payment">
              <h4>Método de Pagamento</h4>
              <?php
              if ( WC()->cart->needs_payment() ) :
                  $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
                  if ( $available_gateways ) :
              ?>
                <ul class="payment_methods methods">
                  <?php
                  foreach ( $available_gateways as $gateway ) :
                      wc_get_template(
                          'checkout/payment-method.php',
                          [ 'gateway' => $gateway ]
                      );
                  endforeach;
                  ?>
                </ul>
              <?php
                  else :
                      echo '<p style="font-size:.82rem;color:var(--gray-text);font-weight:300;">' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'Não existem métodos de pagamento disponíveis.', 'rftrucks-child' ) ) . '</p>';
                  endif;
              else :
                  echo '<p style="font-size:.82rem;color:var(--gray-text);font-weight:300;">' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'O total da sua encomenda é de €0.00 pelo que não é necessário pagamento.', 'rftrucks-child' ) ) . '</p>';
              endif;
              ?>

              <!-- Campos obrigatórios do WooCommerce -->
              <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

              <!-- Termos e condições -->
              <?php if ( apply_filters( 'woocommerce_checkout_show_terms', wc_terms_and_conditions_checkbox_enabled() ) ) :
                wc_get_template( 'checkout/terms.php' );
              endif; ?>

              <!-- Nonce de segurança -->
              <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
              <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="<?php echo wp_create_nonce( 'woocommerce-process_checkout' ); ?>">
              <input type="hidden" name="_wp_http_referer" value="<?php echo esc_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) ); ?>">

              <!-- Botão finalizar -->
              <div class="woo-place-order">
                <button
                  type="submit"
                  class="button alt"
                  name="woocommerce_checkout_place_order"
                  id="place_order"
                  value="<?php esc_attr_e( 'Finalizar Encomenda', 'rftrucks-child' ); ?>"
                  data-value="<?php esc_attr_e( 'Finalizar Encomenda', 'rftrucks-child' ); ?>"
                >
                  <?php esc_html_e( 'Finalizar Encomenda', 'rftrucks-child' ); ?>
                </button>
              </div>

              <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

            </div>
            <!-- /Pagamento -->

            <p class="woo-checkout-privacy">
              Os seus dados pessoais serão utilizados para processar a sua encomenda e suportar a sua experiência neste site.<br>
              <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Política de privacidade</a>
            </p>

          </div>
          <!-- /woo-order-summary -->

        </div>
        <!-- /Coluna direita -->

      </div>
      <!-- /woo-checkout-layout -->

      <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php endif; ?>

  </form>
  <!-- /Formulário checkout -->

  <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>
<!-- /woo-checkout-wrap -->

<script>
/* Toggle morada de envio diferente */
(function() {
    var chk  = document.getElementById('ship-to-different-address-checkbox');
    var wrap = document.getElementById('ship-to-different-address');
    if (!chk || !wrap) return;
    function toggle() { wrap.style.display = chk.checked ? 'block' : 'none'; }
    chk.addEventListener('change', toggle);
    toggle();
})();
</script>

<?php
do_action( 'woocommerce_after_checkout_form', $checkout );
get_footer();
?>
