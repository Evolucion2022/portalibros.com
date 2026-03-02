<?php
/**
 * WooCommerce Session & Cart Fix for LiteSpeed/cPanel Hosting
 *
 * Ensures WooCommerce sessions persist for guest users on
 * LiteSpeed-cached shared hosting (cPanel). Without this,
 * server-level caching strips WC session cookies causing
 * the cart to reset on every add-to-cart.
 *
 * @package LibrosJavired
 */

if (!defined('ABSPATH'))
    exit;


/* ──────────────────────────────────────────────
   1. FORCE WC SESSION INITIALIZATION (EARLY)

   WooCommerce only starts a session after the first
   add-to-cart. On cached pages, the session cookie
   is never set because the cached response doesn't
   include Set-Cookie headers. We force session init
   on EVERY page load for guests.
   ────────────────────────────────────────────── */
add_action('woocommerce_init', function () {
    if (is_admin())
        return;

    if (!WC()->session)
        return;

    // Always ensure guest users have a session cookie
    if (!WC()->session->has_session()) {
        WC()->session->set_customer_session_cookie(true);
    }
}, 1); // Priority 1 — run before everything else


/* ──────────────────────────────────────────────
   2. LITESPEED CACHE EXCLUSIONS

   Tell LiteSpeed to NEVER cache pages for users
   who have WC session/cart cookies. Also excludes
   WC AJAX endpoints entirely.
   ────────────────────────────────────────────── */
add_action('init', function () {
    // If ANY WC cookie exists, this user has a cart/session
    $has_wc_cookie = false;
    if (isset($_COOKIE)) {
        foreach ($_COOKIE as $name => $val) {
            if (
                strpos($name, 'wp_woocommerce_session_') === 0 ||
                strpos($name, 'woocommerce_cart_hash') === 0 ||
                strpos($name, 'woocommerce_items_in_cart') === 0
            ) {
                $has_wc_cookie = true;
                break;
            }
        }
    }

    // Check if this is a WC AJAX request
    $is_wc_ajax = (
        defined('DOING_AJAX') && DOING_AJAX ||
        isset($_GET['wc-ajax']) ||
        strpos($_SERVER['REQUEST_URI'] ?? '', 'wc-ajax=') !== false
    );

    if ($has_wc_cookie || $is_wc_ajax) {
        // Tell LiteSpeed to NOT cache this response
        if (!headers_sent()) {
            header('X-LiteSpeed-Cache-Control: no-cache');
            nocache_headers();
        }

        // Tell LiteSpeed via environment variable
        if (function_exists('litespeed_purge_all')) {
            // LiteSpeed Cache plugin is active — use its API
            do_action('litespeed_control_set_nocache', 'WC session active');
        }

        // Also set via constant for plugins that check it
        if (!defined('DONOTCACHEPAGE')) {
            define('DONOTCACHEPAGE', true);
        }
    }
}, 1);


/* ──────────────────────────────────────────────
   3. ENSURE SESSION COOKIE IS ALWAYS SENT

   WordPress's nocache_headers() can sometimes
   interfere with Set-Cookie. We make sure the
   WC session cookie is always included.
   ────────────────────────────────────────────── */
add_action('wp_loaded', function () {
    if (is_admin())
        return;

    // Remove any cache-related headers that might strip cookies
    add_action('send_headers', function () {
        // Explicitly allow cookies in the response
        if (!headers_sent()) {
            header_remove('Cache-Control');
            header('Cache-Control: no-cache, no-store, must-revalidate, private');
            header('Pragma: no-cache');
            header('Expires: 0');
            header('X-LiteSpeed-Cache-Control: no-cache');
        }
    }, 999);
}, 1);


/* ──────────────────────────────────────────────
   4. HTACCESS CACHE EXCLUSION RULES

   Add LiteSpeed cache exclusion rules via
   htaccess on first run. This tells the server
   to NEVER cache when WC cookies are present.
   ────────────────────────────────────────────── */
add_action('admin_init', function () {
    if (get_option('libros_htaccess_cache_rules_v2'))
        return;

    $htaccess_file = ABSPATH . '.htaccess';
    if (!file_exists($htaccess_file) || !is_writable($htaccess_file))
        return;

    $content = file_get_contents($htaccess_file);

    // Don't add if already present
    if (strpos($content, 'LITESPEED-WC-EXCLUSION') !== false) {
        update_option('libros_htaccess_cache_rules_v2', '1');
        return;
    }

    $rules = <<<'HTACCESS'

# BEGIN LITESPEED-WC-EXCLUSION
# Exclude WooCommerce cart/session users from LiteSpeed cache
<IfModule LiteSpeed>
    RewriteEngine On
    RewriteCond %{HTTP_COOKIE} woocommerce_items_in_cart [OR]
    RewriteCond %{HTTP_COOKIE} wp_woocommerce_session_
    RewriteRule .* - [E=Cache-Control:no-cache]
</IfModule>
# END LITESPEED-WC-EXCLUSION

HTACCESS;

    // Insert before END WordPress
    if (strpos($content, '# END WordPress') !== false) {
        $content = str_replace('# END WordPress', '# END WordPress' . $rules, $content);
    } else {
        $content .= $rules;
    }

    file_put_contents($htaccess_file, $content);
    update_option('libros_htaccess_cache_rules_v2', '1');
});
