<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Mobile menu overlay -->
<div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Menu de navegação">
  <?php
  if ( has_nav_menu( 'primary' ) ) {
      wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'walker'         => new RFTRUCKS_Mobile_Walker(),
          'depth'          => 1,
      ] );
  } else {
      // Fallback se o menu não estiver configurado
      ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" onclick="closeMenu()">Início</a>
      <a href="<?php echo esc_url( home_url( '/#sobre' ) ); ?>" onclick="closeMenu()">Sobre Nós</a>
      <a href="<?php echo esc_url( home_url( '/#servicos' ) ); ?>" onclick="closeMenu()">Serviços</a>
      <a href="<?php echo esc_url( home_url( '/loja/' ) ); ?>" onclick="closeMenu()">Loja</a>
      <a href="<?php echo esc_url( home_url( '/#contactos' ) ); ?>" onclick="closeMenu()">Contactos</a>
      <?php
  }
  ?>
  <a href="tel:919210032" class="mobile-tel">919 210 032</a>
</div>

<!-- ═══════════════════════════ NAV ══════════════════════════════ -->
<header class="nav" id="mainNav" role="banner">

  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" aria-label="<?php bloginfo( 'name' ); ?> — Página inicial">
    <img
      src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/logorf.png"
      alt="<?php bloginfo( 'name' ); ?>"
      class="nav-logo-img"
      width="87"
      height="52"
    >
  </a>

  <nav aria-label="Navegação principal">
    <?php
    if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'nav-links',
            'items_wrap'     => '<ul class="nav-links">%3$s</ul>',
            'depth'          => 1,
        ] );
    } else {
        ?>
        <ul class="nav-links">
          <li><a href="<?php echo esc_url( home_url( '/#sobre' ) ); ?>">Sobre Nós</a></li>
          <li><a href="<?php echo esc_url( home_url( '/#servicos' ) ); ?>">Serviços</a></li>
          <li><a href="<?php echo esc_url( home_url( '/loja/' ) ); ?>">Loja</a></li>
          <li><a href="<?php echo esc_url( home_url( '/#contactos' ) ); ?>">Contactos</a></li>
        </ul>
        <?php
    }
    ?>
  </nav>

  <a href="tel:919210032" class="nav-tel" aria-label="Ligar para 919 210 032">
    919 210 032
  </a>

  <button
    class="hamburger"
    id="hamburger"
    aria-label="Abrir menu"
    aria-expanded="false"
    aria-controls="mobileMenu"
    onclick="toggleMenu()"
    type="button"
  >
    <span></span><span></span><span></span>
  </button>

</header>
