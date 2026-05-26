<?php
/**
 * RFTRUCKS Child Theme — functions.php
 */

/* ─── 1. Setup do tema ─────────────────────────────────────── */
add_action( 'after_setup_theme', function () {

    // Suporte a título dinâmico
    add_theme_support( 'title-tag' );

    // Suporte a imagens em destaque
    add_theme_support( 'post-thumbnails' );

    // Suporte a WooCommerce + galeria
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Menus de navegação
    register_nav_menus( [
        'primary' => __( 'Navegação Principal', 'rftrucks-child' ),
        'footer'  => __( 'Navegação Rodapé',    'rftrucks-child' ),
    ] );

    // Idioma
    load_child_theme_textdomain( 'rftrucks-child', get_stylesheet_directory() . '/languages' );
} );


/* ─── 2. Enqueue de estilos e scripts ──────────────────────── */
add_action( 'wp_enqueue_scripts', function () {

    // Estilo do tema pai GeneratePress
    wp_enqueue_style(
        'generatepress-style',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme( 'generatepress' )->get( 'Version' )
    );

    // Estilo do tema filho (style.css — inclui TODO o CSS)
    wp_enqueue_style(
        'rftrucks-child-style',
        get_stylesheet_uri(),
        [ 'generatepress-style' ],
        wp_get_theme()->get( 'Version' )
    );

    // Google Fonts
    wp_enqueue_style(
        'rftrucks-fonts',
        'https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@300;400;700;900&family=Jost:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap',
        [],
        null
    );

    // Script principal
    wp_enqueue_script(
        'rftrucks-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        [],
        wp_get_theme()->get( 'Version' ),
        true // no footer
    );

    // Passa a URL do tema filho para o JS (para caminhos de assets)
    wp_localize_script( 'rftrucks-main', 'rftrucks', [
        'themeUrl' => get_stylesheet_directory_uri(),
        'homeUrl'  => home_url( '/' ),
    ] );

}, 20 );


/* ─── 3. Remove estilos padrão do WooCommerce ─────────────── */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove também os blocos de estilos do WooCommerce
add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'woocommerce-general' );
    wp_dequeue_style( 'woocommerce-layout' );
    wp_dequeue_style( 'woocommerce-smallscreen' );
    wp_dequeue_style( 'wc-blocks-style' );
}, 99 );


/* ─── 4. Remove wrappers do GeneratePress que colidem ─────── */
remove_action( 'generate_before_header',          'generate_construct_header' );
remove_action( 'generate_header',                 'generate_construct_site_title' );
remove_action( 'generate_after_header',           'generate_featured_page_header_inside_single' );
remove_action( 'generate_before_footer_widgets',  'generate_construct_footer_widgets' );
remove_action( 'generate_footer',                 'generate_construct_footer' );


/* ─── 5. Walker para menu mobile (saída plana sem <li>) ───── */
class RFTRUCKS_Mobile_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $url   = esc_url( $data_object->url );
        $title = esc_html( $data_object->title );
        $output .= '<a href="' . $url . '" onclick="closeMenu()">' . $title . '</a>' . "\n";
    }

    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl(   &$output, $depth = 0, $args = null ) {}
    public function end_el(    &$output, $data_object, $depth = 0, $args = null ) {}
}


/* ─── 6. JSON-LD Schema para a homepage ───────────────────── */
add_action( 'wp_head', function () {
    if ( ! is_front_page() ) return;
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AutoRepair",
        "name": "RFTRUCKS",
        "description": "Oficina especializada em reparação e manutenção de veículos pesados",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "CM1343 80",
            "postalCode": "4980-020",
            "addressLocality": "Vila Nova de Muía",
            "addressRegion": "Ponte da Barca",
            "addressCountry": "PT"
        },
        "telephone": "+351919210032",
        "priceRange": "€€",
        "url": "<?php echo esc_url( home_url( '/' ) ); ?>"
    }
    </script>
    <?php
} );


/* ─── 7. Número de produtos por página na loja ────────────── */
add_filter( 'loop_shop_per_page', function () {
    return 12;
}, 20 );


/* ─── 8. Remove sidebar do WooCommerce ────────────────────── */
add_action( 'widgets_init', function () {
    unregister_sidebar( 'sidebar-1' );
} );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/* ─── 9. Suporte a preconnect para fontes (performance) ───── */
add_action( 'wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );


/* ─── 10. Página da loja aponta para /loja ────────────────── */
add_filter( 'woocommerce_get_shop_url', function () {
    return home_url( '/loja/' );
} );
