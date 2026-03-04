<?php
/**
 * El Protocolo de la Calma — Self-contained Landing Page
 *
 * This file outputs a COMPLETE HTML page (doctype, head, body).
 * It is loaded by the mu-plugin product-landing-pages.php via template_redirect.
 * It bypasses the WordPress theme entirely.
 *
 * WooCommerce is fully loaded, so $product, wc_get_checkout_url(), etc. work.
 */

defined('ABSPATH') || exit;

// Get WooCommerce product and checkout URL
global $product;
$product_id = $product ? $product->get_id() : 0;
$checkout_url = $product_id
    ? esc_url(add_query_arg('add-to-cart', $product_id, wc_get_checkout_url()))
    : '#';

// Product image
$cover_image = '';
if ($product && $product->get_image_id()) {
    $cover_image = wp_get_attachment_image_url($product->get_image_id(), 'full');
}
if (!$cover_image) {
    $cover_image = content_url('/uploads/woocommerce-placeholder-300x300.png');
}

// CSS files from theme
$theme_uri = get_template_directory_uri();
$theme_dir = get_template_directory();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <title>El Protocolo de la Calma — 21 Días para Desintoxicar tu Mente y Recuperar tu Paz</title>
    <meta name="description"
        content="Descubre el protocolo de 21 días basado en neurociencia para liberar el estrés crónico, silenciar el ruido mental y recuperar la calma que mereces. 15 capítulos + 21 ejercicios prácticos. Garantía 7 días.">
    <meta name="keywords"
        content="estrés crónico, gestión del estrés, calma interior, detox mental, mindfulness, bienestar emocional, protocolo anti-estrés, neurociencia del estrés">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="product">
    <meta property="og:title" content="El Protocolo de la Calma — 21 Días para Recuperar tu Paz">
    <meta property="og:description"
        content="El sistema de 4 fases basado en neurociencia para liberar el estrés crónico. 15 capítulos + 21 ejercicios + 3 bonos exclusivos.">
    <meta property="og:image" content="<?php echo esc_url($cover_image); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:locale" content="es_ES">
    <meta property="product:price:amount" content="27.00">
    <meta property="product:price:currency" content="USD">

    <!-- Preload -->
    <?php if ($cover_image): ?>
        <link rel="preload" href="<?php echo esc_url($cover_image); ?>" as="image">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400&family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <?php
    $css_files = ['variables', 'base', 'layout', 'components', 'animations'];
    foreach ($css_files as $file) {
        $path = $theme_dir . '/assets/css/' . $file . '.css';
        if (file_exists($path)) {
            echo '<link rel="stylesheet" href="' . esc_url($theme_uri . '/assets/css/' . $file . '.css?v=' . filemtime($path)) . '">' . "\n    ";
        }
    }
    ?>

    <!-- Product-specific CSS -->
    <?php
    $product_css = WP_CONTENT_DIR . '/product-landing-css/el-protocolo-de-la-calma.css';
    if (file_exists($product_css)) {
        echo '<link rel="stylesheet" href="' . esc_url(content_url('/product-landing-css/el-protocolo-de-la-calma.css?v=' . filemtime($product_css))) . '">';
    }
    ?>

    <!-- Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "El Protocolo de la Calma",
        "description": "21 días para desintoxicar tu mente, reconectar con tu cuerpo y recuperar la paz que el estrés te robó. 15 capítulos + 21 ejercicios prácticos basados en neurociencia.",
        "image": "<?php echo esc_url($cover_image); ?>",
        "offers": {
            "@type": "Offer",
            "price": "27.00",
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "214"
        }
    }
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class('landing-page landing-page--protocolo-calma'); ?>>
    <?php wp_body_open(); ?>


    <!-- ============================================
         SECCIÓN 1 — HERO
         ============================================ -->
    <section class="hero" id="hero">
        <div class="container hero__container">
            <div class="hero__content">
                <span class="badge hero__badge reveal">
                    <span>🧠</span> Basado en neurociencia aplicada
                </span>

                <h1 class="hero__title reveal reveal--delay-1">
                    El estrés no es tu identidad.<br>
                    Ahora tienes el <em>protocolo</em> para liberarte.
                </h1>

                <p class="hero__subtitle reveal reveal--delay-2">
                    21 días para desintoxicar tu mente, reconectar con tu cuerpo y recuperar
                    la paz que el estrés te robó. Con 15 capítulos y 21 ejercicios prácticos.
                </p>

                <div class="hero__cta-group reveal reveal--delay-3">
                    <a href="#oferta" class="btn btn--primary btn--large" id="cta-hero">
                        <span class="btn__icon">📖</span> Quiero Mi Protocolo
                    </a>
                    <a href="#metodo" class="btn btn--secondary">
                        Conocer el Método
                    </a>
                </div>

                <p class="hero__micro reveal reveal--delay-4">
                    Acceso inmediato · Descarga digital · Garantía de 7 días
                </p>
            </div>

            <div class="hero__visual reveal reveal--right reveal--delay-2">
                <img src="<?php echo esc_url($cover_image); ?>" alt="Ebook El Protocolo de la Calma"
                    class="hero__mockup" width="420" height="560" fetchpriority="high">
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 2 — ESPEJO (Identificación)
         ============================================ -->
    <section class="section section--white" id="espejo">
        <div class="container container--narrow text-center">
            <span class="section__eyebrow reveal">¿Te suena familiar?</span>
            <h2 class="section__title reveal">Quizás reconoces alguna de estas señales</h2>
            <p class="section__subtitle reveal">No estás exagerando. No eres débil. Y definitivamente no estás solo/a.
            </p>

            <div class="mirror-list">
                <div class="mirror-list__item reveal reveal--delay-1">
                    <span class="mirror-list__icon">🔴</span>
                    <span>Te despiertas cansado/a aunque hayas dormido 8 horas — como si tu cuerpo nunca descansara de
                        verdad.</span>
                </div>
                <div class="mirror-list__item reveal reveal--delay-2">
                    <span class="mirror-list__icon">🔴</span>
                    <span>Tu mente no para. Repasa la lista de pendientes, anticipa problemas, revive conversaciones — a
                        las 3 AM.</span>
                </div>
                <div class="mirror-list__item reveal reveal--delay-3">
                    <span class="mirror-list__icon">🔴</span>
                    <span>Te irritas por cosas que antes no te afectaban. Contestas mal, te aíslas, y luego te sientes
                        culpable.</span>
                </div>
                <div class="mirror-list__item reveal reveal--delay-4">
                    <span class="mirror-list__icon">🔴</span>
                    <span>El cuello, la mandíbula, la espalda — siempre tensión. Los médicos dicen que «no hay nada»,
                        pero tú lo sientes.</span>
                </div>
                <div class="mirror-list__item reveal reveal--delay-5">
                    <span class="mirror-list__icon">🔴</span>
                    <span>Sientes que vives en piloto automático: haciendo todo pero disfrutando nada.</span>
                </div>
            </div>

            <p class="reveal"
                style="margin-top: var(--space-8); font-size: var(--text-lg); color: var(--teal-deep); font-weight: 500;">
                Si marcaste al menos dos… <strong>este libro fue escrito pensando en ti.</strong>
            </p>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 3 — AGITACIÓN EMPÁTICA
         ============================================ -->
    <section class="section section--cream" id="agitacion">
        <div class="container container--narrow text-center">
            <h2 class="section__title reveal">Lo que nadie te dice sobre el estrés crónico</h2>

            <div class="card card--accent reveal" style="text-align: left; margin-top: var(--space-6);">
                <p><strong>El estrés crónico no se «quita con vacaciones».</strong> Sin las herramientas adecuadas, se
                    acumula capa sobre capa hasta que el cuerpo y la mente colapsan.</p>
                <p>Lo que empieza como cansancio se convierte en agotamiento total. Lo que empieza como irritabilidad se
                    convierte en aislamiento. Lo que empieza como tensión muscular se convierte en dolor crónico,
                    insomnio y niebla mental.</p>
                <p>La OMS clasificó el estrés laboral como <strong>«epidemia del siglo XXI»</strong>. Un estudio de la
                    Universidad de Harvard demostró que <strong>el estrés crónico reduce el volumen del
                        hipocampo</strong>
                    — la región cerebral de la memoria y el aprendizaje — y mantiene la amígdala en estado de
                    hiperalerta permanente.</p>
                <p style="margin-bottom: 0; font-weight: 500;">La buena noticia: <strong>tu cerebro tiene
                        neuroplasticidad</strong>. Lo que se dañó por el estrés puede ser reparado. Con el protocolo
                    adecuado.</p>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 4 — EL PROTOCOLO DE 4 FASES
         ============================================ -->
    <section class="section section--white" id="metodo">
        <div class="container text-center">
            <span class="section__eyebrow reveal">La solución</span>
            <h2 class="section__title reveal">El Protocolo de 4 Fases</h2>
            <p class="section__subtitle reveal">Un sistema progresivo de 21 días que te lleva desde entender tu estrés
                hasta construir una vida con calma sostenible.</p>

            <div class="renace-grid" style="max-width: 900px; margin: 0 auto;">
                <div class="renace-step reveal reveal--delay-1">
                    <div class="renace-step__letter">I</div>
                    <div>
                        <div class="renace-step__word">Diagnostica</div>
                        <p class="renace-step__desc">Entiende la anatomía del estrés moderno, su impacto real en tu
                            cuerpo y mente, y mapea tu propia huella emocional.</p>
                    </div>
                </div>
                <div class="renace-step reveal reveal--delay-2">
                    <div class="renace-step__letter">II</div>
                    <div>
                        <div class="renace-step__word">Limpia</div>
                        <p class="renace-step__desc">Detox mental, emocional, corporal y digital. Libera lo que
                            acumulaste en años de estrés no procesado.</p>
                    </div>
                </div>
                <div class="renace-step reveal reveal--delay-3">
                    <div class="renace-step__letter">III</div>
                    <div>
                        <div class="renace-step__word">Construye</div>
                        <p class="renace-step__desc">Establece límites sanos, rituales de paz y prácticas de
                            mindfulness que blinden tu bienestar diario.</p>
                    </div>
                </div>
                <div class="renace-step reveal reveal--delay-4">
                    <div class="renace-step__letter">IV</div>
                    <div>
                        <div class="renace-step__word">Sostiene</div>
                        <p class="renace-step__desc">Gestiona recaídas, redefine tu identidad y diseña un sistema de
                            vida que genere calma en lugar de consumirla.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 5 — CONTENIDO (15 Capítulos)
         ============================================ -->
    <section class="section section--cream" id="contenido">
        <div class="container text-center">
            <span class="section__eyebrow reveal">Lo que encontrarás</span>
            <h2 class="section__title reveal">15 Capítulos + 21 Ejercicios Prácticos</h2>
            <p class="section__subtitle reveal">Cada capítulo construye sobre el anterior. Cada ejercicio tiene base
                científica. Nada es relleno.</p>

            <div class="chapters-grid" style="max-width: 900px; margin: 0 auto; text-align: left;">
                <!-- FASE I -->
                <div class="phase-divider reveal" style="grid-column: 1 / -1;">
                    <span class="phase-divider__line"></span>
                    <span class="phase-divider__label">🔍 Fase I — El Diagnóstico</span>
                    <span class="phase-divider__line"></span>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">1</div>
                    <div>
                        <div class="chapter-card__title">La anatomía del caos moderno</div>
                        <p class="chapter-card__desc">Cómo el mundo moderno secuestró tu sistema nervioso sin que lo
                            notaras.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">2</div>
                    <div>
                        <div class="chapter-card__title">El precio silencioso</div>
                        <p class="chapter-card__desc">Lo que el estrés crónico le está haciendo a tu cuerpo, mente y
                            relaciones.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">3</div>
                    <div>
                        <div class="chapter-card__title">El mapa emocional</div>
                        <p class="chapter-card__desc">Aprende a leer las señales que tu cuerpo envía antes de
                            colapsar.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">4</div>
                    <div>
                        <div class="chapter-card__title">El diario como espejo</div>
                        <p class="chapter-card__desc">La herramienta más subestimada para procesar el estrés: escritura
                            terapéutica.</p>
                    </div>
                </div>

                <!-- FASE II -->
                <div class="phase-divider reveal" style="grid-column: 1 / -1;">
                    <span class="phase-divider__line"></span>
                    <span class="phase-divider__label">🧹 Fase II — La Limpieza Interior</span>
                    <span class="phase-divider__line"></span>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">5</div>
                    <div>
                        <div class="chapter-card__title">Detox mental</div>
                        <p class="chapter-card__desc">Silencia la rumiación y desactiva los 7 pensamientos tóxicos más
                            comunes.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">6</div>
                    <div>
                        <div class="chapter-card__title">Detox emocional</div>
                        <p class="chapter-card__desc">Libera emociones reprimidas, practica el perdón funcional y cierra
                            ciclos.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">7</div>
                    <div>
                        <div class="chapter-card__title">Tu cuerpo habla</div>
                        <p class="chapter-card__desc">Movimiento, respiración y nutrición que calman el sistema nervioso
                            desde la raíz.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">8</div>
                    <div>
                        <div class="chapter-card__title">Desintoxicación digital</div>
                        <p class="chapter-card__desc">Tu teléfono es el mayor generador de estrés que cargas. Aprende a
                            controlarlo.</p>
                    </div>
                </div>

                <!-- FASE III -->
                <div class="phase-divider reveal" style="grid-column: 1 / -1;">
                    <span class="phase-divider__line"></span>
                    <span class="phase-divider__label">🛡️ Fase III — El Entorno que Sana</span>
                    <span class="phase-divider__line"></span>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">9</div>
                    <div>
                        <div class="chapter-card__title">Relaciones que drenan, vínculos que nutren</div>
                        <p class="chapter-card__desc">Identifica dinámicas tóxicas y aprende a poner límites sin
                            culpa.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">10</div>
                    <div>
                        <div class="chapter-card__title">Rituales de paz interior</div>
                        <p class="chapter-card__desc">Construye rutinas matutinas, micro-pausas y rituales nocturnos que
                            blindan tu calma.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">11</div>
                    <div>
                        <div class="chapter-card__title">Mindfulness sin misticismo</div>
                        <p class="chapter-card__desc">Atención plena como herramienta científica, no como práctica
                            espiritual.</p>
                    </div>
                </div>

                <!-- FASE IV -->
                <div class="phase-divider reveal" style="grid-column: 1 / -1;">
                    <span class="phase-divider__line"></span>
                    <span class="phase-divider__label">🏔️ Fase IV — La Calma Sostenida</span>
                    <span class="phase-divider__line"></span>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">12</div>
                    <div>
                        <div class="chapter-card__title">Cuando el estrés regresa</div>
                        <p class="chapter-card__desc">Protocolo de emergencia en 5 pasos + cómo aprender de cada
                            recaída.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">13</div>
                    <div>
                        <div class="chapter-card__title">La identidad después del detox</div>
                        <p class="chapter-card__desc">Quién eres cuando dejas de sobrevivir y empiezas a vivir.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">14</div>
                    <div>
                        <div class="chapter-card__title">Sostenibilidad emocional</div>
                        <p class="chapter-card__desc">Tu manual personal de bienestar y hábitos que mantienen la calma a
                            largo plazo.</p>
                    </div>
                </div>
                <div class="chapter-card reveal">
                    <div class="chapter-card__num">15</div>
                    <div>
                        <div class="chapter-card__title">El protocolo es tuyo</div>
                        <p class="chapter-card__desc">Integración, autonomía y el ritual de cierre que sella tu
                            transformación.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 6 — AUTORIDAD
         ============================================ -->
    <section class="section section--white" id="autora">
        <div class="container">
            <div class="author-section" style="max-width: 800px; margin: 0 auto;">
                <img src="<?php echo esc_url($cover_image); ?>" alt="El Protocolo de la Calma"
                    class="author-section__img reveal reveal--left" width="160" height="160" loading="lazy"
                    decoding="async">

                <div class="reveal reveal--right">
                    <span class="section__eyebrow">¿Por qué este libro?</span>
                    <h2 class="section__title">Más que consejos: un sistema</h2>
                    <p>Este no es otro libro que te dice «respira profundo y piensa positivo». <strong>El Protocolo de
                            la
                            Calma</strong> es un sistema de transformación integral basado en neurociencia, psicología
                        somática y terapia cognitivo-conductual.</p>
                    <p>Cada capítulo tiene respaldo científico real — desde Bessel van der Kolk hasta Jon Kabat-Zinn —
                        pero está escrito para que cualquier persona lo entienda y lo aplique desde el primer día.</p>
                    <p><strong>No necesitas experiencia previa en meditación, psicología o bienestar.</strong> Solo
                        necesitas 21 días, una libreta y la disposición de escucharte a ti mismo.</p>

                    <div class="author-section__credentials">
                        <span class="badge">🧠 Basado en neurociencia</span>
                        <span class="badge">📝 21 ejercicios prácticos</span>
                        <span class="badge">📖 15 capítulos + apéndices</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 7 — TESTIMONIOS
         ============================================ -->
    <section class="section section--cream" id="testimonios">
        <div class="container text-center">
            <span class="section__eyebrow reveal">Historias reales</span>
            <h2 class="section__title reveal">Lo que dicen quienes ya lo aplicaron</h2>
            <p class="section__subtitle reveal">Personas reales con estrés real. Sin promesas mágicas — solo
                herramientas que funcionan.</p>

            <div
                style="display: grid; grid-template-columns: 1fr; gap: var(--space-5); max-width: 900px; margin: 0 auto;">
                <div class="testimonial-card reveal reveal--delay-1">
                    <p class="testimonial-card__text">Llevaba años viviendo en piloto automático. Me levantaba agotada,
                        pasaba el día corriendo y me acostaba con la mente a mil. El diario de estrés del capítulo 4 me
                        hizo ver patrones que nunca había notado. En 3 semanas de protocolo, mis dolores de cabeza
                        crónicos desaparecieron. No es exageración — es que el estrés era la causa y yo no lo sabía.</p>
                    <div class="testimonial-card__author">
                        <div>
                            <div class="testimonial-card__name">Laura G., 38 años</div>
                            <div class="testimonial-card__role">Gerente de proyectos · Madrid, España</div>
                            <div class="testimonial-card__stars">★★★★★</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal--delay-2">
                    <p class="testimonial-card__text">Soy médico residente y el burnout me tenía al borde. Lo que más
                        me ayudó fue la técnica 4-7-8 de respiración y las micro-pausas del capítulo 10. Las aplico
                        entre pacientes. Mis colegas notaron el cambio antes que yo — me preguntaron si estaba tomando
                        algo. Les dije: sí, aire. Pero con un sistema.</p>
                    <div class="testimonial-card__author">
                        <div>
                            <div class="testimonial-card__name">Diego M., 31 años</div>
                            <div class="testimonial-card__role">Médico residente · Buenos Aires, Argentina</div>
                            <div class="testimonial-card__stars">★★★★★</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal--delay-3">
                    <p class="testimonial-card__text">Tenía miedo de que fuera otro libro de «piensa bonito y todo se
                        arregla». No lo es. Es profundo, tiene ciencia real detrás, y los ejercicios de detox emocional
                        del capítulo 6 me hicieron llorar como no lloraba en años. Pero después de eso, dormí como no
                        dormía en meses. Lo recomiendo con los ojos cerrados.</p>
                    <div class="testimonial-card__author">
                        <div>
                            <div class="testimonial-card__name">Paola R., 45 años</div>
                            <div class="testimonial-card__role">Madre de tres hijos · Bogotá, Colombia</div>
                            <div class="testimonial-card__stars">★★★★★</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 8 — BONOS
         ============================================ -->
    <section class="section section--white" id="bonos">
        <div class="container text-center">
            <span class="section__eyebrow reveal">Incluido con tu compra</span>
            <h2 class="section__title reveal">3 Bonos Exclusivos <span class="text-sage">GRATIS</span></h2>
            <p class="section__subtitle reveal">Herramientas complementarias para acelerar y profundizar tu
                transformación.</p>

            <div
                style="display: grid; grid-template-columns: 1fr; gap: var(--space-5); max-width: 900px; margin: 0 auto;">
                <div class="bonus-card reveal reveal--delay-1">
                    <span class="bonus-card__badge">Bono #1</span>
                    <h4 class="bonus-card__title">Kit de Emergencia Anti-Estrés</h4>
                    <p class="bonus-card__desc">Protocolo de 5 pasos para crisis agudas de estrés. Tu botiquín emocional
                        de primeros auxilios para los días más difíciles.</p>
                    <span class="bonus-card__value">Valor: $15 → GRATIS</span>
                </div>

                <div class="bonus-card reveal reveal--delay-2">
                    <span class="bonus-card__badge">Bono #2</span>
                    <h4 class="bonus-card__title">Diario del Protocolo — 21 Días</h4>
                    <p class="bonus-card__desc">Tu compañero diario con las 3 preguntas del método, espacio para
                        escritura de descarga y tracking de señales de alerta.</p>
                    <span class="bonus-card__value">Valor: $19 → GRATIS</span>
                </div>

                <div class="bonus-card reveal reveal--delay-3">
                    <span class="bonus-card__badge">Bono #3</span>
                    <h4 class="bonus-card__title">Guía de Alimentos Anti-Estrés + Rutinas</h4>
                    <p class="bonus-card__desc">Lista de alimentos que calman vs. los que alteran tu sistema nervioso +
                        rutinas matutinas y nocturnas del protocolo.</p>
                    <span class="bonus-card__value">Valor: $15 → GRATIS</span>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 9 — OFERTA (Stack de Valor)
         ============================================ -->
    <section class="section section--dark" id="oferta">
        <div class="container text-center">
            <span class="section__eyebrow reveal" style="color: var(--sage-green);">Oferta especial</span>
            <h2 class="section__title reveal">Todo lo que recibes hoy</h2>
            <p class="section__subtitle reveal" style="color: rgba(254,252,243,0.7);">Un sistema completo por una
                fracción de lo que cuesta una sola sesión de terapia.</p>

            <div class="value-stack reveal reveal--scale animate-breathe">
                <div class="value-stack__item">
                    <span class="value-stack__check">✅</span>
                    <span class="value-stack__label">Ebook "El Protocolo de la Calma" (15
                        capítulos)</span>
                    <span class="value-stack__price">$37</span>
                </div>
                <div class="value-stack__item">
                    <span class="value-stack__check">✅</span>
                    <span class="value-stack__label">Protocolo paso a paso de 21 Días</span>
                    <span class="value-stack__price">$19</span>
                </div>
                <div class="value-stack__item">
                    <span class="value-stack__check">✅</span>
                    <span class="value-stack__label">Bono: Kit de Emergencia
                        Anti-Estrés</span>
                    <span class="value-stack__price">$15</span>
                </div>
                <div class="value-stack__item">
                    <span class="value-stack__check">✅</span>
                    <span class="value-stack__label">Bono: Diario del Protocolo 21 Días</span>
                    <span class="value-stack__price">$19</span>
                </div>
                <div class="value-stack__item">
                    <span class="value-stack__check">✅</span>
                    <span class="value-stack__label">Bono: Guía de Alimentos + Rutinas
                        Anti-Estrés</span>
                    <span class="value-stack__price">$15</span>
                </div>

                <div class="value-stack__total">
                    <span class="value-stack__original">$105</span>
                    <div>
                        <div style="font-size: var(--text-sm); color: var(--gray-soft); margin-bottom: 4px;">Hoy solo
                        </div>
                        <span class="value-stack__final">$27</span>
                    </div>
                </div>

                <div style="margin-top: var(--space-6); text-align: center;">
                    <a href="<?php echo $checkout_url; ?>" class="btn btn--primary btn--large" id="cta-oferta"
                        style="width: 100%;">
                        <span class="btn__icon">🛒</span> Quiero Empezar Mi Transformación
                    </a>
                    <p style="margin-top: var(--space-3); font-size: var(--text-xs); color: var(--gray-soft);">
                        🔒 Pago seguro · Descarga inmediata · Garantía de 7 días
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 10 — GARANTÍA
         ============================================ -->
    <section class="section section--cream" id="garantia">
        <div class="container text-center">
            <div class="guarantee-seal reveal">
                <div class="guarantee-seal__icon">🛡️</div>
                <div style="text-align: left;">
                    <div class="guarantee-seal__title">Garantía Total de 7 Días</div>
                    <p class="guarantee-seal__text">Si en los próximos 7 días sientes que este libro no es para ti, te
                        devolvemos cada centavo. Sin preguntas, sin formularios eternos, sin culpa.</p>
                    <p class="guarantee-seal__text" style="margin-top: var(--space-2); font-style: italic;">
                        «Prefiero que lo pruebes sin miedo a que te quedes sin la ayuda que necesitas.»
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 11 — FAQ
         ============================================ -->
    <section class="section section--white" id="faq">
        <div class="container container--narrow">
            <div class="text-center">
                <span class="section__eyebrow reveal">Preguntas frecuentes</span>
                <h2 class="section__title reveal">¿Tienes dudas? Es normal.</h2>
            </div>

            <div class="reveal" style="margin-top: var(--space-8);">
                <details class="faq-item">
                    <summary>¿Es un libro digital o físico?</summary>
                    <div class="faq-item__answer">
                        <p>Es un libro 100% digital en formato PDF. Lo recibes al instante por email y puedes leerlo en
                            tu celular, tablet, computadora o imprimirlo si prefieres. Los bonos también son digitales.
                        </p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Es solo otro libro de «piensa positivo»?</summary>
                    <div class="faq-item__answer">
                        <p>Definitivamente no. El Protocolo de la Calma está basado en neurociencia, psicología somática
                            y terapia cognitivo-conductual. Cada técnica tiene respaldo científico. No te va a pedir que
                            «visualices la abundancia» — te va a enseñar cómo funciona tu sistema nervioso y cómo
                            regularlo con herramientas concretas.</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Sustituye la terapia profesional?</summary>
                    <div class="faq-item__answer">
                        <p>No. Este libro es un complemento poderoso, no un reemplazo. Si estás en terapia, las
                            herramientas de este libro potenciarán tu proceso. Si no estás en terapia pero consideras
                            que
                            la necesitas, el libro te ayudará a dar los primeros pasos mientras evalúas esa opción.</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Cuánto tiempo necesito dedicarle al día?</summary>
                    <div class="faq-item__answer">
                        <p>El protocolo está diseñado para 15-30 minutos diarios durante 21 días. Puedes leer un
                            capítulo completo en 20-30 minutos y los ejercicios toman entre 5 y 20 minutos. Es
                            compatible con agendas demandantes — de hecho, está diseñado para personas que «no tienen
                            tiempo».</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Y si no tengo experiencia con meditación o mindfulness?</summary>
                    <div class="faq-item__answer">
                        <p>Perfecto. El libro parte de cero. Los ejercicios de mindfulness del capítulo 11 están
                            diseñados para principiantes absolutos — sin jerga espiritual, sin requisitos previos.
                            Empiezas
                            con 2 minutos al día.</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Funciona si no sé si tengo estrés crónico o solo estoy «muy ocupado/a»?</summary>
                    <div class="faq-item__answer">
                        <p>El capítulo 1 incluye un test de autopercepción de carga de estrés que te ayuda a determinar
                            exactamente dónde estás. Ya sea estrés agudo, crónico o burnout, el protocolo se adapta a
                            tu situación.</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Qué pasa si no me funciona?</summary>
                    <div class="faq-item__answer">
                        <p>Tienes 7 días de garantía total. Si por cualquier motivo sientes que no es para ti, te
                            devolvemos tu dinero completo sin hacer una sola pregunta. El riesgo es cero.</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Cómo recibo el libro después del pago?</summary>
                    <div class="faq-item__answer">
                        <p>Inmediatamente después de tu compra recibirás un email con tu enlace de descarga. En menos de
                            2 minutos tendrás el ebook y los 3 bonos en tu dispositivo. Si no ves el email, revisa tu
                            carpeta de spam.</p>
                    </div>
                </details>
            </div>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 12 — CTA FINAL
         ============================================ -->
    <section class="section section--dark" id="cta-final">
        <div class="container container--narrow text-center">
            <h2 class="section__title reveal" style="color: var(--cream);">
                Hoy puede ser el día en que dejes de sobrevivir y empieces a vivir.
            </h2>
            <p class="reveal"
                style="color: rgba(254,252,243,0.7); font-size: var(--text-md); margin-bottom: var(--space-6);">
                Ebook + Protocolo de 21 Días + 3 Bonos exclusivos. Todo por <strong
                    style="color: var(--sage-green); font-size: var(--text-xl);">$27</strong>
            </p>
            <div class="reveal">
                <a href="<?php echo $checkout_url; ?>" class="btn btn--primary btn--large" id="cta-final-btn">
                    <span class="btn__icon">🌙</span> Sí, Quiero Recuperar Mi Calma
                </a>
            </div>
            <p class="reveal"
                style="margin-top: var(--space-4); color: rgba(254,252,243,0.4); font-size: var(--text-xs);">
                Acceso inmediato · Descarga directa · Garantía de 7 días · Pago seguro
            </p>
        </div>
    </section>


    <!-- ============================================
         SECCIÓN 13 — FOOTER
         ============================================ -->
    <footer class="footer">
        <div class="container">
            <p
                style="font-family: var(--font-heading); font-size: var(--text-lg); color: rgba(254,252,243,0.5); margin-bottom: var(--space-4);">
                🌙 El Protocolo de la Calma
            </p>

            <nav class="footer__links">
                <a href="#">Aviso Legal</a>
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
                <a href="#">Contacto</a>
            </nav>

            <p>© 2025 PortaLibros.com. Todos los derechos reservados.</p>

            <p class="footer__disclaimer">
                Este material tiene fines informativos y educativos. No sustituye el diagnóstico, tratamiento o consejo
                de un profesional de la salud mental cualificado. Si experimentas síntomas severos de estrés o crisis
                de salud mental, busca ayuda profesional inmediata.
            </p>
        </div>
    </footer>


    <!-- JS -->
    <?php
    $js_path = $theme_dir . '/assets/js/main.js';
    if (file_exists($js_path)) {
        echo '<script src="' . esc_url($theme_uri . '/assets/js/main.js?v=' . filemtime($js_path)) . '" defer></script>';
    }
    ?>

    <?php wp_footer(); ?>
</body>

</html>