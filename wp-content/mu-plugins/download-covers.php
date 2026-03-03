<?php
/**
 * Script temporal: descarga las portadas desde GitHub
 * Se ejecuta UNA VEZ desde admin, descarga las 18 imágenes
 * directamente del repo público de GitHub al servidor.
 * Se auto-desactiva con un flag en DB.
 */

if (!defined('ABSPATH'))
    exit;

add_action('admin_init', function () {
    if (get_option('libros_covers_downloaded') === '1')
        return;
    if (!current_user_can('manage_options'))
        return;

    $base_url = 'https://raw.githubusercontent.com/Evolucion2022/portalibros.com/main/wp-content/uploads/book-covers/';

    $files = array(
        'adiestramiento_canino_1772504297949.png',
        'adolescentes_manual_1772504311613.png',
        'anti_aging_1772504253255.png',
        'aromaterapia_aceites_1772504270139.png',
        'automatizacion_web_ia_1772504409239.png',
        'ayuno_intermitente_1772504338293.png',
        'cabello_radiante_1772504353623.png',
        'cachorros_primeros_meses_1772504386445.png',
        'carpinteria_basica_1772504698180.png',
        'chakras_sanacion_1772504732620.png',
        'cocina_latinoamericana_1772504758338.png',
        'cocina_saludable_1772504893342.png',
        'criptomonedas_inversor_1772504769914.png',
        'desactiva_ansiedad_1772504800981.png',
        'fotografia_celular_1772504866878.png',
        'mentalidad_elite_1772504829842.png',
        'protocolo_exito_1772504815572.png',
        'trading_estrategias_1772504878235.png',
    );

    // Crear directorio de destino
    $dest_dir = WP_CONTENT_DIR . '/uploads/book-covers/';
    if (!is_dir($dest_dir)) {
        wp_mkdir_p($dest_dir);
    }

    $downloaded = 0;
    $errors = array();

    foreach ($files as $filename) {
        $dest_path = $dest_dir . $filename;

        // No re-descargar si ya existe
        if (file_exists($dest_path)) {
            $downloaded++;
            continue;
        }

        $url = $base_url . $filename;
        $response = wp_remote_get($url, array('timeout' => 30));

        if (is_wp_error($response)) {
            $errors[] = "Failed: $filename - " . $response->get_error_message();
            continue;
        }

        $http_code = wp_remote_retrieve_response_code($response);
        if ($http_code !== 200) {
            $errors[] = "HTTP $http_code: $filename";
            continue;
        }

        $body = wp_remote_retrieve_body($response);
        if (empty($body)) {
            $errors[] = "Empty: $filename";
            continue;
        }

        file_put_contents($dest_path, $body);
        $downloaded++;
    }

    update_option('libros_covers_downloaded', '1');
    update_option('libros_covers_download_log', "Downloaded: $downloaded/" . count($files) .
        (empty($errors) ? '' : ' Errors: ' . implode(', ', $errors)));

    // Mostrar notificación
    add_action('admin_notices', function () use ($downloaded, $errors) {
        $class = empty($errors) ? 'notice-success' : 'notice-warning';
        echo "<div class='notice $class is-dismissible'>";
        echo "<p><strong>📥 Portadas descargadas:</strong> $downloaded imágenes bajadas desde GitHub.</p>";
        if (!empty($errors)) {
            echo "<p><small>Errores: " . esc_html(implode(', ', $errors)) . "</small></p>";
        }
        echo "</div>";
    });
});
