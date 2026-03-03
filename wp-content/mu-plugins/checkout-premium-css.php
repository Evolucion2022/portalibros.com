<?php
/**
 * Plugin Name: Checkout Premium Design
 * Description: CSS premium para la pagina de checkout. Light + Dark mode.
 * Version: 1.0
 */
if (!defined('ABSPATH'))
    exit;

add_action('wp_head', function () {
    if (!function_exists('is_checkout') || !is_checkout())
        return;
    ?>
    <style id="checkout-premium-css">
        /* ==============================================
           CHECKOUT PREMIUM — PortaLibros.com
           ============================================== */

        /* -- Page wrapper -- */
        .woocommerce-checkout {
            max-width: 1100px !important;
            margin: 0 auto !important;
            padding: 30px 20px !important;
        }


        /* ==============================================
           1. PRODUCT SUMMARY BANNER (top bar)
           ============================================== */
        .checkout-summary-banner {
            background: linear-gradient(135deg, #f8fdf9 0%, #eef7f0 100%) !important;
            border: 1px solid rgba(60, 179, 113, 0.15) !important;
            border-radius: 16px !important;
            padding: 24px !important;
            margin-bottom: 28px !important;
            box-shadow: 0 4px 20px rgba(26, 60, 64, 0.06) !important;
        }

        .checkout-summary-banner__inner {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 20px !important;
            align-items: flex-start !important;
        }

        .checkout-summary-banner__item {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            background: #fff !important;
            border: 1px solid rgba(26, 60, 64, 0.08) !important;
            border-radius: 12px !important;
            padding: 12px 16px !important;
            flex: 0 0 auto !important;
            min-width: 180px !important;
            transition: all 0.25s ease !important;
        }

        .checkout-summary-banner__item:hover {
            border-color: rgba(60, 179, 113, 0.3) !important;
            box-shadow: 0 2px 12px rgba(60, 179, 113, 0.1) !important;
        }

        .checkout-summary-banner__image img {
            width: 64px !important;
            height: 64px !important;
            object-fit: cover !important;
            border-radius: 10px !important;
            border: 1px solid rgba(26, 60, 64, 0.08) !important;
        }

        .checkout-summary-banner__title {
            font-family: 'Inter', sans-serif !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #1A3C40 !important;
            margin: 0 0 2px 0 !important;
            line-height: 1.3 !important;
            max-width: 140px !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
        }

        .checkout-summary-banner__qty {
            font-size: 11px !important;
            color: #6B7D80 !important;
            margin: 0 !important;
        }

        .checkout-summary-banner__price {
            font-size: 16px !important;
            font-weight: 700 !important;
            color: #14532D !important;
            margin: 4px 0 0 0 !important;
        }

        .checkout-summary-banner__total {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin-left: auto !important;
            padding: 16px 20px !important;
            background: linear-gradient(135deg, #14532D, #1A6B3A) !important;
            border-radius: 12px !important;
            color: #fff !important;
        }

        .checkout-summary-banner__total p {
            font-size: 18px !important;
            font-weight: 700 !important;
            color: #fff !important;
            margin: 0 !important;
        }

        .checkout-summary-banner__meta {
            font-size: 12px !important;
            color: #6B7D80 !important;
            text-align: center !important;
            margin: 12px 0 0 0 !important;
            padding: 0 !important;
        }


        /* ==============================================
           2. COUPON BAR
           ============================================== */
        .woocommerce-form-coupon-toggle .woocommerce-info {
            background: #f8fdf9 !important;
            border: 1px solid rgba(60, 179, 113, 0.2) !important;
            border-radius: 12px !important;
            padding: 14px 20px !important;
            color: #1A3C40 !important;
            font-size: 14px !important;
        }

        .woocommerce-form-coupon-toggle .woocommerce-info a {
            color: #14532D !important;
            font-weight: 600 !important;
        }

        .woocommerce-form-coupon-toggle .woocommerce-info::before {
            color: #3CB371 !important;
        }

        .checkout_coupon {
            border: 1px solid rgba(60, 179, 113, 0.2) !important;
            border-radius: 12px !important;
            padding: 20px !important;
            background: #f8fdf9 !important;
        }


        /* ==============================================
           3. FORM — "Tus Datos"
           ============================================== */
        #customer_details h3,
        .woocommerce-billing-fields h3 {
            font-family: 'Inter', sans-serif !important;
            font-size: 20px !important;
            font-weight: 700 !important;
            color: #1A3C40 !important;
            margin-bottom: 20px !important;
            padding-bottom: 12px !important;
            border-bottom: 2px solid rgba(60, 179, 113, 0.15) !important;
        }

        .woocommerce-checkout .form-row {
            margin-bottom: 16px !important;
        }

        .woocommerce-checkout .form-row label {
            font-family: 'Inter', sans-serif !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #1A3C40 !important;
            margin-bottom: 6px !important;
        }

        .woocommerce-checkout .form-row input.input-text,
        .woocommerce-checkout .form-row textarea,
        .woocommerce-checkout .form-row select {
            border: 1.5px solid #D1D9DB !important;
            border-radius: 10px !important;
            padding: 12px 16px !important;
            font-size: 14px !important;
            font-family: 'Inter', sans-serif !important;
            color: #1A3C40 !important;
            background: #fff !important;
            transition: all 0.25s ease !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        }

        .woocommerce-checkout .form-row input.input-text:focus,
        .woocommerce-checkout .form-row textarea:focus,
        .woocommerce-checkout .form-row select:focus {
            border-color: #3CB371 !important;
            box-shadow: 0 0 0 3px rgba(60, 179, 113, 0.12) !important;
            outline: none !important;
        }

        .woocommerce-checkout .form-row input.input-text::placeholder {
            color: #A0B0B3 !important;
        }

        .woocommerce-checkout .form-row .required {
            color: #E53E3E !important;
        }


        /* ==============================================
           4. ORDER REVIEW — "Tu Pedido"
           ============================================== */
        #order_review_heading,
        .woocommerce-checkout h3#order_review_heading {
            font-family: 'Inter', sans-serif !important;
            font-size: 20px !important;
            font-weight: 700 !important;
            color: #1A3C40 !important;
            margin-bottom: 16px !important;
            padding-bottom: 12px !important;
            border-bottom: 2px solid rgba(60, 179, 113, 0.15) !important;
        }

        .woocommerce-checkout-review-order-table {
            border: 1px solid #E8F5E9 !important;
            border-radius: 14px !important;
            overflow: hidden !important;
            box-shadow: 0 2px 12px rgba(26, 60, 64, 0.04) !important;
        }

        .woocommerce-checkout-review-order-table th,
        .woocommerce-checkout-review-order-table td {
            padding: 14px 18px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 14px !important;
            color: #1A3C40 !important;
            border-bottom: 1px solid #E8F5E9 !important;
        }

        .woocommerce-checkout-review-order-table thead th {
            background: #f0f9f2 !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            color: #14532D !important;
        }

        .woocommerce-checkout-review-order-table .cart_item td {
            background: #fff !important;
        }

        .woocommerce-checkout-review-order-table .order-total td,
        .woocommerce-checkout-review-order-table .order-total th {
            font-size: 18px !important;
            font-weight: 700 !important;
            color: #14532D !important;
            background: #f0f9f2 !important;
        }

        .woocommerce-checkout-review-order-table .order-total .amount {
            color: #14532D !important;
            font-size: 22px !important;
        }

        .woocommerce-checkout-review-order-table .amount {
            font-weight: 600 !important;
            color: #1A3C40 !important;
        }


        /* ==============================================
           5. TRUST BADGES
           ============================================== */
        .checkout-trust-badges {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 10px !important;
            justify-content: center !important;
            margin: 20px 0 !important;
            padding: 16px !important;
            background: #f8fdf9 !important;
            border-radius: 12px !important;
            border: 1px solid rgba(60, 179, 113, 0.12) !important;
        }

        .checkout-trust-badges .trust-badge {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            padding: 8px 14px !important;
            background: #fff !important;
            border-radius: 8px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            color: #14532D !important;
            border: 1px solid rgba(60, 179, 113, 0.15) !important;
        }

        .checkout-reassurance {
            text-align: center !important;
            margin: 12px 0 !important;
        }

        .checkout-reassurance p {
            font-size: 12px !important;
            color: #6B7D80 !important;
            margin: 0 !important;
        }


        /* ==============================================
           6. PAYMENT BUTTON
           ============================================== */
        #place_order {
            background: linear-gradient(135deg, #14532D 0%, #1A6B3A 100%) !important;
            color: #fff !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 16px 32px !important;
            font-size: 17px !important;
            font-weight: 700 !important;
            font-family: 'Inter', sans-serif !important;
            letter-spacing: 0.3px !important;
            width: 100% !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 20px rgba(20, 83, 45, 0.2) !important;
        }

        #place_order:hover {
            background: linear-gradient(135deg, #1A6B3A 0%, #22804A 100%) !important;
            box-shadow: 0 6px 30px rgba(20, 83, 45, 0.3) !important;
            transform: translateY(-1px) !important;
        }


        /* ==============================================
           7. PAYMENT METHODS
           ============================================== */
        .wc_payment_methods {
            list-style: none !important;
            padding: 0 !important;
        }

        .wc_payment_method {
            border: 1px solid #E8F5E9 !important;
            border-radius: 12px !important;
            margin-bottom: 10px !important;
            padding: 14px 18px !important;
            background: #fff !important;
            transition: all 0.2s ease !important;
        }

        .wc_payment_method:hover,
        .wc_payment_method.wc_payment_method_active {
            border-color: #3CB371 !important;
            box-shadow: 0 2px 8px rgba(60, 179, 113, 0.1) !important;
        }

        .wc_payment_method label {
            font-weight: 600 !important;
            color: #1A3C40 !important;
            font-size: 14px !important;
        }

        .payment_box {
            background: #f8fdf9 !important;
            border-radius: 8px !important;
            padding: 14px !important;
            margin-top: 10px !important;
            font-size: 13px !important;
            color: #4A6B6E !important;
        }


        /* ==============================================
           8. WOOCOMMERCE NOTICES
           ============================================== */
        .woocommerce-error,
        .woocommerce-message,
        .woocommerce-info {
            border-radius: 12px !important;
            padding: 14px 20px !important;
            font-size: 14px !important;
        }

        .woocommerce-error {
            border-left-color: #E53E3E !important;
        }

        .woocommerce-message {
            border-left-color: #3CB371 !important;
        }


        /* ==============================================
           9. MOBILE
           ============================================== */
        @media (max-width: 768px) {
            .checkout-summary-banner__inner {
                flex-direction: column !important;
            }

            .checkout-summary-banner__item {
                min-width: 100% !important;
            }

            .checkout-summary-banner__total {
                margin-left: 0 !important;
                width: 100% !important;
                justify-content: center !important;
            }
        }


        /* ==============================================
           10. DARK MODE
           ============================================== */

        /* -- Page background -- */
        [data-theme="dark"] .woocommerce-checkout {
            color: #E6E1DB !important;
        }

        /* -- Summary banner -- */
        [data-theme="dark"] .checkout-summary-banner {
            background: linear-gradient(135deg, #161B22 0%, #1C2128 100%) !important;
            border-color: #30363D !important;
        }

        [data-theme="dark"] .checkout-summary-banner__item {
            background: #0D1117 !important;
            border-color: #30363D !important;
        }

        [data-theme="dark"] .checkout-summary-banner__item:hover {
            border-color: #4ADE80 !important;
        }

        [data-theme="dark"] .checkout-summary-banner__title {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .checkout-summary-banner__qty {
            color: #7D8590 !important;
        }

        [data-theme="dark"] .checkout-summary-banner__price {
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .checkout-summary-banner__total {
            background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%) !important;
        }

        [data-theme="dark"] .checkout-summary-banner__total p {
            color: #0D1210 !important;
        }

        [data-theme="dark"] .checkout-summary-banner__meta {
            color: #7D8590 !important;
        }

        [data-theme="dark"] .checkout-summary-banner__image img {
            border-color: #30363D !important;
        }

        /* -- Coupon -- */
        [data-theme="dark"] .woocommerce-form-coupon-toggle .woocommerce-info {
            background: #161B22 !important;
            border-color: #30363D !important;
            color: #C9D1D9 !important;
        }

        [data-theme="dark"] .woocommerce-form-coupon-toggle .woocommerce-info a {
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .checkout_coupon {
            background: #161B22 !important;
            border-color: #30363D !important;
        }

        /* -- Form fields -- */
        [data-theme="dark"] #customer_details h3,
        [data-theme="dark"] .woocommerce-billing-fields h3 {
            color: #F0F0F0 !important;
            border-bottom-color: #30363D !important;
        }

        [data-theme="dark"] .woocommerce-checkout .form-row label {
            color: #C9D1D9 !important;
        }

        [data-theme="dark"] .woocommerce-checkout .form-row input.input-text,
        [data-theme="dark"] .woocommerce-checkout .form-row textarea,
        [data-theme="dark"] .woocommerce-checkout .form-row select {
            background: #0D1117 !important;
            border-color: #30363D !important;
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .woocommerce-checkout .form-row input.input-text:focus,
        [data-theme="dark"] .woocommerce-checkout .form-row textarea:focus {
            border-color: #4ADE80 !important;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.15) !important;
        }

        [data-theme="dark"] .woocommerce-checkout .form-row input.input-text::placeholder {
            color: #484F58 !important;
        }

        /* -- Order review -- */
        [data-theme="dark"] #order_review_heading {
            color: #F0F0F0 !important;
            border-bottom-color: #30363D !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table {
            border-color: #30363D !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table th,
        [data-theme="dark"] .woocommerce-checkout-review-order-table td {
            color: #C9D1D9 !important;
            border-bottom-color: #30363D !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table thead th {
            background: #161B22 !important;
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table .cart_item td {
            background: #0D1117 !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table .order-total td,
        [data-theme="dark"] .woocommerce-checkout-review-order-table .order-total th {
            background: #161B22 !important;
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table .order-total .amount {
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .woocommerce-checkout-review-order-table .amount {
            color: #C9D1D9 !important;
        }

        /* -- Trust badges -- */
        [data-theme="dark"] .checkout-trust-badges {
            background: #161B22 !important;
            border-color: #30363D !important;
        }

        [data-theme="dark"] .checkout-trust-badges .trust-badge {
            background: #0D1117 !important;
            border-color: #30363D !important;
            color: #C9D1D9 !important;
        }

        [data-theme="dark"] .checkout-reassurance p {
            color: #7D8590 !important;
        }

        /* -- Payment methods -- */
        [data-theme="dark"] .wc_payment_method {
            background: #161B22 !important;
            border-color: #30363D !important;
        }

        [data-theme="dark"] .wc_payment_method:hover,
        [data-theme="dark"] .wc_payment_method.wc_payment_method_active {
            border-color: #4ADE80 !important;
        }

        [data-theme="dark"] .wc_payment_method label {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .payment_box {
            background: #0D1117 !important;
            color: #C9D1D9 !important;
        }

        /* -- Payment button -- */
        [data-theme="dark"] #place_order {
            background: linear-gradient(135deg, #4ADE80 0%, #22C55E 100%) !important;
            color: #0D1210 !important;
            box-shadow: 0 4px 20px rgba(74, 222, 128, 0.15) !important;
        }

        [data-theme="dark"] #place_order:hover {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%) !important;
            box-shadow: 0 6px 30px rgba(74, 222, 128, 0.25) !important;
        }

        /* -- General text -- */
        [data-theme="dark"] .woocommerce-checkout p,
        [data-theme="dark"] .woocommerce-checkout span,
        [data-theme="dark"] .woocommerce-checkout div {
            color: #C9D1D9;
        }

        [data-theme="dark"] .woocommerce-checkout h3 {
            color: #F0F0F0 !important;
        }

        [data-theme="dark"] .woocommerce-checkout a {
            color: #4ADE80 !important;
        }

        [data-theme="dark"] .woocommerce-privacy-policy-text p {
            color: #7D8590 !important;
        }
    </style>
    <?php
}, 99999);
