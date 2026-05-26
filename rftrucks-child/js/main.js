/* ── Nav scroll state ───────────────────────── */
(function () {
    'use strict';

    var nav = document.getElementById('mainNav');
    if (nav) {
        var onScroll = function () {
            nav.classList.toggle('is-scrolled', window.scrollY > 60);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ── Mobile menu ────────────────────────────── */
    var burger = document.getElementById('hamburger');
    var menu   = document.getElementById('mobileMenu');

    window.toggleMenu = function () {
        if (!burger || !menu) return;
        var open = menu.classList.toggle('open');
        burger.classList.toggle('open', open);
        burger.setAttribute('aria-expanded', String(open));
        document.body.style.overflow = open ? 'hidden' : '';
    };

    window.closeMenu = function () {
        if (!burger || !menu) return;
        menu.classList.remove('open');
        burger.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    };

    /* ── Scroll reveal ──────────────────────────── */
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) e.target.classList.add('on');
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(function (el) {
            observer.observe(el);
        });
    } else {
        document.querySelectorAll('.reveal').forEach(function (el) {
            el.classList.add('on');
        });
    }

    /* ── Smooth anchor scroll ───────────────────── */
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            var href   = a.getAttribute('href');
            var target = document.querySelector(href);
            if (!target) return;
            e.preventDefault();
            window.closeMenu();
            target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    /* ── WooCommerce: galeria de produto ────────── */
    document.querySelectorAll('.woo-single-thumb').forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            var src = thumb.querySelector('img') && thumb.querySelector('img').src;
            var main = document.querySelector('.woo-single-main-img img');
            if (src && main) {
                main.src = src;
                document.querySelectorAll('.woo-single-thumb').forEach(function (t) {
                    t.classList.remove('active');
                });
                thumb.classList.add('active');
            }
        });
    });

    /* ── WooCommerce: botões de quantidade ──────── */
    document.querySelectorAll('.woo-qty-wrap').forEach(function (wrap) {
        var input = wrap.querySelector('.woo-qty-input') || wrap.querySelector('input[type="number"]');
        var minus = wrap.querySelector('[data-action="minus"]');
        var plus  = wrap.querySelector('[data-action="plus"]');
        if (!input) return;
        if (minus) {
            minus.addEventListener('click', function () {
                var val = parseInt(input.value, 10) || 1;
                if (val > 1) input.value = val - 1;
            });
        }
        if (plus) {
            plus.addEventListener('click', function () {
                var val = parseInt(input.value, 10) || 1;
                input.value = val + 1;
            });
        }
    });

})();
