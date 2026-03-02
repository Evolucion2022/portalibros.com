<?php
/**
 * Plugin Name: Side Cart Dark Mode Fix
 * Description: Inyecta CSS dark mode directamente al HTML para el Side Cart Premium.
 *              Se ejecuta SIEMPRE en wp_head a prioridad ultra-alta (99999)
 *              para garantizar que sobreescriba cualquier estilo del plugin.
 * Author: PortaLibros
 * Version: 1.0
 */

if (!defined('ABSPATH'))
    exit;

add_action('wp_head', function () {
    // Solo cargar si el plugin Side Cart está activo
    if (!class_exists('Xoo_Wsc_Loader'))
        return;
    ?>
    <style id="sidecart-darkmode-fix">
        /* =============================================
           SIDE CART DARK MODE — Portal de Libros
           Inyectado via wp_head priority 99999
           Sobreescribe TODOS los estilos del plugin
           ============================================= */

        /* -- Container & Body -- */
        [data-theme="dark"] .xoo-wsc-container {
            background: #0D1117 !important;
            border-left: 1px solid #30363D !important;
            box-shadow: -10px 0 50px rgba(0, 0, 0, 0.5) !important;
        }

        [data-theme="dark"] .xoo-wsc-body {
            background: #0D1117 !important;
        }

        [data-theme="dark"] .xoo-wsc-overlay {
            background: rgba(0, 0, 0, 0.65) !important;
            backdrop-filter: blur(6px) !important;
        }

        /* -- Header -- */
        [data-theme="dark"] .xoo-wsc-header {
            background: linear-gradient(135deg, #161B22 0%, #1C2128 100%) !important;
            border-bottom: 1px solid #30363D !important;
        }

        [data-theme="dark"] .xoo-wsc-heading,
        [data-theme="dark"] .xoo-wsc-header span,
        [data-theme="dark"] .xoo-wsc-header .xoo-wsc-ctxt,
        [data-theme="dark"] .xoo-wsc-header * {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .xoo-wsc-header .xoo-wsc-icon-cross,
        [data-theme="dark"] .xoo-wsc-header i {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* -- Product Cards -- */
        [data-theme="dark"] .xoo-wsc-product {
            background: #161B22 !important;
            border: 1px solid #30363D !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
        }

        [data-theme="dark"] .xoo-wsc-product:hover {
            border-color: #4ADE80 !important;
            box-shadow: 0 4px 16px rgba(74, 222, 128, 0.1) !important;
        }

        /* -- Product Name — ALL possible tags -- */
        [data-theme="dark"] .xoo-wsc-pname,
        [data-theme="dark"] .xoo-wsc-pname *,
        [data-theme="dark"] .xoo-wsc-pname a,
        [data-theme="dark"] .xoo-wsc-pname span {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .xoo-wsc-pname a:hover,
        [data-theme="dark"] .xoo-wsc-pname *:hover {
            color: #4ADE80 !important;
        }

        /* -- Product Price -- */
        [data-theme="dark"] .xoo-wsc-pprice,
        [data-theme="dark"] .xoo-wsc-pprice *,
        [data-theme="dark"] .xoo-wsc-pprice .amount {
            color: #C9D1D9 !important;
        }

        [data-theme="dark"] .xoo-wsc-pprice del,
        [data-theme="dark"] .xoo-wsc-pprice del * {
            color: #7D8590 !important;
        }

        /* -- Product Total -- */
        [data-theme="dark"] .xoo-wsc-ptotal,
        [data-theme="dark"] .xoo-wsc-ptotal *,
        [data-theme="dark"] .xoo-wsc-ptotal .amount {
            color: #4ADE80 !important;
        }

        /* -- Savings Badge -- */
        [data-theme="dark"] .xoo-wsc-ptotal-save,
        [data-theme="dark"] .xoo-wsc-pprice-save {
            background: rgba(74, 222, 128, 0.12) !important;
            color: #4ADE80 !important;
        }

        /* -- Product Image -- */
        [data-theme="dark"] .xoo-wsc-img-col img {
            border: 1px solid #30363D !important;
        }

        /* -- Delete Icon -- */
        [data-theme="dark"] .xoo-wsc-pdel,
        [data-theme="dark"] .xoo-wsc-icon-del {
            color: #7D8590 !important;
        }

        [data-theme="dark"] .xoo-wsc-product:hover .xoo-wsc-pdel,
        [data-theme="dark"] .xoo-wsc-icon-del:hover {
            color: #F87171 !important;
        }

        /* -- Quantity Controls -- */
        [data-theme="dark"] .xoo-wsc-qtybox {
            border-color: #30363D !important;
        }

        [data-theme="dark"] .xoo-wsc-qtybox:hover,
        [data-theme="dark"] .xoo-wsc-qtybox:focus-within {
            border-color: #4ADE80 !important;
        }

        [data-theme="dark"] .xoo-wsc-qtybox input,
        [data-theme="dark"] .xoo-wsc-qty input {
            background: #161B22 !important;
            color: #F0F0F0 !important;
            border: none !important;
        }

        [data-theme="dark"] .xoo-wsc-qtybox .xoo-wsc-qtybtn {
            background: #0D1117 !important;
            color: #C9D1D9 !important;
        }

        [data-theme="dark"] .xoo-wsc-qtybox .xoo-wsc-qtybtn:hover {
            background: rgba(74, 222, 128, 0.12) !important;
            color: #4ADE80 !important;
        }

        /* -- Product Meta -- */
        [data-theme="dark"] .xoo-wsc-pmeta,
        [data-theme="dark"] .xoo-wsc-pvar {
            color: #7D8590 !important;
        }


        /* ============================================
           SUGGESTED PRODUCTS DRAWER (Cross-sell)
           ============================================ */
        [data-theme="dark"] .xoo-wsc-dr-sp {
            background: #0D1117 !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-container {
            background: #0D1117 !important;
            border-color: #30363D !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-hd,
        [data-theme="dark"] .xoo-wsc-sp-head {
            background: #161B22 !important;
            border-bottom: 1px solid #30363D !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-hd-txt,
        [data-theme="dark"] .xoo-wsc-sp-heading,
        [data-theme="dark"] .xoo-wsc-sp-hd * {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product {
            background: #161B22 !important;
            border: 1px solid #30363D !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product:hover {
            border-color: #4ADE80 !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-title,
        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-title *,
        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-pname,
        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-pname *,
        [data-theme="dark"] .xoo-wsc-sp-product a {
            color: #E6E1DB !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price,
        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price *,
        [data-theme="dark"] .xoo-wsc-sp-product .amount {
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price del,
        [data-theme="dark"] .xoo-wsc-sp-product .xoo-wsc-sp-price del * {
            color: #7D8590 !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product .button,
        [data-theme="dark"] .xoo-wsc-sp-product .add_to_cart_button {
            background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%) !important;
            color: #0D1210 !important;
            border: none !important;
        }

        [data-theme="dark"] .xoo-wsc-sp-product .button:hover {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%) !important;
        }


        /* ============================================
           FOOTER
           ============================================ */
        [data-theme="dark"] .xoo-wsc-footer {
            background: #161B22 !important;
            border-top: 1px solid #30363D !important;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2) !important;
        }

        [data-theme="dark"] .xoo-wsc-ft-totals-row,
        [data-theme="dark"] .xoo-wsc-ft-totals-row *,
        [data-theme="dark"] .xoo-wsc-ft-label {
            color: #E6E1DB !important;
        }

        [data-theme="dark"] .xoo-wsc-ft-amt,
        [data-theme="dark"] .xoo-wsc-ft-amt *,
        [data-theme="dark"] .xoo-wsc-ft-amt .amount {
            color: #4ADE80 !important;
        }

        /* -- Coupon & Info texts -- */
        [data-theme="dark"] .xoo-wsc-coupon-trigger,
        [data-theme="dark"] .xoo-wsc-coupon-label,
        [data-theme="dark"] .xoo-wsc-coupon-form label {
            color: #C9D1D9 !important;
        }

        [data-theme="dark"] .xoo-wsc-coupon-form input {
            background: #161B22 !important;
            border-color: #30363D !important;
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .xoo-wsc-coupon-form input:focus {
            border-color: #4ADE80 !important;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.15) !important;
        }

        [data-theme="dark"] .xoo-wsc-coupon-form button {
            background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%) !important;
            color: #0D1210 !important;
        }

        /* -- Footer texts (payment badge, shipping, etc) -- */
        [data-theme="dark"] .xoo-wsc-ft-text,
        [data-theme="dark"] .xoo-wsc-footer-info,
        [data-theme="dark"] .xoo-wsc-footer p,
        [data-theme="dark"] .xoo-wsc-footer span:not(.amount):not(.xoo-wsc-ft-amt) {
            color: #7D8590 !important;
        }


        /* ============================================
           BUTTONS
           ============================================ */
        [data-theme="dark"] .xoo-wsc-ft-btn {
            background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%) !important;
            color: #0D1210 !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(74, 222, 128, 0.12) !important;
        }

        [data-theme="dark"] .xoo-wsc-ft-btn:hover {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%) !important;
            box-shadow: 0 6px 25px rgba(74, 222, 128, 0.2) !important;
        }

        [data-theme="dark"] a.xoo-wsc-ft-btn.xoo-wsc-cart-close {
            background: transparent !important;
            color: #C9D1D9 !important;
            border: 1.5px solid #30363D !important;
            box-shadow: none !important;
        }

        [data-theme="dark"] a.xoo-wsc-ft-btn.xoo-wsc-cart-close:hover {
            color: #4ADE80 !important;
            border-color: #4ADE80 !important;
            background: rgba(74, 222, 128, 0.06) !important;
        }


        /* ============================================
           MISC
           ============================================ */

        /* Notifications */
        [data-theme="dark"] .xoo-wsc-notice-box .xoo-wsc-notice {
            background: rgba(74, 222, 128, 0.1) !important;
            border-left: 3px solid #4ADE80 !important;
            color: #E6E1DB !important;
        }

        /* Progress bar */
        [data-theme="dark"] .xoo-wsc-bar-container {
            background: #30363D !important;
        }

        [data-theme="dark"] .xoo-wsc-bar-fill {
            background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%) !important;
        }

        [data-theme="dark"] .xoo-wsc-bar-text,
        [data-theme="dark"] .xoo-wsc-bar-text * {
            color: #E6E1DB !important;
        }

        /* Empty cart */
        [data-theme="dark"] .xoo-wsc-empty-cart,
        [data-theme="dark"] .xoo-wsc-ecnt {
            color: #7D8590 !important;
        }

        /* Floating basket */
        [data-theme="dark"] .xoo-wsc-basket {
            background: #161B22 !important;
            border-color: #30363D !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4) !important;
        }

        /* Scrollbar */
        [data-theme="dark"] .xoo-wsc-body::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .xoo-wsc-body::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Saved for later */
        [data-theme="dark"] .xoo-wsc-sl-heading {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .xoo-wsc-sl-product {
            background: #161B22 !important;
            border-color: #30363D !important;
        }
    </style>
    <?php
}, 99999);
