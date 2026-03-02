<?php
/**
 * Side Cart Premium â€” ConfiguraciÃ³n Optimizada para PortaLibros.com
 *
 * Configura programÃ¡ticamente TODOS los ajustes del plugin
 * Woocommerce Side Cart Premium para una experiencia premium
 * de venta de ebooks digitales.
 *
 * Paleta: Teal Deep (#1A3C40) Â· Sage Green (#3CB371) Â· Cream (#FEFCF3)
 *
 * @package LibrosJavired
 */

if (!defined('ABSPATH'))
  exit;


/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   CONFIGURACIÃ“N DEL SIDE CART PREMIUM
   Solo se ejecuta una vez (flag en DB).
   Para re-aplicar: borrar opciÃ³n
   'libros_sidecart_configured' en wp_options.
   â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */

add_action('admin_init', function () {

  // Evitar re-ejecuciÃ³n innecesaria
  if (get_option('libros_sidecart_configured') === '6')
    return;

  if (!function_exists('xoo_wsc_helper'))
    return;

  /* â”€â”€â”€ 1. GENERAL OPTIONS â”€â”€â”€ */
  $general = get_option('xoo-wsc-gl-options', array());

  $general_overrides = array(

    // â”€â”€ Textos en espaÃ±ol â”€â”€
    'sct-cart-heading' => 'ðŸ›’ Tu Carrito',
    'sct-ft-contbtn' => 'Seguir Comprando',
    'sct-ft-cartbtn' => '',              // Oculto â€” redirige directo a checkout
    'sct-ft-chkbtn' => 'Comprar Ahora',
    'sct-empty' => 'Tu carrito estÃ¡ vacÃ­o',
    'sct-shop-btn' => 'ðŸ“š Explorar Libros',
    'sct-savings' => 'Â¡EstÃ¡s ahorrando en este pedido!',
    'sct-subtotal' => 'Subtotal',
    'sct-footer' => 'ðŸ”’ Pago seguro Â· Descarga inmediata',
    'sct-delete' => 'Eliminar',
    'sct-sp-txt' => 'ðŸ“– TambiÃ©n te puede gustar',
    'sct-sl-txt' => 'ðŸ’¾ Guardados para despuÃ©s',

    // â”€â”€ Main Behavior â”€â”€
    'm-auto-open' => 'yes',           // Abrir carrito al agregar producto
    'm-ajax-atc' => 'yes',           // Add to cart sin recargar
    'm-flycart' => 'yes',           // AnimaciÃ³n fly-to-cart
    'm-cart-order' => 'desc',          // Reciente arriba
    'm-bk-count' => 'items',         // Contar productos, no cantidades
    'm-cp-list' => 'available',     // Solo cupones disponibles
    'm-cp-count' => 10,
    'm-hide-cart' => 'checkout',      // Ocultar en checkout
    'm-viewcart-del' => 'yes',           // Quitar link "ver carrito" de WC
    'm-tooltip' => 'yes',

    // â”€â”€ Side Cart Header â”€â”€
    'sch-show' => array('notifications', 'basket', 'close'),
    'sch-notify-time' => '2500',

    // â”€â”€ Side Cart Body â”€â”€
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

    // â”€â”€ Side Cart Footer â”€â”€
    'scf-show' => array('savings', 'subtotal', 'discount', 'total', 'coupon'),
    'scf-payment-btns' => array(),         // Sin botones de pago express en side cart
    'scf-chkbtntotal-en' => 'yes',           // Mostrar total en botÃ³n checkout
    'scf-chklogin-en' => 'no',            // No forzar login
    'scf-ftext-hide' => 'yes',

    // â”€â”€ Suggested Products â”€â”€
    'scsp-enable' => 'yes',
    'scsp-mob-enable' => 'yes',
    'scsp-show' => array('image', 'title', 'price', 'addtocart'),
    'scsp-type' => 'related',
    'scsp-count' => 4,
    'scsp-random' => 'yes',

    // â”€â”€ Save For Later â”€â”€
    'sl-enable' => 'yes',
    'sl-disable-guest' => 'no',
    'sl-show' => array('image', 'title', 'price', 'addtocart'),

    // â”€â”€ Cart Menu / Shortcode â”€â”€
    'shbk-show' => array('icon', 'count'),
    'shbk-hide' => array(),

    // â”€â”€ URLs â”€â”€
    'scu-continue' => '#',             // # = cerrar side cart
  );

  $general = array_merge($general, $general_overrides);
  update_option('xoo-wsc-gl-options', $general);


  /* â”€â”€â”€ 2. STYLE OPTIONS â”€â”€â”€ */
  $style = get_option('xoo-wsc-sy-options', array());

  $style_overrides = array(

    // â”€â”€ Main â”€â”€
    'scm-width' => '420',
    'scm-height' => 'full',
    'scm-open-from' => 'right',
    'scm-font' => 'Inter',

    // â”€â”€ Basket (floating icon) â”€â”€
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

    // â”€â”€ Header â”€â”€
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

    // â”€â”€ Body â”€â”€
    'scb-fsize' => 14,
    'scb-bgcolor' => '#F0F2F1',
    'scb-txtcolor' => '#1A3C40',
    'scb-empty-img' => '',
    'scbp-deltype' => 'icon',
    'scb-del-icon' => 'xoo-wsc-icon-trash1',
    'scb-icon-size' => 14,
    'scb-playout' => 'rows',

    // â”€â”€ Body: Product Row â”€â”€
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

    // â”€â”€ Body: Quantity â”€â”€
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

    // â”€â”€ Footer â”€â”€
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

    // â”€â”€ Buttons â”€â”€
    'scf-btns-theme' => 'custom',
    'scf-btn-padding' => '14px 28px',
    'scf-btn-bgcolor' => '#3CB371',
    'scf-btn-txtcolor' => '#FFFFFF',
    'scf-btn-border' => '2px solid #3CB371',
    'scf-btnhv-bgcolor' => '#2D8F59',
    'scf-btnhv-txtcolor' => '#FFFFFF',
    'scf-btnhv-border' => '2px solid #2D8F59',

    // â”€â”€ Suggested Products â”€â”€
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

    // â”€â”€ Saved For Later â”€â”€
    'sl-icon' => 'xoo-wsc-icon-heart1',
    'sl-style' => 'wide',
    'sl-imgw' => '70',
    'sl-fsize' => '14',
    'sl-bgcolor' => '#F0F2F1',
    'sl-prd-bgcolor' => '#FFFFFF',
    'sl-prd-txtcolor' => '#1A3C40',

    // â”€â”€ Shortcode / Menu â”€â”€
    'shbk-size' => 24,
    'shbk-color' => '#1A3C40',
    'shbk-count-color' => '#FFFFFF',
    'shbk-count-bg' => '#3CB371',
    'shbk-txt-color' => '#1A3C40',
  );

  $style = array_merge($style, $style_overrides);
  update_option('xoo-wsc-sy-options', $style);


  /* â”€â”€â”€ 3. ADVANCED OPTIONS â”€â”€â”€ */
  $advanced = get_option('xoo-wsc-av-options', array());

  $custom_css = <<<'CSS'
/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   SIDE CART PREMIUM â€” PortaLibros.com
   DiseÃ±o premium con soporte completo Light + Dark
   â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */

/* â”€â”€ CSS Variables (Light Mode) â”€â”€ */
:root {
  --wsc-bg-primary: #FFFFFF;
  --wsc-bg-body: #F8FAFB;
  --wsc-bg-card: #FFFFFF;
  --wsc-bg-header: linear-gradient(135deg, #14532D 0%, #166534 50%, #1A7A42 100%);
  --wsc-bg-footer: #FFFFFF;
  --wsc-text-primary: #1B1B1F;
  --wsc-text-secondary: #4A5568;
  --wsc-text-muted: #94A3B8;
  --wsc-text-header: #FFFFFF;
  --wsc-accent: #14532D;
  --wsc-accent-glow: rgba(20, 83, 45, 0.12);
  --wsc-border: #E2E8F0;
  --wsc-border-hover: #14532D;
  --wsc-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
  --wsc-shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.12);
  --wsc-btn-bg: linear-gradient(135deg, #14532D 0%, #166534 100%);
  --wsc-btn-bg-hover: linear-gradient(135deg, #166534 0%, #1A7A42 100%);
  --wsc-btn-text: #FFFFFF;
  --wsc-price: #14532D;
  --wsc-del: #DC2626;
  --wsc-overlay: rgba(15, 23, 42, 0.45);
  --wsc-badge-bg: rgba(20, 83, 45, 0.08);
  --wsc-badge-text: #14532D;
}

/* â”€â”€ Dark Mode Variables â”€â”€ */
[data-theme="dark"] {
  --wsc-bg-primary: #0D1117;
  --wsc-bg-body: #0D1117;
  --wsc-bg-card: #161B22;
  --wsc-bg-header: linear-gradient(135deg, #161B22 0%, #1C2128 100%);
  --wsc-bg-footer: #161B22;
  --wsc-text-primary: #F0F0F0;
  --wsc-text-secondary: #C9D1D9;
  --wsc-text-muted: #7D8590;
  --wsc-text-header: #F0F0F0;
  --wsc-accent: #4ADE80;
  --wsc-accent-glow: rgba(74, 222, 128, 0.12);
  --wsc-border: #30363D;
  --wsc-border-hover: #4ADE80;
  --wsc-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
  --wsc-shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.4);
  --wsc-btn-bg: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%);
  --wsc-btn-bg-hover: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
  --wsc-btn-text: #0D1210;
  --wsc-price: #4ADE80;
  --wsc-del: #F87171;
  --wsc-overlay: rgba(0, 0, 0, 0.65);
  --wsc-badge-bg: rgba(74, 222, 128, 0.12);
  --wsc-badge-text: #4ADE80;
}


/* â•â•â• 1. OVERLAY â•â•â• */
.xoo-wsc-overlay {
  background: var(--wsc-overlay) !important;
  backdrop-filter: blur(6px) !important;
  -webkit-backdrop-filter: blur(6px) !important;
}


/* â•â•â• 2. CONTAINER â•â•â• */
.xoo-wsc-container {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
  background: var(--wsc-bg-primary) !important;
  border-left: 1px solid var(--wsc-border) !important;
  box-shadow: -10px 0 50px rgba(0, 0, 0, 0.15) !important;
}

[data-theme="dark"] .xoo-wsc-container {
  box-shadow: -10px 0 50px rgba(0, 0, 0, 0.5) !important;
}


/* â•â•â• 3. HEADER â•â•â• */
.xoo-wsc-header {
  background: var(--wsc-bg-header) !important;
  padding: 22px 24px !important;
  border-bottom: none !important;
  position: relative !important;
}

.xoo-wsc-header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
}

[data-theme="dark"] .xoo-wsc-header {
  border-bottom: 1px solid var(--wsc-border) !important;
}

[data-theme="dark"] .xoo-wsc-header::after {
  background: linear-gradient(90deg, transparent, rgba(74, 222, 128, 0.15), transparent);
}

.xoo-wsc-heading,
.xoo-wsc-header span,
.xoo-wsc-header .xoo-wsc-ctxt {
  color: var(--wsc-text-header) !important;
  font-weight: 700 !important;
  font-size: 1.15rem !important;
  letter-spacing: -0.2px !important;
}

.xoo-wsc-header .xoo-wsc-icon-cross,
.xoo-wsc-header i {
  color: rgba(255, 255, 255, 0.7) !important;
  transition: all 0.25s ease !important;
}

.xoo-wsc-header .xoo-wsc-icon-cross:hover,
.xoo-wsc-header i:hover {
  color: #FFFFFF !important;
  transform: rotate(90deg) !important;
}


/* â•â•â• 4. BODY â•â•â• */
.xoo-wsc-body {
  background: var(--wsc-bg-body) !important;
  padding: 16px !important;
}


/* â•â•â• 5. PRODUCT ITEMS â•â•â• */
.xoo-wsc-product {
  background: var(--wsc-bg-card) !important;
  border: 1px solid var(--wsc-border) !important;
  border-radius: 14px !important;
  padding: 16px !important;
  margin-bottom: 12px !important;
  box-shadow: var(--wsc-shadow) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  position: relative !important;
  overflow: hidden !important;
}

/* Left accent line on hover */
.xoo-wsc-product::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 3px; height: 100%;
  background: var(--wsc-accent);
  transform: scaleY(0);
  transition: transform 0.3s ease;
  border-radius: 0 3px 3px 0;
}

.xoo-wsc-product:hover {
  border-color: var(--wsc-border-hover) !important;
  box-shadow: var(--wsc-shadow-hover) !important;
  transform: translateX(-2px) !important;
}

.xoo-wsc-product:hover::before { transform: scaleY(1); }

/* Image */
.xoo-wsc-img-col img {
  border-radius: 10px !important;
  border: 1px solid var(--wsc-border) !important;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06) !important;
  transition: transform 0.3s ease !important;
}

.xoo-wsc-product:hover .xoo-wsc-img-col img {
  transform: scale(1.03) !important;
}

/* Product Name */
.xoo-wsc-pname a {
  color: var(--wsc-text-primary) !important;
  font-weight: 600 !important;
  font-size: 0.92rem !important;
  line-height: 1.4 !important;
  text-decoration: none !important;
  transition: color 0.2s !important;
}

.xoo-wsc-pname a:hover {
  color: var(--wsc-accent) !important;
}

/* Price */
.xoo-wsc-pprice,
.xoo-wsc-pprice .amount {
  color: var(--wsc-text-secondary) !important;
  font-weight: 500 !important;
  font-size: 0.85rem !important;
}

.xoo-wsc-pprice del,
.xoo-wsc-pprice del .amount {
  color: var(--wsc-text-muted) !important;
  font-weight: 400 !important;
}

/* Product Total */
.xoo-wsc-ptotal,
.xoo-wsc-ptotal .amount {
  color: var(--wsc-price) !important;
  font-weight: 700 !important;
  font-size: 1rem !important;
}

/* Savings badge */
.xoo-wsc-ptotal-save,
.xoo-wsc-pprice-save {
  background: var(--wsc-badge-bg) !important;
  color: var(--wsc-badge-text) !important;
  border-radius: 6px !important;
  padding: 3px 8px !important;
  font-size: 11px !important;
  font-weight: 700 !important;
  letter-spacing: 0.3px !important;
}

/* Meta */
.xoo-wsc-pmeta,
.xoo-wsc-pvar {
  color: var(--wsc-text-muted) !important;
  font-size: 0.8rem !important;
}

/* Delete */
.xoo-wsc-pdel,
.xoo-wsc-icon-del {
  color: var(--wsc-text-muted) !important;
  opacity: 0.6 !important;
  transition: all 0.2s !important;
}

.xoo-wsc-product:hover .xoo-wsc-pdel,
.xoo-wsc-icon-del:hover {
  color: var(--wsc-del) !important;
  opacity: 1 !important;
  transform: scale(1.15) !important;
}


/* â•â•â• 6. QUANTITY â•â•â• */
.xoo-wsc-qtybox {
  border: 1.5px solid var(--wsc-border) !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  transition: border-color 0.2s !important;
}

.xoo-wsc-qtybox:hover,
.xoo-wsc-qtybox:focus-within {
  border-color: var(--wsc-accent) !important;
}

.xoo-wsc-qtybox input,
.xoo-wsc-qty input {
  background: var(--wsc-bg-card) !important;
  color: var(--wsc-text-primary) !important;
  border: none !important;
  font-weight: 600 !important;
}

.xoo-wsc-qtybox .xoo-wsc-qtybtn {
  background: var(--wsc-bg-body) !important;
  color: var(--wsc-text-secondary) !important;
  font-weight: 700 !important;
  transition: all 0.15s !important;
  border: none !important;
}

.xoo-wsc-qtybox .xoo-wsc-qtybtn:hover {
  background: var(--wsc-accent-glow) !important;
  color: var(--wsc-accent) !important;
}


/* â•â•â• 7. SCROLLBAR â•â•â• */
.xoo-wsc-body::-webkit-scrollbar { width: 5px; }
.xoo-wsc-body::-webkit-scrollbar-track { background: transparent; }
.xoo-wsc-body::-webkit-scrollbar-thumb {
  background: var(--wsc-border);
  border-radius: 10px;
}
.xoo-wsc-body::-webkit-scrollbar-thumb:hover {
  background: var(--wsc-text-muted);
}


/* â•â•â• 8. FOOTER â•â•â• */
.xoo-wsc-footer {
  background: var(--wsc-bg-footer) !important;
  border-top: 1px solid var(--wsc-border) !important;
  padding: 20px 24px !important;
  box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.04) !important;
}

[data-theme="dark"] .xoo-wsc-footer {
  box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2) !important;
}

.xoo-wsc-ft-totals-row {
  padding: 6px 0 !important;
  color: var(--wsc-text-primary) !important;
}

.xoo-wsc-ft-totals-row:last-child {
  font-weight: 700 !important;
  font-size: 1.1rem !important;
  padding-top: 12px !important;
  border-top: 1px solid var(--wsc-border) !important;
}

.xoo-wsc-ft-amt,
.xoo-wsc-ft-amt .amount {
  color: var(--wsc-price) !important;
  font-weight: 700 !important;
}

.xoo-wsc-ft-label {
  color: var(--wsc-text-secondary) !important;
}

.xoo-wsc-ft-text {
  font-size: 12px !important;
  color: var(--wsc-text-muted) !important;
  text-align: center !important;
  padding: 8px 0 4px !important;
}


/* â•â•â• 9. BUTTONS â•â•â• */
.xoo-wsc-ft-btn {
  border-radius: 10px !important;
  font-weight: 700 !important;
  font-family: 'Inter', sans-serif !important;
  font-size: 0.95rem !important;
  padding: 14px 24px !important;
  background: var(--wsc-btn-bg) !important;
  color: var(--wsc-btn-text) !important;
  border: none !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  box-shadow: 0 4px 15px var(--wsc-accent-glow) !important;
  text-transform: none !important;
  letter-spacing: 0.2px !important;
}

.xoo-wsc-ft-btn:hover {
  background: var(--wsc-btn-bg-hover) !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 25px var(--wsc-accent-glow) !important;
}

.xoo-wsc-ft-btn:active {
  transform: translateY(0) !important;
}

/* Continue Shopping */
a.xoo-wsc-ft-btn.xoo-wsc-cart-close {
  background: transparent !important;
  color: var(--wsc-text-secondary) !important;
  border: 1.5px solid var(--wsc-border) !important;
  font-size: 0.88rem !important;
  font-weight: 600 !important;
  padding: 11px 20px !important;
  box-shadow: none !important;
}

a.xoo-wsc-ft-btn.xoo-wsc-cart-close:hover {
  border-color: var(--wsc-accent) !important;
  color: var(--wsc-accent) !important;
  background: var(--wsc-accent-glow) !important;
  box-shadow: none !important;
  transform: none !important;
}


/* â•â•â• 10. EMPTY CART â•â•â• */
.xoo-wsc-empty-cart { padding: 60px 30px !important; text-align: center !important; }
.xoo-wsc-ecnt { color: var(--wsc-text-muted) !important; font-size: 1.1rem !important; }


/* â•â•â• 11. COUPON â•â•â• */
.xoo-wsc-coupon-form input {
  border: 1.5px solid var(--wsc-border) !important;
  border-radius: 8px !important;
  padding: 10px 14px !important;
  background: var(--wsc-bg-card) !important;
  color: var(--wsc-text-primary) !important;
  transition: border-color 0.2s !important;
}

.xoo-wsc-coupon-form input:focus {
  border-color: var(--wsc-accent) !important;
  outline: none !important;
  box-shadow: 0 0 0 3px var(--wsc-accent-glow) !important;
}

.xoo-wsc-coupon-form button {
  background: var(--wsc-btn-bg) !important;
  color: var(--wsc-btn-text) !important;
  border-radius: 8px !important;
  border: none !important;
  font-weight: 600 !important;
}

.xoo-wsc-coupon-label,
.xoo-wsc-coupon-form label {
  color: var(--wsc-text-secondary) !important;
}


/* â•â•â• 12. SUGGESTED PRODUCTS â•â•â• */
.xoo-wsc-sp-container {
  border-top: 1px solid var(--wsc-border) !important;
  background: var(--wsc-bg-body) !important;
}

.xoo-wsc-sp-heading {
  font-weight: 700 !important;
  color: var(--wsc-text-primary) !important;
}

.xoo-wsc-sp-product {
  border-radius: 10px !important;
  background: var(--wsc-bg-card) !important;
  border: 1px solid var(--wsc-border) !important;
  transition: all 0.25s ease !important;
}

.xoo-wsc-sp-product:hover {
  border-color: var(--wsc-accent) !important;
  transform: translateY(-2px) !important;
  box-shadow: var(--wsc-shadow) !important;
}

.xoo-wsc-sp-product .xoo-wsc-sp-title,
.xoo-wsc-sp-product a {
  color: var(--wsc-text-primary) !important;
  font-weight: 600 !important;
  font-size: 0.85rem !important;
}

.xoo-wsc-sp-product .xoo-wsc-sp-price,
.xoo-wsc-sp-product .amount {
  color: var(--wsc-price) !important;
  font-weight: 700 !important;
}

.xoo-wsc-sp-product .xoo-wsc-sp-price del,
.xoo-wsc-sp-product .xoo-wsc-sp-price del .amount {
  color: var(--wsc-text-muted) !important;
}

.xoo-wsc-sp-product .button {
  background: var(--wsc-btn-bg) !important;
  color: var(--wsc-btn-text) !important;
  border: none !important;
  border-radius: 50px !important;
  font-size: 12px !important;
  font-weight: 700 !important;
  padding: 7px 18px !important;
  transition: all 0.2s ease !important;
}

.xoo-wsc-sp-product .button:hover {
  background: var(--wsc-btn-bg-hover) !important;
  transform: translateY(-1px) !important;
}


/* â•â•â• 13. SAVED FOR LATER â•â•â• */
.xoo-wsc-sl-heading { color: var(--wsc-text-primary) !important; font-weight: 700 !important; }
.xoo-wsc-sl-product {
  background: var(--wsc-bg-card) !important;
  border: 1px solid var(--wsc-border) !important;
  border-radius: 10px !important;
}


/* â•â•â• 14. NOTIFICATIONS â•â•â• 
.xoo-wsc-notice-box .xoo-wsc-notice {
  background: var(--wsc-badge-bg) !important;
  border-left: 3px solid var(--wsc-accent) !important;
  color: var(--wsc-text-primary) !important;
  border-radius: 8px !important;
  font-size: 13px !important;
  padding: 12px 16px !important;
}


/* â•â•â• 15. PROGRESS BAR â•â•â• 
.xoo-wsc-bar-container {
  background: var(--wsc-border) !important;
  border-radius: 20px !important;
}

.xoo-wsc-bar-fill {
  background: var(--wsc-btn-bg) !important;
  border-radius: 20px !important;
  transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.xoo-wsc-bar-text { color: var(--wsc-text-primary) !important; font-weight: 600 !important; }


/* â•â•â• 16. FLOATING BASKET â•â•â• 
.xoo-wsc-basket {
  background: var(--wsc-bg-card) !important;
  border: 1px solid var(--wsc-border) !important;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12) !important;
  transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
}

.xoo-wsc-basket:hover {
  transform: scale(1.08) !important;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18) !important;
}

.xoo-wsc-items-count:not(:empty) {
  animation: wsc-pulse 2s ease-in-out infinite !important;
}

@keyframes wsc-pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.12); }
}


/* â•â•â• 17. MOBILE â•â•â• 
@media (max-width: 768px) {
  .xoo-wsc-container { width: 100vw !important; max-width: 100vw !important; }
  .xoo-wsc-product:hover { transform: none !important; }
  .xoo-wsc-ft-btn { font-size: 15px !important; padding: 15px 20px !important; }
}

/* === 17. MOBILE === */
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
    padding: 15px 20px !important;
  }
}

/* =============================================
   18. DARK MODE — EXPLICIT OVERRIDES
   Hardcoded colors for elements that don't
   inherit CSS variables due to plugin inline
   styles or specificity issues.
   ============================================= */

/* -- Suggested Products Drawer (Cross-sell) -- */
[data-theme="dark"] .xoo-wsc-dr-sp,
[data-theme="dark"] .xoo-wsc-sp-container {
  background: #0d1117 !important;
  border-color: #30363d !important;
}

[data-theme="dark"] .xoo-wsc-sp-hd,
[data-theme="dark"] .xoo-wsc-sp-head {
  background: #161b22 !important;
  border-bottom: 1px solid #30363d !important;
}

[data-theme="dark"] .xoo-wsc-sp-hd-txt,
[data-theme="dark"] .xoo-wsc-sp-heading {
  color: #f0f0f0 !important;
}

[data-theme="dark"] .xoo-wsc-sp-hd .xoo-wsc-sp-arrow,
[data-theme="dark"] .xoo-wsc-sp-head i {
  color: #c9d1d9 !important;
}

[data-theme="dark"] .xoo-wsc-sp-product {
  background: #161b22 !important;
  border: 1px solid #30363d !important;
}

[data-theme="dark"] .xoo-wsc-sp-product:hover {
  border-color: #4ade80 !important;
}

[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-title,
[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-title a,
[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-pname,
[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-pname a,
[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-pname span,
[data-theme="dark"] .xoo-wsc-sp-product a {
  color: #e6e1db !important;
}

[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price,
[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price .amount,
[data-theme="dark"] .xoo-wsc-sp-product .amount {
  color: #4ade80 !important;
}

[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price del,
[data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price del .amount {
  color: #7d8590 !important;
}

[data-theme="dark"] .xoo-wsc-sp-product .button,
[data-theme="dark"] .xoo-wsc-sp-product .add_to_cart_button {
  background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
  color: #0d1210 !important;
}

/* -- Product names (span + a + wrappers) -- */
[data-theme="dark"] .xoo-wsc-pname,
[data-theme="dark"] .xoo-wsc-pname a,
[data-theme="dark"] .xoo-wsc-pname span,
[data-theme="dark"] .xoo-wsc-pname > * {
  color: #f0f0f0 !important;
}

[data-theme="dark"] .xoo-wsc-pname a:hover,
[data-theme="dark"] .xoo-wsc-pname span:hover {
  color: #4ade80 !important;
}

/* -- Product Price (all wrappers) -- */
[data-theme="dark"] .xoo-wsc-pprice,
[data-theme="dark"] .xoo-wsc-pprice span,
[data-theme="dark"] .xoo-wsc-pprice .amount {
  color: #c9d1d9 !important;
}

[data-theme="dark"] .xoo-wsc-pprice del,
[data-theme="dark"] .xoo-wsc-pprice del .amount {
  color: #7d8590 !important;
}

[data-theme="dark"] .xoo-wsc-ptotal,
[data-theme="dark"] .xoo-wsc-ptotal span,
[data-theme="dark"] .xoo-wsc-ptotal .amount {
  color: #4ade80 !important;
}

/* -- Container & Body explicit -- */
[data-theme="dark"] .xoo-wsc-container {
  background: #0d1117 !important;
  border-left: 1px solid #30363d !important;
  box-shadow: -10px 0 50px rgba(0, 0, 0, 0.5) !important;
}

[data-theme="dark"] .xoo-wsc-body {
  background: #0d1117 !important;
}

[data-theme="dark"] .xoo-wsc-header {
  background: linear-gradient(135deg, #161b22 0%, #1c2128 100%) !important;
  border-bottom: 1px solid #30363d !important;
}

[data-theme="dark"] .xoo-wsc-heading,
[data-theme="dark"] .xoo-wsc-header span,
[data-theme="dark"] .xoo-wsc-header .xoo-wsc-ctxt {
  color: #f0f0f0 !important;
}

/* -- Product cards explicit -- */
[data-theme="dark"] .xoo-wsc-product {
  background: #161b22 !important;
  border-color: #30363d !important;
}

[data-theme="dark"] .xoo-wsc-product:hover {
  border-color: #4ade80 !important;
}

[data-theme="dark"] .xoo-wsc-img-col img {
  border-color: #30363d !important;
}

/* -- Quantity -- */
[data-theme="dark"] .xoo-wsc-qtybox {
  border-color: #30363d !important;
}

[data-theme="dark"] .xoo-wsc-qtybox input,
[data-theme="dark"] .xoo-wsc-qty input {
  background: #161b22 !important;
  color: #f0f0f0 !important;
}

[data-theme="dark"] .xoo-wsc-qtybox .xoo-wsc-qtybtn {
  background: #0d1117 !important;
  color: #c9d1d9 !important;
}

[data-theme="dark"] .xoo-wsc-qtybox .xoo-wsc-qtybtn:hover {
  background: rgba(74, 222, 128, 0.12) !important;
  color: #4ade80 !important;
}

/* -- Footer -- */
[data-theme="dark"] .xoo-wsc-footer {
  background: #161b22 !important;
  border-top: 1px solid #30363d !important;
}

[data-theme="dark"] .xoo-wsc-ft-totals-row,
[data-theme="dark"] .xoo-wsc-ft-totals-row span,
[data-theme="dark"] .xoo-wsc-ft-label {
  color: #e6e1db !important;
}

[data-theme="dark"] .xoo-wsc-ft-amt,
[data-theme="dark"] .xoo-wsc-ft-amt .amount,
[data-theme="dark"] .xoo-wsc-ft-amt span {
  color: #4ade80 !important;
}

/* -- Coupon & info texts -- */
[data-theme="dark"] .xoo-wsc-coupon-trigger,
[data-theme="dark"] .xoo-wsc-coupon-label,
[data-theme="dark"] .xoo-wsc-coupon-form label {
  color: #c9d1d9 !important;
}

[data-theme="dark"] .xoo-wsc-coupon-form input {
  background: #161b22 !important;
  border-color: #30363d !important;
  color: #f0f0f0 !important;
}

[data-theme="dark"] .xoo-wsc-coupon-form button {
  background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
  color: #0d1210 !important;
}

/* -- Footer info, payment, shipping -- */
[data-theme="dark"] .xoo-wsc-ft-text,
[data-theme="dark"] .xoo-wsc-footer-info,
[data-theme="dark"] .xoo-wsc-footer p,
[data-theme="dark"] .xoo-wsc-footer span:not(.amount) {
  color: #7d8590 !important;
}

/* -- Savings badge -- */
[data-theme="dark"] .xoo-wsc-ptotal-save,
[data-theme="dark"] .xoo-wsc-pprice-save {
  background: rgba(74, 222, 128, 0.12) !important;
  color: #4ade80 !important;
}

/* -- Notifications -- */
[data-theme="dark"] .xoo-wsc-notice-box .xoo-wsc-notice {
  background: rgba(74, 222, 128, 0.1) !important;
  border-left-color: #4ade80 !important;
  color: #e6e1db !important;
}

/* -- Progress bar -- */
[data-theme="dark"] .xoo-wsc-bar-container {
  background: #30363d !important;
}

[data-theme="dark"] .xoo-wsc-bar-fill {
  background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
}

[data-theme="dark"] .xoo-wsc-bar-text,
[data-theme="dark"] .xoo-wsc-bar-text span {
  color: #e6e1db !important;
}

/* -- Empty cart -- */
[data-theme="dark"] .xoo-wsc-empty-cart,
[data-theme="dark"] .xoo-wsc-ecnt {
  color: #7d8590 !important;
}

/* -- Delete icon -- */
[data-theme="dark"] .xoo-wsc-pdel,
[data-theme="dark"] .xoo-wsc-icon-del {
  color: #7d8590 !important;
}

[data-theme="dark"] .xoo-wsc-product:hover .xoo-wsc-pdel,
[data-theme="dark"] .xoo-wsc-icon-del:hover {
  color: #f87171 !important;
}

/* -- Buttons -- */
[data-theme="dark"] .xoo-wsc-ft-btn {
  background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%) !important;
  color: #0d1210 !important;
  box-shadow: 0 4px 15px rgba(74, 222, 128, 0.12) !important;
}

[data-theme="dark"] .xoo-wsc-ft-btn:hover {
  background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
  box-shadow: 0 6px 25px rgba(74, 222, 128, 0.2) !important;
}

[data-theme="dark"] a.xoo-wsc-ft-btn.xoo-wsc-cart-close {
  background: transparent !important;
  color: #c9d1d9 !important;
  border-color: #30363d !important;
}

[data-theme="dark"] a.xoo-wsc-ft-btn.xoo-wsc-cart-close:hover {
  color: #4ade80 !important;
  border-color: #4ade80 !important;
  background: rgba(74, 222, 128, 0.06) !important;
}

/* -- Scrollbar -- */
[data-theme="dark"] .xoo-wsc-body::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
}

[data-theme="dark"] .xoo-wsc-body::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}

/* -- Floating basket -- */
[data-theme="dark"] .xoo-wsc-basket {
  background: #161b22 !important;
  border-color: #30363d !important;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4) !important;
}

/* -- Saved for later -- */
[data-theme="dark"] .xoo-wsc-sl-heading {
  color: #f0f0f0 !important;
}
[data-theme="dark"] .xoo-wsc-sl-product {
  background: #161b22 !important;
  border-color: #30363d !important;
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


  /* â”€â”€â”€ 4. REWARDS OPTIONS â”€â”€â”€ */
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
  update_option('libros_sidecart_configured', '6');
});


/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â••â•â•â•â•
   TRUST BADGES DENTRO DEL SIDE CART
   Se inyecta justo antes del footer del side cart
   â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
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
  echo '<span>ðŸ”’ SSL Seguro</span>';
  echo '<span>âš¡ Descarga Inmediata</span>';
  echo '<span>ðŸ›¡ï¸ GarantÃ­a 7 DÃ­as</span>';
  echo '</div>';
});


/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   PERSONALIZAR NOTIFICACIÃ“N AL AGREGAR PRODUCTO
   â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
add_filter('xoo_wsc_add_to_cart_notice', function ($notice, $product_name) {
  return 'âœ… <strong>' . $product_name . '</strong> se agregÃ³ a tu carrito';
}, 10, 2);


/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   CANTIDAD FIJA = 1 PARA EBOOKS DIGITALES
   Los ebooks solo se compran de a 1 unidad,
   pero no vaciamos el carrito (multi-producto OK)
   â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
add_filter('woocommerce_is_sold_individually', function ($individually, $product) {
  if ($product->is_virtual() || $product->is_downloadable()) {
    return true; // Cantidad siempre 1 para digitales
  }
  return $individually;
}, 10, 2);
