<?php get_header(); ?>

  <!-- ═══════════════════════════ HERO ═════════════════════════════ -->
  <section class="hero" id="inicio" aria-label="Início">

    <div class="hero-bg" aria-hidden="true">
      <img
        src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/hero.jpg"
        alt="RFTRUCKS — Oficina de Veículos Pesados"
        loading="eager"
        fetchpriority="high"
        width="1920"
        height="1080"
      >
    </div>
    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-badge">Vila Nova de Muía · Ponte da Barca</div>

    <div class="hero-content">
      <h1 class="hero-title">RFTRUCKS</h1>

      <p class="hero-tagline">
        <strong>Oficina Especializada em Veículos Pesados.</strong><br>
        Reparação e manutenção com foco na rapidez, confiança e redução do tempo de paragem.
      </p>

      <div class="hero-services-row" aria-label="Especialidades">
        <span>Mecânica</span>
        <div class="dot" aria-hidden="true"></div>
        <span>Eletrónica</span>
        <div class="dot" aria-hidden="true"></div>
        <span>Caixas de Velocidades</span>
        <div class="dot" aria-hidden="true"></div>
        <span>Assistência Técnica</span>
      </div>

      <div class="hero-cta">
        <a href="#contactos" class="btn btn-white">Pedir Orçamento</a>
        <a href="tel:919210032" class="hero-phone-pill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12.5 19.79 19.79 0 0 1 1.61 3.87 2 2 0 0 1 3.58 1.67h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.42-1.42a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
          </svg>
          919 210 032
        </a>
      </div>
    </div>

    <div class="scroll-cue" aria-hidden="true">
      <div class="scroll-cue-bar"></div>
      <span>Descer</span>
    </div>
  </section>


  <!-- ═══════════════════════════ SOBRE ════════════════════════════ -->
  <section class="section about section-light" id="sobre" aria-labelledby="sobre-titulo">
    <div class="about-inner">
      <div class="about-left reveal">
        <p class="sec-label">Sobre Nós</p>
        <h2 class="sec-title" id="sobre-titulo">
          Especialistas<br>em Pesados
        </h2>
        <p class="about-text">
          A RFTRUCKS é uma oficina especializada na reparação e manutenção de veículos pesados, localizada em Vila Nova de Muía, Ponte da Barca.
        </p>
        <p class="about-text">
          Trabalhamos diariamente para garantir soluções rápidas, fiáveis e adaptadas às necessidades de motoristas, empresas de transporte e gestores de frota.
        </p>
        <blockquote class="about-quote">
          Com experiência no setor e uma equipa técnica especializada, asseguramos um serviço rigoroso, diagnóstico preciso e acompanhamento profissional.
        </blockquote>
      </div>

      <div class="reveal" style="transition-delay:0.12s;">
        <div class="about-visual">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/img-2.jpg"
            alt="Técnico especializado a trabalhar em veículo pesado"
            loading="lazy"
            width="800"
            height="1067"
          >
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════ SERVIÇOS ═════════════════════════ -->
  <section class="section services" id="servicos" aria-labelledby="servicos-titulo" style="padding-bottom: 0;">
    <div class="services-header reveal">
      <div>
        <p class="sec-label">Os Nossos Serviços</p>
        <h2 class="sec-title" id="servicos-titulo">O Que Fazemos</h2>
      </div>
      <p class="services-sub">
        Serviços completos de reparação e manutenção para todo o tipo de veículos pesados.
      </p>
    </div>

    <div class="services-grid" role="list">

      <!-- 01 Mecânica -->
      <article class="card reveal" role="listitem" style="transition-delay:0.05s;">
        <svg class="card-icon" viewBox="0 0 28 28" aria-hidden="true">
          <circle cx="14" cy="14" r="3.5"/>
          <path d="M14 2v3M14 23v3M2 14h3M23 14h3M5.5 5.5l2.1 2.1M20.4 20.4l2.1 2.1M5.5 22.5l2.1-2.1M20.4 7.6l2.1-2.1"/>
        </svg>
        <h3 class="card-title">Mecânica Geral</h3>
        <p class="card-desc">Serviços completos de manutenção e reparação mecânica para veículos pesados.</p>
        <ul class="card-list">
          <li>Revisões periódicas</li>
          <li>Reparação de motores</li>
          <li>Sistemas de travagem</li>
          <li>Suspensão e direção</li>
          <li>Sistemas pneumáticos</li>
          <li>Embraiagens</li>
          <li>Manutenção preventiva</li>
        </ul>
      </article>

      <!-- 02 Eletrónica -->
      <article class="card reveal" role="listitem" style="transition-delay:0.1s;">
        <svg class="card-icon" viewBox="0 0 28 28" aria-hidden="true">
          <rect x="3" y="7" width="22" height="14" rx="1"/>
          <path d="M9 12h2M15 12h2M9 16h10M19 12h1"/>
          <path d="M10 7V5M18 7V5"/>
        </svg>
        <h3 class="card-title">Diagnóstico Eletrónico</h3>
        <p class="card-desc">Equipamentos avançados para deteção rápida e precisa de avarias eletrónicas.</p>
        <ul class="card-list">
          <li>Diagnóstico computorizado</li>
          <li>Sistemas ABS / EBS</li>
          <li>Sensores e módulos eletrónicos</li>
          <li>Reparação elétrica</li>
          <li>Programação e parametrização</li>
          <li>Eletrónica de veículos pesados</li>
        </ul>
      </article>

      <!-- 03 Caixas -->
      <article class="card reveal" role="listitem" style="transition-delay:0.15s;">
        <svg class="card-icon" viewBox="0 0 28 28" aria-hidden="true">
          <circle cx="7" cy="11" r="2.5"/>
          <circle cx="21" cy="11" r="2.5"/>
          <circle cx="14" cy="21" r="2.5"/>
          <path d="M9.5 11h9M7 13.5v4a2.5 2.5 0 0 0 2.5 2.5h1M21 13.5v4a2.5 2.5 0 0 1-2.5 2.5h-1"/>
        </svg>
        <h3 class="card-title">Caixas de Velocidades</h3>
        <p class="card-desc">Especialização na reparação e manutenção de sistemas de transmissão.</p>
        <ul class="card-list">
          <li>Caixas manuais e automáticas</li>
          <li>Reparação de transmissões</li>
          <li>Diferenciais</li>
          <li>Sistemas de embraiagem</li>
          <li>Reconstrução de componentes</li>
          <li>Diagnóstico de falhas de transmissão</li>
        </ul>
      </article>

      <!-- 04 Assistência -->
      <article class="card reveal" role="listitem" id="assistencia" style="transition-delay:0.2s;">
        <svg class="card-icon" viewBox="0 0 28 28" aria-hidden="true">
          <path d="M14 3l1.8 5.4h5.7L17 12.1l1.8 5.4L14 14.8l-4.8 2.7 1.8-5.4L6.5 8.4h5.7z"/>
          <path d="M3.5 24c0-5.5 4.7-9.5 10.5-9.5S24.5 18.5 24.5 24"/>
        </svg>
        <h3 class="card-title">Assistência Técnica</h3>
        <p class="card-desc">
          Apoio técnico eficiente para reduzir tempos de imobilização e garantir maior continuidade operacional da sua frota.
        </p>
        <ul class="card-list">
          <li>Assistência técnica especializada</li>
          <li>Manutenção preventiva</li>
          <li>Verificação geral de sistemas</li>
          <li>Apoio a frotas</li>
          <li>Diagnóstico rápido</li>
        </ul>
      </article>

    </div>
  </section>


  <!-- ═══════════════════════════ PRODUTOS ═════════════════════════ -->
  <section class="section products section-light" id="produtos" aria-labelledby="produtos-titulo">
    <p class="sec-label reveal">Produtos de Limpeza Automóvel</p>

    <div class="products-layout">

      <div class="products-body reveal">
        <h3 id="produtos-titulo">Limpeza<br>Automóvel</h3>
        <p>
          Disponibilizamos produtos de limpeza e manutenção para veículos pesados e comerciais, selecionados para garantir maior durabilidade, proteção e apresentação da sua frota.
        </p>
        <p>
          Trabalhamos com soluções adequadas para utilização profissional e manutenção regular de veículos.
        </p>

        <div class="products-tags" aria-label="Produtos disponíveis">
          <span class="ptag">Limpeza de interiores</span>
          <span class="ptag">Limpeza de exteriores</span>
          <span class="ptag">Desengordurantes</span>
          <span class="ptag">Produtos para jantes</span>
          <span class="ptag">Limpeza de motores</span>
          <span class="ptag">Shampoos automóveis</span>
          <span class="ptag">Produtos de acabamento</span>
          <span class="ptag">Consumíveis de manutenção</span>
        </div>

        <p class="products-note-light">Entre em contacto connosco para conhecer os produtos disponíveis e preços.</p>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-border-dark">Ver Loja</a>
      </div>

      <div class="products-showcase reveal" style="transition-delay:0.18s;">
        <div class="products-img-frame">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/products.webp"
            alt="Gama completa de produtos de limpeza automóvel"
            loading="lazy"
            width="600"
            height="600"
          >
        </div>
      </div>

    </div>
  </section>


  <!-- ═══════════════════════════ PORQUÊ ═══════════════════════════ -->
  <section class="section why" aria-labelledby="why-titulo">
    <div class="why-inner">
      <div class="why-head reveal">
        <p class="sec-label">Porquê a RFTRUCKS</p>
        <h2 class="sec-title" id="why-titulo">Porque<br>Nos Escolher</h2>
      </div>

      <div class="why-rows" role="list">
        <div class="why-row reveal" role="listitem">Equipa técnica especializada</div>
        <div class="why-row reveal" role="listitem" style="transition-delay:0.05s;">Atendimento profissional e transparente</div>
        <div class="why-row reveal" role="listitem" style="transition-delay:0.1s;">Diagnóstico rápido e preciso</div>
        <div class="why-row reveal" role="listitem" style="transition-delay:0.15s;">Soluções adaptadas a veículos pesados</div>
        <div class="why-row reveal" role="listitem" style="transition-delay:0.2s;">Compromisso com qualidade e confiança</div>
        <div class="why-row reveal" role="listitem" style="transition-delay:0.25s;">Foco na redução do tempo de paragem</div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════ CTA BAND ═════════════════════════ -->
  <div class="cta-band reveal">
    <h2>Mantemos o Seu<br>Negócio em Movimento</h2>
    <p>
      Sabemos que cada hora parada representa custos para o seu negócio. Na RFTRUCKS damos prioridade a um serviço eficiente, rigoroso e preparado para responder às exigências do setor dos transportes.
    </p>
    <div class="cta-actions">
      <a href="#contactos" class="btn btn-dark">Falar Connosco</a>
      <a href="tel:919210032" class="btn btn-outline-black">Marcar Assistência</a>
    </div>
  </div>

<?php get_footer(); ?>
