<?php
/**
 * Side Cart Premium — Configuración Optimizada para PortaLibros.com
 *
 * Configura programáticamente TODOS los ajustes del plugin
 * Woocommerce Side Cart Premium para una experiencia premium
 * de venta de ebooks digitales.
 *
 * Paleta: Teal Deep (#1A3C40) · Sage Green (#3CB371) · Cream (#FEFCF3)
 *
 * @package LibrosJavired
 */

if (!defined('ABSPATH'))
    exit;


/* ══════════════════════════════════════════════
   CONFIGURACIÓN DEL SIDE CART PREMIUM
   Solo se ejecuta una vez (flag en DB).
   Para re-aplicar: borrar opción
   'libros_sidecart_configured' en wp_options.
   ══════════════════════════════════════════════ */

add_action('admin_init', function () {

    // Evitar re-ejecución innecesaria
    if (get_option('libros_sidecart_configured') === '2')
        return;

    if (!function_exists('xoo_wsc_helper'))
        return;

    /* ─── 1. GENERAL OPTIONS ─── */
    $general = get_option('xoo-wsc-gl-options', array());

    $general_overrides = array(

        // ── Textos en español ──
        'sct-cart-heading' => '🛒 Tu Carrito',
        'sct-ft-contbtn' => 'Seguir Comprando',
        'sct-ft-cartbtn' => '',              // Oculto — redirige directo a checkout
        'sct-ft-chkbtn' => 'Comprar Ahora',
        'sct-empty' => 'Tu carrito está vacío',
        'sct-shop-btn' => '📚 Explorar Libros',
        'sct-savings' => '¡Estás ahorrando en este pedido!',
        'sct-subtotal' => 'Subtotal',
        'sct-footer' => '🔒 Pago seguro · Descarga inmediata',
        'sct-delete' => 'Eliminar',
        'sct-sp-txt' => '📖 También te puede gustar',
        'sct-sl-txt' => '💾 Guardados para después',

        // ── Main Behavior ──
        'm-auto-open' => 'yes',           // Abrir carrito al agregar producto
        'm-ajax-atc' => 'yes',           // Add to cart sin recargar
        'm-flycart' => 'yes',           // Animación fly-to-cart
        'm-cart-order' => 'desc',          // Reciente arriba
        'm-bk-count' => 'items',         // Contar productos, no cantidades
        'm-cp-list' => 'available',     // Solo cupones disponibles
        'm-cp-count' => 10,
        'm-hide-cart' => 'checkout',      // Ocultar en checkout
        'm-viewcart-del' => 'yes',           // Quitar link "ver carrito" de WC
        'm-tooltip' => 'yes',

        // ── Side Cart Header ──
        'sch-show' => array('notifications', 'basket', 'close'),
        'sch-notify-time' => '2500',

        // ── Side Cart Body ──
        'scb-show' => array(
            'product_image',
            'product_name',
            'product_price',
            'product_total',
            'product_qty',
            'product_del',
            'product_meta',
            'product_total_save',
        ),
        'scb-prod-savings' => 'amount',
        'scb-prod-price' => 'sale',          // Mostrar precio regular y de oferta
        'scbp-qpdisplay' => 'separate',
        'scb-update-qty' => 'yes',
        'scb-update-delay' => '350',
        'scb-pname-var' => 'no',

        // ── Side Cart Footer ──
        'scf-show' => array('savings', 'subtotal', 'discount', 'total', 'coupon'),
        'scf-payment-btns' => array(),         // Sin botones de pago express en side cart
        'scf-chkbtntotal-en' => 'yes',           // Mostrar total en botón checkout
        'scf-chklogin-en' => 'no',            // No forzar login
        'scf-ftext-hide' => 'yes',

        // ── Suggested Products ──
        'scsp-enable' => 'yes',
        'scsp-mob-enable' => 'yes',
        'scsp-show' => array('image', 'title', 'price', 'addtocart'),
        'scsp-type' => 'related',
        'scsp-count' => 4,
        'scsp-random' => 'yes',

        // ── Save For Later ──
        'sl-enable' => 'yes',
        'sl-disable-guest' => 'no',
        'sl-show' => array('image', 'title', 'price', 'addtocart'),

        // ── Cart Menu / Shortcode ──
        'shbk-show' => array('icon', 'count'),
        'shbk-hide' => array(),

        // ── URLs ──
        'scu-continue' => '#',             // # = cerrar side cart
    );

    $general = array_merge($general, $general_overrides);
    update_option('xoo-wsc-gl-options', $general);


    /* ─── 2. STYLE OPTIONS ─── */
    $style = get_option('xoo-wsc-sy-options', array());

    $style_overrides = array(

        // ── Main ──
        'scm-width' => '420',
        'scm-height' => 'full',
        'scm-open-from' => 'right',
        'scm-font' => 'Inter',

        // ── Basket (floating icon) ──
        'sck-enable' => 'hide_empty',
        'sck-show-mobile' => 'yes',
        'sck-shape' => 'round',
        'sck-basket-icon' => 'xoo-wsc-icon-shopping-bag1',
        'sck-cust-icon' => '',
        'sck-bk-size' => '56',
        'sck-size' => '28',
        'sck-mob-size' => 'yes',
        'sck-position' => 'bottom',
        'sck-offset' => 20,
        'sck-hoffset' => 2,
        'sck-basket-color' => '#FFFFFF',
        'sck-basket-bg' => '#1A3C40',
        'sck-basket-sh' => '0 8px 30px rgba(26,60,64,0.25)',
        'sck-show-count' => 'yes',
        'sck-count-pos' => 'top_left',
        'sck-count-color' => '#FFFFFF',
        'sck-count-bg' => '#3CB371',

        // ── Header ──
        'sch-layout' => array(
            'left' => array('basket', 'heading'),
            'center' => array(),
            'right' => array('save', 'close'),
        ),
        'sch-close-icon' => 'xoo-wsc-icon-cross',
        'sch-close-fsize' => '22',
        'sch-head-fsize' => '20',
        'sch-padding' => '16px 20px',
        'sch-bgcolor' => '#FFFFFF',
        'sch-txtcolor' => '#1A3C40',
        'sch-border' => '1px solid #E8F5E9',

        // ── Body ──
        'scb-fsize' => 14,
        'scb-bgcolor' => '#F0F2F1',
        'scb-txtcolor' => '#1A3C40',
        'scb-empty-img' => '',
        'scbp-deltype' => 'icon',
        'scb-del-icon' => 'xoo-wsc-icon-trash1',
        'scb-icon-size' => 14,
        'scb-playout' => 'rows',

        // ── Body: Product Row ──
        'scbp-delpos' => 'default',
        'scbp-imgw' => 28,
        'scbp-bgcolor' => '#FFFFFF',
        'scbp-padding' => '12px 16px',
        'scbp-margin' => '6px 12px',
        'scbp-bradius' => '12',
        'scbp-shadow' => '0 2px 8px rgba(26,60,64,0.06)',
        'scbp-display' => 'center',
        'scbp-var-format' => 'one_line',
        'scbp-sales-bgcolor' => '#E8F5E9',
        'scbp-sales-txtcolor' => '#2D8F59',
        'scbp-sales-border' => '1px solid #3CB371',

        // ── Body: Quantity ──
        'scbq-style' => 'circle',
        'scbq-width' => 80,
        'scbq-btnsize' => 22,
        'scbq-height' => 30,
        'scbq-bsize' => 1,
        'scbq-input-bcolor' => '#D4D9D8',
        'scbq-box-bcolor' => '#D4D9D8',
        'scbq-input-bgcolor' => '#FFFFFF',
        'scbq-input-txtcolor' => '#1A3C40',
        'scbq-box-bgcolor' => '#F0F2F1',
        'scbq-box-txtcolor' => '#1A3C40',

        // ── Footer ──
        'scf-stick' => 'yes',
        'scf-totals-loc' => 'footer',
        'scf-padding' => '16px 20px',
        'scf-fsize' => '15',
        'scf-bgcolor' => '#FFFFFF',
        'scf-txtcolor' => '#1A3C40',
        'scf-shadow' => '0 -4px 20px rgba(26,60,64,0.08)',
        'scf-coup-display' => 'slider',
        'scf-coup-icon' => 'xoo-wsc-icon-coupon-8',
        'scf-button-pos' => array('checkout', 'continue'),
        'scf-btns-row' => 'one',

        // ── Buttons ──
        'scf-btns-theme' => 'custom',
        'scf-btn-padding' => '14px 28px',
        'scf-btn-bgcolor' => '#3CB371',
        'scf-btn-txtcolor' => '#FFFFFF',
        'scf-btn-border' => '2px solid #3CB371',
        'scf-btnhv-bgcolor' => '#2D8F59',
        'scf-btnhv-txtcolor' => '#FFFFFF',
        'scf-btnhv-border' => '2px solid #2D8F59',

        // ── Suggested Products ──
        'scsp-main-location' => 'drawer',
        'scs-drawer-width' => '350',
        'scs-drawer-wait' => '500',
        'scsp-style' => 'wide',
        'scsp-slide-en' => 'yes',
        'scsp-slide-auto' => 'yes',
        'scsp-slide-timer' => 4000,
        'scsp-imgw' => '80',
        'scsp-fsize' => '13',
        'scsp-bgcolor' => '#F0F2F1',
        'scsp-prd-bgcolor' => '#FFFFFF',

        // ── Saved For Later ──
        'sl-icon' => 'xoo-wsc-icon-heart1',
        'sl-style' => 'wide',
        'sl-imgw' => '70',
        'sl-fsize' => '14',
        'sl-bgcolor' => '#F0F2F1',
        'sl-prd-bgcolor' => '#FFFFFF',
        'sl-prd-txtcolor' => '#1A3C40',

        // ── Shortcode / Menu ──
        'shbk-size' => 24,
        'shbk-color' => '#1A3C40',
        'shbk-count-color' => '#FFFFFF',
        'shbk-count-bg' => '#3CB371',
        'shbk-txt-color' => '#1A3C40',
    );

    $style = array_merge($style, $style_overrides);
    update_option('xoo-wsc-sy-options', $style);


    /* ─── 3. ADVANCED OPTIONS ─── */
    $advanced = get_option('xoo-wsc-av-options', array());

    $custom_css = <<<'CSS'
/* ============================================
   SIDE CART PREMIUM — CSS PortaLibros.com
   ============================================ */

/* ── Overlay ── */
.xoo-wsc-overlay {
  background: rgba(26, 60, 64, 0.35) !important;
  backdrop-filter: blur(4px) !important;
  -webkit-backdrop-filter: blur(4px) !important;
}

/* ── Container ── */
.xoo-wsc-container {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
  box-shadow: -8px 0 40px rgba(26, 60, 64, 0.15) !important;
  border-left: 1px solid rgba(232, 245, 233, 0.5) !important;
}

/* ── Header glassmorphism ── */
.xoo-wsc-header {
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  background: rgba(255, 255, 255, 0.95) !important;
}

.xoo-wsc-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-weight: 700 !important;
  letter-spacing: -0.3px !important;
}

/* ── Product items: entrada animada ── */
.xoo-wsc-product {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  border: 1px solid rgba(26, 60, 64, 0.04) !important;
}

.xoo-wsc-product:hover {
  transform: translateX(-3px) !important;
  box-shadow: 0 4px 16px rgba(26, 60, 64, 0.1) !important;
  border-color: rgba(60, 179, 113, 0.15) !important;
}

/* ── Product name ── */
.xoo-wsc-pname a {
  font-weight: 600 !important;
  color: #1A3C40 !important;
  text-decoration: none !important;
  transition: color 0.2s !important;
  line-height: 1.4 !important;
}

.xoo-wsc-pname a:hover {
  color: #3CB371 !important;
}

/* ── Product price & total ── */
.xoo-wsc-pprice {
  color: #6B7B7A !important;
  font-size: 13px !important;
}

.xoo-wsc-ptotal {
  font-weight: 700 !important;
  color: #1A3C40 !important;
}

/* ── Product image ── */
.xoo-wsc-img-col img {
  border-radius: 8px !important;
  box-shadow: 0 2px 8px rgba(26, 60, 64, 0.08) !important;
  transition: transform 0.25s ease !important;
}

.xoo-wsc-product:hover .xoo-wsc-img-col img {
  transform: scale(1.03) !important;
}

/* ── Delete icon ── */
.xoo-wsc-pdel {
  opacity: 0.4 !important;
  transition: opacity 0.2s, color 0.2s !important;
}

.xoo-wsc-product:hover .xoo-wsc-pdel {
  opacity: 1 !important;
  color: #E8A598 !important;
}

/* ── Savings badge ── */
.xoo-wsc-ptotal-save,
.xoo-wsc-pprice-save {
  background: rgba(60, 179, 113, 0.08) !important;
  color: #2D8F59 !important;
  padding: 2px 8px !important;
  border-radius: 20px !important;
  font-size: 11px !important;
  font-weight: 600 !important;
  display: inline-block !important;
}

/* ── Quantity input ── */
.xoo-wsc-qtybox {
  border: 1.5px solid #D4D9D8 !important;
  overflow: hidden !important;
  transition: border-color 0.2s !important;
}

.xoo-wsc-qtybox:hover,
.xoo-wsc-qtybox:focus-within {
  border-color: #3CB371 !important;
}

.xoo-wsc-qtybox .xoo-wsc-qtybtn {
  font-weight: 600 !important;
  transition: background 0.15s !important;
}

.xoo-wsc-qtybox .xoo-wsc-qtybtn:hover {
  background: #E8F5E9 !important;
  color: #2D8F59 !important;
}

/* ── Scrollbar body ── */
.xoo-wsc-body::-webkit-scrollbar {
  width: 5px;
}

.xoo-wsc-body::-webkit-scrollbar-track {
  background: transparent;
}

.xoo-wsc-body::-webkit-scrollbar-thumb {
  background: rgba(26, 60, 64, 0.15);
  border-radius: 10px;
}

.xoo-wsc-body::-webkit-scrollbar-thumb:hover {
  background: rgba(26, 60, 64, 0.3);
}

/* ── Footer ── */
.xoo-wsc-footer {
  border-top: 1px solid rgba(232, 245, 233, 0.8) !important;
}

.xoo-wsc-ft-totals-row {
  padding: 6px 0 !important;
}

.xoo-wsc-ft-totals-row:last-child {
  font-weight: 700 !important;
  font-size: 16px !important;
  padding-top: 10px !important;
  border-top: 1px solid #E8F5E9 !important;
}

/* ── Checkout button premium ── */
.xoo-wsc-ft-btn {
  border-radius: 50px !important;
  font-weight: 600 !important;
  font-family: 'Inter', sans-serif !important;
  letter-spacing: 0.3px !important;
  text-transform: none !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  position: relative !important;
  overflow: hidden !important;
}

.xoo-wsc-ft-btn:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 20px rgba(60, 179, 113, 0.3) !important;
}

.xoo-wsc-ft-btn:active {
  transform: translateY(0) !important;
}

/* ── Continue shopping: estilo outline ── */
a.xoo-wsc-ft-btn.xoo-wsc-cart-close {
  background: transparent !important;
  color: #6B7B7A !important;
  border: 1.5px solid #D4D9D8 !important;
  font-size: 13px !important;
  padding: 10px 20px !important;
}

a.xoo-wsc-ft-btn.xoo-wsc-cart-close:hover {
  border-color: #3CB371 !important;
  color: #3CB371 !important;
  background: rgba(60, 179, 113, 0.04) !important;
  box-shadow: none !important;
}

/* ── Footer text ── */
.xoo-wsc-ft-text {
  font-size: 12px !important;
  color: #6B7B7A !important;
  text-align: center !important;
  padding: 8px 0 4px !important;
  letter-spacing: 0.2px !important;
}

/* ── Empty cart ── */
.xoo-wsc-empty-cart {
  padding: 60px 30px !important;
  text-align: center !important;
}

.xoo-wsc-empty-cart .xoo-wsc-ecnt {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 20px !important;
  color: #1A3C40 !important;
  margin-bottom: 16px !important;
}

/* ── Coupon section ── */
.xoo-wsc-coupon-form input {
  border: 1.5px solid #D4D9D8 !important;
  border-radius: 8px !important;
  padding: 10px 14px !important;
  font-family: 'Inter', sans-serif !important;
  transition: border-color 0.2s !important;
}

.xoo-wsc-coupon-form input:focus {
  border-color: #3CB371 !important;
  outline: none !important;
  box-shadow: 0 0 0 3px rgba(60, 179, 113, 0.1) !important;
}

.xoo-wsc-coupon-form button {
  background: #1A3C40 !important;
  color: #FFFFFF !important;
  border-radius: 8px !important;
  border: none !important;
  font-weight: 600 !important;
  transition: background 0.2s !important;
}

.xoo-wsc-coupon-form button:hover {
  background: #2E5250 !important;
}

/* ── Suggested products ── */
.xoo-wsc-sp-container {
  border-top: 1px solid #E8F5E9 !important;
}

.xoo-wsc-sp-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-weight: 600 !important;
  color: #1A3C40 !important;
}

.xoo-wsc-sp-product {
  border-radius: 10px !important;
  overflow: hidden !important;
  transition: transform 0.2s, box-shadow 0.2s !important;
}

.xoo-wsc-sp-product:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 4px 12px rgba(26, 60, 64, 0.1) !important;
}

.xoo-wsc-sp-product .button {
  background: linear-gradient(135deg, #3CB371 0%, #2D8F59 100%) !important;
  color: #FFFFFF !important;
  border: none !important;
  border-radius: 50px !important;
  font-size: 12px !important;
  font-weight: 600 !important;
  padding: 6px 16px !important;
  transition: all 0.2s !important;
}

.xoo-wsc-sp-product .button:hover {
  background: linear-gradient(135deg, #2D8F59 0%, #247A4A 100%) !important;
  transform: translateY(-1px) !important;
}

/* ── Saved For Later ── */
.xoo-wsc-sl-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  color: #1A3C40 !important;
}

/* ── Floating basket premium ── */
.xoo-wsc-basket {
  transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
}

.xoo-wsc-basket:hover {
  transform: scale(1.08) !important;
  box-shadow: 0 10px 35px rgba(26, 60, 64, 0.3) !important;
}

/* Badge pulsante */
.xoo-wsc-items-count:not(:empty) {
  animation: libros-badge-pulse 2s ease-in-out infinite !important;
}

@keyframes libros-badge-pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

/* ── Notifications ── */
.xoo-wsc-notice-box .xoo-wsc-notice {
  background: rgba(60, 179, 113, 0.08) !important;
  border-left: 3px solid #3CB371 !important;
  color: #1A3C40 !important;
  border-radius: 6px !important;
  font-size: 13px !important;
  padding: 10px 14px !important;
}

/* ── Rewards / Progress bar ── */
.xoo-wsc-bar-container {
  border-radius: 20px !important;
  overflow: hidden !important;
}

.xoo-wsc-bar-fill {
  background: linear-gradient(135deg, #3CB371 0%, #2D8F59 100%) !important;
  border-radius: 20px !important;
  transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* ── Mobile refinements ── */
@media (max-width: 768px) {
  .xoo-wsc-container {
    width: 100vw !important;
    max-width: 100vw !important;
  }

  .xoo-wsc-product:hover {
    transform: none !important;
  }

  .xoo-wsc-ft-btn {
    font-size: 15px !important;
    padding: 14px 20px !important;
  }
}
CSS;

    $advanced_overrides = array(
        'm-fetch-cart' => 'cart_open',
        'm-refresh-cart' => 'no',
        'm-custom-css' => $custom_css,
        'm-trigger-class' => '',
    );

    $advanced = array_merge($advanced, $advanced_overrides);
    update_option('xoo-wsc-av-options', $advanced);


    /* ─── 4. REWARDS OPTIONS ─── */
    $rewards = get_option('xoo-wsc-rewards-options', array());

    $rewards_overrides = array(
        'scbar-en' => 'yes',
        'scbar-divide' => 'equal',
        'scbar-font-size' => '14',
        'scbar-icon-size' => '12',
        'scbar-icon-circle-size' => '28',
        'scbar-one-celebrate' => 'RealisticLook',
        'scbar-all-celebrate' => 'Fireworks',
        'scbar-fg-en-delete' => 'no',
        'scbar-fg-show' => 'yes',
        'scbar-fg-showcase-hide' => 'yes',
        'scbar-fg-qtyexc' => 'no',
    );

    $rewards = array_merge($rewards, $rewards_overrides);
    update_option('xoo-wsc-rewards-options', $rewards);


    // Marcar como configurado (v2)
    update_option('libros_sidecart_configured', '2');
});


/* ══════════════════════════════════════════════
   TRUST BADGES DENTRO DEL SIDE CART
   Se inyecta justo antes del footer del side cart
   ══════════════════════════════════════════════ */
add_action('xoo_wsc_before_footer', function () {
    if (!WC()->cart || WC()->cart->is_empty())
        return;

    echo '<div style="
        display: flex;
        justify-content: center;
        gap: 16px;
        padding: 8px 16px;
        font-size: 11px;
        color: #6B7B7A;
        background: #F0F2F1;
        border-top: 1px solid #E8F5E9;
    ">';
    echo '<span>🔒 SSL Seguro</span>';
    echo '<span>⚡ Descarga Inmediata</span>';
    echo '<span>🛡️ Garantía 7 Días</span>';
    echo '</div>';
});


/* ══════════════════════════════════════════════
   PERSONALIZAR NOTIFICACIÓN AL AGREGAR PRODUCTO
   ══════════════════════════════════════════════ */
add_filter('xoo_wsc_add_to_cart_notice', function ($notice, $product_name) {
    return '✅ <strong>' . $product_name . '</strong> se agregó a tu carrito';
}, 10, 2);


/* ══════════════════════════════════════════════
   CANTIDAD FIJA = 1 PARA EBOOKS DIGITALES
   Los ebooks solo se compran de a 1 unidad,
   pero no vaciamos el carrito (multi-producto OK)
   ══════════════════════════════════════════════ */
add_filter('woocommerce_is_sold_individually', function ($individually, $product) {
    if ($product->is_virtual() || $product->is_downloadable()) {
        return true; // Cantidad siempre 1 para digitales
    }
    return $individually;
}, 10, 2);
