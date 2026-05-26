  <!-- ═══════════════════════════ FOOTER ═══════════════════════════ -->
  <footer class="footer" id="contactos" aria-label="Contactos e rodapé">
    <div class="footer-top">

      <div class="footer-left reveal">
        <h2>Entre em<br>Contacto</h2>

        <address style="font-style:normal;">
          <div class="contact-row">
            <span class="contact-row-icon" aria-hidden="true">📍</span>
            <div class="contact-row-body">
              <strong>Morada</strong>
              <p>CM1343 80, 4980-020<br>Vila Nova de Muía, Ponte da Barca</p>
            </div>
          </div>

          <div class="contact-row">
            <span class="contact-row-icon" aria-hidden="true">📞</span>
            <div class="contact-row-body">
              <strong>Telefone</strong>
              <a href="tel:919210032">919 210 032</a>
            </div>
          </div>
        </address>

        <p style="font-size:0.82rem; font-weight:300; color:var(--gray-text); line-height:1.75; margin-top:0.5rem;">
          Entre em contacto connosco para agendar manutenção, diagnóstico ou reparação do seu veículo pesado.
        </p>

        <div class="footer-actions">
          <a href="tel:919210032" class="btn btn-white">Falar Connosco</a>
          <a href="tel:919210032" class="btn btn-ghost">Marcar Assistência</a>
        </div>
      </div>

      <div class="footer-right reveal" style="transition-delay:0.12s;">
        <h3>Navegação</h3>
        <nav aria-label="Navegação do rodapé">
          <?php
          if ( has_nav_menu( 'footer' ) ) {
              wp_nav_menu( [
                  'theme_location' => 'footer',
                  'container'      => false,
                  'menu_class'     => 'footer-nav',
                  'items_wrap'     => '<ul class="footer-nav">%3$s</ul>',
                  'depth'          => 1,
              ] );
          } else {
              ?>
              <ul class="footer-nav">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#sobre' ) ); ?>">Sobre Nós</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#servicos' ) ); ?>">Serviços</a></li>
                <li><a href="<?php echo esc_url( home_url( '/loja/' ) ); ?>">Loja</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#contactos' ) ); ?>">Contactos</a></li>
              </ul>
              <?php
          }
          ?>
        </nav>
      </div>

    </div>

    <div class="footer-bottom">
      <p>© <?php echo date( 'Y' ); ?> RFTRUCKS — Vila Nova de Muía, Ponte da Barca</p>
      <p>Oficina Especializada em Veículos Pesados</p>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
